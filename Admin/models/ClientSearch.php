<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Client search logic
 * @author Karan Khiani
 */
class ClientSearch extends \Interpresense\Includes\BaseModel {
    
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
        
        $this->validators['client_num'] = Validator::noWhitespace()->digit()->positive();
    }
    
    /**
     * Retrieves a list of all finalized invoices pertaining to a client
     * @param $clientID The ID of a client
     * @return array
     */
    public function fetchFinalizedInvoices($clientID) {
        $sql = "SELECT `invoice_id`, `sp_name`, `sp_email`, `is_approved`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 1
                   AND `client_num` = :client_num;";
        
        $data = array('client_num' => $clientID);
        $types = array('client_num' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves a list of all draft invoices pertaining to a client
     * @param $clientID The ID of a client
     * @return array
     */
    public function fetchDraftInvoices($clientID) {
        $sql = "SELECT `invoice_id`, `sp_name`, `sp_email`, `is_approved`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 0
                   AND `client_num` = :client_num;";
        
        $data = array('client_num' => $clientID);
        $types = array('client_num' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
}
