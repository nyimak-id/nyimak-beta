<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Contact extends CI_Controller
{
    protected $email_admin = "admin@nyimak.id";

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation', 'recaptcha'));

        $this->load->model('web');
    }

    public function index()
    {
        $data = array(
            'title'        => 'Contact Us &middot; ' . sistem('site_title'),
            'keywords'     => sistem('keywords'),
            'descriptions' => sistem('descriptions'),
            'author'       => sistem('site_title'),
            'recaptcha_html' => $this->recaptcha->render()
        );
        //set form validation
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('subject', 'Subject email', 'required');
        $this->form_validation->set_rules('email', 'Alamat email', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
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
            $nama    = $this->input->post('nama');
            $subject = $this->input->post('subject');
            $email   = $this->input->post('email');
            $message = strip_tags($this->input->post('message'));

            //sending mail
            $email_me  = 'pondokkode@yahoo.com';
            $nama_me   = sistem('site_title');
            $email_to  = $this->input->post("email");
            $config = array(
                'protocol'  => 'smtp',
                'smtp_host' => 'ssl://smtp.mail.yahoo.com',
                'smtp_user' => 'pondokkode@yahoo.com',
                'smtp_pass' => 'maulayyacyber17',
                'smtp_port' => '465',
                'mailtype'  => 'html',
                'starttls'  => true,
                'newline'   => "\r\n"
            );

            $this->load->library('email', $config);
            $this->email->from($email_me, $nama_me);
            $this->email->to('admin@nyimak.id'); // ganti dengan email tujuan
            $this->email->subject($subject);
            $data = array( 'message' => $message,
                            'nama'   => $nama,
                            'subject'=> $subject,
                            'email'  => $email
            );
            $email = $this->load->view('home/layout/contact/email_template', $data, TRUE);

            $this->email->message( $email );

            if ($this->email->send()) {

                $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto;margin-bottom: 10px">
                                                                    <i class="fa fa-check"></i> Email Berhasil Terkirim.
                                                                </div>');
            }
            else {
                show_error($this->email->print_debugger(), true);
            }

            redirect("contact/");

        }else{
            $this->load->view('home/part/header', $data);
            $this->load->view('home/layout/contact/contact');
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