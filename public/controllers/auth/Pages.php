<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Pages extends CI_Controller
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
            $config['base_url'] = base_url() . 'auth/pages/index/';
            $config['total_rows'] = $this->auth->count_pages()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman = $this->uri->segment(4);
            $halaman = $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'      => 'Pages',
                'icon'       => 'pe-7s-exapnd2',
                'pages'      => TRUE,
                'data_pages' => $this->auth->index_pages($halaman, $config['per_page']),
                'paging'     => $this->pagination->create_links()
            );
            if ($data['data_pages'] != NULL) {
                $data['pages'] = $data['data_pages'];
            } else {
                $data['pages'] = NULL;
            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/pages/data');
            $this->load->view('admin/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query  = $this->auth->search_pages_json();
        $data = array();
        foreach ($query as $key => $value)
        {
            $data[] = array('judul' => $value->judul_page);
        }
        echo json_encode($data);
    }

    public function search()
    {
        if($this->auth->auth_id())
        {
            $limit = 10;
            $this->load->helper('security');
            $keyword = $this->security->xss_clean($_GET['q']);
            $data['keyword'] = strip_tags($keyword);
            $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
            if(!empty($keyword) && $check > 2)
            {
                $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0 ;
                $total  = $this->auth->total_search_pages($keyword);
                //config pagination
                $config['base_url'] = base_url().'auth/pages/search?q='.$keyword;
                $config['total_rows'] = $total;
                $config['per_page'] = $limit;
                $config['page_query_string'] = TRUE;
                $config['use_page_numbers'] = TRUE;
                $config['display_pages']	= TRUE;
                $config['query_string_segment'] = 'page';
                $config['uri_segment']  = 4;
                //instalasi paging
                $this->pagination->initialize($config);

                $data = array(
                    'title'         => 'Pages',
                    'icon'          => 'pe-7s-exapnd2',
                    'category'      => TRUE,
                    'data_pages'    => $this->auth->search_index_pages(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_pages'] != NULL)
                {
                    $data['pages'] = $data['data_pages'];
                }else{
                    $data['pages'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/pages/data');
                $this->load->view('admin/part/footer');
            }else{
                $data['pages'] = NULL;
            }
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_page)
    {
        if($this->auth->auth_id())
        {
            //get id
            $id_page = $this->encryption->decode($this->uri->segment(4));
            //create data array
            $data = array(
                'title'         => 'Edit Pages',
                'icon'          => 'pe-7s-exapnd2',
                'pages'         => TRUE,
                'data_pages'    => $this->auth->edit_pages($id_page)->row_array()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/pages/edit');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public  function save()
    {
        if($this->auth->auth_id())
        {
            $id['id_page'] = $this->encryption->decode($this->input->post("id_page"));
            $update = array(
                        'judul_page'    => $this->input->post("judul_page"),
                        'isi_page'      => $this->input->post("isi_page"),
                        'user_id'       => $this->session->userdata("auth_id"),
                        'date_modified' => date("Y-m-d H:i:s")
            );
            $this->db->update("tbl_pages", $update, $id);
            //deklarasi session flashdata
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
            //redirect halaman
            redirect('auth/pages?source=edit&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

}