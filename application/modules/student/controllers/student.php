<?php

if (!defined('BASEPATH'))
    die();

class Student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('common_model', 'user_model'));
        $this->load->library('ion_auth');
        $this->ion_auth->islog($this->ion_auth->logged_in());
        $this->ion_auth->access_page();
    }

    #student dashboard

    public function index() {
        $data['title'] = 'Student Dashboard';
        $this->template
                ->set_layout('student_template')
                ->build('dashboard', $data);
    }

    public function calendar() {
        $data['title'] = 'Calendar';
        $this->template
                ->set_layout('student_template')
                ->build('dashboard', $data);
    }

    public function json() {

        $get = "select A.*,B.* from treservation A
				left join treservationcartpending B
				on A.reservationID = B.reservationID 
				where A.facilityID = '" . $this->input->post('facilityid') . "' and A.statusID = '2'";
        $query = $this->common_model->custom_query($get);
        foreach ($query as $q) {
            $reserv[] = array(
                'id' => $q->reservationID,
                'title' => $q->name,
                'start' => $q->startdate . 'T00:00:00',
                'end' => $q->enddate . 'T23:59:00',
                'allDay' => false
            );
        }
        echo json_encode($reserv);
        exit;
    }

    public function dates() {
        $get = "select * from treservationcartpending";
        $query = $this->common_model->custom_query($get);
        foreach ($query as $q) {
            $reserv[] = $q->startdate;
        }
        echo json_encode($reserv);
    }

    public function get_reservation() {
        //$reserv[] = array();
        $get = "select * from treservation";
        $query = $this->common_model->custom_query($get);
        foreach ($query as $q) {
            $reserv[] = array(
                'id' => $q->reservationID,
                'title' => $q->organizer,
                'start' => $q->date_activity,
                'end' => $q->date_activity,
                'allDay' => false
            );
        }
        echo json_encode($reserv);
    }

    public function check_date() {
        //$count_query = "select * from  treservationcartpending where startdate = '".$this->input->post('date')."'";
        //$count_reserve = $this->common_model->custom_count($count_query);$this->input->post('date');
        //echo $count_reserve;
        //exit();
        /* $dates = "select date_activity from treservation where date_activity = '".$this->input->post('date')."' and facilityID = '".$this->input->post('facilityid')."'";
          $count_date = $this->common_model->custom_count($dates);
          if($count_date >= 2)
          {
          echo 'Full Reservation Already';
          } else {
          $this->load->view('reserve');
          } */
        $rooms_query = "select * from trentspace where Facility_ID = '" . $this->input->post('facilityid') . "' and is_otherfacility = '0'";
        $rooms_other_facility_query = "select * from trentspace where Facility_ID = '" . $this->input->post('facilityid') . "' and is_otherfacility = '1'";
        $data['rooms'] = $this->common_model->custom_query($rooms_query);
        $data['rooms_facility'] = $this->common_model->custom_query($rooms_other_facility_query);
        $data['nature'] = $this->common_model->get_contents('*', 'tactivity', 'facility_id', $this->input->post('facilityid'), 'activityID', 'asc');
        $data['city'] = $this->common_model->getAll('tcity', '*', 'CityID', 'asc');
        $this->load->view('reserve_form', $data);
    }

    public function addreservation() {
        $datas = array(
            "user_ID" => $this->session->userdata('user_id'),
            "name" => $this->input->post('title_activity'),
            "activityID" => $this->input->post('nature'),
            "organizer" => $this->input->post('organizer'),
            "authorized_Person" => $this->input->post('representative'),
            "position" => $this->input->post('position'),
            "st_brgy" => $this->input->post('barangay'),
            "cityID" => $this->input->post('city'),
            "email" => $this->input->post('email'),
            "mobile" => $this->input->post('mobile'),
            "landline" => $this->input->post('landline'),
            "date_activity" => $this->input->post('date'),
            "statusID" => "1",
            "facilityID" => $this->input->post('facityid')
        );
        if ($this->db->insert('treservation', $datas)) {
            echo $this->db->insert_id();
        } else {
            echo '0';
        }
    }

    public function rooms_available() {
        //$query = "select user_ID from treservation where user_ID = '".$this->session->userdata('user_id')."'";
        //echo $check_user = $this->common_model->custom_count($query);
        //echo $this->session->userdata('user_id');
        //echo $this->uri->segment(4);

        $query_details = "select A.*,B.* from treservation A
						left join tactivity B
						on A.activityID = B.activityID
						 where A.reservationID = '" . $this->uri->segment(4) . "'";
        $airconquery = "select * from trentspace  
					where Facility_ID = '" . $this->uri->segment(3) . "' and room_type_id = '1' and is_otherfacility = '0'";

        $nonairconquery = "select * from gender where id != '3'";
        $other_facilityquery = "select A.*,B.* from trentspace A 
					left join trentpromo B
					on A.rentspace_ID = B.Rent_spaceID
					where A.Facility_ID = '" . $this->uri->segment(3) . "' and A.is_otherfacility = '1'";
        $other_charges_query = "select A.*,B.* from other_charges A
								left join tunit_type B
								on A.unit_id = B.Unit_typeID";

        $data['details'] = $this->common_model->single_result_query($query_details);

        $data['aircon'] = $this->common_model->custom_query($airconquery);
        $data['noaircon'] = $this->common_model->custom_query($nonairconquery);
        $data['others'] = $this->common_model->custom_query($other_facilityquery);
        $data['other_charges'] = $this->common_model->custom_query($other_charges_query);
        $this->template
                ->set_layout('student_template')
                ->build('available_rooms', $data);
    }

    public function room() {
        /* $airconquery = "select A.*,B.* from trentspace A 
          left join trentpromo B
          on A.rentspace_ID = B.Rent_spaceID
          where A.Facility_ID = '".$this->uri->segment(3)."' and B.Is_Aircon = '1' and A.is_otherfacility = '0'";
          $data['aircon'] = $this->common_model->custom_query($airconquery); */
        $this->template
                ->set_layout('student_template')
                ->build('test');
    }

    public function get_schedule() {
        echo $this->input->post('id');
    }

    public function my_reservation() {
        $data['reserve'] = $this->common_model->get_contents('*', 'treservation', 'client_ID', $this->session->userdata('user_id'), 'reservationID', 'desc');
        $this->template
                ->set_layout('student_template')
                ->build('my_reservation', $data);
    }

    public function reserve_rooms() {
        $date_in = explode(" ", $this->input->post('date_time_in'));
        $date_out = explode(" ", $this->input->post('date_time_out'));
        $data = array(
            'reservationID' => $this->input->post('reservation_id'),
            'startdate' => $date_in[0],
            'enddate' => $date_out[0],
            'stime' => $date_in[1],
            'etime' => $date_out[1],
            'rent_space_id' => $this->input->post('room_id'),
            'number_of_guest' => $this->input->post('gender'),
            'stime_type' => $date_in[2],
            'etime_type' => $date_out[2],
            'gender' => $this->input->post('gender_guest')
        );

        if ($this->db->insert('temporary_cart_pending', $data)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function otherfacility() {
        $date_in = explode(" ", $this->input->post('date_time_in'));
        $date_out = explode(" ", $this->input->post('date_time_out'));
        $data = array(
            'reservationID' => $this->input->post('reservation_id'),
            'startdate' => $date_in[0],
            'enddate' => $date_out[0],
            'stime' => $date_in[1],
            'etime' => $date_out[1],
            'rent_space_id' => $this->input->post('room_id'),
            'number_of_guest' => $this->input->post('no_of_person'),
            'stime_type' => $date_in[2],
            'etime_type' => $date_out[2],
            'gender' => '2',
            'other_charge_id' => $this->input->post('charge')
        );

        if ($this->db->insert('temporary_cart_pending', $data)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function reserve_requirment() {
        $date_in = explode(" ", $this->input->post('date_time_in'));
        $date_out = explode(" ", $this->input->post('date_time_out'));
        $data = array(
            'reservationID' => $this->input->post('reservation_id'),
            'Dateto' => $date_in[0],
            'Datefrom' => $date_out[0],
            'Timeto' => $date_in[1],
            'Timefrom' => $date_out[1],
            'R_ForRentID' => $this->input->post('requirment_id')
        );
        if ($this->db->insert('treserverequirement', $data)) {
            echo '1';
        } else {
            echo '0';
        }
    }

    public function compute_reservation() {
        $query = "select A.*,B.Name,B.is_female,B.is_male,B.is_both_gender,C.is_NoAircon,C.Is_Aircon 
				from treservationcartpending A
				left join trentspace B
				on A.rent_space_id = B.rentspace_ID 
				left join trentpromo C
				on B.rentspace_ID = C.Rent_spaceID
				where A.reservationID = '" . $this->input->post('reservation_id') . "' and B.is_otherfacility = '0'";
        $query_other = "select A.*,B.Name,B.is_female,B.is_male,B.is_both_gender,
				C.is_NoAircon,C.Is_Aircon from treservationcartpending A
				left join trentspace B
				on A.rent_space_id = B.rentspace_ID 
				left join trentpromo C
				on B.rentspace_ID = C.Rent_spaceID
				where A.reservationID = '" . $this->input->post('reservation_id') . "' and B.is_otherfacility = '1'";
        $data['compute'] = $this->common_model->custom_query($query);
        $data['others'] = $this->common_model->custom_query($query_other);
        $this->load->view('compute_reservation', $data);
    }

    public function testing() {
        $data['all'] = $this->common_model->getAll('treservation', '*', 'reservationID', 'asc');
        $this->load->view('testing', $data);
    }

    public function get_compute() {
        $query = "select A.*,B.user_ID, C.room_type_id from temporary_cart_pending A
				left join treservation B on A.reservationID = B.reservationID
                                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
				where A.rent_space_id = '" . $this->input->post('rent_space_id') . "' and user_ID = '" . $this->session->userdata('user_id') . "'";
        $data['compute'] = $this->common_model->custom_query($query);
        $this->load->view('compute_charges', $data);
    }
    
    public function get_compute_non_ac(){
        
        $query = "select A.*,B.user_ID, C.* from temporary_cart_pending A
				left join treservation B on A.reservationID = B.reservationID
                                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
				where A.rent_space_id = '" . $this->input->post('rent_space_id') . "' and user_ID = '" . $this->session->userdata('user_id') . "'";
        $data['compute'] = $this->common_model->custom_query($query);
        $this->load->view('compute_charges_nonac', $data);
        
    }

    public function get_compute_others() {
        $query = "select A.*,B.user_ID, C.room_type_id from temporary_cart_pending A
				left join treservation B on A.reservationID = B.reservationID
                                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
				where A.rent_space_id = '" . $this->input->post('rent_space_id') . "' and user_ID = '" . $this->session->userdata('user_id') . "'";
        $data['compute'] = $this->common_model->custom_query($query);
        $this->load->view('compute_charges_others', $data);
    }

    public function delete() {
        $this->common_model->delete_contents('temporary_cart_pending', 'ID', $this->input->post('id'));
    }

    public function get_no_allowed() {
        echo $this->input->post('room_id');
        $this->load->view('room_allowed_no');
    }

    public function get_grand_total() {
        //$query_total = "select * from temporary_cart_pending where reservationID = '".$this->input->post('reservation_id')."' and ";
        //$query = $this->common_model->custom_query();
        $this->load->model('reservation_model', 'reservation');
        $data['total'] = $this->reservation->get_total();
        
        echo number_format($data['total'], 2, ".", ",");
        exit;
        
        
    }

    public function get_sub_total($room_type_id) {
        $this->load->model('reservation_model', 'reservation');
        $data['sub_total'] = $this->reservation->get_sub_total($room_type_id);
        
        $this->load->view('subtotal', $data);
    }

}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
