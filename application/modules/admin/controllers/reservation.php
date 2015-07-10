<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reservation extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('admin_model', 'admin');
        $this->load->model('reservation_model', 'reservation');
    }

    public function index() {



        $worklist = $this->reservation->get_reservation(array('statusID' => 1));
        $data['title'] = 'Reservation';
        $data['facilityall'] = $this->admin->getalldata();
        $data['worklist'] = $worklist;

        $this->template
                ->set_layout('student_template')
                ->build('reservation', $data);
    }

    public function reserve($reservation_id) {

        $result = $this->reservation->get_reservation( array('reservationID' => $reservation_id), true);
        $data = array();
        $data['reservationcartinfo'] = (array)$result;
        
        $data['facility'] = $data['reservationcartinfo']['facility']->Facility_name;
        $this->template
                ->set_layout('student_template')
                ->build('reservationview', $data);
    }

}
