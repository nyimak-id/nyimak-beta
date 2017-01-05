<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Lucu Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Auth extends CI_Model{

    public function __construct()
    {
        parent::__construct();
    }

    /* fungsi login username */
    function check_username($table,$field1)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    /* end fungsi login username */

    /* fungsi login all */
    function check_all($table,$field1,$field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    /* end fungsi login all */

    /* checking double data */
    function check_one($table,$where)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }
    /* end checking double data */

    /* funsi visitor */
    function count_in_today()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_today FROM tbl_counter WHERE DATE(date_visit) = CURDATE()");
        return $q;
    }

    function count_in_week()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_week FROM tbl_counter WHERE DATE(date_visit) BETWEEN CURDATE() - INTERVAL 7 DAY AND CURDATE()");
        return $q;
    }

    function count_in_month()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_month FROM tbl_counter WHERE DATE(date_visit) BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()");
        return $q;
    }

    function count_in_year()
    {
        $q = $this->db->query("SELECT COUNT(id_counter) as count_in_year FROM tbl_counter WHERE YEAR(date_visit) = YEAR(CURDATE())");
        return $q;
    }
    /* end fungsi visitor */


    /* fungsi category */
    function count_category()
    {
        return $this->db->get('tbl_category');
    }

    function index_category($halaman,$batas)
    {
        $query = "SELECT * FROM tbl_category ORDER BY id_category DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function edit_category($id_category)
    {
        $id_category  =  array('id_category'=> $id_category);
        return $this->db->get_where('tbl_category',$id_category);
    }

    function search_category_json()
    {
        $query = $this->db->get('tbl_category');
        return $query->result();
    }

    function total_search_category($keyword)
    {
        $query = $this->db->like('nama_category',$keyword)->get('tbl_category');

        if($query->num_rows() > 0)
        {
            return $query->num_rows();
        }
        else
        {
            return NULL;
        }
    }

    function search_index_category($keyword,$limit,$offset)
    {
        $query = $this->db->select('id_category, nama_category, deskripsi_category, slug_category')
            ->from('tbl_category')
            ->limit($limit,$offset)
            ->like('nama_category',$keyword)
            ->limit($limit,$offset)
            ->order_by('id_category','DESC')
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
    /* end fungsi category */

    /* fungsi video */
    function count_videos()
    {
        return $this->db->get('tbl_category');
    }

    function index_videos($halaman,$batas)
    {
        $query = "SELECT * FROM tbl_videos as a JOIN tbl_category as b ON a.category_id = b.id_category ORDER BY id_video DESC limit $halaman, $batas";
        return $this->db->query($query);
    }

    function search_videos_json()
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
        $query = $this->db->select('a.id_video, a.category_id, a.judul_video, a.slug_video, a.views, b.id_category, b.nama_category, b.slug_category')
            ->from('tbl_videos a')
            ->join('tbl_category b','a.category_id = b.id_category')
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

    function cat_videos()
    {
        $this->db->order_by('nama_category ASC');
        return $this->db->get('tbl_category');
    }

    function edit_videos($id_videos)
    {
        $id_videos  =  array('id_video'=> $id_videos);
        return $this->db->get_where('tbl_videos',$id_videos);
    }
    /* end fungsi video */

    /* fungsi restrict halaman */
    function auth_id()
    {
        return $this->session->userdata('auth_id');
    }
    function auth_username()
    {
        return $this->session->userdata('auth_username');
    }
    /* end fungsi restrict */

    /* fungsi logout */
    function logout()
    {
        $this->session->sess_destroy();
    }
    /* end fungsi logout */
}