(function(){
    
    'use strict';
    
    /**
     * Builds an ISO8601 date string
     * @param {number} year
     * @param {number} 0-indexed month
     * @param {number} day
     * @returns {String} A date string in ISO8601 (YYYY-mm-dd) format 
     */
    function buildYMDString(year, month, day){
        return year + '-' + String('0' + (month + 1)).slice(-2) + '-' + String('0' + day).slice(-2);
    }

    /**
     * A simple function to caluate either the start or end date of a month
     * @param  {number}  step Number of months future/past that you want to calulate the first/last day of
     * @param  {number}  pos  Determines the day of the month to calculate, 1 indicates the first of the month and 0 indicates the last day of the previous month
     * @return {Date}      The year, month and day of the result
     */
    function determineDate(step, pos) {
        var date = new Date();
        return new Date(date.getFullYear(), date.getMonth() + step, pos);
    }

    /**
     * User changes the quick pick select
     */
    $('.admin-date-range-quick-picks').change(function(){

        if ($(this).val() === ""){
            return;
        }
        
        var current_start_date = new Date($('[name="start"]').val());
        var current_end_date = new Date($('[name="end"]').val());
        var y_m_d_start, y_m_d_end, date_time_this_week_start, date_time_this_week_end, date_time_date_range_start, date_time_date_range_end;

        var milliseconds_one_day = 86400000;
        var milliseconds_one_week = 604800000;

        var date_time_today = new Date();
        var date_time_tomorrow = new Date(date_time_today.getTime() + milliseconds_one_day);
        var date_time_yesterday = new Date(date_time_today.getTime() - milliseconds_one_day);

        var first_day_of_week = date_time_today.getDate() - date_time_today.getDay();
        var last_day_of_week = first_day_of_week + 6;

        switch ($(this).val()) {
        
            case 'range-forward':
                date_time_date_range_start = new Date(current_end_date.getTime() + milliseconds_one_day);
                y_m_d_start = buildYMDString(date_time_date_range_start.getFullYear(), date_time_date_range_start.getMonth(), date_time_date_range_start.getDate());
                date_time_date_range_end = new Date(date_time_date_range_start.getTime() + (current_end_date.getTime() - current_start_date.getTime()));
                y_m_d_end = buildYMDString(date_time_date_range_end.getFullYear(), date_time_date_range_end.getMonth(), date_time_date_range_end.getDate());
                break;
                
            case 'range-backward':
                date_time_date_range_end = new Date(current_start_date.getTime() - milliseconds_one_day);
                y_m_d_end = buildYMDString(date_time_date_range_end.getFullYear(), date_time_date_range_end.getMonth(), date_time_date_range_end.getDate());        
                date_time_date_range_start = new Date(date_time_date_range_end.getTime() - (current_end_date.getTime() - current_start_date.getTime()));
                y_m_d_start = buildYMDString(date_time_date_range_start.getFullYear(), date_time_date_range_start.getMonth(), date_time_date_range_start.getDate());
                break;
                
            case 'today':
                y_m_d_start = buildYMDString(date_time_today.getFullYear(), date_time_today.getMonth(), date_time_today.getDate());
                y_m_d_end = buildYMDString(date_time_today.getFullYear(), date_time_today.getMonth(), date_time_today.getDate());
                break;
                
            case "tomorrow":
                y_m_d_start = buildYMDString(date_time_tomorrow.getFullYear(), date_time_tomorrow.getMonth(), date_time_tomorrow.getDate());
                y_m_d_end = buildYMDString(date_time_tomorrow.getFullYear(), date_time_tomorrow.getMonth(), date_time_tomorrow.getDate());
                break;
            
            case "yesterday":
                y_m_d_start = buildYMDString(date_time_yesterday.getFullYear(), date_time_yesterday.getMonth(), date_time_yesterday.getDate());
                y_m_d_end = buildYMDString(date_time_yesterday.getFullYear(), date_time_yesterday.getMonth(), date_time_yesterday.getDate());
                break;
            
            case "plus-minus-1-day":
                y_m_d_start = buildYMDString(date_time_yesterday.getFullYear(), date_time_yesterday.getMonth(), date_time_yesterday.getDate());
                y_m_d_end = buildYMDString(date_time_tomorrow.getFullYear(), date_time_tomorrow.getMonth(), date_time_tomorrow.getDate());
                break;
                
            case "this-week":
                date_time_this_week_start = new Date(date_time_today.setDate(first_day_of_week));
                date_time_this_week_end = new Date(date_time_today.setDate(last_day_of_week));
                y_m_d_start = buildYMDString(date_time_this_week_start.getFullYear(), date_time_this_week_start.getMonth(), date_time_this_week_start.getDate());
                y_m_d_end = buildYMDString(date_time_this_week_end.getFullYear(), date_time_this_week_end.getMonth(), date_time_this_week_end.getDate());
                break;
                
            case "next-week":
                date_time_this_week_start = new Date(date_time_today.setDate(first_day_of_week) + milliseconds_one_week);
                date_time_this_week_end = new Date(date_time_today.setDate(last_day_of_week) + milliseconds_one_week);
                y_m_d_start = buildYMDString(date_time_this_week_start.getFullYear(), date_time_this_week_start.getMonth(), date_time_this_week_start.getDate());
                y_m_d_end = buildYMDString(date_time_this_week_end.getFullYear(), date_time_this_week_end.getMonth(), date_time_this_week_end.getDate());
                break;
                
            case "last-week":
                date_time_this_week_start = new Date(date_time_today.setDate(first_day_of_week) - milliseconds_one_week);
                date_time_this_week_end = new Date(date_time_today.setDate(last_day_of_week) - milliseconds_one_week);
                y_m_d_start = buildYMDString(date_time_this_week_start.getFullYear(), date_time_this_week_start.getMonth(), date_time_this_week_start.getDate());
                y_m_d_end = buildYMDString(date_time_this_week_end.getFullYear(), date_time_this_week_end.getMonth(), date_time_this_week_end.getDate());
                break;
                
            case "this-month":
                var date_time_this_month_start = determineDate(0, 1);
                var date_time_this_month_end = determineDate(1, 0);
                y_m_d_start = buildYMDString(date_time_this_month_start.getFullYear(), date_time_this_month_start.getMonth(), date_time_this_month_start.getDate());
                y_m_d_end = buildYMDString(date_time_this_month_end.getFullYear(), date_time_this_month_end.getMonth(), date_time_this_month_end.getDate());
                break;
                
            case "next-month":
                var date_time_next_month_start = determineDate(1, 1);
                var date_time_next_month_end = determineDate(2, 0);
                y_m_d_start = buildYMDString(date_time_next_month_start.getFullYear(), date_time_next_month_start.getMonth(), date_time_next_month_start.getDate());
                y_m_d_end = buildYMDString(date_time_next_month_end.getFullYear(), date_time_next_month_end.getMonth(), date_time_next_month_end.getDate());
                break;
                
            case "last-month":
                var date_time_last_month_start = determineDate(-1, 1);
                var date_time_last_month_end = determineDate(0, 0);
                y_m_d_start = buildYMDString(date_time_last_month_start.getFullYear(), date_time_last_month_start.getMonth(), date_time_last_month_start.getDate());
                y_m_d_end = buildYMDString(date_time_last_month_end.getFullYear(), date_time_last_month_end.getMonth(), date_time_last_month_end.getDate());
                break;
        }
        
        //Insert the values in to the start and end date pickers and submit the form
        $(this).siblings('[name="start"]').val(y_m_d_start);
        $(this).siblings('[name="end"]').val(y_m_d_end);
        $('.admin-page-filter-input').trigger('change');
        
    });
}());