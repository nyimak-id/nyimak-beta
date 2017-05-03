<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('web');
        $this->load->helper('sistem');
    }

    public function index()
	{
	    $data = array(
                'title'         => sistem('site_title'),
                'keywords'      => sistem('keywords'),
                'descriptions'  => sistem('descriptions'),
                'author'        => sistem('site_title'),
                'video_personal'=> $this->web->get_personal_video(),
                'video_popular' => $this->web->home_sidebar_popular(),
                'category_header'=> $this->web->category_header()
        );
		$this->load->view('home/part/header', $data);
        $this->load->view('home/layout/home/home');
        $this->load->view('home/part/footer');
	}

	public function sitemap()
    {
        $data = array(
                    'data_sitemap' => $this->web->sitemap(),
        );
        $this->load->view('home/layout/sitemap/sitemap_xml.php', $data);
    }


    function get_playlist()
    {
        $page   =  $_GET['page'];
        $videos = $this->web->get_playlist($page);
        foreach($videos as $video){
            if(strlen($video->nama_playlist)<22)
            {
                $judul = '<a href="'.base_url('playlist').'/'.$video->slug_playlist.'/" style="font-size: 18px;font-family: Roboto;font-weight: 400;text-decoration: none;" title="'.$video->nama_playlist.'">'.$video->nama_playlist.'</a>';
            }else{
                $judul = '<a href="'.base_url('playlist').'/'.$video->slug_playlist.'/" style="font-size: 18px;font-family: Roboto;font-weight: 400;text-decoration: none;" title="'.$video->nama_playlist.'">'.substr($video->nama_playlist, 0,22).'...</a>';

            }

            $jml = $this->db->query("SELECT COUNT(playlist_id) as jml FROM tbl_videos WHERE playlist_id='$video->id_playlist'")->row();

            echo '<div class="col-md-3">
                    <div class="card card-playlist" style="min-height: 230px">
                    <a href="'.base_url().'playlist/'.$video->slug_playlist.'/">
                        <div class="card-image" style="height: 150px;min-height: 150px">
                            <img class="img-responsive" src="'.base_url().'resources/images/playlist/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
                    </a>    
                        <div class="card-content" style="min-height: 80px">
                            '.$judul.'
                            <p style="padding-top: 5px"><i class="fa fa-list-ul"></i> <b>'.$jml->jml.'</b> VIDEOS</p>
                        </div>
                    </div>
                </div>';
        }
        exit;
    }

	function get_videos_terbaru()
    {
        $page   =  $_GET['page'];
        $videos = $this->web->get_videos_terbaru($page);
        foreach($videos as $video){
            if(strlen($video->judul_video)<60)
            {
                $judul = '<a href="'.base_url('watch').'/'.$video->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$video->judul_video.'">'.$video->judul_video.'</a>';
            }else{
                $judul = '<a href="'.base_url('watch').'/'.$video->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$video->judul_video.'">'.substr($video->judul_video, 0,60).'...</a>';

            }
            echo '<div class="col-md-3">
                    <div class="card card-video" style="min-height: 230px">
                    <a href="'.base_url().'watch/'.$video->slug_video.'/">
                        <div class="card-image" style="height: 150px;min-height: 150px">
                            <img class="img-responsive" src="'.base_url().'resources/images/videos/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
                    </a>    
                        <div class="card-content" style="min-height: 60px">
                            <p style="color: #84909f;font-size: 11px;padding-bottom: 5px">'.$this->web->time_elapsed_string($video->date_created).' </p>
                            '.$judul.'
                        </div>
                        <div class="card-autor" style="padding: 1px 18px;background: #ffffff">
                            <a style="font-size: 12px;color: #767676;font-weight: 500;text-decoration: none" href="'.base_url().'user/'.$video->username.'/">'.$video->nama_user.'</a>
                            <p style="color: #84909f;font-size: 11px;margin-top: 5px;padding-bottom: 5px">'.$video->views.'x ditonton </p>
                        </div>
                    </div>
                </div>';
        }
        exit;
    }

    function get_videos_popular()
    {
        $page   =  $_GET['page'];
        $videos = $this->web->get_videos_popular($page);
        foreach($videos as $video){
            if(strlen($video->judul_video)<60)
            {
                $judul = '<a href="'.base_url('watch').'/'.$video->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$video->judul_video.'">'.$video->judul_video.'</a>';
            }else{
                $judul = '<a href="'.base_url('watch').'/'.$video->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$video->judul_video.'">'.substr($video->judul_video, 0,60).'...</a>';

            }
            echo '<div class="col-md-3">
                    <div class="card card-video" style="min-height: 230px">
                    <a href="'.base_url().'watch/'.$video->slug_video.'/">
                        <div class="card-image" style="height: 150px;min-height: 150px">
                            <img class="img-responsive" src="'.base_url().'resources/images/videos/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
                    </a>
                        <div class="card-content" style="min-height: 60px">
                            <p style="color: #84909f;font-size: 11px;padding-bottom: 5px">'.$this->web->tgl_tunggal($video->date_created).' '.$this->web->bulan_inggris($video->date_created).', '.$this->web->year_tunggal($video->date_created).' </p>
                            '.$judul.'
                        </div>
                        <div class="card-autor" style="padding: 1px 18px;background: #ffffff">
                            <a style="font-size: 12px;color: #767676;font-weight: 500;text-decoration: none" href="'.base_url().'user/'.$video->username.'/">'.$video->nama_user.'</a>
                            <p style="color: #84909f;font-size: 11px;margin-top: 5px;padding-bottom: 5px">'.$video->views.'x ditonton </p>
                        </div>
                    </div>
                </div>';
        }
        exit;
    }

    function get_videos_recomended()
    {
        $page   =  $_GET['page'];
        $videos = $this->web->get_videos_recomended($page);
        foreach($videos as $video){
            if(strlen($video->judul_video)<60)
            {
                $judul = '<a href="'.base_url('watch').'/'.$video->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$video->judul_video.'">'.$video->judul_video.'</a>';
            }else{
                $judul = '<a href="'.base_url('watch').'/'.$video->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$video->judul_video.'">'.substr($video->judul_video, 0,60).'...</a>';

            }
            echo '<div class="col-md-3">
                    <div class="card card-video" style="min-height: 230px">
                    <a href="'.base_url().'watch/'.$video->slug_video.'/">
                        <div class="card-image" style="height: 150px;min-height: 150px">
                            <img class="img-responsive" src="'.base_url().'resources/images/videos/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
                    </a>
                        <div class="card-content" style="min-height: 60px">
                            <p style="color: #84909f;font-size: 11px;padding-bottom: 5px">'.$this->web->tgl_tunggal($video->date_created).' '.$this->web->bulan_inggris($video->date_created).', '.$this->web->year_tunggal($video->date_created).' </p>
                            '.$judul.'
                        </div>
                        <div class="card-autor" style="padding: 1px 18px;background: #ffffff">
                            <a style="font-size: 12px;color: #767676;font-weight: 500;text-decoration: none" href="'.base_url().'user/'.$video->username.'/">'.$video->nama_user.'</a>
                            <p style="color: #84909f;font-size: 11px;margin-top: 5px;padding-bottom: 5px">'.$video->views.'x ditonton </p>
                        </div>
                    </div>
                </div>';
        }
        exit;
    }


    function get_category()
    {
        $page   =  $_GET['page'];
        $category = $this->web->get_category($page);
        foreach($category as $hasil){

            echo '<div class="col-md-3">
                    <div class="card card-category">
                        <a href="'.base_url().'category/'.$hasil->slug_category.'/" style="text-decoration: none" class="link-category">
                            <div class="card-image" style="height: 150px;min-height: 150px">
                                <img class="img-responsive" src="'.base_url().'resources/images/category/thumb/'.$hasil->thumbnail.'" style="width: 100%;height: 100%">
                                <span class="post-title"><b>Make a Image Blur Effects With</b></span>
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

    function get_category_sidebar()
    {
        $page   =  $_GET['page'];
        $category = $this->web->get_category_sidebar($page);
        foreach($category as $hasil){

            echo '<div class="chip-phantom" style="margin-bottom: 10px;">
                        <img src="'.base_url().'resources/images/category/thumb/'.$hasil->thumbnail.'" alt="Person" width="96" height="96">
                        <p style="margin-top:6px"><a href="'.base_url().'category/'.$hasil->slug_category.'/" style="text-decoration:none;text-transform: uppercase;margin-top:15px">'.$hasil->nama_category.'</a></p>
                  </div>';
        }
        exit;
    }

}
