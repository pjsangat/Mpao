<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reservation_model extends CI_model {

    function __construct() {
        parent::__construct();
    }
    
    public function get_all(){
        
         
       
    }
    public function update_status($data = array()){
        $arrValue = array();
        $arrValue['statusID'] = $data['status'];
        $this->db->where('reservationID', $data['reservation_id']);
        $this->db->where('facilityID', $data['facility_id']);
        $this->db->update('treservation', $arrValue);
        
    }
    
    public function move_to_approval($data = array()){
        
        $this->db->where('reservationID', $data['reservation_id']);
        $this->db->where('facilityID', $data['facility_id']);
        $query = $this->db->get('treservation');
        
        if( $query->num_rows > 0 ){
            $this->load->model('facility_model', 'facility');
            $result = $query->row();
            $facility = $this->facility->get_facility_by_id($data['facility_id']);
//            $start_date_time = $this->db->query('select startdate, stime, stime_type from temporary_cart_pending where reservationID = ? order by startdate asc limit 1', array($data['reservation_id']))->row();
//            $end_date_time = $this->db->query('select enddate, etime, etime_type from temporary_cart_pending where reservationID = ? order by startdate desc limit 1', array($data['reservation_id']))->row();
//            $max_person = $this->db->query('select max(number_of_guest) as max_person from temporary_cart_pending where reservationID = ? order by startdate desc limit 1', array($data['reservation_id']))->row()->max_person;
//            
//            $facility = $this->db->query('select * from tfacility where facility_iD = ?', array($data['facility_id']))->row();
//            
//            $user =  $this->db->query('select * from users where id = ?', array($result->user_ID))->row();
//            
//            $activity =  $this->db->query('select * from tactivity where activityID = ?', array($result->activityID))->row();
            $cart =  $this->db->query('select * from temporary_cart_pending where reservationID = ?', array($result->reservationID));
            $data = array();
//            $data['startdate'] = date("M d Y", strtotime($start_date_time->startdate));
//            $data['enddate'] = date("M d Y", strtotime($end_date_time->enddate));
//            $data['stime'] = $start_date_time->stime;
//            $data['etime'] = $end_date_time->etime;
//            $data['reservationID'] = $result->reservationID;
//            $data['facilityID'] = $result->facilityID;
//            $data['facility_Name'] = $facility->Facility_name;
//            $data['control'] = $facility->Control_Number_Header;
//            $data['user_id'] = $result->user_ID;
//            $data['Client_Name'] = $user->first_name. " " . $user->last_name;
//            $data['name'] = $result->name;
//            $data['activity'] = $activity->Activity;
//            $data['date_activity'] = $result->date_activity;
//            $data['organizer'] = $result->organizer;
//            $data['authorized_person'] = $result->authorized_Person;
//            $data['position'] = $result->position;
//            $data['st_brgy'] = $result->st_brgy;
//            $data['email'] = $result->email;
//            $data['mobile'] = $result->mobile;
//            $data['landline'] = $result->landline;
//            $data['number_person'] = $result->number_person;
//            $data['date_created'] = $result->DATE_Created;
//            $data['status'] = 'Pending';
//            $data['statusID'] = 1;
            
            $cnt = $this->db->query('SELECT count(*) as count FROM treservation_control_no WHERE date = ? AND month = ?', array(date("Y"), date("m")))->row()->count;
            
            $data['reservation_id'] = $result->reservationID;
            $data['date'] = date("y");
            $data['month'] = date("m");
            $data['code'] = $facility->Control_Number_Header;
            $data['control_num'] = $facility->Control_Number_Header.date("y")."-".date("m")."-".str_pad( ($cnt + 1), 4, 0, STR_PAD_LEFT);
            
            $this->db->insert('treservation_control_no', $data);
            
            $data = array();
            if($cart->num_rows > 0){
                foreach($cart->result() as $item){
                    
                    $data['rentpromo_ID'] = $item->rentpromo_ID;
                    $data['reservationID'] = $item->reservationID;
                    $data['startdate'] = $item->startdate;
                    $data['enddate'] = $item->enddate;
                    $data['stime'] = $item->stime;
                    $data['etime'] = $item->etime;
                    $data['stime_type'] = $item->stime_type;
                    $data['etime_type'] = $item->etime_type;
                    $data['male'] = 0;
                    $data['female'] = 0;
                    $data['Both_Gender'] = 0;
                    $data['Aircon_Avail'] = $item->Aircon_Avail;
                    $data['rent_space_id'] = $item->rent_space_id;
                    $data['number_of_guest'] = $item->number_of_guest;
                    $data['date_created'] = $item->date_created;

                    $this->db->insert('treservationcartpending', $data);
                }
            }
        }
        
    }
    
    public function get_sub_total($room_type_id, $reservation_id, $user_id) {

        $sql = "SELECT A.*,B.user_ID
                FROM temporary_cart_pending A
                LEFT JOIN treservation B on A.reservationID = B.reservationID
                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
                WHERE C.room_type_id = ? AND B.user_ID = ? AND A.reservationID = ?";

        $query = $this->db->query($sql, array($room_type_id, $user_id, $reservation_id));
        $amount = 0;

        if ($query->num_rows > 0) {

            foreach ($query->result() as $result) {

                switch ($room_type_id) {
                    case 1:
                        
                        $rent = $this->db->query("select * from charges where rent_space_id = ?  order by id asc LIMIT " . $result->number_of_guest, array($result->rent_space_id))->result();
                        foreach ($rent as $charges) {
                            $amount += $charges->amount;
                        }

                        break;
                        
                    case 2:
                        
                        $rent = $this->db->query("select * from charges where rent_space_id = ? ", array($result->rent_space_id))->row();
                        for($ctr = 0; $ctr < $result->number_of_guest; $ctr++){
                            $amount += $rent->amount;
                        }
                        
                        break;


                    case 3:
                        
                        $rent = $this->db->query("select * from other_charges where id = '".$result->other_charge_id."'")->row();
                        $amount += $rent->cost * $result->number_of_guest;
                        
                        break;
                    
                    default:
                        break;
                }
            }
        }

        return $amount;
    }

    public function get_total($reservation_id, $user_id) {

        $sql = "SELECT A.*,B.user_ID, C.room_type_id
                FROM temporary_cart_pending A
                LEFT JOIN treservation B on A.reservationID = B.reservationID
                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
                WHERE B.user_ID = ? AND A.reservationID = ?";

        $query = $this->db->query($sql, array($user_id, $reservation_id));

        $amount = 0;
        if ($query->num_rows > 0) {

            foreach ($query->result() as $result) {
                switch ($result->room_type_id) {
                    case 1:
                        
                        $rent = $this->db->query("select * from charges where rent_space_id = ?  order by id asc LIMIT " . $result->number_of_guest, array($result->rent_space_id))->result();
                        foreach ($rent as $charges) {
                            $amount += $charges->amount;
                        }

                        break;
                        
                    case 2:
                        
                        $rent = $this->db->query("select * from charges where rent_space_id = ? ", array($result->rent_space_id))->row();
                        for($ctr = 0; $ctr < $result->number_of_guest; $ctr++){
                            $amount += $rent->amount;
                        }
                        
                        break;


                    case 3:
                        
                        $rent = $this->db->query("select * from other_charges where id = '".$result->other_charge_id."'")->row();
                        $amount += $rent->cost * $result->number_of_guest;
                        
                        break;
                    
                    default:
                        break;
                }
            }
        }

        return $amount;
    }
    
    
    
    
    public function get_reservation($where = array(), $details = false){
        
        $this->load->model('facility_model', 'facility');
        $this->load->model('activity_model', 'activity');
        $this->load->model('reservation_cart_model', 'reservation_cart');
        $this->load->model('user_model', 'user');
        
        $arrValue = array();
        
        if(is_array($where) && !empty($where)){
            $this->db->where($where);
        }
        
        
        $query = $this->db->get('treservation');
        
        if($query->num_rows > 0){
            
            $ctr = 0;
            foreach($query->result() as $result){
                
                $result->client = $this->user->get_by_id($result->user_ID);
                $result->facility = $this->facility->get_facility_by_id($result->facilityID);
                $result->activity = $this->activity->get_activity_by_id($result->activityID);
                
                $control = $this->db->query('SELECT control_num FROM treservation_control_no WHERE reservation_id = ?', array($result->reservationID));
                if($control->num_rows > 0){
                    $result->control_number = $control->row()->control_num;
                }else{
                    $result->control_number = '';
                }
                if($details){
                    $result->room_reserves = $this->reservation_cart->get_reservation_cart($result->reservationID);
                    foreach($result->room_reserves as $reserves){
                        $result->subtotal_amount[$reserves->rent_space->room_type_id] = $this->get_sub_total($reserves->rent_space->room_type_id, $result->reservationID, $result->user_ID);
                    }
                }
                $result->total_amount = $this->get_total($result->reservationID, $result->user_ID);
                
                if($query->num_rows == 1){
                    $arrValue = $result;
                }else{
                    $arrValue[$ctr] = $result;
                }
                $ctr++;
            }
            return $arrValue;
        }
        
        
        return false;
    }

}
