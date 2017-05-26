<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reques_tHttp
 *
 * @author Administrator
 */
class Request_Http {
    //put your code here
    public $columns = array();
    public $method = 'get';
    protected $CI;
    
    public function __construct() {
       $this->CI =& get_instance();
       $this->CI->load->helper('myarray');
    }
    
    public function show(){
        return 'this is a Request Http Class';
    }
    /*
     * $method : get, post, put, delete
     * 
     */
    public function input_data(){
        $cols = $this->columns;
        $data = array();
        $y = array();
        switch ($this->method){
            case 'get':
//                echo 'method get';
                foreach ($cols as $col => $vals){
                    $x = $this->CI->get($vals['name']);
//                    echo 'input get :  '. $x .'<br>';
                    $pos = strpos($x, ",", 0);
                    if ($pos == FALSE) {
                        $xarr = $x;
                    } else {
                        $xarr = explode(",", $x);
                    }
                    
//                    echo 'is array :'. ((is_array($x))? 1 : 0) .'<br>';
//                    array_push($data,array($col => $x));
                    $data[$col]= $this->check_data($xarr);
                }
                break;
            case 'post':
//                echo 'method post';
                foreach ($cols as $col => $vals){
                    $x = $this->CI->post($vals['name']);
                    $data[$col]= $this->check_data($x);
                }
                break;
            case 'put':
//                echo 'method put';
                foreach ($cols as $col => $vals){
                    $x = $this->CI->put($vals['name']);
                    $data[$col]= $this->check_data($x);
                }
                break;
            case 'delete':
//                echo 'method delete';
                foreach ($cols as $col => $vals){
                    $x = $this->CI->delete($vals['name']);
                    $data[$col]= $this->check_data($x);
                }
                break;
            default:
//                echo 'method get';
                foreach ($cols as $col => $vals){
                    $x = $this->CI->get($vals['name']);
                    $data[$col]= $this->check_data($x);
                }
        }
//        echo '<br>';
//        print_r($data);
        return $data;
        
    }
    
    public function input_where(){
        return $data = array_for_search($this->input_data());
        
    }
    
    public function input_update(){
        
        
    }
       
    
    function check_data($param){
        $data;
        if (isset($param)){
            $data = $param;
        }else{
            $data = "";
        }
        return $data;
    }
    
    
    
    
}
