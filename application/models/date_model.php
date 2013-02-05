<?php
/**
 * Created by IntelliJ IDEA.
 * User: meneli
 * Date: 1/6/13
 * Time: 8:12 AM
 * To change this template use File | Settings | File Templates.
 */

class Date_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * @param $timezone_offset a -11 through 11 span of times
     */
    function get_magic_hour($timezone_offset)
    {
        if($timezone_offset < 0)
        {
            return 24+$timezone_offset;
        }
        return $timezone_offset;
    }

    function get_current_magic_hour_offset($date_hour)
    {
        if($date_hour == 12)
        {
            return 0;
        }
        if($date_hour>11)
        {
            $date_hour = $date_hour-24;
        }
        return $date_hour;
    }

}