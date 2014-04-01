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
        
        // @todo More rules?
        $this->validators['username'] = Validator::string()->notEmpty();
    }
    
    /**
     * Generates a random string of characters to be used as a salt
     * @param int $length The length of the output (defaults to 22)
     * @return string
     */
    private function generateSalt($length = 22) {
        $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789.';
        $str = '';
        $count = mb_strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
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
        
        $sql = 'SELECT COUNT(*)
                  FROM `interpresense_users`
                 WHERE `user_name` = :username;';
        
        $data = array('username' => $username);
        $types = array('username' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        
        return $result > 0;
    }
    
    /**
     * Logins a user in
     * @todo Check is_confirmed?
     * @param string $username The username
     * @param string password The password
     * @return array
     */
    public function login($username, $password) {
        
        if(!$this->validators['username']->validate($username)) {
            throw new \InvalidArgumentException('Invalid username.');
        }
        
        $sql = 'SELECT `user_name`, `user_password`, `first_name`, `last_name`, `last_log_in`, `is_confirmed`
                  FROM `interpresense_users`
                 WHERE `user_name` = :username;';
        
        $data = array('username' => $username);
        $types = array('username' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types);
        
        if(!$this->passwordVerify($password, $result[0]['user_password'])) {
            return false;
        }
        
        unset($result[0]['user_password']);

        // Update the last log in
        $uSql = 'UPDATE `interpresense_users`
                    SET `last_log_in` = NOW()
                  WHERE `user_name` = :username;';

        parent::$db->query($uSql, $data, $types);

        return $result[0];
    }
    
    /**
     * Creates a user
     * @todo
     */
    public function createUser($data) {
        
    }
    
    /**
     * Confirms a user
     * @param string $username The username
     */
    public function confirmUser($username) {
        $data = array('is_confirmed' => 1);
        $types = array('is_confirmed' => \PDO::PARAM_INT);
        
        $username = parent::$db->db->quote($username);
        
        parent::$db->update('interpresense_users', $data, $types, "`user_name` = $username");
    }
    
    /**
     * Modifies a user
     * @todo
     */
    public function modifyUser($data) {
        
    }
    
    /**
     * Initiates a password reset request
     * @todo
     */
    public function requestPasswordReset($username) {
        
    }
    
    /**
     * Resets a user's password
     * @todo
     */
    public function resetPassword($username, $hash) {
        
    }
}