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
     * Replaces static hashtags (values available at initialization time)
     * @param string $content The content to replace (haystack)
     * @param array $hashtags The hashtags to replace. Defaults to all known hashtags.
     * @return string
     */
    public function replaceStaticHashtags($content, array $hashtags = null) {
        $settings = \Interpresense\Includes\ApplicationSettings::load(parent::$db);
        $users = new Users(parent::$db);
        $adminUser = $users->fetchUserDetails($_SESSION['admin']['user_id']);
        
        $needles = array(
            '#institutionName' => $settings['institution_name'],
            '#institutionEmail' => $settings['institution_email'],
            '#institutionPhone' => $settings['institution_phone'],
            '#institutionDeptName' => $settings['institution_dept_name'],
            '#institutionDeptContactName' => $settings['institution_dept_recipient_name'],
            '#institutionDeptContactEmail' => $settings['institution_dept_recipient_email'],
            '#institutionDeptContactPhone' => $settings['institution_dept_recipient_phone'],
            '#institutionDeptContactTitle' => $settings['institution_dept_recipient_title'],
            '#adminUserName' => $adminUser['user_name'],
            '#adminUserFirstName' => $adminUser['first_name'],
            '#adminUserLastName' => $adminUser['last_name'],
            '#adminUserAccountExpiresOn' => $adminUser['expires_on'],
            '#adminUserAccountCreatedOn' => $adminUser['created_on'],
            '#adminUserLastLogOn' => $adminUser['last_log_in']
        );
        
        if ($hashtags !== null) {
            // Eliminate the hashtags that are not to be replaced
            // Extraneous hashtags in $hashtags will also be eliminated
            $needles = array_intersect_key($needles, array_flip($hashtags));
        }
        
        return str_replace(array_keys($needles), array_values($needles), $content);
    }
    
    /**
     * Replaces dynamic hashtags (values only available at runtime)
     * @param string $content The content to replace (haystack)
     * @param array $hashmap An associative array containing hashtags (keys) and replacement values (values)
     * @return string
     */
    public function replaceDynamicHashtags($content, array $hashmap) {
        
        // Enforce hashtag integrity
        $hashtags = array(
            '#invoiceSpPhone',
            '#invoiceSpEmail',
            '#invoiceSpHstNum',
            '#invoiceIsFinal',
            '#invoiceGrandTotal',
            '#invoiceIsApproved',
            '#invoiceApprovedBy',
            '#invoiceApprovedOn'
        );
        
        // Remove invalid hashtags
        $hashmap = array_intersect_key($hashmap, array_flip($hashtags));
        
        return str_replace(array_keys($hashmap), array_values($hashmap), $content);
    }
}