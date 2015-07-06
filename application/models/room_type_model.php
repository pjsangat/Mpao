<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Room_type_model extends CI_Model{
    
    function __construct() {
        parent::__construct();
    }
    
    public function get_room_type($room_type_id = ''){
        if(empty($room_type_id)){
            return false;
        }
        
        $this->db->where('id', $room_type_id);
        
        
        $query = $this->db->get('room_type');
        
        
        if($query->num_rows > 0){
         
            return $query->row();
         
        }
        
        return false;
    }
    
}