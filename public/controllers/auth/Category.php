<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Lucu Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Category extends CI_Controller
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
            //config pagination
            $config['base_url'] = base_url().'auth/category/index/';
            $config['total_rows'] = $this->auth->count_category()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(4);
            $halaman            =  $halaman==''? 0 : $halaman;
            //create data array
            $data = array(
                'title'         => 'Category',
                'icon'          => 'pe-7s-ribbon',
                'category'      => TRUE,
                'data_category' => $this->auth->index_category($halaman,$config['per_page']),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_category'] != NULL)
            {
                $data['category'] = $data['data_category'];
            }else{
                $data['category'] = NULL;
            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/category/data');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query  = $this->auth->search_category_json();
        $data = array();
        foreach ($query as $key => $value)
        {
            $data[] = array('judul' => $value->nama_category);
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
                $total  = $this->auth->total_search_category($keyword);
                //config pagination
                $config['base_url'] = base_url().'auth/category/search?q='.$keyword;
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
                    'title'         => 'Category',
                    'icon'          => 'pe-7s-ribbon',
                    'category'      => TRUE,
                    'data_category' => $this->auth->search_index_category(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_category'] != NULL)
                {
                    $data['category'] = $data['data_category'];
                }else{
                    $data['category'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/category/data');
                $this->load->view('admin/part/footer');
            }else{
                $data['category'] = NULL;
            }
        }else{
            show_404();
            return FALSE;
        }
    }


    public function add()
    {
        if($this->auth->auth_id())
        {
            //create data array
            $data = array(
                'title'         => 'Tambah Category',
                'icon'          => 'pe-7s-ribbon',
                'category'      => TRUE,
                'type'          => 'add',
                'thumbnail'     => 'userfile'
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/category/add');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_category)
    {
        if($this->auth->auth_id())
        {
            //get id
            $id_category = $this->encryption->decode($this->uri->segment(4));
            //create data array
            $data = array(
                'title'         => 'Edit Category',
                'icon'          => 'pe-7s-ribbon',
                'category'      => TRUE,
                'type'          => 'edit',
                'thumbnail'     => 'userfile',
                'data_category' => $this->auth->edit_category($id_category)->row_array()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/category/edit');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function save()
    {
        if($this->auth->auth_id())
        {
            //get type from form
            $type              = $this->input->post("type");
            $id['id_category'] = $this->encryption->decode($this->input->post("id_category"));
            $check_category    = $this->auth->check_one('tbl_category', array('nama_category' => $this->input->post("nama_category")));
            if($check_category != FALSE)
            {
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! Nama category sudah terdaftar.
			                                                </div>');
                //redirect halaman
                redirect('auth/category?source=add&utf8=✓');
            }else{
                //check value var type
                if($type == "add")
                {
                    //config upload
                    $config = array(
                        'upload_path'   => realpath('resources/images/category/'),
                        'allowed_types' =>'jpg|png|jpeg',
                        'encrypt_name'  =>TRUE,
                        'remove_spaces' =>TRUE,
                        'overwrite'     =>TRUE,
                        'max_size'      =>'5000',
                        'max_width'     =>'5000',
                        'max_height'    =>'5000'
                    );
                    //load library upload
                    $this->load->library("upload",$config);
                    //load library lib image
                    $this->load->library("image_lib");

                    $this->upload->initialize($config);
                    if($this->upload->do_upload("userfile"))
                    {
                        $data_upload    = $this->upload->data();

                        /* PATH */
                        $source             = realpath('resources/images/category/'.$data_upload['file_name']);
                        $destination_thumb  = realpath('resources/images/category/thumb/');

                        // Permission Configuration
                        chmod($source, 0777) ;

                        /* Resizing Processing */
                        // Configuration Of Image Manipulation :: Static
                        $img['image_library'] = 'GD2';
                        $img['create_thumb']  = TRUE;
                        $img['maintain_ratio']= TRUE;

                        /// Limit Width Resize
                        $limit_thumb    = 600 ;

                        // Size Image Limit was using (LIMIT TOP)
                        $limit_use  = $data_upload['image_width'] > $data_upload['image_height'] ? $data_upload['image_width'] : $data_upload['image_height'] ;

                        // Percentase Resize
                        if ($limit_use > $limit_thumb) {
                            $percent_thumb  = $limit_thumb/$limit_use ;
                        }

                        //// Making THUMBNAIL ///////
                        $img['width']  = $limit_use > $limit_thumb ?  $data_upload['image_width'] * $percent_thumb : $data_upload['image_width'] ;
                        $img['height'] = $limit_use > $limit_thumb ?  $data_upload['image_height'] * $percent_thumb : $data_upload['image_height'] ;

                        // Configuration Of Image Manipulation :: Dynamic
                        $img['thumb_marker'] = '';
                        $img['quality']      = '100%' ;
                        $img['source_image'] = $source ;
                        $img['new_image']    = $destination_thumb ;

                        // Do Resizing
                        $this->image_lib->initialize($img);
                        $this->image_lib->resize();
                        $this->image_lib->clear() ;

                        $insert = array(
                            'nama_category'       => $this->input->post("nama_category"),
                            'slug_category'       => url_title(strtolower($this->input->post("nama_category"))),
                            'deskripsi_category'  => $this->input->post("descriptions"),
                            'thumbnail'           => $data_upload['file_name'],
                            'date_created'        => date("Y-m-d H:i:s")
                        );
                        $this->db->insert("tbl_category",$insert);
                        //deklarasi session flashdata
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                        //redirect halaman
                        redirect('auth/category?source=add&utf8=✓');
                    }else{
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Disimpan '.$this->upload->display_errors('').'
			                                                </div>');
                        redirect('auth/category?source=add&utf8=✓');
                    }

                }elseif($type == "edit"){
                    if(empty($_FILES['userfile']['name']))
                    {
                        //create update array
                        $update = array(
                            'nama_category'      => $this->input->post("nama_category"),
                            'slug_category'      => url_title(strtolower($this->input->post("nama_category"))),
                            'deskripsi_category' => $this->input->post("descriptions"),
                            'date_modified'      => date("Y-m-d H:i:s")
                        );
                        $this->db->update("tbl_category", $update, $id);
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                        redirect('auth/category?source=edit&utf8=✓');
                    }else{
                        //config upload
                        $config = array(
                            'upload_path' => realpath('resources/images/category/'),
                            'allowed_types' => 'jpg|png|jpeg',
                            'encrypt_name' => TRUE,
                            'remove_spaces' => TRUE,
                            'overwrite' => TRUE,
                            'max_size' => '5000',
                            'max_width' => '5000',
                            'max_height' => '5000'
                        );
                        //load library upload
                        $this->load->library("upload", $config);
                        //load library lib image
                        $this->load->library("image_lib");

                        $this->upload->initialize($config);
                        if ($this->upload->do_upload("userfile")) {
                            $data_upload = $this->upload->data();

                            /* PATH */
                            $source = realpath('resources/images/category/' . $data_upload['file_name']);
                            $destination_thumb = realpath('resources/images/category/thumb/');
                            $source_old = realpath('resources/images/category/thumb/' . $foto_thumbnail . '');

                            // Permission Configuration
                            chmod($source, 0777);

                            /* Resizing Processing */
                            // Configuration Of Image Manipulation :: Static
                            $img['image_library'] = 'GD2';
                            $img['create_thumb'] = TRUE;
                            $img['maintain_ratio'] = TRUE;

                            /// Limit Width Resize
                            $limit_thumb = 600;

                            // Size Image Limit was using (LIMIT TOP)
                            $limit_use = $data_upload['image_width'] > $data_upload['image_height'] ? $data_upload['image_width'] : $data_upload['image_height'];

                            // Percentase Resize
                            if ($limit_use > $limit_thumb) {
                                $percent_thumb = $limit_thumb / $limit_use;
                            }

                            //// Making THUMBNAIL ///////
                            $img['width'] = $limit_use > $limit_thumb ? $data_upload['image_width'] * $percent_thumb : $data_upload['image_width'];
                            $img['height'] = $limit_use > $limit_thumb ? $data_upload['image_height'] * $percent_thumb : $data_upload['image_height'];

                            // Configuration Of Image Manipulation :: Dynamic
                            $img['thumb_marker'] = '';
                            $img['quality'] = '100%';
                            $img['source_image'] = $source;
                            $img['new_image'] = $destination_thumb;

                            // Do Resizing
                            $this->image_lib->initialize($img);
                            $this->image_lib->resize();
                            $this->image_lib->clear();

                            $update = array(
                                'nama_category'      => $this->input->post("nama_category"),
                                'slug_category'      => url_title(strtolower($this->input->post("nama_category"))),
                                'deskripsi_category' => $this->input->post("descriptions"),
                                'thumbnail'          => $data_upload['file_name'],
                                'date_modified'      => date("Y-m-d H:i:s")

                            );
                            $this->db->update("tbl_category", $update, $id);
                            //deklarasi session flashdata
                            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                            //redirect halaman
                            redirect('auth/category?source=edit&utf8=✓');
                        } else {
                            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Diupdate ' . $this->upload->display_errors('') . '
			                                                </div>');
                            redirect('auth/category?source=edit&utf8=✓');
                        }
                    }

                }else{
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Variable Type not value
			                                                </div>');
                    redirect('auth/category?source=edit&utf8=✓');
                }
            }

        }else{
            show_404();
            return FALSE;
        }

    }

    public function delete()
    {
        if($this->auth->auth_id())
        {
            $id     = $this->encryption->decode($this->uri->segment(4));
            $query  = $this->db->query("SELECT id_category, thumbnail FROM tbl_category WHERE id_category ='$id'")->row();
            unlink(realpath('resources/images/category/'.$query->thumbnail));
            unlink(realpath('resources/images/category/thumb/'.$query->thumbnail));
            $key['id_category'] = $id;
            $this->db->delete("tbl_category", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('auth/category?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }



}