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
                'video_popular' => $this->web->home_sidebar_popular()
        );
		$this->load->view('home/part/header', $data);
        $this->load->view('home/layout/home/home');
        $this->load->view('home/part/footer');
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
                    <div class="card" style="min-height: 230px">
                        <div class="card-image" style="height: 164px;min-height: 164px">
                            <img class="img-responsive" src="'.base_url().'resources/images/videos/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
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
                    <div class="card" style="min-height: 230px">
                        <div class="card-image" style="height: 164px;min-height: 164px">
                            <img class="img-responsive" src="'.base_url().'resources/images/videos/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
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
                    <div class="card" style="min-height: 230px">
                        <div class="card-image" style="height: 164px;min-height: 164px">
                            <img class="img-responsive" src="'.base_url().'resources/images/videos/thumb/'.$video->thumbnail.'" style="width: 100%;height: 100%">
                        </div>
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

}
