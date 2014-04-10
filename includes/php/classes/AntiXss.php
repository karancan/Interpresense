<?php

namespace Interpresense\Includes;

/**
 * Output escaping class extended from Zend_Escaper
 *
 * @author Vincent Diep
 */
class AntiXss extends \Zend\Escaper\Escaper {
    
    const HTML_BODY = 1;
    const HTML_ATTR = 2;
    const JS = 3;
    const CSS = 4;
    const URL_PARAM = 5;
    
    /**
     * Creates a new AntiXss escaper
     */
    public function __construct() {
        parent::__construct('UTF-8');
    }
    
    /**
     * Contextually escapes data
     * @param string $string The data to escape
     * @param int $context The context to escape in. Defaults to HTML body content
     * @return string The escaped data
     * @throws \InvalidArgumentException In the case of invalid context
     */
    public function escape($string, $context = self::HTML_BODY) {
        $type = gettype($string);
        
        if(in_array($type, array('boolean', 'integer', 'double', 'NULL'), true)) {
            return $string;
        }
        
        if(in_array($type, array('object', 'resource', 'unknown type'), true)) {
            throw new \InvalidArgumentException("Unable to escape variable of type $type.");
        }
        
        if($context === self::HTML_BODY) {
            return parent::escapeHtml($string);
        }
        
        if($context === self::HTML_ATTR) {
            return parent::escapeHtmlAttr($string);
        }
        
        if($context === self::CSS) {
            return parent::escapeCss($string);
        }
        
        if($context === self::JS) {
            return parent::escapeJs($string);
        }
        
        if($context === self::URL_PARAM) {
            return parent::escapeUrl($string);
        }
        
        throw new \InvalidArgumentException('Invalid context.');
    }
    
}