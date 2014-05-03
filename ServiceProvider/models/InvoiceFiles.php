<?php

namespace Interpresense\ServiceProvider;

use Respect\Validation\Validator;

/**
 * Invoice files logic
 * @author Karan Khiani
 */
class InvoiceFiles extends \Interpresense\Includes\BaseModel {
    
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
        
        $this->validators['file_id'] = Validator::noWhitespace()->digit()->positive();
        $this->validators['invoice_id'] = Validator::notEmpty()->noWhitespace()->digit()->positive();
        $this->validators['file_name'] = Validator::notEmpty()->string();
        $this->validators['file_content'] = Validator::notEmpty()->string(); //@todo: not sure about this one
        $this->validators['file_type'] = Validator::notEmpty()->string();
        $this->validators['file_size'] = Validator::notEmpty()->int();
    }
    
    /**
     * Fetches files for a given invoice
     * @param int $invoiceID The invoice ID
     * @param boolean $idsOnly Fetch file IDs only. Default is FALSE
     * @return array
     */
    public function fetchFiles($invoiceID, $idsOnly = false) {
        
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT `file_id`";
        
        if(!$idsOnly) {
            $sql .= ", `file_name`, `file_content`, `file_type`, `file_size`, `inserted_on`";
        }
        
        $sql .= " FROM `interpresense_service_provider_invoice_files`
                 WHERE `invoice_id` = :invoice_id";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Fetches the number of files for a given invoice
     * @param int $invoiceID The invoice ID
     * @return int The number of files
     */
    public function fetchFilesCount($invoiceID) {
        
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT COUNT(file_id) AS count
                  FROM `interpresense_service_provider_invoice_files`
                 WHERE `invoice_id` = :invoice_id";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        return $result[0];
    }
    
    /**
     * Adds invoice files
     * @param int $invoiceID The invoice ID
     */
    public function addFiles($invoiceID) {
        
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "";
        
        //@todo
    }
    
    /**
     * Deletes a file
     * @param int $fileID The file ID
     */
    public function deleteFile($fileID) {
        
        if(!$this->validators['file_id']->validate($fileID)) {
            throw new \InvalidArgumentException('Invalid file ID.');
        }
        
        $sql = "DELETE FROM `interpresense_service_provider_invoice_files`
                      WHERE `file_id` = :file_id;";
        
        $data = array('file_id' => $fileID);
        $types = array('file_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }
}