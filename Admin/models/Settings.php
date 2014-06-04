<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Class for manipulating application settings
 * @author Vincent
 */
class Settings extends \Interpresense\Includes\BaseModel {
    
    /**
     * Constructor
     * @param \Interpresense\Includes\DatabaseObject $db A database object
     */
    public function __construct(\Interpresense\Includes\DatabaseObject $db) {
        parent::__construct($db);
    }
    
    /**
     * Retrieves settings
     * @return array
     */
    public function fetchSettings() {
        $sql = 'SELECT `setting_key`, `setting_key_canonical`, `setting_value`, `setting_lang`, `description_en`, `description_fr`
                  FROM `interpresense_settings`
                 WHERE `internal_use` = 0;';
        
        return parent::$db->query($sql);
    }
    
    /**
     * Creates or updates a setting
     * @param string $key The key of the setting
     * @param string $value The value
     */
    public function changeSetting($key, $value) {
        
        if(!Validator::string()->validate($key)) {
            throw new \InvalidArgumentException('Setting name must be a string.');
        }
        
        $sql = 'INSERT INTO `interpresense_settings` ( `setting_key`, `setting_value`, `inserted_on`, `updated_on`)
                     VALUES (:setting_key, :setting_value, NOW(), NOW())
    ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`),
                               `updated_on` = NOW();';
        
        $data = array(
            'setting_key' => $key,
            'setting_value' => $value
        );
        
        $types = array(
            'setting_key' => \PDO::PARAM_STR,
            'setting_value' => \PDO::PARAM_STR
        );
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Deletes a setting
     * @param string $key The key of the setting
     */
    public function deleteSetting($key) {
        
        if(!Validator::string()->validate($key)) {
            throw new \InvalidArgumentException('Setting name must be a string.');
        }
        
        $key = parent::$db->db->quote($key);
        
        parent::$db->delete('interpresense_settings', "`setting_key` = $key AND `internal_use` = 0");
    }
}