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
class api_lotqueue extends REST_Controller {

    //put your code here
    function __construct() {
        header('Access-Control-Allow-Origin:*');
        header("Access-Control-Allow-Headers:cache-control, X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
//        header("Access-Control-Allow-Headers:".$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']."'");
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        
        $data['begin'] = 'access';
        $fb1 = fopen("C:\\xampp\\htdocs\\json_data\\api_wgs.json", 'w');
        fwrite($fb1, json_encode($data));
        fclose($fb1);
        
        
        parent::__construct();
        
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
        
        $this->load->model('m_lotqueue');
        $this->load->helper('myarray');
        $this->load->library('request_http');
    }

//    function check_data($param){
//        $data;
//        if (isset($param)){
//            $data = $param;
//        }else{
//            $data = "";
//        }
//        return $data;
//    }
//    function input_data(){
//        $data = "";
//        
//        $cols = $this->m_lotqueue->columns;
////        print_r($cols);
//        foreach ($cols as $col => $vals){
////            $lwchar = strtolower($vals['name']);
//            //$lwchar =
//            $x = $this->get($vals['name']);
//            $data[$col]= $this->check_data($x);
//           
//        }
//        print_r($data);
//        echo '<br>';
//        echo 'catlot '. $data['CatLot'];
//        echo '<br>';
////        $id = $this->get('id');
////        $data['CatLot'] = $this->check_data($id);
////        if (!empty($id)){
////            $data['CatLot'] = $id;
////        }
//        
////        $wgid = $this->get('idWeight');
////        $data['idWeight'] = $this->check_data($wgid);
////        if (!empty($wgid)){
////            $data['idWeight'] = $wgid;
////        }
//        
//        return $data;
//    }
//    
//    function wglots_get(){
//        $idwg = $this->get('idWeight');
//        
//        
//        
//    }

    function lots_get() {
        //get many lots.

        $cols = $this->m_lotqueue->columns;
        $this->request_http->columns = $cols;
        $this->request_http->method = 'get';
        $data = $this->request_http->input_data();
//        echo 'req http data <br>';
//        print_r($data);
        $data = array_for_search($data);
        //print_r($data);
        $id = $this->get('id');

//        echo 'id count is : '. count($id) ;
//        print_r($id);
//        if (($id === NULL) || (count($id) === 0)) { //ไม่ส่งค่ามา  return ค่าทั้งหมด
        $data_lng = count($data);
//        echo 'data count '. $data_lng . '<br>';
        if ($data_lng === 0){
            $strt = 0;   //$post_wh['strt'];
//            $row = 50;   //$post_wh['row'];
            $row = $this->m_lotqueue->total_rows();
            //$this->m_inventory_packagingstock->inventory_packagingstock_where = $post_wh['where'];
            $result = $this->m_lotqueue->list_data($row, $strt); //,$where
            //$this->response(array('status'=>'okkk'),200);
            //$result = NULL;
            if ($result) { //ถ้ามีข้อมูล
//                echo 'result';
                $this->response($result, 200);
            } else { //ถ้าไม่มีข้อมูล ส่งค่าสถานะ แจ้งไม่พบข้อมูล
                $this->response([
                    'status' => FALSE,
                    'message' => 'ไม่มีรายการ'
                        ], REST_Controller::HTTP_NOT_FOUND);
            }
        } else {//ส่งค่ามา
//        echo 'isset';
//            $pos = strpos($id, ",", 0);
////            echo "pos " . $pos . '<br>';
//            if ($pos == FALSE) {
//                $xarr = array('CatLot' => $id);
//            } else {
//                $xarr = explode(",", $id);
//            }
//            print_r($xarr);
            $strt = 0;
//            print_r($data);
            $this->m_lotqueue->option_where = 'none';
            $this->m_lotqueue->bmrfm_where = $data;
            $row = $this->m_lotqueue->total_rows();
            $result = $this->m_lotqueue->list_data($row, $strt);

            $this->response($result, 200);
        }
    }

//    function lot_get($id) {
//        //get a lot.
//        
//        
//        
//    }

    function lot_post() {
        //update
        $cols = $this->m_lotqueue->columns;
        $this->request_http->columns = $cols;
        $this->request_http->method = 'post';
        $data = $this->request_http->input_data();
        print_r($data);
    }

    function lot_put() {
        //insert
    }

    function lot_delete() {
        //delete
    }
    
    function wgs_get(){
        
        $wg = $this->get('id');
        
        
        $xarr = array('idWeight' => $wg);
//        echo 'wg = '. $wg;
        $strt = 0;
        $this->m_lotqueue->option_where = 'none';
        $this->m_lotqueue->bmrfm_where = $xarr;
        $row = $this->m_lotqueue->total_rows();
        $result = $this->m_lotqueue->list_data($row, $strt);      
//        print_r($result);
        $this->response($result, 200);
    }

}

/* End of file api_lotqueue.php */
/* Location: ./application/controllers/api/api_lotqueue.php */