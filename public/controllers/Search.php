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

        $limit = 10;
        $this->load->helper('security');
        $keyword = $this->security->xss_clean($_GET['q']);
        $data['keyword'] = strip_tags($keyword);
        $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
        if(!empty($keyword) && $check > 2)
        {
            $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;
            $total  = $this->web->total_search_videos($keyword);
            //config pagination
            $config['base_url'] = base_url().'search?q='.$keyword;
            $config['total_rows'] = $total;
            $config['per_page'] = $limit;
            $config['page_query_string'] = TRUE;
            $config['use_page_numbers'] = TRUE;
            $config['display_pages']	= TRUE;
            $config['query_string_segment'] = 'page';
            $config['uri_segment']  =1;
            //instalasi paging
            $this->pagination->initialize($config);

            $data = array(
                'title'         => 'Search &middot; ' .$keyword,
                'keywords'      => sistem('keywords'),
                'descriptions'  => sistem('descriptions'),
                'author'        => sistem('site_title'),
                'data_video' => $this->web->search_index_videos(strip_tags($keyword),$limit,$offset),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_video'] != NULL)
            {
                $data['video'] = $data['data_video'];
                $data['keyword'] = strip_tags($keyword);
            }else{
                $data['video'] = '';
                $data['keyword'] = strip_tags($keyword);
            }
            //load view with data
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/search/search');
            $this->load->view('home/part/footer');
        }else{
            $data['video'] = NULL;
        }
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