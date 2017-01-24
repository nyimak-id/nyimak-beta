<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Search extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('web');
    }

    public function index()
    {

    }

    public function json()
    {
        //query get
        $query = $this->web->search_json();
        $data = array();
        foreach ($query as $key => $value) {
            $data[] = array('judul' => $value->judul_video);
        }
        echo json_encode($data);
    }
}