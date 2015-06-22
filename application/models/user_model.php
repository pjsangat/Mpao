<?php
/*
 * Unit_model
 * An easier way to construct your unit testing
 * and pass it to a really nice looking page.
 *
 * @author sjlu
 */
class User_model extends CI_Model {

   	public function __construct()
   	{
      parent::__construct();
   	}

   	public function checkDuplicate($table,$field,$singleVariable)
	{
		$query = $this->db->get_where($table, array($field => $singleVariable));
			if ($query->num_rows() == '0')
			{
			echo 'true';
			}
		  else
			{
			echo 'false';
		  }
	}
	
	public function insertUser($password)
	{
		$activation_code = sha1(mt_rand(10000,99999).time().$this->input->post('email'));
		$users = array(			
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
				'password'		=> $password,
				'email'			=> $this->input->post('email'),
				'created_on'	=> time(),
				'activation_code' => $activation_code,
				'active'		=> '0',
		);	
		$this->db->insert('users', $users);
		$lastIdUserInserted = $this->db->insert_id();
		
		$to = $this->input->post('email');
		$subject = "Activate your account";
		$message = "<p>Hi ".$this->input->post('first_name')."</p>";
		$message .= "<p>Thanks for getting started.</p>";
		$message .= "<p>Please follow this link to activate your account :</p>";
		$message .= "<p><a href='".base_url()."/auth/activate/".$lastIdUserInserted."/".$activation_code."'>Activate</a></p>";
		$header = "From:noreply@test.com \r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";
		$retval = mail ($to,$subject,$message,$header);
		
		
		$unique_username = explode("@",$this->input->post('email'));
		$unique_u = $unique_username[0].''.$lastIdUserInserted;
		$unique_u_username = str_replace(".","",$unique_u);
		
		$data_update = array('username' => $unique_u_username);
		$this->db->where('id', $lastIdUserInserted);
		$this->db->update('users', $data_update);
		
		$insertM = array(
					'user_id'	=>	$lastIdUserInserted,
					'group_id'	=>	$this->input->post('type')
						 );
		$newUser = $this->db->insert('users_groups', $insertM);
		
		//insert if type selected employer
		if($newUser) {
			echo '1';
		} else {
			echo '0';
		}
	}
	
	
	
	public function get_job()
	{
		$query = $this->db->query("select A.*,B.*,A.id as jobid from company_joblisting A
									left join company_information B
									on A.user_id = B.user_id
									where A.id = ".$this->uri->segment(3)."");
		return $query->row_array();
	}
	
	public function employee_job_list($limit, $start)
	{
		$query = $this->db->query("select A.*,B.* from company_joblisting A
									left join applicants B
									on A.id = B.job_id
									where B.user_id = ".$this->session->userdata('user_id')." order by A.id asc LIMIT $start, $limit");
		return $query->result();
	}
	
	public function get_applicant()
	{
		$query = $this->db->query("select A.id,B.*,C.first_name,C.last_name,C.profile_picture_thumbnail,C.user_summary, C.username, C.id as user_id from company_joblisting A
									inner join applicants B
									on A.id = B.job_id
									left join users C
									on B.user_id = C.id
									where A.id = ".$this->uri->segment(3)."");
		
		return $query->result();	
	}
	
	public function get_profile()
	{
		$query = $this->db->query("select A.first_name,A.last_name,A.resume,A.user_summary,A.email,B.phone,B.skype,B.yahoo,B.googlechat from users A
									left join user_contact B
									on A.id = B.user_id
									where A.id = ".$this->session->userdata('user_id')."");
		//echo '<pre>'; print_r($query->row_array()); echo '</pre>';
		return $query->row_array();
	}
	
	public function search_job()
	{
		$query1 = $this->db->query("select * from categories where alias = '".$this->uri->segment(4)."'");
		$cat = $query1->row_array();
		$query = $this->db->query("select A.*,B.*,B.id as company_id, A.id as job_id from company_joblisting A
									left join company_information B
									on A.user_id = B.user_id  
									where A.category_id = '".$cat['id']."' and 
									(A.title LIKE '%".$this->uri->segment(3)."%' 
									or A.description LIKE '%".$this->uri->segment(3)."%')");
		return $query->result();
	}
}
