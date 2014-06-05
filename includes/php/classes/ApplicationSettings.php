<?php

namespace Interpresense\Includes;

/**
 * Loads application settings from the database
 *
 * @author Vincent Diep
 */
class ApplicationSettings {
    
    /**
     * The DatabaseObject
     * @var DatabaseObject
     */
    protected static $db;
    
    /**
     * Retrieves settings from the database
     * @return array 
     */
    public static function load(DatabaseObject $db) {
        static::$db = $db;
        
        $settings = array();
        
        if (!isset($_SESSION['lang']) || empty($_SESSION['lang'])) {
            $_SESSION['lang'] = static::getDefaultLanguage();
        }
        
        try {
            $sql = 'SELECT `setting_key_canonical`, `setting_value`, `setting_lang`
                      FROM `interpresense_settings`
                     WHERE `setting_lang` IS NULL
                        OR `setting_lang` = :lang;';
            
            $data = array('lang' => $_SESSION['lang']);
            $types = array('lang' => \PDO::PARAM_STR);
            
            $result = static::$db->query($sql, $data, $types, \PDO::FETCH_OBJ);
            
            foreach ($result as $s) {
                $settings[$s->setting_key_canonical] = $s->setting_value;
            }
            
        } catch (\PDOException $e) {
            // Table hasn't been created yet or some other error
        }
        
        return $settings;
    }
    
    /**
     * Retrieves the default language value from the database
     */
    protected static function getDefaultLanguage() {
        $sql = 'SELECT `setting_value`
                  FROM `interpresense_settings`
                 WHERE `setting_key_canonical` = "institution_default_lang";';

        return static::$db->db->query($sql)->fetchColumn();
    }
    
}