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
        
        $this->validators['invoice_id'] = Validator::notEmpty()->noWhitespace()->digit()->positive();
        $this->validators['invoice_uid'] = Validator::xdigit()->length(128, 128);
        $this->validators['sp_name'] = Validator::notEmpty();
        $this->validators['sp_address'] = Validator::string();
        $this->validators['sp_postal_code'] = Validator::notEmpty()->length(6, 6)->regex('/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]\d[ABCEGHJKLMNPRSTVWXYZ]\d$/');
        $this->validators['sp_city'] = Validator::notEmpty();
        $this->validators['sp_province'] = Validator::notEmpty()->in(array('AB', 'BC', 'ON', 'MB', 'NB', 'NF', 'NL', 'NU', 'ON', 'PE', 'PQ', 'SK', 'YT'), true);
        $this->validators['sp_phone'] = Validator::notEmpty()->noWhitespace()->digit();
        $this->validators['sp_email'] = Validator::notEmpty()->email();
        $this->validators['sp_hst_number'] = Validator::alnum();
    }
    
    /**
     * Adds an invoice
     * @param array $data The POST data
     * @param boolean $final Whether the new invoice is a draft or is a final copy
     * @return string The newly created invoice ID
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
            'sp_hst_number' => \PDO::PARAM_STR,
            'client_id' => \PDO::PARAM_STR,
            'is_final' => \PDO::PARAM_INT,
            'grand_total' => \PDO::PARAM_STR
        );
        
        // Janitization
        $data['sp_phone'] = preg_replace('/[[:^digit:]]/i', '', $data['sp_phone']);
        
        // Validation
        if(!Validator::key('sp_name', $this->validators['sp_name'])
               ->key('sp_address', $this->validators['sp_address'])
               ->key('sp_postal_code', $this->validators['sp_postal_code'])
               ->key('sp_city', $this->validators['sp_city'])
               ->key('sp_province', $this->validators['sp_province'])
               ->key('sp_phone', $this->validators['sp_phone'])
               ->key('sp_email', $this->validators['sp_email'])
               ->key('sp_hst_number', $this->validators['sp_hst_number'])
               ->key('invoice_id_for_sp')
               ->key('client_id')
               ->validate($data) || !Validator::bool()->validate($final)) {
            throw new \InvalidArgumentException('Required data invalid or missing');
        }
        
        $data['invoice_uid'] = hash('sha512', microtime(true) . mt_rand());
        $data['is_final'] = (int)$final;
        $data['grand_total'] = $this->calculateGrandTotal($data['invoice_items']);
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        $sql = "INSERT INTO `interpresense_service_provider_invoices` (`invoice_uid`, `invoice_id_for_sp`, `sp_name`, `sp_address`, `sp_postal_code`, `sp_city`, `sp_province`, `sp_phone`, `sp_email`, `sp_hst_number`, `client_id`, `is_final`, `grand_total`, `inserted_on`, `updated_on`)
                     VALUES (:invoice_uid, :invoice_id_for_sp, :sp_name, :sp_address, :sp_postal_code, :sp_city, :sp_province, :sp_phone, :sp_email, :sp_hst_number, :client_id, :is_final, :grand_total, NOW(), NOW());";
        
        parent::$db->query($sql, $data, $types);
        
        return parent::$db->db->lastInsertId();
    }
    
    /**
     * Updates the organization's invoice ID
     * @param int $invoiceID The invoice ID
     * @param mixed $orgInvoiceID The organization's invoice ID
     */
    public function updateOrgInvoiceId($invoiceID, $orgInvoiceID) {
        
        if (!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `invoice_id_for_org` = :invoice_id_for_org, `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_confirmed` = 1;";
        
        $data = array(
            'invoice_id_for_org' => $orgInvoiceID,
            'invoice_id' => $invoiceID
        );
        
        $types = array(
            'invoice_id_for_org' => \PDO::PARAM_STR,
            'invoice_id' => \PDO::PARAM_INT
        );
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves an invoice
     * @param int $invoiceID The invoice ID
     * @return array
     */
    public function fetchInvoice($invoiceID) {
        
        $sql = "SELECT `invoice_id`, `invoice_uid`, `invoice_id_for_sp`, `invoice_id_for_org`, `sp_name`,
                       `sp_address`, `sp_postal_code`, `sp_city`, `sp_province`, `sp_phone`, `sp_email`,
                       `sp_hst_number`, `client_id`, `is_final`, `inserted_on`, `updated_on`, `is_approved`,
                       `approved_on`, `approved_by`, `admin_viewed`, `admin_last_viewed_on`, `admin_last_viewed_by`,
                       `grand_total`
                  FROM `interpresense_service_provider_invoices`
                 WHERE `invoice_id` = :invoice_id
                   AND `is_confirmed` = 1;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Retrieves invoices
     * @param \DateTime $startRange The start of the date range
     * @param \DateTime $endRange The end of the date range
     * @param string $status Filters invoices by status. Default is all.
     * @return array
     */
    public function fetchInvoices(\DateTime $startRange, \DateTime $endRange, $status = 'all', $approvedOnly = false) {
        
        $sql = "SELECT i.invoice_id, i.invoice_uid, i.invoice_id_for_sp, i.invoice_id_for_org, i.sp_name,
                       i.sp_address, i.sp_postal_code, i.sp_city, i.sp_province, i.sp_phone, i.sp_email,
                       i.sp_hst_number, i.client_id, i.is_final, i.inserted_on, i.updated_on, i.is_approved,
                       i.approved_on, i.approved_by, i.admin_viewed, i.admin_last_viewed_on, i.admin_last_viewed_by,
                       i.grand_total, u.first_name, u.last_name
                  FROM `interpresense_service_provider_invoices` i
             LEFT JOIN `interpresense_users` u
                    ON i.approved_by = u.user_id
                 WHERE i.inserted_on BETWEEN :start AND :end
                   AND i.is_confirmed = 1";
        
        if ($status === 'final') {
            $sql .= ' AND `is_final` = 1';
        } elseif ($status === 'draft') {
            $sql .= ' AND `is_final` = 0';
        }
        
        if ($approvedOnly) {
            $sql .= ' AND `is_approved` = 1;';
        }
        
        $data = array(
            'start' => $startRange->format('Y-m-d'),
            'end' => $endRange->format('Y-m-d')
        );
        
        $types = array(
            'start' => \PDO::PARAM_STR,
            'end' => \PDO::PARAM_STR
        );
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Marks a non-approved invoice as a draft
     * @param int $invoiceID The invoice ID
     */
    public function markInvoiceAsDraft($invoiceID) {
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `is_final` = 0, `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_approved` = 0;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Marks a finalized (non-draft) invoice as approved
     * @param int $invoiceID The invoice ID
     */
    public function markInvoiceAsApproved($invoiceID) {
    
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `is_approved` = 1, `approved_by` = :approved_by, `approved_on` = NOW(), `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_final` = 1
                   AND `is_confirmed` = 1;";
        
        $types = array(
            'invoice_id' => \PDO::PARAM_INT,
            'approved_by' => \PDO::PARAM_INT
        );
        
        $data = array(
            'invoice_id' => $invoiceID,
            'approved_by' => $_SESSION['admin']['user_id']
        );
        
        parent::$db->query($sql, $data, $types);
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
                 WHERE `invoice_uid` = :invoice_uid
                   AND `is_confirmed` = 1;";
        
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
     * @param int $invoiceID The invoice ID
     */
    public function finalizeDraftInvoice($invoiceID) {
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `is_final` = 1, `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_confirmed` = 1;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
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
                 WHERE `invoice_uid` = :invoice_uid
                   AND `is_confirmed` = 1;";
        
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
            'sp_postal_code' => \PDO::PARAM_STR,
            'sp_city' => \PDO::PARAM_STR,
            'sp_province' => \PDO::PARAM_STR,
            'sp_phone' => \PDO::PARAM_STR,
            'sp_email' => \PDO::PARAM_STR,
            'sp_hst_number' => \PDO::PARAM_STR,
            'client_id' => \PDO::PARAM_STR,
            'is_final' => \PDO::PARAM_INT,
            'grand_total' => \PDO::PARAM_STR
        );
        
        // Validation
        if(!Validator::key('invoice_uid', $this->validators['invoice_uid'])
                ->key('sp_name', $this->validators['sp_name'])
               ->key('sp_address', $this->validators['sp_address'])
               ->key('sp_postal_code', $this->validators['sp_postal_code'])
               ->key('sp_city', $this->validators['sp_city'])
               ->key('sp_province', $this->validators['sp_province'])
               ->key('sp_phone', $this->validators['sp_phone'])
               ->key('sp_email', $this->validators['sp_email'])
               ->key('sp_hst_number', $this->validators['sp_hst_number'])
               ->key('client_id')
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data invalid or missing');
        }
        
        $data['grand_total'] = $this->calculateGrandTotal($data['invoice_items']);
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `sp_name` = :sp_name, `sp_address` = :sp_address, `sp_postal_code` = :sp_postal_code, `sp_city` = :sp_city, `sp_province` = :sp_province, `sp_phone` = :sp_phone, `sp_email` = :sp_email, `sp_hst_number` = :sp_hst_number, `client_id` = :client_id, `grand_total` = :grand_total, `updated_on` = NOW()
                 WHERE `invoice_uid` = :invoice_uid
                   AND `is_confirmed` = 1;";
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Mark invoice as approved
     * @param int $invoiceID The invoice ID
     */
    public function approveInvoice($invoiceID) {
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `is_approved` = 1, `approved_by` = :user_id, `approved_on` = NOW(), `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_confirmed` = 1;";
        
        $data = array(
            'invoice_id' => $invoiceID,
            'user_id' => $_SESSION['user_id']
        );
        
        $types = array(
            'invoice_id' => \PDO::PARAM_INT,
            'user_id' => \PDO::PARAM_INT
        );
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Marks an invoice as viewed
     * @param int $invoiceID The invoice ID
     */
    public function markInvoiceViewed($invoiceID) {
    
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `admin_viewed` = 1, `admin_last_viewed_on` = NOW(), `admin_last_viewed_by` = :user_id, `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_confirmed` = 1;";
        
        $data = array(
            'invoice_id' => $invoiceID,
            'user_id' => $_SESSION['user_id']
        );
        
        $types = array(
            'invoice_id' => \PDO::PARAM_INT,
            'user_id' => \PDO::PARAM_INT
        );
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Marks an invoice as unread
     * @param int $invoiceID The invoice ID
     */
    public function markInvoiceAsUnread($invoiceID) {
    
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_invoices`
                   SET `admin_viewed` = 0, `admin_last_viewed_on` = NULL, `admin_last_viewed_by` = NULL, `updated_on` = NOW()
                 WHERE `invoice_id` = :invoice_id
                   AND `is_confirmed` = 1;";
        
        $data = array(
            'invoice_id' => $invoiceID
        );
        
        $types = array(
            'invoice_id' => \PDO::PARAM_INT
        );
        
        parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Fetches if, who and when an invoice was last viewed
     * @param int $invoiceID The invoice ID
     */
    public function fetchInvoiceViewedDetails($invoiceID) {
    
        if(!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "SELECT i.admin_last_viewed_on, CONCAT(u.first_name, ' ', u.last_name) AS name
                  FROM `interpresense_service_provider_invoices` i
                  JOIN `interpresense_users` u
                    ON i.admin_last_viewed_by = u.user_id
                 WHERE i.invoice_id = :invoice_id
                   AND i.admin_viewed = 1
                   AND i.is_confirmed = 1;";
        
        $data = array(
            'invoice_id' => $invoiceID
        );
        
        $types = array(
            'invoice_id' => \PDO::PARAM_INT
        );
        
        return parent::$db->query($sql, $data, $types);
    }
    
    /**
     * Deletes a draft invoice
     * @param int $invoiceID The invoice ID
     */
    public function deleteInvoice($invoiceID) {
        
        if (!$this->validators['invoice_id']->validate($invoiceID)) {
            throw new \InvalidArgumentException('Invalid invoice ID.');
        }
        
        $sql = "DELETE FROM `interpresense_service_provider_invoices`
                      WHERE `invoice_id` = :invoice_id
                        AND `is_final` = 0
                        AND `is_approved` = 0;";
        
        $data = array('invoice_id' => $invoiceID);
        $types = array('invoice_id' => \PDO::PARAM_INT);
        
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
                 WHERE `invoice_uid` = :invoice_uid
                   AND `is_confirmed` = 1;";
        
        $data = array('invoice_uid' => $invoiceUID);
        $types = array('invoice_uid' => \PDO::PARAM_STR);
        
        $result = parent::$db->query($sql, $data, $types, \PDO::FETCH_COLUMN);
        
        if(empty($result)) {
            throw new \RuntimeException('Requested invoice does not exist.');
        }
        
        return reset($result) === '0';
    }
    
    /**
     * Calculates the grand total of an invoice
     * @param array $items An array of invoice items
     * @return float
     */
    private function calculateGrandTotal(array $items) {
        $total = 0.0;
        
        foreach ($items as $item) {
            $start = \DateTime::createFromFormat('Y-m-d H:i', "{$item['service_date']} {$item['start_time']}");
            $end = \DateTime::createFromFormat('Y-m-d H:i', "{$item['service_date']} {$item['end_time']}");
            $time = $start->diff($end);
            
            $total += ($time->h + $time->i / 60) * (float)$item['rate'];
        }
        
        return round($total, 2, PHP_ROUND_HALF_UP);
    }
    
    /**
     * Fetches the number of invoices that are finalized and unread
     * @return int The number of finalized and unread invoices
     */
    public function fetchUnreadFinalizedInvoiceCount() {
        
        $sql = "SELECT COUNT(invoice_id) AS count
                  FROM `interpresense_service_provider_invoices`
                 WHERE `is_final` = 1
                   AND `admin_viewed` = 0
                   AND `is_confirmed` = 1;";

        $result = parent::$db->query($sql, array(), array(), \PDO::FETCH_COLUMN);
        return (int)$result[0];
    }
}