<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('web');
    }

    public function detail($username)
    {
        $username = $this->uri->segment(2);
        //config pagination
        $config['base_url'] = base_url().'user/'.$username.'/index/';
        $config['total_rows'] = $this->web->count_videos($username);
        $config['per_page'] = 10;
        //instalasi paging
        $this->pagination->initialize($config);
        //deklare halaman
        $halaman            =  $this->uri->segment(4);
        $halaman            =  $halaman==''? 0 : $halaman;

        $data = array(
            'data_user'    => $this->web->user_videos($username)->row_array(),
            'title'        => $username . '  '. '( ' .$this->web->get_nama_user($username)->nama_user. ' )'. ' &middot; ' . sistem('site_title'),
            'keywords'     => sistem('keywords'),
            'descriptions' => sistem('descriptions'),
            'author'       => sistem('site_title'),
            'data_videos'  => $this->web->index_videos($halaman,$config['per_page'],$username),
            'paging'       => $this->pagination->create_links()
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/user/user');
        $this->load->view('home/part/footer');
    }
}