<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Pages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('web');
    }

    public function about()
    {
        $data = array(
            'title'         => 'About - ' .sistem('site_title'),
            'keywords'      => sistem('keywords'),
            'descriptions'  => sistem('descriptions'),
            'author'        => sistem('site_title')
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/pages/about');
        $this->load->view('home/part/footer');
    }

    function get_developers()
    {
        $page   =  $_GET['page'];
        $developers = $this->web->get_developers($page);
        foreach($developers as $developer){
            echo '<div class="col-md-3">
                    <div class="card" style="min-height: 230px">
                        <div class="card-image" style="height: 235px;min-height: 235px">
                            <img class="img-responsive" src="'.base_url().'resources/images/developers/thumb/'.$developer->foto.'" style="width: 100%;height: 100%">
                        </div>
                        <div class="card-content" style="min-height: 60px;text-align: center;">
                            <p style="margin-bottom: 2px;font-size:20px;font-family:Roboto;font-weight:300">'.$developer->nama.'</p>
                            <p style="color: #84909f;font-size: 15px;margin-bottom: 15px;margin-top:10px;font-familiy:Roboto;font-weight:300"> '.$developer->jabatan.'</p>
                            <a data-original-title="LinkedIn" rel="tooltip" href="'.$developer->linkedin.'" target="_blank" class="btn btn-linkedin btn-sm" data-placement="left">
                                <i class="fa fa-linkedin"></i>
                            </a>
                        </div>
                    </div>
                  </div>';
        }
        exit;
    }

}