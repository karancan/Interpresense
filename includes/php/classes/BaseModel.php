<?php

namespace Interpresense\Includes;

/**
 * Common code for all models
 *
 * @author Vincent Diep
 */
abstract class BaseModel {
    
    /**
     * Database access layer
     * @var DatabaseObject
     */
    protected static $db;
    
    /**
     * Abstract constructor
     * @param DatabaseObject $db A database object
     */
    public function __construct(DatabaseObject $db) {
        static::$db = $db;
    }
}
