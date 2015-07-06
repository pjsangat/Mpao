<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Facility_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_facility_by_id($id = '') {
        if(empty($id)){
            return false;
        }
        
        
        $this->db->where('facility_iD', $id);
        
        $query = $this->db->get('tfacility');
        
        return $query->row();
        
    }

    public function get_facility($where = array()) {


        if (is_array($where) && !empty($where)) {
            $this->db->where($where);
        }

        $query = $this->db->get('tfacility');
        
        
        if($query->num_rows > 0){
            
            return $query->result();
            
        }
        
        return false;
        
    }

}
