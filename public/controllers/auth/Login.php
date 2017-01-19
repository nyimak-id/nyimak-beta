<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Login extends CI_Controller {

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
        if($this->auth->auth_id())
        {
            //redirect dahsboard
            redirect('auth/dashboard/');

        }elseif($this->auth->auth_username()){

            //redirect next page
            redirect('auth/login/next?source=login&utf8=✓');

        }else{
            //create form validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            //set message form validation
            $this->form_validation->set_message('required', '<div style="color: #a20008;font-family:Roboto;margin-top: 15px">
                                                                <i class="fa fa-exclamation-circle"></i> {field} harus diisi.
                                                            </div>');
            if($this->form_validation->run() != FALSE){

                $username = $this->input->post("username", TRUE);

                //checking via model
                $checking = $this->auth->check_username('tbl_users', array('username' => $username));

                //kondisi var checking
                if($checking != FALSE)
                {
                    foreach($checking as $auth){
                        //create session data
                        $this->session->set_userdata(array(
                            //'auth_id'         => $auth->id_user,
                            'auth_username'     => $auth->username,
                            'auth_nama'         => $auth->nama_user,
                            //'auth_email'      => $auth->email_user,
                            'auth_foto'         => $auth->foto_user
                        ));
                    }
                    redirect('auth/login/next?source=login&utf8=✓');
                }else{
                    //create data array with error message
                    $data = array(
                        'error'     => '<div style="color: #a20008;font-family:Roboto;margin-top: 15px">
                                            <i class="fa fa-exclamation-circle"></i> Sorry, the username is not registered.
                                        </div>',
                        'title'     =>  'Login &rsaquo; Nyimak.ID - Make Me Happy'
                    );
                    $this->load->view('admin/auth/login', $data);
                }

            }else{
                $data = array(
                    'title' => 'Login &rsaquo; Nyimak.ID - Make Me Happy'
                );
                $this->load->view('admin/auth/login', $data);
            }
        }

    }

    public function next()
    {
        if($this->auth->auth_id())
        {
            //redirect dahsboard
            redirect('auth/dashboard/');

        }elseif($this->auth->auth_username()){

            //check dengan form validation
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_message('required', '<div style="color: #a20008;font-family:Roboto;margin-top: 15px">
                                                                <i class="fa fa-exclamation-circle"></i> {field} harus diisi.
                                                             </div>');
            if($this->form_validation->run() == TRUE)
            {
                $username = $this->session->userdata('auth_username');
                $password = SHA1(MD5(MD5(SHA1($this->input->post('password', TRUE)))));
                //checking data via model
                $checking = $this->auth->check_all('tbl_users', array('username' => $username), array('password' => $password));
                //jika ditemukan, maka create session
                if($checking !=FALSE)
                {
                    foreach($checking as $auth)
                    {
                        $this->session->set_userdata(array(
                            'auth_id'           => $auth->id_user,
                            'auth_username'     => $auth->username,
                            'auth_nama'         => $auth->nama_user,
                            'auth_email'        => $auth->email_user,
                            'auth_foto'         => $auth->foto_user
                        ));
                        redirect('auth/dashboard/');
                    }
                }else{
                    //create data array
                    $data = array(
                        'error' => '<div style="color: #a20008;font-family:Roboto;margin-top: 15px">
                                        <i class="fa fa-exclamation-circle"></i> Sorry, password incorrect.
                                    </div>',
                        'title'         => 'Login &rsaquo; Nyimak.ID - Make Me Happy'
                    );
                    $this->load->view('admin/auth/login_next', $data);
                }
            }else{
                //create data array
                $data = array(
                    'title'         => 'Login &rsaquo; Nyimak.ID - Make Me Happy'
                );
                $this->load->view('admin/auth/login_next', $data);
            }

        }else{
            redirect('auth/login?source=next&utf8=✓');
        }
    }

    public function forgot()
    {
        $this->load->view('admin/auth/forgot');
    }

}
