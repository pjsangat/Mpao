<?php if (!defined('BASEPATH')) die();
class Requirement extends CI_Controller {
	
	function __construct()	
	{
		parent::__construct();
		$this->load->model('admin_model');
		$this->load->model(array('common_model','user_model'));
		$this->load->library('ion_auth');
		$this->ion_auth->islog($this->ion_auth->logged_in());
		$this->ion_auth->access_page();
		$this->load->library('form_validation');

	}


	public function index()
	{
		$data['title'] = 'Requirements';
		$data['requirementsdata'] = $this->getrequirement();
		$this->template
			->set_layout('student_template')
			->build('requirements',$data);
	}

	public function addrequirement()
	{
		$requirementname = $this->input->post('newrequire');

		if(!empty($requirementname))
		{
			$this->admin_model->insertrequirement($requirementname);
		}
		
	}

	public function getrequirement()
	{
		$result =  $this->admin_model->getallrequirementdata();
		return $result;
	}




}