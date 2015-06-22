<?php if (!defined('BASEPATH')) die();
class Employer extends CI_Controller {
	
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
		$this->load->library('pagination_configuration');
		$config = array();
		$perPage = $this->pagination_configuration->per_page();
		$this->pagination_configuration->pagi($baseUrl = base_url() . "employer/index",$totalRow = $this->common_model->count_table_user('company_joblisting',$this->session->userdata('user_id'),'*','user_id'),$perPage,$uriSegment = 3);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['title'] = 'Employee Dashboard';
		$data['job'] = $this->common_model->get_table_with_pagination_user('company_joblisting','user_id',$this->session->userdata('user_id'),$perPage, $page);
		$data["pagination"] = $this->pagination->create_links();
		$this->template
				->set_layout('emplooyer_template')
				->build('dashboard',$data);
	}
	
	public function get_single_content()
	{
		$data['info'] = $this->common_model->get_single_content('*',$this->input->post('table'),'id',$this->input->post('id'));
		if($this->input->post('table') == 'company_joblisting')
		{
			$data['category'] = $this->common_model->get_contents('*','categories','active','1','id','asc');
			$this->load->view('edit_job_listing',$data);
		}
	}
	
	public function edit_action()
	{
		if($this->input->post('table') == 'company_joblisting')
		{
			$data = array(
				'title' => $this->input->post('title'),
				'description' => $this->input->post('description'),
				'type'	=> $this->input->post('type'),
				'salary'	=> $this->input->post('salary'),
				'category_id' => $this->input->post('category')
			);
			$success = 'Company Job Posted Updated';
			$error = 'Error Updating Job';
		}
		$this->common_model->edit($this->input->post('table'),$data,'id',$this->input->post('id'),$success,$error);	
	}
	
	public function get_form()
	{
		if($this->input->post('form_name') == 'add_form')	
		{
			$data['category'] = $this->common_model->get_contents('*','categories','active','1','id','asc');
			$this->load->view('add_job_form',$data);	
		}
	}
	
	public function add_job_action()
	{
		$add_job = array(			
				'user_id'		=> $this->session->userdata('user_id'),
				'title'			=> $this->input->post('title'),
				'description' 	=> $this->input->post('description'),
				'type' 			=> $this->input->post('type'),
				'salary'		=> $this->input->post('salary'),
				'category_id'	=> $this->input->post('category')
			);
		$this->common_model->insert_content($this->input->post('table'),$add_job);	
	}
	
	public function info()
	{
		$data['title'] = 'Edit Company Information';
		$this->template
				->set_layout('emplooyer_template')
				->build('company_information',$data);
	}
	
	public function upload_logo()
	{
		$this->load->library('imageupload');
		$image_info = getimagesize($_FILES["upl"]["tmp_name"]);
		$image_width = $image_info[0];
		$image_height = $image_info[1];
		
		$upload = $this->imageupload->uploadImageAjax($_FILES['upl']['name'],
				$_FILES["upl"]["tmp_name"],"assets/uploads/company_logo/","assets/uploads/company_logo/thumbnails/",900,900);
				
		$upload_thumb = $this->imageupload->generate_image_thumbnail($upload[1],$upload[0],100,100);
		
		$upload_orignal = $this->imageupload->generate_image_fixed_size($upload[1],$upload[1],900,900);
		
		//data passed to update image		
		$data = array(		
				'logo'					=> $upload[1],
				'logo_thumbnail' 	=> $upload[0]
				);
		
		//update the users table image
		$this->common_model->edit('company_information',$data,'user_id', $this->session->userdata('user_id'), 1, 0);	
		
		
		exit();
	}
	
	public function get_content()
	{
		if($this->input->post('table') == 'company_information')
		{
			$data['logo'] = $this->common_model->get_single_content('*',$this->input->post('table'),'user_id',$this->input->post('uid'));
			$this->load->view('company_logo',$data);
		} else if($this->input->post('table') == 'user_education') {
			$data['education'] = $this->common_model->get_contents('*',$this->input->post('table'),'user_id',$this->input->post('uid'),'id', 'desc');
			$this->load->view('education',$data);	
		}
	}
	
	public function delete()
	{
		if($this->input->post('table') == 'company_joblisting')
		{
			echo $this->common_model->delete_contents($this->input->post('table'),$this->input->post('id'));	
		}
	}
	
	public function get_applicants()
	{
		$query = "select A.*,B.username,B.first_name,B.last_name from applicants A
					inner join users B
					on A.user_id = B.id where A.job_id = ".$this->input->post('job_id')." ORDER BY A.id desc";
		$data['applicants'] = $this->common_model->custom_query($query);
		$this->load->view('applicants',$data);
	}
	
	public function settings()
	{
		$data['title'] = 'Company Settings';
		$data['notification'] = $this->common_model->get_single_content('*','user_notification','user_id',$this->session->userdata('user_id'));
		$this->template
				->set_layout('emplooyer_template')
				->build('company_settings',$data);
	}
	
	public function change_pass()
	{
		$this->load->model('ion_auth_model');
		$data = array('password' => $this->ion_auth_model->pass($this->input->post('password')));
		
		$this->common_model->edit('users',$data,'id',$this->session->userdata('user_id'),'Password Changed','Error Changing Password');	
	}
	
	public function update_notification()
	{
		$data = array('email_notification' => $this->input->post('email_notification'));
		$this->common_model->edit('user_notification',$data,'user_id',$this->session->userdata('user_id'),'Notification Updated','Error Updating Notification');	
	}
	
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
