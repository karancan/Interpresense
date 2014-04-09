<?php

namespace Interpresense\ServiceProvider;

use Respect\Validation\Validator;

/**
 * This is an example model that will probably be changed later on
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
        
        $this->validators['invoice_uid'] = Validator::xdigit()->length(128, 128);
    }
    
    /**
     * Adds an invoice
     * @param array $data The POST data
     * @return int The newly created invoice ID
     * @todo
     */
    public function addInvoice(array $data) {
        
        // @todo figure out what the fields represent
        $types = array(
            'invoice_uid' => \PDO::PARAM_STR,
            'sp_name' => \PDO::PARAM_STR,
            'sp_address' => \PDO::PARAM_STR,
            'sp_phone' => \PDO::PARAM_STR,
            'sp_email' => \PDO::PARAM_STR,
            'student_num' => \PDO::PARAM_INT,
            'is_final' => \PDO::PARAM_INT,
            'grand_total' => \PDO::PARAM_STR
        );
        
        // @todo validators
        if(!Validator::key('sp_name')
               ->key('sp_phone')
               ->key('sp_email')
               ->key('student_num')
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data invalid or missing');
        }
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        $data['invoice_uid'] = hash('sha512', microtime(true) . mt_rand());
        
        // @todo amend query in accordance to understanding of the SQL
        $sql = "INSERT INTO `interpresense_service_provider_invoices` (`invoice_uid`, `sp_name`, `sp_address`, `sp_phone`, `sp_email`, `student_num`, `is_final`, `grand_total`, `inserted_on`, `updated_on`)
                     VALUES (:invoice_uid, :sp_name, :sp_address, :sp_phone, :sp_email, :student_num, :is_final, :grand_total, NOW(), NOW());";
        
        parent::$db->query($sql, $data, $types);
        
        return parent::$db->db->lastInsertId();
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
                   SET `is_final` = 1
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Loads a draft invoice
     * @param string $invoiceUID The invoice UID
     * @return array
     * @todo
     */
    public function loadDraftInvoice($invoiceUID) {
        
        if(!$this->validators['invoice_uid']->validate($invoiceUID)) {
            throw new \InvalidArgumentException('Invalid invoice UID');
        }
        
        if(!$this->getInvoiceDraftStatus($invoiceUID)) {
            throw new \RuntimeException('Cannot load a finalized invoice.');
        }
        
        $sql = "SELECT things
                  FROM `interpresense_service_provider_invoices`
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types);
        return $result[0];
    }
    
    /**
     * Retrieves the draft status of the invoice
     * @param string $invoiceUID The invoice UID
     * @return boolean TRUE if the invoice is a draft
     * 
     * @todo Untested
     */
    private function getInvoiceDraftStatus($invoiceUID) {
        $sql = "SELECT `is_final`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `invoice_uid` = :invoice_uid;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        
        // @TODO: What if the invoice UID does not exist?
        
        return $result[0] === 0;
    }
}