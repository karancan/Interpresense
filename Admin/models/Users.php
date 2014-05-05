<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Class for handling users in Interpresense
 * @author Vincent Diep
 */
class Users extends \Interpresense\Includes\BaseModel {
    
    /**
     * Validation rules
     * @var Validator[]
     */
    protected $validators = array();
    
    /**
     * Constructor
     * @param \Interpresense\Includes\DatabaseObject $db A database object
     */
    public function __construct(\Interpresense\Includes\DatabaseObject $db) {
        parent::__construct($db);
        
        $today = new \DateTime();
        
        $this->validators['user_id'] = Validator::notEmpty()->noWhitespace()->digit()->positive();
        $this->validators['username'] = Validator::notEmpty()->string()->alnum();
        $this->validators['user_password_reset_key'] = Validator::notEmpty()->length(64, 64)->xdigit();
        $this->validators['first_name'] = Validator::notEmpty()->string()->regex('/^[\w .\'-]+$/');
        $this->validators['last_name'] = Validator::notEmpty()->string()->regex('/^[\w .\'-]+$/');
        $this->validators['expires_on'] = Validator::notEmpty()->date('Y-m-d')->min($today->format('Y-m-d'), true);
    }
    
    /**
     * Generates a random string of characters to be used as a salt
     * @param int $length The length of the output (defaults to 22)
     * @return string
     */
    private function generateSalt($length = 22) {
        $salt_charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.';
        $str = '';
        $count = mb_strlen($salt_charset);
        while ($length--) {
            $str .= $salt_charset[mt_rand(0, $count-1)];
        }
        return $str;
    }
    
    /**
     * Generates a hashed password using bcrypt
     * @param string $password The password to hash
     * @return string
     */
    private function passwordHash($password) {
        return crypt($password, '$2a$07$' . $this->generateSalt());
    }
    
    /**
     * Verifies a given password with a hash
     * @link https://github.com/ircmaxell/password_compat/blob/master/lib/password.php Taken from password_compat
     * 
     * @param string $password The password to check
     * @param string $hash The hash to check against
     * @return boolean
     */
    private function passwordVerify($password, $hash) {
        // The salt does not need to be extracted because characters
        // beyond that point is truncated by crypt
        $checkAgainst = crypt($password, $hash);
        
        // Bitwise operations are used to prevent timing attacks
        $status = 0;
        for ($i = 0, $length = mb_strlen($checkAgainst); $i < $length; ++$i) {
            $status |= (ord($checkAgainst[$i]) ^ ord($hash[$i]));
        }
        
        return $status === 0;
    }

