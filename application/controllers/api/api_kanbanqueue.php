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
 * Description of api_po
 *
 * @author Administrator
 */
class api_kanbanqueue extends REST_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        $this->load->model('m_po');
    }

    function po_gets() {
        $id = $this->get();
        if ($id === NULL) { //ไม่ส่งค่ามา  return ค่าทั้งหมด
            $strt = 0;   //$post_wh['strt'];
            $row = 50;   //$post_wh['row'];
            //$this->m_inventory_packagingstock->inventory_packagingstock_where = $post_wh['where'];
            $result = $this->m_po->list_data($row, $strt); //,$where
            //$this->response(array('status'=>'okkk'),200);
            //$result = NULL;
            if ($result) { //ถ้ามีข้อมูล
                $this->response($result, 200);
            } else { //ถ้าไม่มีข้อมูล ส่งค่าสถานะ แจ้งไม่พบข้อมูล
                $this->response([
                    'status' => FALSE,
                    'message' => 'ไม่มีรายการ'
                        ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {//ส่งค่ามา
            $pos = strpos($id, ",", 0);
            //echo "pos " . $pos . '<br>';
            if ($pos == FALSE) {
                $xarr = $id;
            } else {
                $xarr = explode(",", $id);
            }
            //print_r($xarr);
            $this->response($xarr, 200);
        }
    }

    function po_get($id) {
        
    }

    function po_post() {
        
    }

    function po_put() {
        
    }

    function po_delete() {
        
    }

}
