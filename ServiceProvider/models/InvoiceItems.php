<?php

namespace Interpresense\ServiceProvider;

use Respect\Validation\Validator;

/**
 * Invoice items logic
 * @author Vincent Diep
 */
class InvoiceItems extends \Interpresense\Includes\BaseModel {
    
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
        
        $this->validators['item_id'] = Validator::noWhitespace()->digit()->positive();
        $this->validators['invoice_id'] = Validator::notEmpty()->noWhitespace()->digit()->positive();
        $this->validators['description'] = Validator::notEmpty()->string();
        $this->validators['course_code'] = Validator::notEmpty()->string();
        $this->validators['activity_id'] = Validator::notEmpty()->noWhitespace()->digit()->positive();
        $this->validators['service_date'] = Validator::notEmpty()->date('Y-m-d');
        $this->validators['start_time'] = Validator::notEmpty()->date('H:i');
        $this->validators['end_time'] = Validator::notEmpty()->date('H:i');
        $this->validators['rate'] = Validator::notEmpty()->float();
    }
    
    /**
     * Fetches items for a given invoice
     * @param int $invoiceID The invoice ID
     * @param boolean $idsOnly Fetch item IDs only. Default is FALSE
     * @return array
     */
    public function fetchItems($invoiceID, $idsOnly = false) {
        
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT `item_id`";
        
        if(!$idsOnly) {
            $sql .= ", `description`, `course_code`, `activity_id`, `service_date`, `start_time`, `end_time`, `rate`, `inserted_on`";
        }
        
        $sql .= " FROM `interpresense_service_provider_invoice_items`
                 WHERE `invoice_id` = :invoice_id;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Fetches the number of items for a given invoice
     * @param int $invoiceID The invoice ID
     * @return int The number of items
     */
    public function fetchItemsCount($invoiceID) {
        
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT COUNT(item_id) AS count
                  FROM `interpresense_service_provider_invoice_items`
                 WHERE `invoice_id` = :invoice_id;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
    }
    
    /**
     * Adds or updates invoice items
     * @param int $invoiceID The invoice ID
     * @param array[] $items An array of invoice items
     */
    public function changeItems($invoiceID, array $items) {
        
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "INSERT INTO `interpresense_service_provider_invoice_items` (`item_id`, `invoice_id`, `description`, `course_code`, `activity_id` `service_date`, `start_time`, `end_time`, `rate`, `inserted_on`, `updated_on`)
                     VALUES (:item_id, :invoice_id, :description, :course_code, :activity_id, :service_date, :start_time, :end_time, :rate, NOW(), NOW())
    ON DUPLICATE KEY UPDATE `description` = VALUES(`description`),
                            `course_code` = VALUES(`course_code`),
                            `activity_id` = VALUES(`activity_id`),
                            `service_date` = VALUES(`service_date`),
                            `start_time` = VALUES(`start_time`),
                            `end_time` = VALUES(`end_time`),
                            `rate` = VALUES(`rate`),
                            `updated_on` = NOW();";
        
        foreach($items as &$item) {
            $item['invoice_id'] = $invoiceID;
            
            if(empty($item['item_id'])) {
                $item['item_id'] = 0;
            }
            
            if(!Validator::key('description', $this->validators['description'])
                ->key('course_code', $this->validators['course_code'])
                ->key('activity_id', $this->validators['activity_id'])
                ->key('service_date', $this->validators['service_date'])
                ->key('start_time', $this->validators['start_time'])
                ->key('end_time', $this->validators['end_time'])
                ->key('rate', $this->validators['rate'])
                ->validate($item)) {
                throw new \InvalidArgumentException('Data invalid for one or more invoice items.');
            }
        }
        unset($item);
        
        $types = array(
            'item_id' => \PDO::PARAM_INT,
            'invoice_id' => \PDO::PARAM_INT,
            'description' => \PDO::PARAM_STR,
            'service_date' => \PDO::PARAM_STR,
            'start_time' => \PDO::PARAM_STR,
            'end_time' => \PDO::PARAM_STR,
            'rate' => \PDO::PARAM_STR
        );
        
        parent::$db->batchManipulationQuery($sql, $items, $types);
    }
    
    /**
     * Deletes an item
     * @param int $itemID The item ID
     */
    public function deleteItems($itemID) {
        
        if(!$this->validators['item_id']->validate($itemID)) {
            throw new \InvalidArgumentException('Invalid item ID.');
        }
        
        $sql = "DELETE FROM `interpresense_service_provider_invoice_items`
                      WHERE `item_id` = :item_id;";
        
        $data = array('item_id' => $itemID);
        $types = array('item_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }
}