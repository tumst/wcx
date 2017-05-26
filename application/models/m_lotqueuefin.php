<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of m_po
 * 
 *
 * @author Administrator
 */
class M_lotqueuefin extends CI_Model {

    private $table = 'tblBMR_Formula_TempIV';         //setting table of primary key
    private $pk = 'RawPK';             //setting primary key
    public $m_order;                     //setting order
    public $bmrfm_where = '';            //settings where
    public $option_where = '';           //option is both, none, before, after of '%'
    public $columns = array(
        'isort' => array('name' => 'isort', 'type' => 'number'),
        'RawPK'=> array('name' => 'RawPK','type' => 'string'), 
        'CatID'=> array('name' => 'CatID','type' => 'string'), 
        'LotID'=> array('name' => 'LotID','type' => 'string'), 
        'RawmatID'=> array('name' => 'RawmatID','type' => 'string'),
        'RawmatName'=> array('name' => 'RawmatName','type' => 'string'), 
        'CatLot'=> array('name' => 'id','type' => 'string'), 
        'idWeight'=> array('name' => 'idWeight', 'type' => 'number'),
        'colorid' => array('name' => 'colorid', 'type'=> 'string'),
        
    );

    public function __construct() {
        $this->load->database();
        $this->load->helper('newsql_helper');
    }

    public function list_data($per_page, $strt, $where_arr = array()) {
//        print_r($where_arr);
//        $wh = arrayto_where($where_arr, $this->option_where);
//        print_r($wh);
//        echo '<br>';
//        $this->m_order = '';

        $xstr = ($strt - 1) * $per_page;
        if ($xstr < 0) {
            $xstr = 0;
        } else {
            $xstr = $xstr;
        }
//        echo 'listdata';

        $sub_sql = $this->sub_sql();
        $sql = "SELECT idx.* FROM ( $sub_sql ) As idx WHERE ((idx.isort > $xstr AND idx.isort <= $xstr+$per_page ))";
//        echo $sql . '<br>';

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
//        echo 'where '. $wh .'<br>';
        //$this->m_order = '';
        $subsql = " 
            SELECT  ROW_NUMBER() OVER (ORDER BY tblBMR_Formula_TempIV.CatLot ASC, 
                    tblBMR_Formula_TempIV.RawmatID ASC) As isort,
                    tblBMR_Formula_TempIV.RawPK, tblBMR_Formula_TempIV.CatID, 
                    tblBMR_Formula_TempIV.LotID, tblBMR_Formula_TempIV.RawmatID, 
                    tblRawMaterial.RawmatName, tblBMR_Formula_TempIV.BMRunit, 
                    tblUnit.UnitName, tblBMR_Formula_TempIV.Decimalx, 
                    tblBMR_Formula_TempIV.ExtRawmatID, tblBMR_Formula_TempIV.Lock,
                    tblBMR_Formula_TempIV.part, tblBMR_Formula_TempIV.CatLot, 
                    tblBMR_Formula_TempIV.idWeight, tblBMR_Formula_TempIV.idBasket, 
                    tblBMR_Formula_TempIV.Use_BMR, tblBMR_Formula_TempIV.OrderNo, 
                    tblBMR_Formula_TempIV.fixed
            FROM    tblBMR_Formula_TempIV INNER JOIN
                    tblRawMaterial ON tblBMR_Formula_TempIV.RawmatID =
                    tblRawMaterial.RawmatID INNER JOIN
                    tblUnit ON tblBMR_Formula_TempIV.BMRunit = tblUnit.UnitID 
            $wh ";

        return $subsql;
    }

    public function sub_sql_nojoin() {
        $wh = $this->where();
        $subsql = " 
            SELECT  RawPK, CatID, LotID, RawmatID, BMRunit, Decimalx,
                    ExtRawmatID, Lock, part, CatLot, idWeight, idBasket,
                    Use_BMR, OrderNo, fixed
            FROM    tblBMR_Formula_TempIV
            $wh ";
        return $subsql;
    }

//    public function update($data, $id) {
//        $this->db->where($this->pk, $id);
//        $this->db->update($this->table, $data);
//    }

//    public function insert($data) {
//        $this->db->insert($this->table, $data);
//    }

//    public function delete($id) {
//        $this->db->where($this->pk, $id);
//        $this->db->delete($this->table);
//    }

    public function where() {
//        print_r($this->bmrfm_where);
//        echo '<br>';
        $wh = arrayto_where($this->bmrfm_where, $this->option_where, $this->columns);
        return $wh;
    }

    public function total_rows($where_arr = array()) {
        $onsubsql = $this->sub_sql();
        $query = $this->db->query($onsubsql);
        $numb = $query->num_rows();
        return $numb;
    }

}

/* End of file m_lotqueuefin.php */
/* Location: ./application/models/m_lotqueuefin.php */