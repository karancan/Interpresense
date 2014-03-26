<?php

namespace Interpresense\Includes;

/**
 * DatabaseObject class for handling database connections.
 * @author Vincent Diep
 */
class DatabaseObject {

    /**
     * The database connection
     * @var \PDO
     */
    protected $db;

    /**
     * DatabaseObject Constructor
     */
    public function __construct() {
        try {
            $this->db = new \PDO('mysql:host=' . DB_HOSTNAME . ';dbname=' . DB_NAME . ';charset=utf8', DB_USERNAME, DB_PASSWORD);

            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            
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

    /**
     * Build and execute SQL insert.
     * @param string $table The table to insert into
     * @param array $data The data to insert
     * @param array $types The types of the data
     * @return int The ID of the last inserted row
     */
    public function insert($table, array $data, array $types) {

        if (!is_string($table) || empty($table)) {
            throw new \InvalidArgumentException('Invalid table name');
        }

        if(sizeof($data) !== sizeof($types)) {
            throw new \LengthException('Number of data values do not match number of data types');
        }
        
        if(sizeof(array_diff_key($types, $data)) > 0) {
            throw new \InvalidArgumentException('Keys do not match between data and data types');
        }
        
        $fields = array_keys($data);
        
        $sql = "INSERT INTO `$table` (`" . implode("`,`", $fields) . "`) VALUES (";
        foreach($fields as $f) {
            $sql .= ":$f,";
        }
        $sql = substr($sql, 0, -1) . ");";
        
        // Prepare the statement
        $q = $this->db->prepare($sql);
        
        foreach($types as $field => $type) {
            $q->bindValue(":{$field}", $data[$field], $type);
        }
        
        // Execute the statement
        $q->execute();
        
        return $this->db->lastInsertId();
    }

    /**
     * Build and execute SQL update.
     * @param string $table The name of the table
     * @param array $data The new data
     * @param array $types The types of the data
     * @param string $condition The WHERE clause. WARNING: Unescaped.
     * @return int The number of rows updated
     */
    public function update($table, array $data, array $types, $condition = null) {

        if (!is_string($table) || empty($table)) {
            throw new \InvalidArgumentException('Invalid table name');
        }
        
        if(sizeof($data) !== sizeof($types)) {
            throw new \LengthException('Number of data values do not match number of data types');
        }
        
        if(sizeof(array_diff_key($types, $data)) > 0) {
            throw new \InvalidArgumentException('Keys do not match between data and data types');
        }

        $fields = array_keys($data);
        
        $set = '';
        foreach ($fields as $f) {
            $set .= "`$f` = :$f, ";
        }
        $set = substr($set, 0, -2);

        $sql = "UPDATE `$table` SET $set";
        if ($condition !== null) {
            $sql .= " WHERE $condition;";
        }
        
        // Prepare the statement
        $q = $this->db->prepare($sql);
        
        $i = 0;
        foreach($types as $field => $type) {
            $q->bindValue(":{$field}", $data[$i++], $type);
        }
        
        // Execute the statement
        $q->execute();
        
        return $q->rowCount();
    }

    /**
     * Build and execute SQL delete.
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
        return $this->db->exec($sql);
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

            $i = 0;
            foreach($types as $field => $type) {
                $q->bindValue(":{$field}", $data[$i++], $type);
            }

            // Execute the statement
            $q->execute();

            if (mb_strtoupper(substr(ltrim($sql), 0, 6)) === 'SELECT') {
                return $q->fetchAll($fetchFormat);
            }
            
            return $q->rowCount();
            
        } catch (\PDOException $e) {
            echo $e->getMessage() . " <br> [ THROWN BY QUERY ] => $sql";
        }
    }

}