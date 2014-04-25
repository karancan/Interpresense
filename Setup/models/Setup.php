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
     * Creates database tables
     */
    public function createTables() {
        $tables = array(
            'interpresense_settings',
            'interpresense_users',
            'interpresense_service_provider_activities',
            'interpresense_service_provider_invoices',
            'interpresense_service_provider_invoice_items',
            'interpresense_service_provider_invoice_files',
            'interpresense_service_provider_invoices_notes',
            'interpresense_admin_report_templates',
            'interpresense_admin_reports'
        );
        
        // Drop tables in reverse order to avoid foreign key constraint errors
        $dropSql = 'DROP TABLE IF EXISTS ' . implode(',', array_reverse($tables)) . ';';
        parent::$db->db->exec($dropSql);
        
        foreach($tables as $table) {
            $sql = file_get_contents(FS_INCLUDES . "/sql/$table.sql");
            parent::$db->db->exec($sql);
        }
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