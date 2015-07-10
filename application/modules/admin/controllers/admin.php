<?php if (!defined('BASEPATH')) die();
class Admin extends CI_Controller {
	
	function __construct()	
	{
		parent::__construct();
		$this->load->model('admin_model');

		$this->load->model(array('common_model','user_model'));
		$this->load->library('ion_auth');
		$this->ion_auth->islog($this->ion_auth->logged_in());
		$this->ion_auth->access_page();
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

	//start of Facility Tab

   	public function facilitymaintenance()
	{
		$this->load->library('form_validation');
		
				
		$facilitytypeID =str_replace("'",' ',$this->input->post('typefacility'));
		$facility = str_replace("'",'',$this->input->post('facility'));
		$description  = str_replace("'",'',$this->input->post('description'));
		$control  = str_replace("'",'',$this->input->post('control'));




		if(!empty($facility) && !empty($facilitytypeID) && !empty($description) && !empty($control))
		{
			$this->admin_model->form_insertfacility($facility,$facilitytypeID,$description,$control);
			redirect('admin/index','refresh');

		}

	}


	public function insertrentspace()
	{

		$this->load->library('form_validation');

		$name = str_replace("'",'',$this->input->post('Rent_Space_Name'));
		$facilityid = str_replace("'",'',$this->input->post('facility_category'));
		$maxperson = str_replace("'",'',$this->input->post('maximum_person'));
		$gender = str_replace("'",'',$this->input->post('Gender'));
		$malecount = str_replace("'",'',$this->input->post('Max_male_person'));
		$femalecount = str_replace("'",'',$this->input->post('Max_female_person'));
		$otherfacility = str_replace("'",'',$this->input->post('otherfac'));
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

	public function uploadfile()
	{
		$facilityid = str_replace("'",'',$this->input->post('facility'));
	
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'pdf';
		$config['max_size'] = '1000';
		$config['max_width'] = '2024';
		$config['max_height'] = '1468';

		$this->load->library('upload',$config);

		if(!$this->upload->do_upload())
		{
			$error = $this->upload->display_errors();

				$this->session->set_flashdata('uploaderror', $error);
				redirect(site_url('admin/index/'), 'refresh'); 

		}	
		else
		{
			$upload_data = $this->upload->data(); 
			$file_name =  str_replace("'",'',$upload_data['file_name']);
			$uploadmsg=  "Pdf successfully uploaded";
			$this->admin_model->updatefilepdf($file_name ,$facilityid);
			$this->session->set_flashdata('uploadmsg', $uploadmsg);
			redirect(site_url('admin/index'), 'refresh'); 

		}

 	

	}

 	//start of Requirement Tab

	public function requirements()
	{
		$data['title'] = 'Requirements';
		$data['requirementsdata'] = $this->getrequirement();
		$data['facilityall'] = $this->getallfacility();
		$data['unittype'] = $this->getunit();
		$data['ratereferrence'] = $this->getratereferrence();
		$this->template
			->set_layout('student_template')
			->build('requirements',$data);
	}

	public function addrequirement()
	{
		$requirementname = $this->input->post('newrequire');

		if(!empty($requirementname))
		{
			$result = $this->admin_model->insertrequirement($requirementname);
			$this->session->set_flashdata('newrequirementname',$result);
			redirect(site_url('admin/requirements/'),'refresh');
		}
		
	}

	public function getrequirement()
	{
		$result =  $this->admin_model->getallrequirementdata();
		return $result;
	}

	// inserting new requirement along it's rate and items available.
	public function insertnewrequirementrate()
	{
		$equipmentid =	str_replace("'",'',$this->input->post('require_name'));
		$facilityid = str_replace("'",'',$this->input->post('facility'));
		$uniid = str_replace("'",'',$this->input->post('unit'));
		$price = str_replace("'",'',$this->input->post('price'));
		$itemavailabe = str_replace("'",'',$this->input->post('requirement_available'));
		$result = $this->admin_model->insertnewraterequirement($equipmentid,$facilityid,$uniid,$price,$itemavailabe);
		$this->session->set_flashdata('newrequirementrate',$result);
		redirect(site_url('admin/requirements'),'refresh');

	}

	//Getting all unit type

	public function getunit()
	{
		$result = $this->admin_model->selectunittype();
		return $result;
	}

	public function insertnewunitype()
	{
		$unit = str_replace("'",'',$this->input->post('Unit_name'));
		$result = $this->admin_model->insertunittype($unit);
		$this->session->set_flashdata('newunitype',$result);
		redirect(site_url('admin/requirements'),'refresh');
	}

	public function insertratetype()
	{
		$rate =  str_replace("'",'',$this->input->post('Rate_name'));
		$ratereferrence =  str_replace("'",'',$this->input->post('ratereferrence'));
		$result = $this->admin_model->insertratetype($rate,$ratereferrence);
		$this->session->set_flashdata('newratetype',$result);
		redirect(site_url('admin/requirements'),'refresh');
		
	}
	public function getratereferrence()
	{
		$result = $this->admin_model->selectratereferrence();
		return $result;
	}



	//start of charges tab


	public function charges()
	{
		$data['title'] = 'Charges';
		$data['rentspaceroomtypeaircon'] = $this->getrentspaceroomtypeaircon();
		$data['rentspaceroomtypefemale'] = $this->getrentspaceroomtypefemale();
		$data['rentspaceroomtypemale'] = $this->getrentspaceroomtypemale();
		$data['natureofactivity'] = $this-> getnatureofactivity();
		$data['rentspaceventtype'] = $this->getrentspaceeventtype();
		$data['ratetype'] = $this->getratetype();

		$this->template
			->set_layout('student_template')
			->build('charges',$data);

	}

	public function getrentspaceroomtypeaircon()
	{
		$result = $this->admin_model->selectrentspaceroomtypeaircon();
		return $result;
	}
	public function getrentspaceroomtypefemale()
	{
		$result  = $this->admin_model->selectrentspaceroomtypefemale();
		return $result;
	}

	public function getrentspaceroomtypemale()
	{
		$result  = $this->admin_model->selectrentspaceroomtypemale();
		return $result;
	}

	public function addnatureactivity()
	{
		$name = str_replace("'",'',$this->input->post('activity'));
		$description = str_replace("'",'',$this->input->post('description'));
		$result  = $this->admin_model->insertnatureactivity($name,$description);


		if($result)
		{
			$this->session->set_flashdata('addactivity', $result);
			redirect(site_url('admin/charges'), 'refresh'); 
		}
	}

	public function getnatureofactivity()
	{
		$result  = $this->admin_model->selectnatureactivity();
		return $result;
	}

	public function getrentspaceeventtype()
	{
		$result  = $this->admin_model->selectrentspaceeventtype();
		return $result;
	}

	public function getratetype()
	{
		$result  = $this->admin_model->selectratetype();
		return $result;
	}

	public function insertchargesactivityevent()
	{
		$natureacvityid = str_replace("'",'',$this->input->post('activity'));
		$rentspaceid =    str_replace("'",'',$this->input->post('rentspace'));
		$ratetypeid = 	  str_replace("'",'',$this->input->post('renttype'));
		$regnumber =	  str_replace("'",'',$this->input->post('regularnumber')); 
		$regprice = 	  str_replace("'",'',$this->input->post('regularprice'));
		$sucnumber = 	  str_replace("'",'',$this->input->post('succeedingnumber'));
		$sucprice = 	  str_replace("'",'',$this->input->post('succeedingprice'));
		$aircon = 		  str_replace("'",'',$this->input->post('aircon'));

		if($aircon != 'true')
		{
			$aircon = 'No';
		}
		else
		{
			$aircon = 'Yes';
		}



		$dataresult = $this->admin_model->checkexistingcharges($rentspaceid,$aircon);
		

		
		
		$exist = 'false';

		foreach ($dataresult as $row) {

			$exist = $row->result;
			
		}

		if($exist == 'false')
		{
			$result = $this->admin_model->chargesevent($natureacvityid,$rentspaceid,$ratetypeid,$regnumber,$regprice,$sucnumber,$sucprice,$aircon);
		}
		
	

		 $this->session->set_flashdata('chargesexist', $exist);
		 redirect(site_url('admin/charges'), 'refresh'); 

	}

	//start of Reservation Tab

	public function reservation()
	{

	}

	public function getworklist()
	{
		$result = $this->admin_model->selectapprovalworklist();
		return $result;
	}

	public function reserved()
	{
		$data['title'] = 'Reservation-View';
		$data['facility'] = $this->input->get('facility');
		$data['reservationcartinfo'] = $this->getreservationcart($this->input->get('reservedcartid'));
		$data['controlnumber'] = $this->generatecontrolnumber($this->input->get('reservedcartid'));
		$this->template
			->set_layout('student_template')
			->build('reservationview',$data);

	}

	public function getreservationcart($reservationcartid)
	{
		$result = $this->admin_model->selectreservationcart($reservationcartid);
		return $result;
	} 

	public function generatecontrolnumber($reservationcartid)
	{

		$result = $this->admin_model->selectcontrolnumber($reservationcartid);
		return $result;

	}
	public function approvereservation()
	{
		$reservationid = $this->input->post('reservationid');
		$type = $this->input->post('typeemail');
		$control = $this->input->post('control');
		$emailadd = $this->input->post('emailadd');
		$msgemail = str_replace("'",'',$this->input->post('msgsend'));
		


		$result = $this->admin_model->updatestatusreservation($reservationid,$type);
		$resultmsg = "";
		if( $type == 2 )
		{
			$resultmsg = "New Reservation Approved";
		}
		else
		{
			$resultmsg = "Reservation Dis-Approved";
		}


		if($result)
		{
			$this->sendemail($control,$type,$emailadd,$msgemail);
			$this->session->set_flashdata('approvedmsg',$resultmsg);
			redirect(site_url('admin/reservation'),'refresh');
		}

			
	}

	public function sendemail($controlnum,$typeemail,$emailadd,$msgletter)
	{
		 
				$controlnumber = $controlnum;
				$type = $typeemail;
				$msg = $msgletter;
				$sentemailadd = $emailadd;
				
		
				require (base_url().'assets/boosstrap/PHPMailer_5.2.4/class.phpmailer.php');

				$mail = new PHPMailer();
				$mail->IsSMTP(); // set mailer to use SMTP
				$mail->SMTPDebug  = 2; 
				$mail->From = "arnelitobcabinti@gmail.com";
				$mail->FromName = "Arnel Cabinti";
				$mail->Host = "smtp.gmail.com"; // specif smtp server
				$mail->SMTPSecure= "ssl"; // Used instead of TLS when only POP mail is selected
				$mail->Port = 465; // Used instead of 587 when only POP mail is selected
				$mail->SMTPAuth = true;
				$mail->Username = "arnelitobcabinti@gmail.com"; // SMTP username
				$mail->Password = "yabsko2013"; // SMTP password
				$mail->AddAddress($email, "Arnel Cabinti"); //replace myname and mypassword to yours
				$mail->AddReplyTo("arnelitobcabinti@gmail.com", "Arnel Cabinti");
				$mail->WordWrap = 50; // set word wrap
				//$mail->AddAttachment("c:\\temp\\js-bak.sql"); // add attachments
				//$mail->AddAttachment("c:/temp/11-10-00.zip");

				$mail->IsHTML(true); // set email format to HTML
				$mail->Subject = 'Ateneo University Reservation Email';

				if ($type == 2)

				{

				$mail->Body =                '<h4>CONTROL NO.: '.$controlnumber.'</h4>
				                              <p>Your reservation has been approved.</p>
				                              <p>You may now process your payment through the following:</p>
				                              <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Cash or Check Payable to Ateneo de Manila University</strong></p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Print the Statement of Account</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Fill-up the Turn-Over Report below the Statement of Account</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Submit and pay to the cashier windows 7 or 8 at Xavier hall</p>
				                              <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. Via Metrobank Bills Payments Facility</strong></p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Indicate the name of theOrganizer , and the Control Number ( Refer to the Statement of Account )</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Account Name: Ateneo de Manila University</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Subscriber No.: 906 JPRC</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Reference: Lodging</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Kindly send us the copy of the deposit slip via e-mail or fax ( ecabanlit@ateneo.edu / Fax No.: 426-60-69 )</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Please wait for your Payment to be posted in 2-3 working days</p>
				                              <p><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C. Budget Transfer</strong> ( For those with Ateneo Budget Account only )</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Print  the statement of accont</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Accomplish the box below and fill up the budget transfer box</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Have it signed by the authorized signatory</p>
				                              <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- Submit to the MPAO Office</p></br></br>'.$msg ;  


				}

				else 
				{

				$mail->Body = '<label style="color:red;"><p>Sorry, but the facility you are reserving is not available.Please choose another date.</p></label><br><br>'.$msg;
				}


				if($mail->Send())
					 {
						echo "Send mail success";
					 }

				else {
						echo "Send mail fail";
					 } 


	}







	
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