    /**
     * Checks if a username exists
     * @param string $username The username to check
     * @return boolean
     */
    public function userExists($username) {
        
        if(!$this->validators['username']->validate($username)) {
            throw new \InvalidArgumentException('Invalid username.');
        }
        
        $sql = 'SELECT COUNT(*)
                  FROM `interpresense_users`
                 WHERE `user_name` = :username;';
        
        $data = array('username' => $username);
        $types = array('username' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        
        return $result[0] > 0;
    }
    
    /**
     * Logins a user in
     * @param string $username The username
     * @param string password The password
     * @return array|boolean Returns the user details, or FALSE on failure
     */
    public function login($username, $password) {
        
        if(!$this->userExists($username)) {
            return false;
        }
        
        $sql = 'SELECT `user_id`, `user_password`, `first_name`, `last_name`, `last_log_in`, `expires_on`, `is_confirmed`
                  FROM `interpresense_users`
                 WHERE `user_name` = :username;';
        
        $data = array('username' => $username);
        $types = array('username' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types);
        
        if(!$this->passwordVerify($password, $result[0]['user_password'])) {
            return false;
        }
        
        unset($result[0]['user_password']);
        
        $result[0]['expires_on'] = new \DateTime($result[0]['expires_on']);

        // Update the last log in only if user is already confirmed
        if ($result[0]['is_confirmed'] === '1' && $result[0]['expires_on'] > new \DateTime()) {
            $uSql = 'UPDATE `interpresense_users`
                        SET `last_log_in` = NOW()
                      WHERE `user_name` = :username;';

            parent::$db->query($uSql, $data, $types);
        }
        
        return reset($result);
    }
    
    /**
     * Creates a user
     * @param array $data The POST data
     */
    public function createUser(array $data) {
        $types = array(
            'user_uid' => \PDO::PARAM_STR,
            'user_name' => \PDO::PARAM_STR,
            'first_name' => \PDO::PARAM_STR,
            'last_name' => \PDO::PARAM_STR,
            'expires_on' => \PDO::PARAM_STR
        );
        
        if(!Validator::key('user_name', $this->validators['username'])
                ->key('first_name', $this->validators['first_name'])
                ->key('last_name', $this->validators['last_name'])
                ->key('expires_on', $this->validators['expires_on'])
                ->validate($data)) {
            throw new \InvalidArgumentException('Required data invalid or missing');
        }
        
        $data['user_uid'] = hash('sha512', microtime(true) . mt_rand());
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        $sql = 'INSERT INTO `interpresense_users` (`user_uid`, `user_name`, `first_name`, `last_name`, `created_on`, `updated_on`, `expires_on`)
                     VALUES (:user_uid, :user_name, :first_name, :last_name, NOW(), NOW(), :expires_on);';
        parent::$db->query($sql, $data, $types);
        return parent::$db->db->lastInsertId();
    }
    
    /**
     * Confirms a user
     * @param string $username The username
     */
    public function confirmUser($username) {
        
        if(!$this->userExists($username)) {
            throw new Exception('User does not exist.');
        }
        
        $sql = "UPDATE `interpresense_users`
                   SET `is_confirmed` = 1
                 WHERE `user_name` = :user_name;";

        $data = array('user_name' => $username);
        $types = array('user_name' => \PDO::PARAM_STR);
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Fetches a list of users
     * @return array
     */
    public function fetchUsers() {
        $sql = "SELECT `user_id`, `user_name`, `first_name`, `last_name`, `created_on`, `expires_on`, `is_confirmed`, `last_log_in`
                  FROM `interpresense_users`;";
        
        return parent::$db->query($sql);
    }
    
    /**
     * Update user details
     * @param array $data The POST data
     */
    public function updateUser(array $data) {
        
        $types = array(
            'user_id' => \PDO::PARAM_INT,
            'user_name' => \PDO::PARAM_STR,
            'first_name' => \PDO::PARAM_STR,
            'last_name' => \PDO::PARAM_STR,
            'expires_on' => \PDO::PARAM_STR
        );
        
        if (!Validator::key('user_id', $this->validators['user_id'])
                ->key('user_name', $this->validators['username'])
                ->key('first_name', $this->validators['first_name'])
                ->key('last_name', $this->validators['last_name'])
                ->key('expires_on', $this->validators['expires_on'])
                ->validate($data)) {
            throw new \InvalidArgumentException('Required data missing or invalid.');
        }
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        $sql = "UPDATE `interpresense_users`
                   SET `first_name` = :first_name, `last_name` = :last_name, `updated_on` = NOW(), `expires_on` = :expires_on, `user_name` = :user_name
                WHERE `user_id` = :user_id;";
        
        parent::$db->query($sql, $data, $types);
        
        return $data['user_id'];
    }
    
    /**
     * Initiates a password reset request
     * @param string $username The username
     * @param string $newPassword The new password
     * @return string Returns the reset key if successful
     */
    public function requestPasswordReset($username, $newPassword) {
        if(!$this->userExists($username)) {
            throw new \Exception('User does not exist.');
        }
        
        $resetHash = hash('sha256', microtime(true) . mt_rand());
        
        $sql = "UPDATE `interpresense_users`
                   SET `user_password_reset_key` = :user_password_reset_key, `user_password_reset_password` = :user_password_reset_password
                 WHERE `user_name` = :user_name;";
        
        $data = array(
            'user_name' => $username,
            'user_password_reset_key' => $resetHash,
            'user_password_reset_password' => $this->passwordHash($newPassword)
        );
        
        $types = array(
            'user_name' => \PDO::PARAM_STR,
            'user_password_reset_key' => \PDO::PARAM_STR,
            'user_password_reset_password' => \PDO::PARAM_STR
        );
        
        if(parent::$db->query($sql, $data, $types)) {
            return $resetHash;
        }
    }
    
    /**
     * Resets a user's password
     * @param string $username The username
     * @param string $hash The password reset key
     * @return boolean
     */
    public function confirmPasswordReset($username, $hash) {
        
        if (!$this->userExists($username)) {
            throw new \Exception('User does not exist.');
        }
        
        if(!$this->validators['user_password_reset_key']->validate($hash)) {
            throw new \InvalidArgumentException('Invalid reset key');
        }     
        
        $sql = "UPDATE `interpresense_users`
                   SET `user_password` = `user_password_reset_password`,
                       `user_password_reset_key` = NULL,
                       `user_password_reset_password` = NULL,
                       `updated_on` = NOW()
                 WHERE `user_name` = :username
                   AND `user_password_reset_key` = :user_password_reset_key;";
        
        $data = array(
            'username' => $username,
            'user_password_reset_key' => $hash
        );
        
        $types = array(
            'username' => \PDO::PARAM_STR,
            'user_password_reset_key' => \PDO::PARAM_STR
        );
        
        return (bool)parent::$db->query($sql, $data, $types);
    }
}