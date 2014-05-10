/**
 * Given a year, 0-indexed month and day, this function returns a string in the form `Y-m-d`
 * where the month is 1-indexed
 */
function buildYMDString(year, month, day){
    'use strict';
    return year + '-' + (month + 1) + '-' + day; //because JS months are 0 based
}

/**
 * Calculate either the start or end date of a month
 */
function determineDate(date, step, pos) {
    'use strict';
    return new Date(date.getFullYear(), date.getMonth() + step, pos);
}

/**
 * User changes the quick pick select
 */
$('.admin-date-range-quick-picks').change(function(){
    
    'use strict';

    if ($(this).val() === ""){
        return;
    }

    var y_m_d_start, y_m_d_end, date_time_this_week_start, date_time_this_week_end;
    
    var milliseconds_one_day = 86400000;
    var milliseconds_one_week = 604800000;
    
    var date_time_today = new Date();
    var date_time_tomorrow = new Date(date_time_today.getTime() + milliseconds_one_day);
    var date_time_yesterday = new Date(date_time_today.getTime() - milliseconds_one_day);
    
    var first_day_of_week = date_time_today.getDate() - date_time_today.getDay();
    var last_day_of_week = first_day_of_week + 6;
    
    if ($(this).val() === "today") {
        y_m_d_start = buildYMDString(date_time_today.getFullYear(), date_time_today.getMonth(), date_time_today.getDate());
        y_m_d_end = buildYMDString(date_time_today.getFullYear(), date_time_today.getMonth(), date_time_today.getDate());
    } else if ($(this).val() === "tomorrow") {
        y_m_d_start = buildYMDString(date_time_tomorrow.getFullYear(), date_time_tomorrow.getMonth(), date_time_tomorrow.getDate());
        y_m_d_end = buildYMDString(date_time_tomorrow.getFullYear(), date_time_tomorrow.getMonth(), date_time_tomorrow.getDate());
    } else if ($(this).val() === "yesterday") {
        y_m_d_start = buildYMDString(date_time_yesterday.getFullYear(), date_time_yesterday.getMonth(), date_time_yesterday.getDate());
        y_m_d_end = buildYMDString(date_time_yesterday.getFullYear(), date_time_yesterday.getMonth(), date_time_yesterday.getDate());
    } else if ($(this).val() === "plus-minus-1-day") {
        y_m_d_start = buildYMDString(date_time_yesterday.getFullYear(), date_time_yesterday.getMonth(), date_time_yesterday.getDate());
        y_m_d_end = buildYMDString(date_time_tomorrow.getFullYear(), date_time_tomorrow.getMonth(), date_time_tomorrow.getDate());
    } else if ($(this).val() === "this-week") {
        date_time_this_week_start = new Date(date_time_today.setDate(first_day_of_week));
        date_time_this_week_end = new Date(date_time_today.setDate(last_day_of_week));
        y_m_d_start = buildYMDString(date_time_this_week_start.getFullYear(), date_time_this_week_start.getMonth(), date_time_this_week_start.getDate());
        y_m_d_end = buildYMDString(date_time_this_week_end.getFullYear(), date_time_this_week_end.getMonth(), date_time_this_week_end.getDate());
    } else if ($(this).val() === "next-week") {
        date_time_this_week_start = new Date(date_time_today.setDate(first_day_of_week) + milliseconds_one_week);
        date_time_this_week_end = new Date(date_time_today.setDate(last_day_of_week) + milliseconds_one_week);
        y_m_d_start = buildYMDString(date_time_this_week_start.getFullYear(), date_time_this_week_start.getMonth(), date_time_this_week_start.getDate());
        y_m_d_end = buildYMDString(date_time_this_week_end.getFullYear(), date_time_this_week_end.getMonth(), date_time_this_week_end.getDate());
    } else if ($(this).val() === "last-week") {
        date_time_this_week_start = new Date(date_time_today.setDate(first_day_of_week) - milliseconds_one_week);
        date_time_this_week_end = new Date(date_time_today.setDate(last_day_of_week) - milliseconds_one_week);
        y_m_d_start = buildYMDString(date_time_this_week_start.getFullYear(), date_time_this_week_start.getMonth(), date_time_this_week_start.getDate());
        y_m_d_end = buildYMDString(date_time_this_week_end.getFullYear(), date_time_this_week_end.getMonth(), date_time_this_week_end.getDate());
    } else if ($(this).val() === "this-month") {
        var date_time_this_month_start = determineDate(date_time_today, 0, 1);
        var date_time_this_month_end = determineDate(date_time_today, 1, 0);
        y_m_d_start = buildYMDString(date_time_this_month_start.getFullYear(), date_time_this_month_start.getMonth(), date_time_this_month_start.getDate());
        y_m_d_end = buildYMDString(date_time_this_month_end.getFullYear(), date_time_this_month_end.getMonth(), date_time_this_month_end.getDate());
    } else if ($(this).val() === "next-month") {
        var date_time_next_month_start = determineDate(date_time_today, 1, 1);
        var date_time_next_month_end = determineDate(date_time_today, 2, 0);
        y_m_d_start = buildYMDString(date_time_next_month_start.getFullYear(), date_time_next_month_start.getMonth(), date_time_next_month_start.getDate());
        y_m_d_end = buildYMDString(date_time_next_month_end.getFullYear(), date_time_next_month_end.getMonth(), date_time_next_month_end.getDate());
    } else if ($(this).val() === "last-month") {
        var date_time_last_month_start = determineDate(date_time_today, -1, 1);
        var date_time_last_month_end = determineDate(date_time_today, 0, 0);
        y_m_d_start = buildYMDString(date_time_last_month_start.getFullYear(), date_time_last_month_start.getMonth(), date_time_last_month_start.getDate());
        y_m_d_end = buildYMDString(date_time_last_month_end.getFullYear(), date_time_last_month_end.getMonth(), date_time_last_month_end.getDate());
    }
    
    //Insert the values in to the start and end date pickers and submit the form
    $(this).siblings('[name="start"]').val(y_m_d_start);
    $(this).siblings('[name="end"]').val(y_m_d_end);
    $('.admin-page-filter-input').trigger('change');
    
});

