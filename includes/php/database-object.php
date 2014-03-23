<?php

require_once 'config.php';

/**
 * DatabaseObject class for handling database connections.
 * @author Vincent Diep
 */
abstract class DatabaseObject {

    /**
     * The database connection
     * @var PDO
     */
    protected $db;

    /**
     * DatabaseObject Constructor
     */
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=' . Config::getHostName() . ';dbname=' . Config::getDatabase() . ';charset=utf8', Config::getUserName(), Config::getPassword());

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // @todo: Remove the following line after upgrading > PHP 5.3.6
            $this->db->exec('SET NAMES utf8;');
        } catch (PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
    }

    /**
     * Clean an array keys and values or a single data point.
     * @param mixed $data is the data to clean.
     * @return mixed The cleaned data.
     */
    public function clean($data) {

        //If the data is an array.
        if (is_array($data)) {

            //set up a new array to fill with the cleaned keys and values.
            $cleaned = array();

            //Get the keys.
            $keys = array_keys($data);

            //Clean keys and data.
            foreach ($keys as $key)
                $cleaned[$key] = $this->clean($data[$key]);

            //Return cleaned array.
            return $cleaned;
        } elseif (is_string($data) || is_object($data)) {
            $data = str_replace("\n", "", $data);
            $data = str_replace("\r", "", $data);
            $data = stripslashes($data);
            return $this->db->quote($data);
        } elseif (is_null($data)) {
            return 'NULL';
        } else {
            return $data;
        }
    }

    /**
     * Select a sub array based on the provided keys
     * @param array $keys are the keys to pick and clean from $data,
     * @param array $data is the data to pick from.
     * @return array Return the picked data.
     */
    public static function pick($keys, $data) {

        $picked = array();
        foreach ($keys as $key) {
            if (isset($data[$key])) {
                $picked[$key] = $data[$key];
            }
        }

        return $picked;
    }

    /**
     * Build and execute SQL insert.
     * @param string $table is the table,
     * @param array $data is the data in array form to insert.
     * @return int The number of rows inserted.
     */
    protected function insert($table, $data = NULL) {

        if (!is_string($table) || empty($table)) {
            throw new InvalidArgumentException('DatabaseObject->insert() requires a valid table name.');
        }

        //Build sql
        $data = $this->clean($data);
        $sql = "INSERT INTO `$table`";
        $sql .= " (" . implode(",", array_keys($data)) . ") VALUES (";
        foreach ($data as $value) {
            if (is_null($value)) {
                $sql .= 'NULL,';
            } else {
                $sql .= "$value,";
            }
        }
        $sql = substr($sql, 0, -1) . ")";

        return $this->query($sql, false);
    }

    /**
     * Build and execute SQL update.
     * @param string $table is the table,
     * @param array $data is the data in array form to update.
     * @param string $condition is what follows the WHERE. WARNING: Unescaped.
     * @return int The number of rows updated
     */
    protected function update($table, $data, $condition = NULL) {

        if (!is_string($table) || empty($table)) {
            throw new InvalidArgumentException('DatabaseObject->update() requires a valid table name.');
        }

        if (!is_array($data)) {
            throw new InvalidArgumentException('Data must be an array');
        }

        $set = '';
        foreach ($data as $key => $value) {

            $value = $this->clean($value);

            $set .= "`$key`=$value, ";
        }
        $set = substr($set, 0, -2);

        $sql = "UPDATE $table SET $set";
        if (!is_null($condition)) {
            $sql .= " WHERE $condition";
        }
        
        return $this->query($sql, false);
    }

    /**
     * Build and execute SQL delete.
     * @param string $table is the table to delete from
     * @param string $condition is what follows the WHERE.
     * @return int The number of rows deleted
     */
    protected function delete($table, $condition = NULL) {

        if (!is_string($table) || empty($table)) {
            throw new InvalidArgumentException('DatabaseObject->delete() requires a valid table name.');
        }

        if (!is_string($condition) || empty($condition)) {
            throw new InvalidArgumentException('DatabaseObject->delete() requires a non-empty where_condition for safety reasons.');
        }

        $sql = "DELETE FROM `$table` WHERE $condition";
        return $this->query($sql, false);
    }

    /**
     * Build and execute SQL select.
     * @param string $table is the table.
     * @param array $keys are the keys to select. Everything is selected by default.
     * @param string $condition is what follows the WHERE.
     * @return array The data selected
     */
    protected function select($table, $keys = array('*'), $condition = NULL) {

        if (!is_string($table) || empty($table)) {
            throw new InvalidArgumentException('DatabaseObject->select() requires a valid table name.');
        }

        $keys = $this->clean($keys);
        $sql = "SELECT " . implode(",", $keys) . " FROM `$table`";

        if (is_string($condition) && !empty($condition)) {
            $sql .= " WHERE $condition";
        }

        return $this->query($sql, true);
    }

    /**
     * The general query function.
     * @param string $sql is the raw SQL query to execute.
     * @param boolean $select Whether the query was a select query
     * @return mixed If the query is not a SELECT: The number of rows affected. If the query was a SELECT: The data.
     */
    protected function query($sql, $select = true) {

        try {
            $q = $this->db->prepare($sql);

            if (!method_exists($q, 'execute')) {
                throw new RuntimeException('Unable to execute query: ' . $sql);
            }

            $q->execute();

            if ($select) {
                // @todo Allow more options than just returning an associative array!
                return $q->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return $q->rowCount();
            }
        } catch (PDOException $e) {
            echo $e->getMessage() . " <br> [ THROWN BY QUERY ] => $sql";
        }
    }

    /**
     * JSON encode function since our.
     * @param mixed $data Any data that needs to be turned into JSON.
     * @return string JSON encoded data
     */
    public function json_encode($data) {
        switch ($type = gettype($data)) {
            case 'NULL' :
                return 'null';
            case 'boolean' :
                return ($data ? 'true' : 'false');
            case 'integer' :
            case 'double' :
            case 'float' :
                return $data;
            case 'string' :
                $search = array('"', "\n", "\r");
                $replace = array('\"', "", "");
                return '"' . str_replace($search, $replace, $data) . '"';
            case 'object' :
                $data = get_object_vars($data);
            case 'array' :
                $output_index_count = 0;
                $output_indexed = array();
                $output_associative = array();
                foreach ($data as $key => $value) {
                    $output_indexed[] = $this->json_encode($value);
                    $output_associative[] = $this->json_encode($key) . ':' . $this->json_encode($value);
                    if ($output_index_count !== NULL && $output_index_count++ !== $key) {
                        $output_index_count = NULL;
                    }
                }
                if ($output_index_count !== NULL) {
                    return '[' . implode(',', $output_indexed) . ']';
                } else {
                    return '{' . implode(',', $output_associative) . '}';
                }
            default :
                return '';
        }
    }

}