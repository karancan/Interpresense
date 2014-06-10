;(function() {
    'use strict';
    
    var i18nStrings;
    
/**
 *If a row needs to be focussed on, we highlight it
 */
$(document).ready(function(){
    if (focus !== ''){
        global.highlightRow($('[data-focus="' + focus + '"]'), 15000);
        $('html, body').animate({
            scrollTop: $('[data-focus="' + focus + '"]').offset().top
        }, 1000);
    }
    
    $.ajax({
        url: 'l10n/settings.json'
    }).done(function(data) {
        i18nStrings = data;
    });
});

/**
 *User wants to add a setting
 */
$('[data-action="add-setting"]').click(function(){
    $('#setting_description_container').hide();
    $('#admin-add-setting-modal .modal-title').text(i18nStrings.values[document.documentElement.lang].settingModalTitleAdd);
    $('#setting_name').prop('readOnly', false);
    $('#setting_name, #setting_value').val('');
});

/**
 *User wants to add an activity
 */
$('[data-action="add-activity"]').click(function(){
    $('#admin-add-activity-modal .modal-title').text(i18nStrings.values[document.documentElement.lang].activityModalTitleAdd);
    $('input[name="activity_id"], #name_en, #name_fr').val('');
});

/**
 *User wants to edit a setting
 */
$('#admin-settings-table [data-action="edit"]').click(function(){
    
    $('#setting_description_container').show();
    $('#admin-add-setting-modal .modal-title').text(i18nStrings.values[document.documentElement.lang].settingModalTitleEdit);
    $('#setting_name').prop('readOnly', true);
    $('#setting_name').val($(this).closest('tr').data('setting-key'));
    $('#setting_value').val($(this).closest('tr').data('setting-value'));
    $('#setting_description').html($(this).closest('tr').data('setting-description'));
    
    global.highlightRow($(this).closest('tr'));
    
});

/**
 *User wants to edit an activity
 */
$('#admin-activities-table [data-action="edit"]').click(function(){ 
    $('#admin-add-activity-modal .modal-title').text(i18nStrings.values[document.documentElement.lang].activityModalTitleEdit);
    $('input[name="activity_id"]').val($(this).closest('tr').data('focus'));
    $('#name_en').val($(this).closest('tr').data('activity-name-en'));
    $('#name_fr').val($(this).closest('tr').data('activity-name-fr'));
    global.highlightRow($(this).closest('tr'));
});

/**
 *User wants to delete a setting
 */
$('#admin-settings-table [data-action="delete"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    if(confirm(i18nStrings.values[document.documentElement.lang].deleteSettingPrompt)){
        $.ajax({
            type: 'post',
            url: 'settings.php?page=delete-setting',
            data: {
                key: $(this).closest('tr').data('setting-key')
            }
        }).done(function() {
            window.location.href = 'settings.php';
        });
    } else {
        global.removeRowHighlighting($(this).closest('table'));
    }
});

/**
 *User wants to delete an activity
 */
$('#admin-activities-table [data-action="delete"]').click(function(){
    
    global.highlightRow($(this).closest('tr'));
    
    if(confirm(i18nStrings.values[document.documentElement.lang].deleteActivityPrompt)){
        $.ajax({
            type: 'post',
            url: 'settings.php?page=delete-activity',
            data: {
                activity_id: $(this).closest('tr').data('focus')
            }
        }).done(function() {
            window.location.href = 'settings.php';
        });
    } else {
        global.removeRowHighlighting($(this).closest('table'));
    }
});

/**
 *The add/edit settings dialog has been closed
 */
$('#admin-add-setting-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-settings-table'));
});

/**
 *The add/edit activities dialog has been closed
 */
$('#admin-add-activity-modal').on('hidden.bs.modal', function () {
    global.removeRowHighlighting($('#admin-activities-table'));
});

}());