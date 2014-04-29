<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Class for handling template placeholders in Interpresense
 * @author Karan Khiani
 */
class Placeholders extends \Interpresense\Includes\BaseModel {
    
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
        
        //@todo: `forEmails` and `forReports`
    }
    
    /**
     * Retrieves all template placeholders pertaining to either emails, reports, or both
     * @param int $forEmails Fetch placeholders pertaining to email templates. Default is 0
     * @param int $forReports Fetch placeholders pertaining to report templates. Default is 0
     * @return array
     */
    public function fetchPlaceholders($forEmails = 0, $forReports = 0) {
        
        //@todo: validate parameters
    
        $sql = 'SELECT `placeholder`, `description_en`, `description_fr`
                  FROM `interpresense_template_placeholders`
                 WHERE `for_emails` = :for_emails
                   AND `for_reports` = :for_reports;';
        
        return parent::$db->query($sql);
    }
}