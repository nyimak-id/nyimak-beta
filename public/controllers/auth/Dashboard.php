<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Dashboard extends CI_Controller
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
        if($this->auth->auth_id())
        {
            //create data array
            $data = array(
                    'title'      => 'Dashboard',
                    'icon'       => 'pe-7s-home',
                    'dashboard'  => TRUE
            );
            $data['js_ready']   = "GetToday('".date("Y-m-d")."')";
            // Get Count Visitor
            $today_visit = $this->auth->count_in_today();
            $get_today_visit = $today_visit->row();
            $data['today_visit'] = $get_today_visit->count_in_today;

            $week_visit = $this->auth->count_in_week();
            $get_week_visit = $week_visit->row();
            $data['week_visit'] = $get_week_visit->count_in_week;

            $month_visit = $this->auth->count_in_month();
            $get_month_visit = $month_visit->row();
            $data['month_visit'] = $get_month_visit->count_in_month;

            $year_visit = $this->auth->count_in_year();
            $get_year_visit = $year_visit->row();
            $data['year_visit'] = $get_year_visit->count_in_year;
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/dashboard/dashboard');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    function get_chart_today()
    {
        $tgl = $this->input->post("tgl");
        $jm = array();
        $total = array();
        for($jam=00;$jam<=23;$jam++){
            if(strlen($jam)==1)
            {
                $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE(date_visit)='$tgl' AND DATE_FORMAT(date_visit, '%H')='0$jam'");
                $get = $query->row();
                $jm[] = "0$jam";
                $total[] = $get->total_pengunjung;
            }else{
                $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE(date_visit)='$tgl' AND DATE_FORMAT(date_visit, '%H')='$jam'");
                $get = $query->row();
                $jm[] = "$jam";
                $total[] = $get->total_pengunjung;
            }
        }
        echo json_encode(array("jam" => $jm, "total" => $total), JSON_NUMERIC_CHECK);
    }

    function get_chart_week()
    {
        $tgl2 = strtotime($this->input->post("tgl1"));
        $tgl1 = strtotime($this->input->post("tgl2"));
        $tgl = array();
        $total = array();
        $m= date("m");
        $de= date("d");
        $y= date("Y");
        for($i=0; $i<=6; $i++){
            $date = date('Y-m-d',mktime(0,0,0,$m,($de-$i),$y));
            $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE(date_visit)='$date'");
            $get = $query->row();
            $tgl[] = date('d-m-Y',mktime(0,0,0,$m,($de-$i),$y));
            $total[] = $get->total_pengunjung;
        }
        echo json_encode(array("tgl" => $tgl, "total" => $total), JSON_NUMERIC_CHECK);
    }

    function get_chart_month()
    {
        $tgl = array();
        $total = array();
        $month = date("m");
        $currentdays = intval(date("t"));
        $i = 0;
        while ($i++ < $currentdays){
            $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE_FORMAT(date_visit, '%m')='$month' AND DATE_FORMAT(date_visit, '%e')='$i'");
            $get = $query->row();
            $tgl[] = $i."-".date("M");
            $total[] = $get->total_pengunjung;
        }
        echo json_encode(array("tgl" => $tgl, "total" => $total), JSON_NUMERIC_CHECK);
    }

    function get_chart_all()
    {
        $tgl = array();
        $total = array();
        for($i =0; $i <= 4 ;$i++)
        {
            $year = date('Y') - 4 + $i;
            $query = $this->db->query("SELECT count(id_counter) as total_pengunjung FROM tbl_counter WHERE DATE_FORMAT(date_visit, '%Y')='$year'");
            $get = $query->row();
            $tgl[] = $year;
            $total[] = $get->total_pengunjung;
        }
        echo json_encode(array("tgl" => $tgl, "total" => $total), JSON_NUMERIC_CHECK);
    }

    public function logout()
    {
        if($this->auth->auth_id())
        {
            $this->auth->logout();
            redirect('/');
        }else{
            show_404();
            return FALSE;
        }
    }



}