<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Web extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    function get_personal_video()
    {
        $query = "SELECT * FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user ORDER BY a.id_video DESC limit 0, 1";
        return $this->db->query($query);
    }

    function home_sidebar_popular()
    {
        $query = "SELECT * FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user WHERE a.views > 1000 ORDER BY a.id_video DESC limit 0, 5";
        return $this->db->query($query);
    }

    function get_playlist($page){
        $offset = 12 * $page;
        $limit  = 12;
        $query  = "SELECT * FROM tbl_playlist ORDER BY id_playlist DESC limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function get_videos_terbaru($page){
        $offset = 12 * $page;
        $limit  = 12;
        $query  = "SELECT a.id_video, a.judul_video, a.slug_video, a.thumbnail, a.category_id, a.user_id, a.views, a.date_created, b.nama_user, b.id_user, b.username FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user ORDER BY a.id_video DESC limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function get_videos_popular($page){
        $offset = 12 * $page;
        $limit  = 12;
        $query  = "SELECT a.id_video, a.judul_video, a.slug_video, a.thumbnail, a.category_id, a.user_id, a.views, a.date_created, b.nama_user, b.id_user, b.username FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user WHERE a.views > 1000 ORDER BY a.id_video DESC limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function get_videos_recomended($page){
        $offset = 12 * $page;
        $limit  = 12;
        $query  = "SELECT a.id_video, a.judul_video, a.slug_video, a.thumbnail, a.category_id, a.user_id, a.views, a.date_created, b.nama_user, b.id_user, b.username FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user WHERE a.views > 1000 AND  a.date_created BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()  limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function get_category($page){
        $offset = 12 * $page;
        $limit  = 12;
        $query  = "SELECT * FROM tbl_category ORDER  BY nama_category ASC  limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function get_category_sidebar($page){
        $offset = 5 * $page;
        $limit  = 5;
        $query  = "SELECT * FROM tbl_category ORDER  BY nama_category ASC  limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function detail_videos($url)
    {
        $query = $this->db->query("SELECT a.id_video, a.judul_video, a.slug_video, a.embed, a.thumbnail, a.deskripsi_video, a.meta_keywords, a.meta_descriptions, a.category_id, a.user_id, a.views, a.date_created, b.nama_user, b.id_user, .b.foto_user, b.username, c.id_category, c.nama_category, c.slug_category FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user JOIN tbl_category as c ON a.category_id = c.id_category WHERE   a.slug_video = '$url'");

        if($query->num_rows() > 0)
        {
            return $query->row();
        }else
        {
            return NULL;
        }
    }

    function related_video($category_id)
    {
        $query = "SELECT * FROM tbl_videos as a JOIN tbl_users as b ON a.user_id = b.id_user WHERE a.category_id ='$category_id' ORDER BY a.category_id DESC limit 0,5";
        return $this->db->query($query);
    }

    function get_developers($page){
        $offset = 8 * $page;
        $limit  = 8;
        $query  = "SELECT * FROM tbl_developers limit $offset ,$limit";
        $result = $this->db->query($query)->result();
        return $result;
    }

    function search_json()
    {
        $query = $this->db->get('tbl_videos');
        return $query->result();
    }

    function total_search_videos($keyword)
    {
        $query = $this->db->like('judul_video',$keyword)->get('tbl_videos');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    public function search_index_videos($keyword,$limit,$offset)
    {
        $query = $this->db->select('a.id_video, a.category_id, a.judul_video, a.slug_video, a.views, a.thumbnail, a.date_created, b.id_category, b.nama_category, b.slug_category, c.id_user, c.username, c.nama_user')
            ->from('tbl_videos a')
            ->join('tbl_category b','a.category_id = b.id_category')
            ->join('tbl_users c','a.user_id = c.id_user')
            ->limit($limit,$offset)
            ->like('a.judul_video',$keyword)
            ->or_like('b.nama_category',$keyword)
            ->limit($limit,$offset)
            ->order_by('a.id_video','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query;
        }
        else
        {
            return NULL;
        }
    }

    function count_videos($username)
    {
        $query = $this->db->select('a.id_video, a.category_id, a.judul_video, a.slug_video, a.views, a.thumbnail, a.date_created, b.id_category, b.nama_category, b.slug_category, c.id_user, c.username, c.nama_user')
            ->from('tbl_videos a')
            ->join('tbl_category b','a.category_id = b.id_category')
            ->join('tbl_users c','a.user_id = c.id_user')
            ->where('c.username',$username)
            ->order_by('a.id_video','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    function index_videos($halaman,$batas,$username)
    {
        $query = "SELECT a.id_video, a.category_id, a.judul_video, a.slug_video, a.views, a.thumbnail, a.date_created, b.id_category, b.nama_category, b.slug_category, c.id_user, c.username, c.nama_user, c.foto_user FROM tbl_videos as a JOIN tbl_category as b JOIN tbl_users as c ON a.category_id = b.id_category AND a.user_id = c.id_user WHERE c.username = '$username' limit $halaman, $batas";
        return $this->db->query($query);
    }

    function user_videos($username)
    {
        $username  =  array('username'=> $username);
        return $this->db->get_where('tbl_users',$username);
    }

    function get_nama_user($username)
    {
        $query = $this->db->query("SELECT * FROM tbl_users WHERE username = '$username'");

        if($query->num_rows() > 0)
        {
            return $query->row();
        }else
        {
            return NULL;
        }
    }

    function count_category($slug)
    {
        $query = $this->db->select('a.id_video, a.category_id, a.judul_video, a.slug_video, a.views, a.thumbnail, a.date_created, b.id_category, b.nama_category, b.slug_category, c.id_user, c.username, c.nama_user')
            ->from('tbl_videos a')
            ->join('tbl_category b','a.category_id = b.id_category')
            ->join('tbl_users c','a.user_id = c.id_user')
            ->where('b.slug_category',$slug)
            ->order_by('a.id_video','DESC')
            ->get();

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    function index_category($halaman,$batas,$slug)
    {
        $query = "SELECT a.id_video, a.category_id, a.judul_video, a.slug_video, a.views, a.thumbnail, a.date_created, b.id_category, b.nama_category, b.slug_category, b.slug_category, c.id_user, c.username, c.nama_user, c.foto_user FROM tbl_videos as a JOIN tbl_category as b JOIN tbl_users as c ON a.category_id = b.id_category AND a.user_id = c.id_user WHERE b.slug_category = '$slug' limit $halaman, $batas";
        return $this->db->query($query);
    }

    function get_category_judul($slug)
    {
        $query = $this->db->query("SELECT * FROM tbl_category WHERE slug_category = '$slug'");

        if($query->num_rows() > 0)
        {
            return $query->row();
        }else
        {
            return NULL;
        }
    }

    function get_pages($id_pages)
    {
        $query = $this->db->query("SELECT * FROM tbl_pages WHERE id_page = '$id_pages'");
        return $query;
    }

    function category_header()
    {
        $query = "SELECT * FROM tbl_category ORDER BY nama_category ASC limit 0,4";
        return $this->db->query($query);
    }

    function sitemap()
    {
        $query  =   $this->db->order_by("id_video","DESC")->get("tbl_videos");
        return $query->result_array();
    }

    //fungsi date

    // Fungsi GLobal //
    function tgl_time_indo($date=null){
        $tglindo = date("d-m-Y H:i:s", strtotime($date));
        $formatTanggal = $tglindo;
        return $formatTanggal;
    }

    function tgl_database($date=null)
    {
        $tgldatabase = date("Y-m-d", strtotime($date));
        $formatTanggal = $tgldatabase;
        return $formatTanggal;
    }

    function tgl_indo($date=null)
    {
        $tglindo = date("d-m-Y", strtotime($date));
        $formatTanggal = $tglindo;
        return $formatTanggal;
    }

    function tgl_tunggal($date=null)
    {
        $tglindo = date("j", strtotime($date));
        $formatTanggal = $tglindo;
        return $formatTanggal;
    }

    function tgl_mont_year($date=null)
    {
        $tglindo = date("n, Y");
        return $tglindo;
    }

    function year_tunggal($date=null)
    {
        $tglindo = date("Y");
        return $tglindo;
    }

    function jam_format($time=null)
    {
        $jamformat = date("H:i", strtotime($time));
        $formatJam = $jamformat;
        return $formatJam;
    }

    function bulan_inggris($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Jan','Feb','Mar', 'Apr', 'May', 'Jun','Jul','Aug',
            'Sep','Oct', 'Nov','Dec');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('j');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('j', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
        }
        $formatTanggal = $bulan;
        return $formatTanggal;
    }

    function tgl_indo_no_hari($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('j');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('j', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
        }
        $formatTanggal = $tanggal ." ". $bulan ." ". $tahun;
        return $formatTanggal;
    }

    function bulan_indo($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('j');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('j', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
        }
        $formatTanggal = $bulan;
        return $formatTanggal;
    }

    function tgl_indo_lengkap($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('d');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
            $jam = date('H:i:s');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('d', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
            $jam = date('H:i:s',$date);
        }
        $formatTanggal = $hari . ", " . $tanggal ." ". $bulan ." ". $tahun ." Jam ". $jam;
        return $formatTanggal;
    }

    function tgl_jam_indo_no_hari($date=null){
        //buat array nama hari dalam bahasa Indonesia dengan urutan 1-7
        $array_hari = array(1=>'Senin','Selasa','Rabu','Kamis','Jumat', 'Sabtu','Minggu');
        //buat array nama bulan dalam bahasa Indonesia dengan urutan 1-12
        $array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus',
            'September','Oktober', 'November','Desember');
        if($date == null) {
            //jika $date kosong, makan tanggal yang diformat adalah tanggal hari ini
            $hari = $array_hari[date('N')];
            $tanggal = date ('d');
            $bulan = $array_bulan[date('n')];
            $tahun = date('Y');
            $jam = date('H:i:s');
        } else {
            //jika $date diisi, makan tanggal yang diformat adalah tanggal tersebut
            $date = strtotime($date);
            $hari = $array_hari[date('N',$date)];
            $tanggal = date ('d', $date);
            $bulan = $array_bulan[date('n',$date)];
            $tahun = date('Y',$date);
            $jam = date('H:i:s',$date);
        }
        $formatTanggal = $tanggal ." ". $bulan ." ". $tahun ." Jam ". $jam;
        return $formatTanggal;
    }

    function time_elapsed_string($datetime, $full = false) {
        $today = time();
        $createdday= strtotime($datetime);
        $datediff = abs($today - $createdday);
        $difftext="";
        $years = floor($datediff / (365*60*60*24));
        $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours= floor($datediff/3600);
        $minutes= floor($datediff/60);
        $seconds= floor($datediff);
        //year checker
        if($difftext=="")
        {
            if($years>1)
                $difftext=$years." years ago";
            elseif($years==1)
                $difftext=$years." year ago";
        }
        //month checker
        if($difftext=="")
        {
            if($months>1)
                $difftext=$months." months ago";
            elseif($months==1)
                $difftext=$months." month ago";
        }
        //month checker
        if($difftext=="")
        {
            if($days>1)
                $difftext=$days." days ago";
            elseif($days==1)
                $difftext=$days." day ago";
        }
        //hour checker
        if($difftext=="")
        {
            if($hours>1)
                $difftext=$hours." hours ago";
            elseif($hours==1)
                $difftext=$hours." hour ago";
        }
        //minutes checker
        if($difftext=="")
        {
            if($minutes>1)
                $difftext=$minutes." minutes ago";
            elseif($minutes==1)
                $difftext=$minutes." minute ago";
        }
        //seconds checker
        if($difftext=="")
        {
            if($seconds>1)
                $difftext=$seconds." seconds ago";
            elseif($seconds==1)
                $difftext=$seconds." second ago";
        }
        return $difftext;
    }

}