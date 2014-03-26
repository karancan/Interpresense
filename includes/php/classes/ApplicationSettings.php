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
        
        foreach($db->query('SELECT `setting_key`, `setting_value` FROM `interpresense_settings`', array(), array(), \PDO::FETCH_OBJ) as $s) {
            $settings[$s->setting_key] = $s->setting_value;
        }
        
        return $settings;
    }
    
}