/**
 *Actions to be run when page is done loading
 */
$(document).ready(function(){
    
    //Init datatable
    $('.admin-search-table').dataTable({
        "aLengthMenu": [
            [25, 50, 100, 200, -1],
            [25, 50, 100, 200, 'All']
        ],
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [-1]
        }],
        "iDisplayLength": -1
    });
    
});