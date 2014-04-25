<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Class for handling email templates in Interpresense
 * @author Karan Khiani
 */
class Emails extends \Interpresense\Includes\BaseModel {
    
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
        
        //@todo: add constructor body
    }
    
    /**
     * Retrieves email templates
     * @return array
     */
    public function fetchEmailTemplates() {
        $sql = 'SELECT *
                  FROM `interpresense_email_templates`;';
        
        return parent::$db->query($sql);
    }
    
    /**
     * Updates an email template
     * @param array $data The POST data
     */
    public function updateEmailTemplate(array $data) {
        
        //@todo: add function body
        
    }
}