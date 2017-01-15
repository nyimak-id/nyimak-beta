<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Developers extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load library
        $this->load->library('form_validation');
        //load model
        $this->load->model('auth');
    }

    public function index()
    {
        if ($this->auth->auth_id()) {
            //config pagination
            $config['base_url'] = base_url() . 'auth/developers/index/';
            $config['total_rows'] = $this->auth->count_developers()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman = $this->uri->segment(4);
            $halaman = $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title' => 'Developers',
                'icon' => 'pe-7s-user',
                'developers' => TRUE,
                'data_developers' => $this->auth->index_developers($halaman, $config['per_page']),
                'paging' => $this->pagination->create_links()
            );
            if ($data['data_developers'] != NULL) {

                $data['developers'] = $data['data_developers'];

            } else {

                $data['developers'] = NULL;

            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/developers/data');
            $this->load->view('admin/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query = $this->auth->search_developers_json();
        $data = array();
        foreach ($query as $key => $value) {
            $data[] = array('judul' => $value->nama);
        }
        echo json_encode($data);
    }

    public function search()
    {
        if ($this->auth->auth_id()) {
            $limit = 10;
            $this->load->helper('security');
            $keyword = $this->security->xss_clean($_GET['q']);
            $data['keyword'] = strip_tags($keyword);
            $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
            if (!empty($keyword) && $check > 2) {
                $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0;
                $total = $this->auth->total_search_developers($keyword);
                //config pagination
                $config['base_url'] = base_url() . 'auth/developers/search?q=' . $keyword;
                $config['total_rows'] = $total;
                $config['per_page'] = $limit;
                $config['page_query_string'] = TRUE;
                $config['use_page_numbers'] = TRUE;
                $config['display_pages'] = TRUE;
                $config['query_string_segment'] = 'page';
                $config['uri_segment'] = 4;
                //instalasi paging
                $this->pagination->initialize($config);

                $data = array(
                    'title' => 'Developers',
                    'icon'  => 'pe-7s-user',
                    'developers' => TRUE,
                    'data_developers' => $this->auth->search_index_developers(strip_tags($keyword), $limit, $offset),
                    'paging' => $this->pagination->create_links()
                );
                if ($data['data_developers'] != NULL) {
                    $data['developers'] = $data['data_developers'];
                } else {
                    $data['developers'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/developers/data');
                $this->load->view('admin/part/footer');
            } else {
                $data['developers'] = NULL;
            }
        } else {
            show_404();
            return FALSE;
        }
    }
}