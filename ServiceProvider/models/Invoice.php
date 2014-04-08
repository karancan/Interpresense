<?php

namespace Interpresense\ServiceProvider;

/**
 * This is an example model that will probably be changed later on
 * @author Vincent Diep
 */
class Invoice extends \Interpresense\Includes\BaseModel {
    
    /**
     * Constructor
     * @param \Interpresense\Includes\DatabaseObject $db A database object
     */
    public function __construct(\Interpresense\Includes\DatabaseObject $db) {
        parent::__construct($db);
    }
    
    /**
     * Retrieve things
     * 
     * Simple select query example
     * 
     * @return array An array of things
     */
    public function fetchThings() {
        return parent::$db->query('SELECT `thing_properties` FROM `things` ORDER BY `thing_name` DESC;');
    }

    /**
     * Delete things
     * 
     * Simple delete query example
     * 
     * @param int $id The ID of the thing to delete
     */
    public function deleteThing($id) {
        parent::$db->delete('things', "`thing_id` = $id");
    }
    
    /**
     * Retrieves things given a name
     * 
     * This example shows parameterized queries
     * This example also shows fetching alternative formats such as
     * an array of objects
     * 
     * @param string $name The name of the thing
     * @return array An array of thing objects
     */
    public function fetchThingsByName($name) {
        
        $sql = 'SELECT `thing_properties`
                  FROM `things`
                 WHERE `thing_name` = :name
              ORDER BY `thing_id` ASC;';
        
        $data = array(
            'name' => $name
        );
        
        $types = array(
            'name' => \PDO::PARAM_STR
        );
        
        return parent::$db->query($sql, $data, $types, \PDO::FETCH_OBJ);
    }
}
