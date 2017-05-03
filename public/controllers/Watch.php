<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
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
            'detail_video'  => $this->web->detail_videos($url),
            'title'         => $this->web->detail_videos($url)->judul_video .' &middot; ' .sistem('site_title'),
            'keywords'      => $this->web->detail_videos($url)->meta_keywords,
            'descriptions'  => $this->web->detail_videos($url)->meta_descriptions,
            'author'        => $this->web->detail_videos($url)->nama_user,
            //related video
            'related_video' => $this->web->related_video($this->web->detail_videos($url)->category_id),
            'disqus'        => $this->disqus->get_html()
        );
        $id = $this->web->detail_videos($url)->id_video;
        //query
        $query = $this->db->query("SELECT * FROM tbl_videos as a JOIN tbl_category as b JOIN tbl_users as c ON a.category_id = b.id_category AND a.user_id = c.id_user WHERE a.id_video = '$id'");
        $row   = $query->row();

        //update views video
        $key['id_video']  = $id;
        $update['views'] = $this->web->detail_videos($url)->views+1;
        //$insert = $this->db->update("tbl_videos",$update,$key);

        $this->load->view('home/part/header', $data);
        $this->load->view('home/layout/videos/detail');
        $this->load->view('home/part/footer');
    }
}
