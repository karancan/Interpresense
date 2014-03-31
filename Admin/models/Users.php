<?php

namespace Interpresense\Admin;

/**
 * Class for handling users in Interpresense
 * @author Vincent Diep
 */
class Users extends \Interpresense\Includes\BaseModel {
    
    /**
     * Constructor
     * @param \Interpresense\Includes\DatabaseObject $db A database object
     */
    public function __construct(\Interpresense\Includes\DatabaseObject $db) {
        parent::__construct($db);
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
     * @todo
     * @return array
     */
    public function login($username, $password) {
        
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