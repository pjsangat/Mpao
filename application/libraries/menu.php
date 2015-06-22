<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu
{
	private $CI;
	
	function __construct() 
	{
		ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
       $this->CI =& get_instance();
       $this->CI->load->database();
   }
	
    
	public function category_menu()
	{
		$query = $CI->db->query("select * from categories");
		return $query->result();
	}
}