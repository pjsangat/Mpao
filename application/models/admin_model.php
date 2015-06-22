<?php
class admin_model extends CI_Model{
function __construct() {
parent::__construct();
}

	public function form_insertfacility($facility,$facilitytypeID,$description,$control)
	{
		$this->db->query("INSERT INTO 
						tfacility (facilitytypeID,facility_name,facility_description,Control_Number_Header,date_created) VALUES
						('$facilitytypeID','$facility','$description','$control',CURDATE())");
	}

	public function updatefilepdf($filename,$facilityid)
	{
		$this->db->query("UPDATE tfacility SET PDF_File ='$filename' where facility_id = '$facilityid'");
		
	}

	public function insertrentspace($name,$facilityid,$maxperson,$gender,$maleperson,$femaleperson,$otherfacility)
	{

		$this->db->query("CALL insertnewrentspaces('$name','$facilityid','$maxperson','$gender','$maleperson','$femaleperson',$otherfacility)");

	}

	public function insertrequirement($requirement)
	{

		$result = $this->db->query("INSERT INTO trequirements (requirement_name) VALUES('$requirement')");	
		return $result;	
	}

	public function getalldata()
	{
		$result = $this->db->query("Select facility_iD,Facility_name from tfacility");
		return $result->result();
		
	}

	public function getallrequirementdata()
	{
		$myresult = $this->db->query("Select requirement_ID,requirement_name from trequirements");
		return $myresult->result();
		
	}

	public function insertnewraterequirement($equipmentid,$facilityid,$unitid,$price,$numberavailability)
	{

		$result = $this->db->query("INSERT INTO trequirement_forrent (requirement_ID,facility_ID,Unit_typeID,Price,Available_item)
								    VALUES('$equipmentid','$facilityid','$unitid','$price','$numberavailability')");

		return $result;
	}

	public function selectunittype()
	{
		$result = $this->db->query("SELECT Unit_typeID, Unit_typename from tunit_type");
		return $result->result();
	}


	public function insertunittype($unittype)
	{

		$result = $this->db->query("INSERT INTO tunit_type (Unit_typename) VALUES('$unittype')");
		return $result;
	}

	public function insertratetype($ratetype,$referrenceid)
	{
		$result = $this->db->query("INSERT INTO trate_type (rate_name,ratereferrenceID) VALUES('$ratetype','$referrenceid')");
		return $result;
		
	}
	public function selectratereferrence()
	{
		$result = $this->db->query("SELECT ratereferrenceID, referrenceName from ratereferrence");
		return $result->result();
		
	}

	public function selectrentspaceroomtypeaircon()
	{
		$result = $this->db->query("SELECT `rentspace_ID`,`Name` from trentspace a
									LEFT JOIN tfacility b ON a.facility_id = b.facility_id
									where b.facilitytypeid = 2 and a.is_otherfacility = 0
									and a.is_female = 1 and a.is_male = 1");
		return $result->result();
	}

	public function selectrentspaceroomtypefemale()
	{
		$result = $this->db->query("SELECT `rentspace_ID`,`Name` from trentspace a
									LEFT JOIN tfacility b ON a.facility_id = b.facility_id
									where b.facilitytypeid = 2 and a.is_otherfacility = 0
									and a.is_female = 1 and a.is_male = 0");
		return $result->result();
	}
	public function selectrentspaceroomtypemale()
	{
		$result = $this->db->query("SELECT `rentspace_ID`,`Name` from trentspace a
									LEFT JOIN tfacility b ON a.facility_id = b.facility_id
									where b.facilitytypeid = 2 and a.is_otherfacility = 0
									and a.is_female = 0 and a.is_male = 1");
		return $result->result();
	}

	public function insertnatureactivity($name,$description)
	{
		$result = $this->db->query("INSERT INTO natureactivity (natureactivity_name,natureactivity_description)
									VALUES('$name','$description')");
		return $result;
	}

 	public function selectnatureactivity()
 	{
 		$result = $this->db->query("SELECT natureactivity_id,natureactivity_name from natureactivity");
 		return $result->result();
 	}
 	public function selectrentspaceeventtype()
 	{
 		$result = $this->db->query("SELECT rentspace_ID,Name from trentspace a LEFT JOIN tfacility b ON a.facility_id = b.facility_id
 									where b.facilitytypeid = 1");
 		return $result->result();
 	}
 	public function selectratetype()
 	{
 		$result = $this->db->query("SELECT rate_typeid,rate_name FROM trate_type");
 		return $result->result();

 	}

 	public function checkexistingcharges($rentspaceID,$aircon)
 	{
 		$result='';

 		if($aircon == 'Yes')
 		{
 			$result  = $this->db->query("SELECT 'true' result from charges_eventtype where rent_spaceid =  $rentspaceID AND aircontype = 'Yes'");
 		}
 		else
 		{
 			$result  = $this->db->query("SELECT 'true' result from charges_eventtype where rent_spaceid =  $rentspaceID AND aircontype = 'No'");
 		}

 		return $result->result();

 	}

 	public function chargesevent($natureid,$rentspaceID,$rateid,$regnumber,$regprice,$sucnumber,$sucprice,$aircon)
 	{
 		$result = $this->db->query("INSERT INTO charges_eventtype (natureactivity_id,rent_spaceid,rate_typeid,regular_number_per_rate,regular_price,succeeding_number_per_rate,succeeding_price,aircontype,date_created)
 									 VALUES ('$natureid','$rentspaceID','$rateid','$regnumber','$regprice','$sucnumber'
 									,'$sucprice','$aircon',CURDATE())");
 		return $result;

 	}


 	public function selectapprovalworklist()
 	{
 		$result = $this->db->query("SELECT reservationcartpending_ID cartid , facilityid id ,CONCAT(CLIENT_name,' / ',startdate,' - ',enddate,' / ', activity) Approval,reservationid reservationID from `vtreservationapproval`
									where statusid = 1 ORDER BY startdate asc");
 		return $result->result();
 	}

 	public function selectreservationcart($reservationcartid)
 	{
 		$result = $this->db->query("SELECT `name`,`activity`,`organizer`,`authorized_person`,`position`,`date_activity`,`mobile`,`email`,`landline`,CONCAT(`st_brgy`,' ',`city`) Address FROM `vtreservationapproval` where reservationcartpending_ID = '$reservationcartid' ");
 		return $result->result();
 	}
 	public function selectcontrolnumber($reservationcartid)
 	{
 		$result = $this->db->query("SELECT CONCAT(control,RIGHT(LEFT(date_activity,4),2),'-',RIGHT(LEFT(date_activity,7),2),'-',reservationcartpending_ID) control_number from vtreservationapproval
									where reservationcartpending_ID = '$reservationcartid'");
 		return $result->result();
 	}

 	public function updatestatusreservation($reservationid,$type)
 	{
 		$result = $this->db->query("UPDATE treservation SET statusid = '$type' where reservationID = '$reservationid'");
 		return $result;
 	}


	






}

?>