<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Make Me Happy
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Playlist extends CI_Controller
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
            $config['base_url'] = base_url().'auth/playlist/index/';
            $config['total_rows'] = $this->auth->count_playlist()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(4);
            $halaman            =  $halaman==''? 0 : $halaman;
            //create data array
            $data = array(
                'title'         => 'Playlist Videos',
                'icon'          => 'pe-7s-ribbon',
                'playlist'      => TRUE,
                'data_playlist' => $this->auth->index_playlist($halaman,$config['per_page']),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_playlist'] != NULL)
            {
                $data['playlist'] = $data['data_playlist'];
            }else{
                $data['playlist'] = NULL;
            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/playlist/data');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query  = $this->auth->search_playlist_json();
        $data = array();
        foreach ($query as $key => $value)
        {
            $data[] = array('judul' => $value->nama_playlist);
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
                $total  = $this->auth->total_search_playlist($keyword);
                //config pagination
                $config['base_url'] = base_url().'auth/playlist/search?q='.$keyword;
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
                    'title'         => 'playlist',
                    'icon'          => 'pe-7s-ribbon',
                    'playlist'      => TRUE,
                    'data_playlist' => $this->auth->search_index_playlist(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_playlist'] != NULL)
                {
                    $data['playlist'] = $data['data_playlist'];
                }else{
                    $data['playlist'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/playlist/data');
                $this->load->view('admin/part/footer');
            }else{
                $data['playlist'] = NULL;
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
                'title'         => 'Tambah Playlist',
                'icon'          => 'pe-7s-ribbon',
                'playlist'      => TRUE,
                'type'          => 'add',
                'thumbnail'     => 'userfile'
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/playlist/add');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_playlist)
    {
        if($this->auth->auth_id())
        {
            //get id
            $id_playlist = $this->encryption->decode($this->uri->segment(4));
            //create data array
            $data = array(
                'title'         => 'Edit Playlist',
                'icon'          => 'pe-7s-ribbon',
                'playlist'      => TRUE,
                'type'          => 'edit',
                'thumbnail'     => 'userfile',
                'data_playlist' => $this->auth->edit_playlist($id_playlist)->row_array()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/playlist/edit');
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
            $id['id_playlist'] = $this->encryption->decode($this->input->post("id_playlist"));
            $check_playlist    = $this->auth->check_one('tbl_playlist', array('nama_playlist' => $this->input->post("nama_playlist")));
            //check value var type
            if($type == "add") {
                if ($check_playlist != FALSE) {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! Nama Playlist sudah terdaftar.
			                                                </div>');
                    //redirect halaman
                    redirect('auth/playlist?source=add&utf8=✓');
                } else {
                    //config upload
                    $config = array(
                        'upload_path' => realpath('resources/images/playlist/'),
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
                        $source = realpath('resources/images/playlist/' . $data_upload['file_name']);
                        $destination_thumb = realpath('resources/images/playlist/thumb/');

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

                        $insert = array(
                            'nama_playlist' => $this->input->post("nama_playlist"),
                            'slug_playlist' => url_title(strtolower($this->input->post("nama_playlist"))),
                            'deskripsi' => $this->input->post("descriptions"),
                            'thumbnail' => $data_upload['file_name'],
                            'date_created' => date("Y-m-d H:i:s")
                        );
                        $this->db->insert("tbl_playlist", $insert);
                        //deklarasi session flashdata
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
                                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
                                                                </div>');
                        //redirect halaman
                        redirect('auth/playlist?source=add&utf8=✓');
                    } else {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
                                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Disimpan ' . $this->upload->display_errors('') . '
                                                                </div>');
                        redirect('auth/playlist?source=add&utf8=✓');
                    }
                }

            }elseif($type == "edit"){
                if(empty($_FILES['userfile']['name']))
                {
                    //create update array
                    $update = array(
                        'nama_playlist'      => $this->input->post("nama_playlist"),
                        'slug_playlist'      => url_title(strtolower($this->input->post("nama_playlist"))),
                        'deskripsi'          => $this->input->post("descriptions"),
                        'date_modified'      => date("Y-m-d H:i:s")
                    );
                    $this->db->update("tbl_playlist", $update, $id);
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                    redirect('auth/playlist?source=edit&utf8=✓');
                }else{
                    //config upload
                    $config = array(
                        'upload_path' => realpath('resources/images/playlist/'),
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
                        $source = realpath('resources/images/playlist/' . $data_upload['file_name']);
                        $destination_thumb = realpath('resources/images/playlist/thumb/');
                        $source_old = realpath('resources/images/playlist/thumb/' . $foto_thumbnail . '');

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
                            'nama_playlist'      => $this->input->post("nama_playlist"),
                            'slug_playlist'      => url_title(strtolower($this->input->post("nama_playlist"))),
                            'deskripsi'          => $this->input->post("descriptions"),
                            'thumbnail'          => $data_upload['file_name'],
                            'date_modified'      => date("Y-m-d H:i:s")

                        );
                        $this->db->update("tbl_playlist", $update, $id);
                        //deklarasi session flashdata
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                        //redirect halaman
                        redirect('auth/playlist?source=edit&utf8=✓');
                    } else {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Diupdate ' . $this->upload->display_errors('') . '
			                                                </div>');
                        redirect('auth/playlist?source=edit&utf8=✓');
                    }
                }

            }else{
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Variable Type not value
			                                                </div>');
                redirect('auth/playlist?source=edit&utf8=✓');
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
            $query  = $this->db->query("SELECT id_playlist, thumbnail FROM tbl_playlist WHERE id_playlist ='$id'")->row();
            unlink(realpath('resources/images/playlist/'.$query->thumbnail));
            unlink(realpath('resources/images/playlist/thumb/'.$query->thumbnail));
            $key['id_playlist'] = $id;
            $this->db->delete("tbl_playlist", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('auth/playlist?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }



}