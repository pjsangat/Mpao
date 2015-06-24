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

    public function get_sub_total($room_type_id) {

        $sql = "SELECT A.*,B.user_ID
                FROM temporary_cart_pending A
                LEFT JOIN treservation B on A.reservationID = B.reservationID
                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
                WHERE C.room_type_id = ? AND B.user_ID = ?";

        $query = $this->db->query($sql, array($room_type_id, $this->session->userdata('user_id')));
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

    public function get_total() {

        $sql = "SELECT A.*,B.user_ID, C.room_type_id
                FROM temporary_cart_pending A
                LEFT JOIN treservation B on A.reservationID = B.reservationID
                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
                WHERE B.user_ID = ? ";

        $query = $this->db->query($sql, array($this->session->userdata('user_id')));

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

}
