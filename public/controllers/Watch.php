<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Watch extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('web');
    }

    public function detail($url)
    {
        $this->load->library('disqus');
        $data = array(
            'title'         => '',
            'keywords'      => '',
            'descriptions'  => '',
            'author'        => '',
            'detail_video'  => $this->web->detail_videos($url),
            'video_popular' => $this->web->home_sidebar_popular(),
            'disqus'        => $this->disqus->get_html()
        );
        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/videos/detail');
        $this->load->view('home/part/footer');
    }
}
