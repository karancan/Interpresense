<?php

namespace Interpresense\Includes;

/**
 * DatabaseObject class for handling database connections.
 * @author Vincent Diep
 * @author Karan Khiani
 */
class DatabaseObject {

    /**
     * The database connection
     * @var \PDO
     */
    public $db;

    /**
     * DatabaseObject Constructor
     * @param string $host The hostname of the database server
     * @param string $db The name of the database
     * @param string $user The database username
     * @param string $password The database user password
     */
    public function __construct($host = DB_HOSTNAME, $db = DB_NAME, $user = DB_USERNAME, $password = DB_PASSWORD) {
        try {
            $this->db = new \PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);

            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->db->setAttribute(\PDO::ATTR_STRINGIFY_FETCHES, true);
            
            $this->db->exec('SET NAMES utf8;');
        } catch (\PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Select a sub array based on the provided keys
     * @param array $keys are the keys to pick and clean from $data,
     * @param array $data is the data to pick from.
     * @return array Return the picked data.
     */
    public static function pick(array $keys, array $data) {
        return array_intersect_key($data, array_flip($keys));
    }

    /** Build and execute SQL delete.
     * @param string $table The table name
     * @param string $condition The WHERE clause. Warning: Unescaped
     * @return int The number of rows deleted
     */
    public function delete($table, $condition) {

        if (!is_string($table) || empty($table)) {
            throw new \InvalidArgumentException('Invalid table name');
        }

        if (!is_string($condition) || empty($condition)) {
            throw new \InvalidArgumentException('For safety reasons, a WHERE clause is required.');
        }

        $sql = "DELETE FROM `$table` WHERE $condition;";
        
        try {
            return $this->db->exec($sql);
        } catch (\PDOException $e) {
            // @todo: trigger email to admin (as specified in config)
        }
    }

    /**
     * The general query function.
     * @param string $sql A parameterized SQL query with named parameters
     * @param array $data The data to bind
     * @param array $types The types of data
     * @param int $fetchFormat One of PDO::FETCH_* constants. Ignored if the query is not a SELECT query.
     *                         Defaults to an associative array.
     * @return array|int Returns the results of a SELECT query or the number of rows affected.
     */
    public function query($sql, array $data = array(), array $types = array(), $fetchFormat = \PDO::FETCH_ASSOC) {
        
        if (!is_string($sql) || empty($sql)) {
            throw new \InvalidArgumentException('Invalid SQL query');
        }
        
        if(sizeof($data) !== sizeof($types)) {
            throw new \LengthException('Number of data values do not match number of data types');
        }
        
        if(sizeof(array_diff_key($types, $data)) > 0) {
            throw new \InvalidArgumentException('Keys do not match between data and data types');
        }
        
        try {
            // Prepare the statement
            $q = $this->db->prepare($sql);

            foreach($types as $field => $type) {
                $q->bindValue(":{$field}", $data[$field], $type);
            }

            // Execute the statement
            $q->execute();

            if (mb_strtoupper(substr(ltrim($sql), 0, 6)) === 'SELECT') {
                return $q->fetchAll($fetchFormat);
            }
            
            return $q->rowCount();
            
        } catch (\PDOException $e) {
            echo $e->getMessage();
            // @todo: trigger email to admin (as specified in config)
        }
    }
    
    /**
     * Execute prepared statements with sets of parameter value sets
     * @param string $sql A parameterized SQL query with named parameters
     * @param array $data An array of data sets to bind
     * @param array $types The types of data
     * @return array|void Returns the results of a SELECT query.
     */
    public function batchManipulationQuery($sql, array $data = array(), array $types = array()) {        
        
        if (!is_string($sql) || empty($sql)) {
            throw new \InvalidArgumentException('Invalid SQL query');
        }
        
        if (!preg_match('/^(INSERT|UPDATE|DELETE|REPLACE)/', mb_strtoupper(substr(ltrim($sql), 0, 6)))) {
            throw new \InvalidArgumentException('This method only works with data manipulation statements');
        }
        
        try {
            // Prepare the statement
            $q = $this->db->prepare($sql);

            foreach($types as $field => $type) {
                $q->bindParam(":{$field}", $$field, $type);
            }
            
            // Start transaction
            $this->db->beginTransaction();
            
            // Loop through set of data sets
            $numTypes = sizeof($types);
            foreach($data as $r) {
                
                if(sizeof($r) !== $numTypes) {
                    $this->db->rollBack();
                    throw new \LengthException('Number of data values do not match number of data types');
                }
                
                // Loop through fields of data set
                foreach($r as $field => $value) {
                    $$field = $value;
                }
                $q->execute();
            }
            
            // Commit
            $this->db->commit();
            
        } catch (\PDOException $e) {
            // If we are in a transaction, roll it back
            try {
                $this->db->rollBack();
            } catch (\PDOException $e2) {
                
            }
            
            // @todo: trigger email to admin (as specified in config)
        }
    }

}