<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class date_config
{
    function per_page($date) 
	{
		$unix_time = strtotime($date);
		return date("M d, Y", $unix_time);
	}
	
	function convert_data($unixtime) 
	{
		return date("M d, Y", $unixtime);
	}

}