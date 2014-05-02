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
        
        $this->validators['subject'] = Validator::notEmpty()->string();
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
        
        if(!Validator::key('email_id', $this->validators['email_id'])
               ->key('subject', $this->validators['subject'])
               ->key('cc', $this->validators['cc'])
               ->key('bcc', $this->validators['bcc'])
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data missing or invalid.');
        }
        
        $sql = 'UPDATE `interpresense_email_templates`
                   SET `subject` = :subject, `cc` = :cc, `bcc` = :bcc, `content` = :content
                 WHERE `email_id` = :email_id;';
        
        $types = array(
            'subject' => \PDO::PARAM_STR,
            'cc' => \PDO::PARAM_STR,
            'bcc' => \PDO::PARAM_STR,
            'content' => \PDO::PARAM_STR,
            'email_id' => \PDO::PARAM_INT
        );
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        parent::$db->query($sql, $data, $types);
        
    }
}