<?php

namespace Interpresense\Admin;

use Respect\Validation\Validator;

/**
 * Service provider activities logic
 * @author Vincent Diep
 */
class Activities extends \Interpresense\Includes\BaseModel {
    
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
        
        $this->validators['activity_id'] = Validator::noWhitespace()->digit()->positive();
        $this->validators['activity_name_en'] = Validator::notEmpty()->string();
        $this->validators['activity_name_fr'] = Validator::notEmpty()->string();
    }
    
    /**
     * Adds an activity
     * @param array $data The POST data
     */
    public function addActivity(array $data) {
        if (!Validator::key('activity_name_en', $this->validators['activity_name_en'])
               ->key('activity_name_fr', $this->validators['activity_name_fr'])
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data missing or invalid');
        }
        
        $sql = "INSERT INTO `interpresense_service_provider_activities` (`activity_name_en`, `activity_name_fr`, `inserted_on`, `updated_on`)
                     VALUES (:activity_name_en, :activity_name_fr, NOW(), NOW());";
        
        $types = array(
            'activity_name_en' => \PDO::PARAM_STR,
            'activity_name_fr' => \PDO::PARAM_STR
        );
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        parent::$db->query($sql, $data, $types);
        //@todo: return last insert ID
    }
    
    /**
     * Updates an activity
     * @param array $data The POST data
     */
    public function updateActivity(array $data) {
        if (!Validator::key('activity_id', $this->validators['activity_id'])
               ->key('activity_name_en', $this->validators['activity_name_en'])
               ->key('activity_name_fr', $this->validators['activity_name_fr'])
               ->validate($data)) {
            throw new \InvalidArgumentException('Required data missing or invalid');
        }
        
        $sql = "UPDATE `interpresense_service_provider_activities`
                   SET `activity_name_en` = :activity_name_en, `activity_name_fr` = :activity_name_fr, `updated_on` = NOW()
                 WHERE `activity_id` = :activity_id;";
        
        $types = array(
            'activity_id' => \PDO::PARAM_INT,
            'activity_name_en' => \PDO::PARAM_STR,
            'activity_name_fr' => \PDO::PARAM_STR
        );
        
        $data = parent::$db->pick(array_keys($types), $data);
        
        parent::$db->query($sql, $data, $types);
        return $data['activity_id'];
    }
    
    /**
     * Retrieves a list of all activities
     * @return array
     */
    public function fetchActivities() {
        $sql = "SELECT `activity_id`, `activity_name_en`, `activity_name_fr`, `inserted_on`
                  FROM `interpresense_service_provider_activities`
                 WHERE `is_deleted` = 0;";
        
        return parent::$db->query($sql);
    }
    
    /**
     * Deletes an activity
     * @param int $activityID The activity ID
     */
    public function deleteActivity($activityID) {
        
        if (!$this->validators['activity_id']->validate($activityID)) {
            throw new \InvalidArgumentException('Invalid activity ID.');
        }
        
        $sql = "UPDATE `interpresense_service_provider_activities`
                   SET `is_deleted` = 1, `updated_on` = NOW()
                 WHERE `activity_id` = :activity_id;";
        
        $data = array('activity_id' => $activityID);
        $types = array('activity_id' => \PDO::PARAM_INT);
        
        parent::$db->query($sql, $data, $types);
    }
    
}
