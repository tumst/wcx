<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of c_stp
 *
 * @author Administrator
 */
class c_stp extends CI_Controller {

    public function index() {
        echo 'this is index function ';
    }

    function __construct() {
        parent::__construct();
        $this->load->model('test/m_stp');
    }

    function test_stp() {
        //echo 'test stp !!';
        /* $rest = $this->m_stp->test_stp();
          foreach ($rest as $col){
          //print_r($col);
          echo $col['CusID']. '   '. $col['CusName']. '<br>';

          } */
        $this->load->view('test/v_test');
    }

}

/* End of file c_stp.php */
/* Location: ./application/controllers/test/c_stp.php */