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
    
    /**
     * Replaces hashtags
     * @param string $content The content to replace
     * @param array $hashmap An associative array containing hashtags (keys) and replacement values (values)
     * @return string
     */
    protected function replaceHashtags($content, array $hashmap) {
        return str_replace(array_keys($hashmap), array_values($hashmap), $content);
    }
    
    /**
     * Replaces institution hashtags
     * @param string $content The content to replace (haystack)
     * @return string
     */
    public function replaceInstitutionHashtags($content) {
        $settings = \Interpresense\Includes\ApplicationSettings::load(parent::$db);
        
        if (!empty($settings)) {
            $hashmap = array(
                '#institutionName' => $settings['institution_name'],
                '#institutionEmail' => $settings['institution_email'],
                '#institutionPhone' => $settings['institution_phone'],
                '#institutionDeptName' => $settings['institution_dept_name'],
                '#institutionDeptContactName' => $settings['institution_dept_recipient_name'],
                '#institutionDeptContactEmail' => $settings['institution_dept_recipient_email'],
                '#institutionDeptContactPhone' => $settings['institution_dept_recipient_phone'],
                '#institutionDeptContactTitle' => $settings['institution_dept_recipient_title']
            );
            
            return $this->replaceHashtags($content, $hashmap);
        }
    }
    
    /**
     * Replaces user hashtags
     * @param string $content The content to replace (haystack)
     * @param int $userID The user ID. Defaults to the currently logged in user.
     * @return string
     */
    public function replaceUserHashtags($content, $userID = null) {
        if($userID === null) {
            $userID = $_SESSION['admin']['user_id'];
        }
        
        $usersModel = new Users(parent::$db);
        $user = $usersModel->fetchUserDetails($_SESSION['admin']['user_id']);
        
        if (!empty($user)) {
            $hashmap = array(
                '#adminUserName' => $user['user_name'],
                '#adminUserFirstName' => $user['first_name'],
                '#adminUserLastName' => $user['last_name'],
                '#adminUserAccountExpiresOn' => $user['expires_on'],
                '#adminUserAccountCreatedOn' => $user['created_on'],
                '#adminUserLastLogOn' => $user['last_log_in']
            );
            
            return $this->replaceHashtags($content, $hashmap);
        }
    }
    
    /**
     * Replaces invoice hashtags
     * @param string $content The content to replace (haystack)
     * @param int $invoiceID The invoice ID
     * @return string
     */
    public function replaceInvoiceHashtags($content, $invoiceID) {
        
        $invoiceModel = new \Interpresense\ServiceProvider\Invoice(parent::$db);
        $invoice = $invoiceModel->fetchInvoice($invoiceID);
        
        if (!empty($invoice)) {
            $hashmap = array(
                '#invoiceSpPhone' => $invoice['sp_phone'],
                '#invoiceSpEmail' => $invoice['sp_email'],
                '#invoiceSpHstNum' => $invoice['sp_hst_number'],
                '#invoiceIsFinal' => $invoice['is_final'],
                '#invoiceGrandTotal' => $invoice['grand_total'],
                '#invoiceIsApproved' => $invoice['is_approved'],
                '#invoiceApprovedBy' => $invoice['approver'],
                '#invoiceApprovedOn' => $invoice['approved_on']
            );
            
            return $this->replaceHashtags($content, $hashmap);
        }
    }
}