<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Class for handling reports generated and report templates templates in Interpresense
 * @author Karan Khiani
 */
class Reports extends \Interpresense\Includes\BaseModel {
    
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
        
        //@todo: add validators
    }
    
    /**
     * Retrieves reports generated
     * @return array
     */
    public function fetchReportsGenerated() {
        $sql = 'SELECT r.report_id, r.report_name, r.inserted_on, t.name AS template_name,
                       CONCAT(u.first_name, " ", u.last_name) AS emp_name
                  FROM `interpresense_admin_reports` r
                  JOIN `interpresense_admin_report_templates` t
                    ON r.template_id = t.template_id
                  JOIN `interpresense_users` u
                    ON r.generated_by = u.user_id
                 WHERE r.is_deleted = 0;';
        
        return parent::$db->query($sql);
    }
    
    /**
     * Retrieves report templates
     * @return array
     */
    public function fetchReportTemplates() {
        $sql = 'SELECT t.name, t.description, t.inserted_on, t.template_id, t.content,
                       CONCAT(u.first_name, " ", u.last_name) AS emp_name
                  FROM `interpresense_admin_report_templates` t
                  JOIN `interpresense_users` u
                    ON t.user_id = u.user_id
                 WHERE t.is_deleted = 0;';
        
        return parent::$db->query($sql);
    }
    
    /**
     * Retrieves a report
     * @param int $reportID The report ID
     * @return array
     */
    public function fetchReport($reportID) {
        $sql = "SELECT `generated_by`, `report_name`, `report_content`, `report_file_type`, `report_file_size`, `inserted_on`, `updated_on`
                  FROM `interpresense_admin_reports`
                 WHERE `report_id` = :report_id
                   AND `is_deleted` = 0;";
        
        $data = array('report_id' => $reportID);
        $types = array('report_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Marks a report as deleted
     * @param int $reportID The report ID
     */
    public function deleteReport($reportID) {
        $sql = "UPDATE `interpresense_admin_reports`
                   SET `is_deleted` = 1, `updated_on` = NOW()
                 WHERE `report_id` = :report_id;";
        
        $data = array('report_id' => $reportID);
        $types = array('report_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }
    
}