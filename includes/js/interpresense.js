/**
 * Global functions
 * @namespace
 */
var global = {};

(function(ns) {
    'use strict';
    
    /**
     * Highlights rows of a table
     * @param {object} row The row to highlight. This can be a HTMLTableRowElement or jQuery collection
     */
    ns.highlightRow = function(row) {
        if(!(row instanceof $)) {
            if(!(row instanceof HTMLTableRowElement)) {
                throw "Invalid element";
            }
            
            row = $(row);
        }

        if(row.length) {
            row.addClass('highlighted-row');
        }
    };
    
    /**
     * Removes row highlighting from a table
     * @param {object} table
     */
    ns.removeRowHighlighting = function(table) {
        $('.highlighted-row', table).removeClass('highlighted-row');
    };
    
}(global));