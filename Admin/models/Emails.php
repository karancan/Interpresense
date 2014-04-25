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
        
        $this->validators['cc'] = Validator::email();
        $this->validators['bcc'] = Validator::email();
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
        
        $sql = 'UPDATE `interpresense_email_templates`
                   SET cc = :cc, bcc = :bcc, content = :content
                 WHERE `email_id` = :email_id;';
        
        $types = array(
            'cc' => \PDO::PARAM_STR,
            'bcc' => \PDO::PARAM_STR,
            'content' => \PDO::PARAM_STR,
            'email_id' => \PDO::PARAM_INT
        );
        
        parent::$db->query($sql, $data, $types);
        
    }
}