<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of m_po
 * 
 *
 * @author Administrator
 */
class M_po extends CI_Model {

    private $table = 'tblPO';         //setting table of primary key
    private $pk = 'PO_No';             //setting primary key
    public $m_order;                     //setting order
    public $po_where = '';            //settings where

    public function __construct() {
        $this->load->database();
        $this->load->helper('newsql_helper');
    }

    public function list_data($per_page, $strt, $where_arr = array()) {

        $wh = arrayto_where($where_arr);
        $this->m_order = '';

        $xstr = ($strt - 1) * $per_page;
        if ($xstr < 0) {
            $xstr = 0;
        } else {
            $xstr = $xstr;
        }


        $sub_sql = $this->sub_sql();
        $sql = "SELECT idx.* FROM ( $sub_sql ) As idx WHERE ((idx.isort > $xstr AND idx.isort <= $xstr+$per_page ))";
        $query = $this->db->query($sql);

        //$query = $this->db->get($this->table,$per_page,$xstr);
        return $query->result_array();
//        $xql = $this->db->last_query();
//        echo $xql .'<br>';
    }

    public function list_data_nojoin($per_page, $strt, $where_arr = array()) {

        $wh = arrayto_where($where_arr);
        $this->m_order = '';

        $xstr = ($strt - 1) * $per_page;
        if ($xstr < 0) {
            $xstr = 0;
        } else {
            $xstr = $xstr;
        }

        $sub_sql_nojoin = $this->sub_sql_nojoin();

        $sql = "SELECT idx.* FROM ( $sub_sql_nojoin ) As idx WHERE ((idx.isort > $xstr AND idx.isort <= $xstr+$per_page ))";
        $query = $this->db->query($sql);

        //$query = $this->db->get($this->table,$per_page,$xstr);
        return $query->result_array();
//        $xql = $this->db->last_query();
//        echo $xql .'<br>';
    }

    public function sub_sql() {
        $wh = $this->where();
        //$this->m_order = '';
        $subsql = " 
            SELECT ROW_NUMBER() OVER(ORDER BY PO_No ASC) AS isort,
                    tblPO.PO_No, tblPO.No,
                    tblPO.PO_date, tblPO.CusID,
                    tblPO.OrderbyName, tblPO.OrderbyDetail,
                    tblPO.RequiredDate, tblPO.ShippedDate,
                    tblPO.DetailWann, tblPO.DetailCus, 
                    tblPO.POnumb, tblPO.Cust
                    FROM tblPO 
                     $wh ";

        return $subsql;
    }

    public function sub_sql_nojoin() {
        $wh = $this->where();
        $subsql = " 
          SELECT ROW_NUMBER() OVER(ORDER BY PO_No ASC) AS isort,
                    tblPO.PO_No, tblPO.No,
                    tblPO.PO_date, tblPO.CusID,
                    tblPO.OrderbyName, tblPO.OrderbyDetail,
                    tblPO.RequiredDate, tblPO.ShippedDate,
                    tblPO.DetailWann, tblPO.DetailCus, 
                    tblPO.POnumb, tblPO.Cust
                    FROM tblPO 
                     $wh ";
        return $subsql;
    }

    public function update($data, $id) {
        $this->db->where($this->pk, $id);
        $this->db->update($this->table, $data);
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
    }

    public function delete($id) {
        $this->db->where($this->pk, $id);
        $this->db->delete($this->table);
    }

    public function where() {
        $wh = arrayto_where($this->po_where);
        return $wh;
    }

    public function total_rows($where_arr = array()) {
        $onsubsql = $this->sub_sql();
        $query = $this->db->query($onsubsql);
        $numb = $query->num_rows();
        return $numb;
    }

}

/* End of file m_po.php */
/* Location: ./application/models/m_po.php */