<?php

namespace Interpresense\ServiceProvider;

use Respect\Validation\Validator;

/**
 * Invoice logic
 * @author Vincent Diep
 */
class Invoice extends \Interpresense\Includes\BaseModel {
    
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
        
        // @todo Validation rules
        $this->validators['invoice_uid'] = Validator::xdigit()->length(128, 128);
    }
    
    /**
     * Adds an invoice
     * @param array $data The POST data
     * @param boolean $final Whether the new invoice is a draft or is a final copy
     * @return int The newly created invoice ID
     */
    public function addInvoice(array $data, $final = true) {
        
        $types = array(
            'invoice_uid' => \PDO::PARAM_STR,
            'invoice_id_for_sp' => \PDO::PARAM_STR,
            'invoice_id_for_org' => \PDO::PARAM_STR,
            'sp_name' => \PDO::PARAM_STR,
            'sp_address' => \PDO::PARAM_STR,
            'sp_postal_code' => \PDO::PARAM_STR,
            'sp_city' => \PDO::PARAM_STR,
            'sp_province' => \PDO::PARAM_STR,
            'sp_phone' => \PDO::PARAM_STR,
            'sp_email' => \PDO::PARAM_STR,
            'client_id' => \PDO::PARAM_STR,
            'is_final' => \PDO::PARAM_INT,
            'grand_total' => \PDO::PARAM_STR
        );
        
        // Validation
        if(!Validator::key('sp_name')
               ->key('sp_phone')
               ->key('sp_email')
               ->key('client_id')
               ->validate($data) || !Validator::bool()->validate($final)) {
            throw new \InvalidArgumentException('Required data invalid or missing');
        }
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        // Janitization
        $data['sp_phone'] = preg_replace('/[[:^digit:]]/i', '', $data['sp_phone']);
        
        $data['invoice_uid'] = hash('sha512', microtime(true) . mt_rand());
        $data['is_final'] = (int)$final;
        
        $sql = "INSERT INTO `interpresense_service_provider_invoices` (`invoice_uid`, `invoice_id_for_sp`, `invoice_id_for_org`, `sp_name`, `sp_address`, `sp_postal_code`, `sp_city`, `sp_province`, `sp_phone`, `sp_email`, `client_id`, `is_final`, `grand_total`, `inserted_on`, `updated_on`)
                     VALUES (:invoice_uid, :invoice_id_for_sp, :invoice_id_for_org, :sp_name, :sp_address, :sp_postal_code, :sp_city, :sp_province, :sp_phone, :sp_email, :client_id, :is_final, :grand_total, NOW(), NOW());";
        
        parent::$db->query($sql, $data, $types);
        
        return parent::$db->db->lastInsertId();
    }
    
    /**
     * Retrieves an invoice ID given an invoice UID
     * @param string $invoiceUID The invoice UID
     * @return null|int The ID of the invoice, or NULL if it does not exist.
     */
    public function getInvoiceIdFromUid($invoiceUID) {
        
        if(!$this->validators['invoice_uid']->validate($invoiceUID)) {
            throw new \InvalidArgumentException('Invalid invoice UID');
        }
        
        $sql = "SELECT `invoice_id`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        
        if(empty($result)) {
            return null;
        }
        
        return (int)reset($result);
    }
    
    /**
     * Marks a draft invoice as final
     * @param string $invoiceUID The invoice UID
     */
    public function finalizeDraftInvoice($invoiceUID) {
        
        if(!$this->validators['invoice_uid']->validate($invoiceUID)) {
            throw new \InvalidArgumentException('Invalid invoice UID');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `is_final` = 1, `updated_on` = NOW()
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Loads a draft invoice
     * @param string $invoiceUID The invoice UID
     * @return array
     */
    public function loadDraftInvoice($invoiceUID) {
        
        if(!$this->validators['invoice_uid']->validate($invoiceUID)) {
            throw new \InvalidArgumentException('Invalid invoice UID');
        }
        
        if(!$this->getInvoiceDraftStatus($invoiceUID)) {
            throw new \RuntimeException('Cannot load a finalized invoice.');
        }
        
        $sql = "SELECT `invoice_id`, `sp_name`, `sp_address`, `sp_email`, `client_id`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types);
        return reset($result);
    }
    
    /**
     * Updates a draft invoice
     * @param array $data The POST data
     */
    public function updateDraftInvoice(array $data) {
        $types = array(
            'invoice_uid' => \PDO::PARAM_STR,
            'sp_name' => \PDO::PARAM_STR,
            'sp_address' => \PDO::PARAM_STR,
            'sp_phone' => \PDO::PARAM_STR,
            'sp_email' => \PDO::PARAM_STR,
            'client_id' => \PDO::PARAM_STR,
            'is_final' => \PDO::PARAM_INT,
            'grand_total' => \PDO::PARAM_STR
        );
        
        // @todo Add validation
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `sp_name` = :sp_name, `sp_address` = :sp_address, `sp_phone` = :sp_phone, `sp_email` = :sp_email, `client_id` = :client_id, `grand_total` = :grand_total, `updated_on` = NOW()
                 WHERE `invoice_uid` = :invoice_uid;";
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves the draft status of the invoice
     * @param string $invoiceUID The invoice UID
     * @return boolean TRUE if the invoice is a draft
     */
    private function getInvoiceDraftStatus($invoiceUID) {
        $sql = "SELECT `is_final`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        
        if(empty($result)) {
            throw new \RuntimeException('Requested invoice does not exist.');
        }
        
        return reset($result) === '0';
    }
}