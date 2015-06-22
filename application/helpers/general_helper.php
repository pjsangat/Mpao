<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function p($arr = array()){
    print "<pre>";
    print_r($arr);
    print "<pre>";
}

function pe($arr = array()){
    p($arr);
    exit;
}