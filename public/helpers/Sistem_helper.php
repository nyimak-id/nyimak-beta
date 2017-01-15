<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */

    if(!function_exists('sistem'))
    {
        function sistem($key)
        {
            $CI =& get_instance();

            $query = $CI->db->select($key)->where('id_sistem',1)->get('tbl_sistem');

            if($query->num_rows() != 1){

                return NULL;
            }else{
                $result = $query->row();

                return $result->$key;
            }
        }
    }