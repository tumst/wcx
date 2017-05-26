<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require APPPATH . '/libraries/REST_Controller.php';

/**
 * Description of c_packagingrecord_api
 *
 * @author Sa-ard Samenram
 */
class api_lotqueuefin extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        //echo '_allow is '. $this->_allow .'<br>';
        
        $this->load->model('');
    }

    function lots_fin_get(){
        //select all
        
        
    }
    
    function lot_fin_get(){
        //select one
        
        
    }
    
    function pkgrecord_post(){
        //insert
        
    }
    
    function pkgrecord_put(){
        //update
        
    }
    
    function pkgrecord_delete(){
        //delete
        
    }
    
    
}

/* End of file api_lotqueuefin */
/* Location: ./application/controllers/api/api_lotqueuefin.php */