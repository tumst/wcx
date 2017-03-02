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
class c_packagingrecord_api extends REST_Controller {

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

    
    function inv_stocks_get(){       
        //$post_wh = $this->post_where();
        
        //print_r($post_wh);
        $strt = 0;   //$post_wh['strt'];
        $row = 10;   //$post_wh['row'];
        //$this->m_inventory_packagingstock->inventory_packagingstock_where = $post_wh['where'];
        $result = $this->m_inventory_packagingstock->list_data($row, $strt); //,$where
        $this->restponse($result,200);
        
    }
    
    function inv_stock_post(){
        
    }
    
    function inv_stock_put(){
        
    }
    
    function inv_stock_delete(){
        
    }
    
    public function post_where() {
		
//ใส่เงื่อนไขกรณี ค่า 'begin'ที่ส่งมา ไม่มีค่า ให้เป็น 0
        $start = $this->input->post('begin');
        if (!empty($start)) {
            $data['strt'] = $start;
        } else {
            $data['strt'] = 0;
        }

//ใส่เงื่อนไขกรณี ค่า 'rows'ที่ส่งมา ไม่มีค่า ให้เป็น 10
        $row = $this->input->post('rows');
        if (!empty($row)) {
            $data['row'] = $row;
        } else {
            $data['row'] = 10;
        }

//ใส่เงื่อนไขกรณี ค่า 'ProductID'ที่ส่งมา ไม่มีค่า ให้เป็น 10
        $id = $this->input->post('trackid');
        if (!empty($id)) {
            $id = $id;
        } else {
            $id = '%';
        }

//กำหนดค่า array ของ ตัวแปร $where
        $where = array(
            'trackid' => $id,
        );

//ดึงข้อมูลจาก function input_data(); ในไฟล์นี้ มาใช้
        $wh = $this->input_data();
        if (empty($wh)) {
            $where_ = array();
//            echo 'empty';
        } else {
            //$where_ = $this->input_data();
			$where_ = array_for_search($this->input_data());
//            echo 'not empty';
        }

//รวมตัวแปร $where กับ $where_ เข้าด้วยกัน
        $where_new = array_merge($where, $where_);
        
        $data['where']=$where_new;
        
        return $data;        
    }
    
    
}

/* End of file c_packagingrecord_api */
/* Location: ./application/controllers/api/c_packaging_api.php */