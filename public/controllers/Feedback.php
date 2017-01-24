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

        $this->load->library(array('form_validation', 'recaptcha'));

        $this->load->model('web');
    }

    public function index()
    {
        $data = array(
            'title'        => 'Feedback &middot; ' . sistem('site_title'),
            'keywords'     => sistem('keywords'),
            'descriptions' => sistem('descriptions'),
            'author'       => sistem('site_title'),
            'recaptcha_html' => $this->recaptcha->render()
        );
        //set form validation
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Alamat email', 'required');
        $this->form_validation->set_rules('isi', 'Feedback', 'required');
        $this->form_validation->set_rules('g-recaptcha-response', '<b>Captcha</b>', 'callback_getResponseCaptcha');
        //set message form validation
        $this->form_validation->set_message('required', '<div class="alert alert-danger" style="font-family:Roboto;margin-top: 5px">
                                                        <i class="fa fa-exclamation-circle"></i> {field} harus diisi.
                                                     </div>');
        $this->form_validation->set_message('callback_getResponseCaptcha',
            '<div class="alert alert-danger" style="font-family:Roboto">
                                                          i class="fa fa-exclamation-circle"></i> {field} {g-recaptcha-response} harus diisi.
                                                      div>');
        if($this->form_validation->run() == TRUE)
        {
            $insert = array(
                'nama_feedback'     => $this->input->post("nama"),
                'email_feedback'    => $this->input->post("email"),
                'isi_feedback'      => $this->input->post("isi"),
                'date_created'      => date("Y-m-d H:i:s")
            );
            $this->db->insert("tbl_feedback", $insert);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                                                                    <i class="fa fa-check"></i> Termikasih atas partisipasinya.
                                                                </div>');
            redirect("feedback/");
        }else{
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/feedback/feedback');
            $this->load->view('home/part/footer');
        }
    }

    public function getResponseCaptcha($str)
    {
        $this->load->library('recaptcha');
        $response = $this->recaptcha->verifyResponse($str);
        if ($response['success'])
        {
            return true;
        }
        else
        {
            $this->form_validation->set_message('getResponseCaptcha', ' <div class="alert alert-danger" style="font-family:Roboto;margin-top: 5px">
                                                                          <i class="fa fa-exclamation-circle"></i> %s harus dipilih.
                                                                      </div>' );
            return false;
        }
    }

}