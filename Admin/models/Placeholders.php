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
    }
    
    /**
     * Retrieves all template placeholders pertaining to either emails, reports, or both
     * @param int $forEmails Fetch placeholders pertaining to email templates. Default is 0
     * @param int $forReports Fetch placeholders pertaining to report templates. Default is 0
     * @return array
     */
    public function fetchPlaceholders($forEmails = 1, $forReports = 1) {
        
        $tinyIntValidator = Validator::int()->in(array(0,1));
        
        if (!$tinyIntValidator->validate($forEmails) || !$tinyIntValidator->validate($forReports)){
            throw new \InvalidArgumentException('Cannot fetch placeholders with invalid filtering parameters');
        }
    
        $sql = 'SELECT `placeholder`, `description_en`, `description_fr`
                  FROM `interpresense_template_placeholders`
                 WHERE `for_emails` = :for_emails
                    OR `for_reports` = :for_reports;';
        
        $types = array(
            'for_emails' => \PDO::PARAM_INT,
            'for_reports' => \PDO::PARAM_INT
        );
        
        return parent::$db->query($sql, array('for_emails' => $forEmails, 'for_reports' => $forReports), $types);
    }
}