<?php

namespace Interpresense\Setup;

/**
 * Installation logic
 * @author Vincent Diep
 */
class Setup extends \Interpresense\Includes\BaseModel {
    
    /**
     * Constructor
     * @param \Interpresense\Includes\DatabaseObject $db A database object
     */
    public function __construct(\Interpresense\Includes\DatabaseObject $db) {
        parent::__construct($db);
    }
    
    /**
     * Accept EULA
     */
    public function acceptEula() {
        $sql = "UPDATE `interpresense_settings`
                   SET `setting_value` = '1'
                 WHERE `setting_key` = 'installation_accepted_eula';";
        
        parent::$db->query($sql);
    }
    
    /**
     * Finish installation process
     */
    public function finishInstallation() {
        $sql = "UPDATE `interpresense_settings`
                   SET `setting_value` = '1'
                 WHERE `setting_key` = 'installation_complete';";
        
        parent::$db->query($sql);
    }
}