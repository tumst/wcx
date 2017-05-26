<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newsql_helper
 * This function for create array of where
 * 
 * parameter Filter set '%' on both (%x%), 
 *                             before (%x),
 *                             after (x%),
 *                             none (x) 
 * 
 * @author Sa-ard Samenram.
 */
if (!function_exists('arrayto_where')) {

    function arrayto_where($where_arr = '', $Filter = 'both', $column) {
        $wh = '';
        $cnt = 0;
//        echo '<br>';
//        print_r($where_arr);
//        echo '<br>----';
//        if ($where_arr == ''){
//            echo 'yes, no data empty';
//        }else{
//            echo 'no, have data'; //print_r($where_arr);
//        }
//        echo '------<br>';
        //echo 'count= ' .count($where_arr);
        //  if (count($where_arr) > 0 )
        if (is_array($where_arr)) {
            // print_r($where_arr);
            foreach ($where_arr as $key => $value) {
                $cnt = count($value);
                $type = $column[$key]['type'];
//                echo 'type '. $type . '   key '. $key;
//                echo 'count = '. $cnt . '<br>';
                switch ($type){
                    case 'number':
//                        echo 'number is : '.$key;
                        if ($cnt > 1){
                            $wh = $wh."(";
                            for ( $i=0; $i <= $cnt-1; $i++ ){
                                $wh = $wh. "($key = $value[$i]) OR  ";
                            }
                            $wh = set_or($wh);
//                            $wh = $wh.")";
//                            echo $wh;
                        }else{
                            $wh = $wh. "($key = $value ) AND ";
                        }
                        break;
                    case 'string':
                        if ($Filter == 'both' || $Filter == '') {
                            if ($cnt > 1){
                                $wh = $wh."(";
                                for ( $i=0; $i <= $cnt-1; $i++ ){
        //                            echo 'value '.$value[$i] . '<br>';
                                    $wh = $wh . "($key Like '%$value[$i]%') OR  ";
                                }
                                $wh = set_or($wh);
//                                 $wh = $wh.")";
                            }else{
                                $wh = $wh . "($key Like '%$value%') AND ";
                            }
                        } else if ($Filter == 'before') {
                            if ($cnt > 1){
                                $wh = $wh."(";
                                for ( $i=0; $i <= $cnt-1; $i++ ){
        //                            echo 'value '.$value[$i] . '<br>';
                                    $wh = $wh . "($key Like '%$value[$i]') OR  ";
                                }
                                $wh = set_or($wh);
//                                $wh = $wh.")";
                            }else{
                                $wh = $wh . "($key Like '%$value') AND ";
                            }
                        } else if ($Filter == 'after') {
                            if ($cnt > 1){
                                $wh = $wh."(";
                                for ( $i=0; $i <= $cnt-1; $i++ ){
        //                            echo 'value '.$value[$i] . '<br>';
                                    $wh = $wh . "($key Like '$value[$i]%') OR  ";
                                }
                                $wh = set_or($wh);
//                                $wh = $wh.")";
                            }else{
                                $wh = $wh . "($key Like '$value%') AND ";
                            }
                        } else {  //$Filter == 'none'
        //                    echo 'val ...-> '. $value[0]. '     '. $value[1]. '  count '. $cnt .'<br>';
                            if ($cnt > 1){
                                $wh = $wh."(";
                                for ( $i=0; $i <= $cnt-1; $i++ ){
        //                            echo 'i is '. $i . '<br>';
        //                            echo 'value    '.$value[$i] . '<br>';
                                    
                                    $wh = $wh . "($key Like '$value[$i]') OR  ";  
                                }
                                $wh = set_or($wh);
//                                $wh = $wh.")";
                            }else{
                                $wh = $wh . "($key Like '$value') AND ";
                            }
                        }
                        break;
                }
                
            }
            //ตัด 'AND' ตัวสุดท้ายออก
//            echo 'befor sub string ' . $wh . '<br>';
            $wh = substr($wh, 0, strlen($wh) - 5);
            $wh = "Where (" . $wh . ")";
        } else {
            $wh = '';
        }
//        echo "newsql <br>". $wh . "<br>newsql" ;
        return $wh;
    }

}

function set_or($wh){
    $wh = substr($wh, 0, strlen($wh) - 5). ")   AND ";
    return $wh;
}

function strwhere(){
    
}

function check_type(){
    
       
}

function base_arrayto_where($where_arr = '') {
    $wh = '';
    if (is_array($where_arr)) {
            foreach ($where_arr as $key => $value) {
                $wh = $wh . "($key Like '$value') AND "; 
            }

        //ตัด 'AND' ตัวสุดท้ายออก
        $wh = substr($wh, 0, strlen($wh) - 5);
        $wh = "Where (" . $wh . ")";
    } else {
        $wh = '';
    }

    return $wh;
}
