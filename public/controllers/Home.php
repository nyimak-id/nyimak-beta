<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Lucu Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('home/part/header');
        $this->load->view('home/layout/home/home');
        $this->load->view('home/part/footer');
	}
}
