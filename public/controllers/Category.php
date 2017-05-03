<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('web');
        $this->load->helper('sistem');
    }

    public function index()
    {
        $data = array(
            'title'        => 'Category &middot; ' .sistem('site_title'),
            'keywords'     => sistem('keywords'),
            'descriptions' => sistem('descriptions'),
            'author'       => sistem('site_title')
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/category/data');
        $this->load->view('home/part/footer');
    }

    public function detail($slug)
    {
        $slug = $this->uri->segment(2);
        //config pagination
        $config['base_url'] = base_url().'category/'.$slug.'/index/';
        $config['total_rows'] = $this->web->count_category($slug);
        $config['per_page'] = 12;
        //instalasi paging
        $this->pagination->initialize($config);
        //deklare halaman
        $halaman            =  $this->uri->segment(4);
        $halaman            =  $halaman==''? 0 : $halaman;

        $data = array(
            'title'        => $this->web->get_category_judul($slug)->nama_category. ' &middot; ' . sistem('site_title'),
            'keywords'     => sistem('keywords'),
            'descriptions' => sistem('descriptions'),
            'author'       => sistem('site_title'),
            'nama_category'=> $this->web->get_category_judul($slug)->nama_category,
            'data_videos'  => $this->web->index_category($halaman,$config['per_page'],$slug),
            'paging'       => $this->pagination->create_links()
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/category/detail');
        $this->load->view('home/part/footer');
    }

}