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
        //
    }


    function get_category()
    {
        $page   =  $_GET['page'];
        $category = $this->web->get_category($page);
        foreach($category as $hasil){

            echo '<div class="col-md-3">
                    <div class="card card-category">
                        <a href="'.base_url().'category/'.$hasil->slug_category.'/" style="text-decoration: none" class="link-category">
                            <div class="card-image" style="height: 164px;min-height: 164px">
                                <img class="img-responsive" src="'.base_url().'resources/images/category/thumb/'.$hasil->thumbnail.'" style="width: 100%;height: 100%">
                            </div>
                            <div class="card-content" style="text-align:center;font-size:18px;font-weight:500;font-family:Roboto;text-transform: uppercase;">
                                '.$hasil->nama_category.'
                            </div>
                        </a>
                    </div>
                </div>';
        }
        exit;
    }

}