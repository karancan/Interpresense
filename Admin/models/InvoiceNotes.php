<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Class for handling notes for invoices
 * @author Vincent Diep
 */
class InvoiceNotes extends \Interpresense\Includes\BaseModel {

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
        
        $this->validators['note_id'] = Validator::noWhitespace()->digit()->positive();
        $this->validators['invoice_id'] = Validator::notEmpty()->noWhitespace()->digit()->positive();
        $this->validators['note'] = Validator::notEmpty()->string();
    }
    
    /**
     * Adds a note to an invoice
     * @param array $data The POST data
     */
    public function addNote(array $data) {
        
        if(!Validator::key('invoice_id', $this->validators['invoice_id'])
               ->key('note', $this->validators['note'])
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data missing or invalid.');
        }
        
        $sql = "INSERT INTO `interpresense_service_provider_invoices_notes` (`invoice_id`, `user_id`, `note`, `inserted_on`, `updated_on`)
                     VALUES (:invoice_id, :user_id, :note, NOW(), NOW());";
        
        $types = array(
            'invoice_id' => \PDO::PARAM_INT,
            'user_id' => \PDO::PARAM_INT,
            'note' => \PDO::PARAM_STR
        );
        
        $data = parent::$db->pick(array_keys($types), $data);
        $data['user_id'] = $_SESSION['user_id'];
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Fetches all notes associated with an invoice
     * @param int $invoiceID The invoice ID
     * @return array
     */
    public function fetchNotes($invoiceID) {
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT `note_id`, `note`, `inserted_on`
                  FROM `interpresense_service_provider_invoices_notes`
                 WHERE `invoice_id` = :invoice_id
                   AND `is_deleted` = 0";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Fetches the number of notes associated with an invoice
     * @param int $invoiceID The invoice ID
     * @return int The number of notes
     */
    public function fetchNotesCount($invoiceID) {
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT COUNT(note_id) AS count
                  FROM `interpresense_service_provider_invoices_notes`
                 WHERE `invoice_id` = :invoice_id
                   AND `is_deleted` = 0;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
    }
    
    /**
     * Updates an invoice note
     * @param array $data The POST data
     */
    public function updateNote(array $data) {
        if(!Validator::key('note_id', $this->validators['note_id'])
               ->key('invoice_id', $this->validators['invoice_id'])
               ->key('note', $this->validators['note'])
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data missing or invalid.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices_notes`
                   SET `invoice_id` = :invoice_id, `user_id` = :user_id, `note` = :note, `updated_on` = NOW()
                 WHERE `note_id` = :note_id;";
        
        $types = array(
            'note_id' => \PDO::PARAM_INT,
            'invoice_id' => \PDO::PARAM_INT,
            'user_id' => \PDO::PARAM_INT,
            'note' => \PDO::PARAM_STR
        );
        
        $data = parent::$db->pick(array_keys($types), $data);
        $data['user_id'] = $_SESSION['user_id'];
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Marks a note as deleted
     * @param int $noteID The invoice note ID
     */
    public function deleteNote($noteID) {
        if(!$this->validators['note_id']->validate($noteID)) {
            throw new \InvalidArgumentException('Invalid note ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices_notes`
                   SET `is_deleted` = 1, `updated_on` = NOW()
                 WHERE `note_id` = :note_id;";
        
        $data = array('note_id' => $noteID);
        $types = array('note_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Deletes all notes associated with an invoice
     * @param int $invoiceID The invoice ID
     */
    public function deleteInvoiceNotes($invoiceID) {
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices_notes`
                   SET `is_deleted` = 1, `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }

}