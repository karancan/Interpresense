/**
 * Global functions
 * @namespace
 */
var global = {};

(function(ns) {
    'use strict';
    
    /**
     * Highlights a row in a table
     * @param {object} row The row to highlight. This can be a HTMLTableRowElement or jQuery collection
     * @param {int} [duration=Number.POSITIVE_INFINITY] The duration of highlighting in milliseconds. Defaults to infinity.
     */
    ns.highlightRow = function(row, duration) {
        if(!(row instanceof $)) {
            if(!(row instanceof HTMLTableRowElement)) {
                throw "Invalid element";
            }
            
            row = $(row);
        }
        
        duration = parseInt(duration, 10) || Number.POSITIVE_INFINITY;

        if(row.length) {
            row.addClass('highlighted-row');
            if(duration && duration > 0 && isFinite(duration)) {
                row.animate({
                    backgroundColor: 'inherit'
                }, duration, function() {
                    row.removeClass('highlighted-row');
                });
            }
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