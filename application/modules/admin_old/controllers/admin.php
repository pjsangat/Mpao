<?php if (!defined('BASEPATH')) die();
class Admin extends CI_Controller {
	
	function __construct()	
	{
		parent::__construct();
		$this->load->model(array('common_model','user_model'));
		$this->load->library('ion_auth');
		$this->ion_auth->islog($this->ion_auth->logged_in());
		$this->ion_auth->access_page();
	}
	
	#home page
   	public function index()
	{
			
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
