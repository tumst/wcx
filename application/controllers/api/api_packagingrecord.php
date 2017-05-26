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
class api_packagingrecord extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        //echo '_allow is '. $this->_allow .'<br>';
        
        $this->load->model('m_inventory_packagingstock');
    }

    function pkgrecord_get(){
        
    }
    
    function pkgrecord_post(){
        
    }
    
    function pkgrecord_put(){
        
    }
    
    function pkgrecord_delete(){
        
    }
    
    
}

/* End of file api_packagingrecord */
/* Location: ./application/controllers/api/api_packaging.php */