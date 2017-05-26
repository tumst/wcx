<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function array_for_search($array_data){
    $array_result = array();
    foreach ($array_data as $key => $val){
        $val = str_replace(" ", "", $val);
        if ($val == ""){
            //$array_result[$key] = '%';
        }else{
            $array_result[$key] = $val;
        }
    }
    return $array_result;
}


function array_for_update($array_data){
    $array_result = array();
    foreach ($array_data as $key => $val){
        $val = str_replace(" ", "", $val);
        if ($val == ""){
            //echo $key .'   '. $val . '<br>' ;
            $array_result[$key] = '';
        }else{
            $array_result[$key] = $val;
        }
    }
    return $array_result;
}