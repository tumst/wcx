<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of m_inventory_packagingstock
 * 
 *
 * @author Administrator
 */
class M_inventory_packagingstock extends CI_Model {

    private $table = 'tblInventory_PackagingStock';         //setting table of primary key
    private $pk = 'trackid';             //setting primary key
    public $m_order;                     //setting order
    public $inventory_packagingstock_where = '';            //settings where

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
            SELECT ROW_NUMBER() OVER(ORDER BY trackid ASC) AS isort,
                    tblInventory_PackagingStock.trackid, tblInventory_PackagingStock.invent_selector,
                    tblInventory_PackagingStock.Inventdate, tblInventory_PackagingStock.OperationID,
                    tblInventory_PackagingStock.ProductionPackNo, tblInventory_PackagingStock.PackagingID,
                    tblInventory_PackagingStock.packageRecieved, tblInventory_PackagingStock.inputQty,
                    tblInventory_PackagingStock.outputQty, tblInventory_PackagingStock.TypePlanIDPackaging,
                    tblInventory_PackagingStock.PackagingStatus, tblInventory_PackagingStock.packPerson,
                    tblInventory_PackagingStock.packPersonchck
                        FROM tblInventory_PackagingStock 
                     $wh ";

        return $subsql;
    }

    public function sub_sql_nojoin() {
        $wh = $this->where();
        $subsql = " 
            SELECT ROW_NUMBER() OVER(ORDER BY trackid ASC) AS isort,
                    tblInventory_PackagingStock.trackid, tblInventory_PackagingStock.invent_selector,
                    tblInventory_PackagingStock.Inventdate, tblInventory_PackagingStock.OperationID,
                    tblInventory_PackagingStock.ProductionPackNo, tblInventory_PackagingStock.PackagingID,
                    tblInventory_PackagingStock.packageRecieved, tblInventory_PackagingStock.inputQty,
                    tblInventory_PackagingStock.outputQty, tblInventory_PackagingStock.TypePlanIDPackaging,
                    tblInventory_PackagingStock.PackagingStatus, tblInventory_PackagingStock.packPerson,
                    tblInventory_PackagingStock.packPersonchck
                        FROM tblInventory_PackagingStock 
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
        $wh = arrayto_where($this->inventory_packagingstock_where);
        return $wh;
    }

    public function total_rows($where_arr = array()) {
        $onsubsql = $this->sub_sql();
        $query = $this->db->query($onsubsql);
        $numb = $query->num_rows();
        return $numb;
    }

}

/* End of file m_bulk.php */
/* Location: ./application/models/m_inventory_packagingstock.php */