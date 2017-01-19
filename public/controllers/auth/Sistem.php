<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Sistem extends CI_Controller
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
            //create data array
            $data = array(
                'title'         => 'Setting Sistem',
                'icon'          => 'pe-7s-config',
                'sistem'        => TRUE,
                'data_session'  => $this->auth->index_session()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/sistem/data');
            $this->load->view('admin/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function save()
    {
        if($this->auth->auth_id())
        {
            $id['id_sistem'] = $this->encryption->decode($this->input->post('id_sistem'));
            //create var update array
            $update = array(
                        'admin_title'   => $this->input->post('admin_title'),
                        'admin_footer'  => $this->input->post('admin_footer'),
                        'site_title'    => $this->input->post('site_title'),
                        'site_footer'   => $this->input->post('site_footer'),
                        'keywords'      => $this->input->post('keywords'),
                        'descriptions'  => $this->input->post('descriptions')
            );
            $this->db->update('tbl_sistem', $update, $id);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Sistem Berhasil Diupdate.
			                                                </div>');
            redirect('auth/sistem?source=update&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }
}