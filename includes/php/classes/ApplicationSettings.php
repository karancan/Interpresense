<?php

namespace Interpresense\Includes;

/**
 * Loads application settings from the database
 *
 * @author Vincent Diep
 */
class ApplicationSettings {
    
    /**
     * Retrieves settings from the database
     * @return array 
     */
    public static function load(DatabaseObject $db) {
        $settings = array();
        
        try {
            $stmt = $db->db->query('SELECT `setting_key`, `setting_value` FROM `interpresense_settings`');
            while($result = $stmt->fetch(\PDO::FETCH_OBJ)) {
                $settings[$result->setting_key] = $result->setting_value;
            }
            
        } catch (\PDOException $e) {
            // Table hasn't been created yet or some other error
        }
        
        return $settings;
    }
    
}