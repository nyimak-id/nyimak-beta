<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Feedback extends CI_Controller
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
            $config['base_url'] = base_url() . 'auth/feedback/index/';
            $config['total_rows'] = $this->auth->count_feedback()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman = $this->uri->segment(4);
            $halaman = $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title' => 'Feedback',
                'icon' => 'pe-7s-bell',
                'feedback' => TRUE,
                'data_feedback' => $this->auth->index_feedback($halaman, $config['per_page']),
                'paging' => $this->pagination->create_links()
            );
            if ($data['data_feedback'] != NULL) {
                $data['feedback'] = $data['data_feedback'];
            } else {
                $data['feedback'] = NULL;
            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/feedback/data');
            $this->load->view('admin/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query = $this->auth->search_feedback_json();
        $data = array();
        foreach ($query as $key => $value) {
            $data[] = array('judul' => $value->nama_feedback);
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
                $total = $this->auth->total_search_feedback($keyword);
                //config pagination
                $config['base_url'] = base_url() . 'auth/feedback/search?q=' . $keyword;
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
                    'title' => 'Feedback',
                    'icon' => 'pe-7s-bell',
                    'feedback' => TRUE,
                    'data_feedback' => $this->auth->search_index_feedback(strip_tags($keyword), $limit, $offset),
                    'paging' => $this->pagination->create_links()
                );
                if ($data['data_feedback'] != NULL) {
                    $data['feedback'] = $data['data_feedback'];
                } else {
                    $data['feedback'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/feedback/data');
                $this->load->view('admin/part/footer');
            } else {
                $data['feedback'] = NULL;
            }
        } else {
            show_404();
            return FALSE;
        }
    }

    public function detail($id_feedback)
    {
        if($this->auth->auth_id())
        {
            //get id
            $id_feedback = $this->encryption->decode($this->uri->segment(4));
            //create data array
            $data = array(
                'title'         => 'Detail Feedback',
                'icon'          => 'pe-7s-bell',
                'feedback'      => TRUE,
                'data_feedback' => $this->auth->detail_feedback($id_feedback)->row_array()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/feedback/detail');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }
}