<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reservation_model extends CI_model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function get_sub_total($room_type_id){
        
        $sql = "SELECT A.*,B.user_ID
                FROM temporary_cart_pending A
                LEFT JOIN treservation B on A.reservationID = B.reservationID
                INNER JOIN trentspace C on C.rentspace_ID = A.rent_space_id
                WHERE C.room_type_id = ? AND B.user_ID = ?";
        
        $query = $this->db->query($sql, array($room_type_id, $this->session->userdata('user_id')));
        
        if($query->num_rows > 0){
            return $query->result();
        }
        
        
        return false;
    }
    
}