<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Reservation_cart_model extends CI_Model{
    
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_reservation_cart($reservation_id = ''){
        if(empty($reservation_id)){
            return false;
        }
        $arrValue = array();
        
        $this->db->where('reservationID', $reservation_id);
        
        
        $query = $this->db->get('treservationcartpending');
        
        
        if($query->num_rows > 0){
            $ctr = 0;
            
            $this->load->model('rent_space_model', 'rent_space');
            
            foreach($query->result() as $result){
                
                $result->rent_space = $this->rent_space->get_rent_space($result->rent_space_id);
                $arrValue[$ctr] = $result;
                
                $ctr++;
            }
            
            return $arrValue;
        }
        
            
        return false;
    }
}