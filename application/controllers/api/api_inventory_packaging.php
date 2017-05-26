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
class Inventory_packaging extends REST_Controller {


    function __construct() {
        // Construct the parent class
        //$this->cor['head'] = $this->config['allowed_cors_headers'];
        //$data['begin'] = 'access';
        //$fb1 = fopen("C:\\xampp\\htdocs\\json_data\\api_pkginvent.json", 'w');
        //fwrite($fb1, json_encode($data));
        //fclose($fb1);
        
        //header('Access-Control-Allow-Origin:*');
        //$this->con = "access control allow origin";
        //header("Access-Control-Allow-Headers:cache-control, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        //header("Access-Control-Allow-Headers:".$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']."'");
        //header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        //header('Access-Control-Allow-Credentials: true');
        //header('Access-Control-Max-Age: 86400'); 
        
        //$data['after header'] = 'access';
        //$method = $_SERVER;
        //$data['method'] = $method;
        
        //$fb2 = fopen("C:\\xampp\\htdocs\\json_data\\api_pkginvent.json", 'a');
        //fwrite($fb2, json_encode($data));
        //fclose($fb2);
        
        parent::__construct();

//Header add Access-Control-Allow-Origin "*";
//Header add Access-Control-Allow-Headers "origin, x-requested-with, content-type";
//Header add Access-Control-Allow-Methods "PUT, GET, POST, DELETE, OPTIONS";
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        //echo '_allow is '. $this->_allow .'<br>';

        $this->load->model('m_inventory_packagingstock');
    }

    function inv_stocks_get() {
        //print_r($_SERVER);
       // $data['data'][0] = 'test get : 1 ';
       // $data['data'][1] = $this->con;
       // $data['cors'] = $this->cor;
        

        $id = $this->get('id');
        if ($id === NULL) { //ไม่ส่งค่ามา  return ค่าทั้งหมด
            $strt = 0;   //$post_wh['strt'];
            $row = 100;   //$post_wh['row'];
            //$this->m_inventory_packagingstock->inventory_packagingstock_where = $post_wh['where'];
            $result = $this->m_inventory_packagingstock->list_data($row, $strt); //,$where
            //$this->response(array('status'=>'okkk'),200);
            //$result = NULL;
            if ($result) { //ถ้ามีข้อมูล
                $this->response($result, 200);
            } else { //ถ้าไม่มีข้อมูล ส่งค่าสถานะ แจ้งไม่พบข้อมูล
                $this->response([
                    'status' => FALSE,
                    'message' => 'ไม่มีรายการสต๊อกบรรจุภัณฑ์'
                        ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {//ส่งค่ามา
            $pos = strpos($id, ",", 0);
            echo "pos " . $pos . '<br>';
            if ($pos == FALSE) {
                $xarr = $id;
            } else {
                $xarr = explode(",", $id);
            }
            //print_r($xarr);
            $this->response($xarr, 200);
        }




//        echo '<br />';
//        $y = explode(",", $this->get('name'));
//        echo " id is " . $x[9];
//        print_r($y);
//        echo "1 " . $y[0] . "  2 " . $y[1];
    }

    function inv_stock_post($track) {
        echo 'method : ' . $_SERVER['REQUEST_METHOD'] . '<br>';
        //insert
        echo 'track ' . $track . '  ccc<br>';
        $id = $this->post('trackid');
        //$id = $this->input->post('trackid');
        $data['trackid'] = $id;
        $ids = $this->input->post('trackid');
        $data['trackids'] = $ids;
        // $data = $this->input_data();
        print_r($data);
        //$result = $this->m_inventory_packagingstock->insert();
    }

    function inv_stock_put($track) {
        //update
        echo 'method : ' . $_SERVER['REQUEST_METHOD'] . '<br>';
        print_r($_SERVER);
        echo '1<br>';
        print_r($this->put());
        echo '2<br>';
        echo 'track ' . $track . '  ccc<br>';
        $id = $this->put('trackids');
        //$id = $this->input->post('trackid');
        $data['trackid'] = $id;
//        $ids = $this->input->put('trackid');
//        $data['trackids'] = $ids;
        // $data = $this->input_data();
        print_r($data);
    }

    function inv_stock_delete() {
        //delete
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

        $data['where'] = $where_new;

        return $data;
    }

}

/* End of file api_inventory_packaging */
/* Location: ./application/controllers/api/api_inventory_packaging.php */