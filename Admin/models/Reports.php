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
        $sql = 'SELECT *
                  FROM `interpresense_admin_reports`
                 WHERE `is_deleted` = 0;';
        
        return parent::$db->query($sql);
    }
    
    /**
     * Retrieves report templates
     * @return array
     */
    public function fetchReportTemplates() {
        $sql = 'SELECT *
                  FROM `interpresense_admin_report_templates`
                 WHERE `is_deleted` = 0;';
        
        return parent::$db->query($sql);
    }
    
}