<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Worklist extends CI_Controller{
    
    
    
    function __construct() {
        parent::__construct();
    }
    
    public function index(){
        
        $data['title'] = 'Student Dashboard';
        $this->template
                ->set_layout('default')
                ->build('worklist/dashboard', $data);
    }
    
}