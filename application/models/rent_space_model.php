<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Rent_space_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_rent_space($rent_space_id = ''){
        if(empty($rent_space_id)){
            return false;
        }
        
        $this->db->where('rentspace_ID', $rent_space_id);
        
        
        $query = $this->db->get('trentspace');
        
        
        if($query->num_rows > 0){
            
            $this->load->model('room_type_model', 'room_type');
            
            $result = $query->row();
            $result->room_type = $this->room_type->get_room_type($result->room_type_id);
            
            return $result;
         
        }
        
        return false;
    }
    
}