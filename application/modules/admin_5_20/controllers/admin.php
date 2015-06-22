<?php if (!defined('BASEPATH')) die();
class Admin extends CI_Controller {
	
	function __construct()	
	{
		parent::__construct();
		$this->load->model('admin_model');

		// $this->load->model(array('common_model','user_model'));
		// $this->load->library('ion_auth');
		// $this->ion_auth->islog($this->ion_auth->logged_in());
		// $this->ion_auth->access_page();



	}

	public function index()
	{

		$data['title'] = 'Facility';
		$this->facilitymaintenance();
		$data['facilityall'] = $this->getallfacility();
		$this->template
			->set_layout('student_template')
			->build('maintenance',$data);

	}


	//adding facility controller
   	public function facilitymaintenance()
	{
		$this->load->library('form_validation');
		
				
		$facilitytypeID = $this->input->post('typefacility');
		$facility = $this->input->post('facility');
		$description  = $this->input->post('description');

		echo $facilitytypeID;

		if(!empty($facility) && !empty($facilitytypeID) && !empty($description))
		{
			$this->admin_model->form_insertfacility($facility,$facilitytypeID,$description);
			redirect('admin/index','refresh');

		}

	}


	public function insertrentspace()
	{

		$this->load->library('form_validation');

		$name = $this->input->post('Rent_Space_Name');
		$facilityid = $this->input->post('facility_category');
		$maxperson = $this->input->post('maximum_person');
		$gender = $this->input->post('Gender');
		$malecount = $this->input->post('Max_male_person');
		$femalecount = $this->input->post('Max_female_person');
		$otherfacility = $this->input->post('otherfac');

		if($otherfacility != 'true')
		{
			$otherfacility = 'false';


		}
		
		$this->admin_model->insertrentspace($name,$facilityid,$maxperson,$gender,$malecount,$femalecount,$otherfacility);
		
		redirect('admin/index','refresh');
		





	}      
	
	private function getallfacility()
	{
		$result =  $this->admin_model->getalldata();
		return $result;
	}






	
	
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
