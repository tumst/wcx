<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of m_stp
 *
 * @author Administrator
 */
class m_stp extends CI_Model {

    //put your code here
    public function __construct() {
        $this->load->database();
    }

    //No exec or call needed for storeprocedure (mssql server)
    /* Example storeprocedure
     * from http://stackoverflow.com/questions/29450755/issue-executing-stored-procedure-from-php-to-a-microsoft-sql-server
     * $sp = "MOBILE_COM_SP_GetCallXXX ?,?,?,?,?,?,?,?,?,? "; //No exec or call needed
     * 
     * No @ needed.  Codeigniter gets it right either way
     * $params = array(
      'PARAM_1' => NULL,
      'PARAM_2' => NULL,
      'PARAM_3' => NULL,
      'PARAM_4' => NULL,
      'PARAM_5' => NULL,
      'PARAM_6' => NULL,
      'PARAM_7' => NULL,
      'PARAM_8' => NULL,
      'PARAM_9' => NULL,
      'PARAM_10' =>NULL);
     * //Here's the magic...
     * sqlsrv_configure('WarningsReturnAsErrors', 0);
     * 
     * Even if I don't make the connect explicitly, I can configure sqlsrv
     * and get it running using $this->db->query....
     * 
     * $result = $this->db->query($sp,$params);
     */

    function test_stp() {
        $sp = "exec myCustomer";
        //echo "model stp ". $sp;
        //
        //$result = $this->db->query($sp,$params); //with parameters
        //echo '<br>';
        $query = $this->db->query($sp);
        $result = $query->result_array();
        //print_r($result);
        return $result;
    }

}

/* End of file m_stp.php */
/* Location: ./application/models/test/m_stp.php */