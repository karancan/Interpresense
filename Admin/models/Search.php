<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Search logic
 * @author Karan Khiani
 */
class Search extends \Interpresense\Includes\BaseModel {
    
    /**
     * Validation objects
     * @var Validator[]
     */
    protected $validators = array();

    /**
     * Constructor
     * @param \Interpresense\Includes\DatabaseObject $db A database object
     */
    public function __construct(\Interpresense\Includes\DatabaseObject $db) {
        parent::__construct($db);
        
        $this->validators['client_id'] = Validator::notEmpty()->string();
        $this->validators['sp_name'] = Validator::notEmpty()->string();
        $this->validators['sp_email'] = Validator::notEmpty()->email();
        $this->validators['sp_hst_number'] = Validator::notEmpty()->string();
    }
    
    /**
     * Retrieves a list of all finalized invoices pertaining to a client
     * @param string $q The ID of a client
     * @return array
     */
    public function fetchFinalizedInvoicesForClient($q) {
        $sql = "SELECT `invoice_id`, `invoice_id_for_org`, `sp_name`, `sp_email`, `sp_hst_number`,
                       `is_approved`, `client_id`, `grand_total`, `is_approved`, `inserted_on`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 1
                   AND `is_confirmed` = 1
                   AND `client_id` LIKE :client_id;";
        
        $data = array('client_id' => $q . '%');
        $types = array('client_id' => \PDO::PARAM_STR);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves a list of all finalized invoices pertaining to a service provider
     * @param string $q The query string
     * @return array
     */
    public function fetchFinalizedInvoicesForServiceProvider($q) {
        $sql = "SELECT `invoice_id`, `invoice_id_for_org`, `sp_name`, `sp_email`, `sp_hst_number`,
                       `is_approved`, `client_id`, `grand_total`, `is_approved`, `inserted_on`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 1
                   AND `is_confirmed` = 1
                   AND (`sp_name` LIKE :sp_name
                    OR `sp_email` LIKE :sp_email
                    OR `sp_hst_number` LIKE :sp_hst_number
                    OR `sp_phone` LIKE :sp_phone);";
        
        $data = array('sp_name' => '%' . $q . '%', 'sp_email' => '%' . $q . '%', 'sp_hst_number' => '%' . $q . '%', 'sp_phone' => '%' . $q . '%');
        $types = array('sp_name' => \PDO::PARAM_STR, 'sp_email' => \PDO::PARAM_STR, 'sp_hst_number' => \PDO::PARAM_STR, 'sp_phone' => \PDO::PARAM_STR);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves a list of all draft invoices pertaining to a client
     * @param string $q The ID of a client
     * @return array
     */
    public function fetchDraftInvoicesForClient($q) {
        $sql = "SELECT `invoice_id`, `invoice_id_for_org`, `sp_name`, `sp_email`, `sp_hst_number`,
                       `is_approved`, `client_id`, `grand_total`, `is_approved`, `inserted_on`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 0
                   AND `is_confirmed` = 1
                   AND `client_id` LIKE :client_id;";
        
        $data = array('client_id' => $q . '%');
        $types = array('client_id' => \PDO::PARAM_STR);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves a list of all draft invoices pertaining to a service provider
     * @param $q The query string
     * @return array
     */
    public function fetchDraftInvoicesForServiceProvider($q) {
        $sql = "SELECT `invoice_id`, `invoice_id_for_org`, `sp_name`, `sp_email`, `sp_hst_number`,
                       `is_approved`, `client_id`, `grand_total`, `is_approved`, `inserted_on`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 0
                   AND `is_confirmed` = 1
                   AND (`sp_name` LIKE :sp_name
                    OR `sp_email` LIKE :sp_email
                    OR `sp_hst_number` LIKE :sp_hst_number
                    OR `sp_phone` LIKE :sp_phone);";
        
        $data = array('sp_name' => '%' . $q . '%', 'sp_email' => '%' . $q . '%', 'sp_hst_number' => '%' . $q . '%', 'sp_phone' => '%' . $q . '%');
        $types = array('sp_name' => \PDO::PARAM_STR, 'sp_email' => \PDO::PARAM_STR, 'sp_hst_number' => \PDO::PARAM_STR, 'sp_phone' => \PDO::PARAM_STR);
        
        return parent::$db->query($sql, $data, $types);
    }
    
}
