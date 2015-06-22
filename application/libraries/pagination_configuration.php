<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagination_configuration
{
	private $CI;
	
	function __construct() 
	{
       $this->CI =& get_instance();
	   $this->CI->load->library('pagination');
   }
	
    function per_page() 
	{
		return 20;
	}
	
	public function pagi($baseUrl,$totalRow,$perPage,$uriSegment)
	{
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		 
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		 
		$config['first_link'] = '&lt;&lt;';
		$config['last_link'] = '&gt;&gt;';
		$config["base_url"] = $baseUrl;
		$config["total_rows"] = $totalRow;
		$config["per_page"] = $perPage;
        $config["uri_segment"] = $uriSegment;
		$this->CI->pagination->initialize($config);
	}
}