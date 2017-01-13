<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Videos extends CI_Controller
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
            $config['base_url'] = base_url().'auth/videos/index/';
            $config['total_rows'] = $this->auth->count_videos()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman            =  $this->uri->segment(4);
            $halaman            =  $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title'         => 'Videos',
                'icon'          => 'pe-7s-film',
                'videos'        => TRUE,
                'data_videos'   => $this->auth->index_videos($halaman,$config['per_page']),
                'paging'        => $this->pagination->create_links()
            );
            if($data['data_videos'] != NULL)
            {
                $data['videos'] = $data['data_videos'];
            }else{
                $data['videos'] = NULL;
            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/videos/data');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query  = $this->auth->search_videos_json();
        $data = array();
        foreach ($query as $key => $value)
        {
            $data[] = array('judul' => $value->judul_video);
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
                $total  = $this->auth->total_search_videos($keyword);
                //config pagination
                $config['base_url'] = base_url().'auth/videos/search?q='.$keyword;
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
                    'title'         => 'Videos',
                    'icon'          => 'pe-7s-photo-gallery',
                    'videos'        => TRUE,
                    'data_videos'   => $this->auth->search_index_videos(strip_tags($keyword),$limit,$offset),
                    'paging'        => $this->pagination->create_links()
                );
                if($data['data_videos'] != NULL)
                {
                    $data['videos'] = $data['data_videos'];
                }else{
                    $data['videos'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/videos/data');
                $this->load->view('admin/part/footer');
            }else{
                $data['videos'] = NULL;
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
                'title'         => 'Tambah Videos',
                'icon'          => 'pe-7s-film',
                'videos'        => TRUE,
                'type'          => 'add',
                'thumbnail'     => 'userfile',
                'cat_videos'    => $this->auth->cat_videos()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/videos/add');
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
            $id_videos = $this->encryption->decode($this->uri->segment(4));
            //create data array
            $data = array(
                'title'         => 'Edit Videos',
                'icon'          => 'pe-7s-film',
                'videos'        => TRUE,
                'type'          => 'edit',
                'thumbnail'     => 'userfile',
                'cat_videos'    => $this->auth->cat_videos(),
                'data_videos'   => $this->auth->edit_videos($id_videos)->row_array()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/videos/edit');
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
            $id['id_video']    = $this->encryption->decode($this->input->post("id_video"));
            $check_video       = $this->auth->check_one('tbl_videos', array('judul_video' => $this->input->post("judul_video")));
                //check value var type
                if ($type == "add") {
                    if($check_video != FALSE)
                    {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Error! Judul video sudah terdaftar.
			                                                </div>');
                        //redirect halaman
                        redirect('auth/videos?source=add&utf8=✓');
                    }else {
                        //config upload
                        $config = array(
                            'upload_path' => realpath('resources/images/videos/'),
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
                            $source = realpath('resources/images/videos/' . $data_upload['file_name']);
                            $destination_thumb = realpath('resources/images/videos/thumb/');

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
                                'judul_video' => $this->input->post("judul_video"),
                                'slug_video' => url_title(strtolower($this->input->post("judul_video"))),
                                'embed' => $this->input->post("embed_video"),
                                'category_id' => $this->input->post("category_video"),
                                'deskripsi_video' => $this->input->post("descriptions"),
                                'thumbnail' => $data_upload['file_name'],
                                'user_id' => $this->session->userdata("auth_id"),
                                'date_created' => date("Y-m-d H:i:s")
                            );
                            $this->db->insert("tbl_videos", $insert);
                            //deklarasi session flashdata
                            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                            //redirect halaman
                            redirect('auth/videos?source=add&utf8=✓');
                        } else {
                            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Disimpan ' . $this->upload->display_errors('') . '
			                                                </div>');
                            redirect('auth/videos?source=add&utf8=✓');
                        }
                    }

                } elseif ($type == "edit") {
                    if (empty($_FILES['userfile']['name'])) {
                        //create update array
                        $update = array(
                            'judul_video'     => $this->input->post("judul_video"),
                            'slug_video'      => url_title(strtolower($this->input->post("judul_video"))),
                            'embed'           => $this->input->post("embed_video"),
                            'category_id'     => $this->input->post("category_video"),
                            'deskripsi_video' => $this->input->post("descriptions"),
                            'user_id'         => $this->session->userdata("auth_id"),
                            'date_modified'   => date("Y-m-d H:i:s")
                        );
                        $this->db->update("tbl_videos", $update, $id);
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                        redirect('auth/videos?source=edit&utf8=✓');
                    } else {
                        //config upload
                        $config = array(
                            'upload_path' => realpath('resources/images/videos/'),
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
                            $source = realpath('resources/images/videos/' . $data_upload['file_name']);
                            $destination_thumb = realpath('resources/images/videos/thumb/');
                            $source_old = realpath('resources/images/videos/thumb/' . $foto_thumbnail . '');

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
                                'judul_video'     => $this->input->post("judul_video"),
                                'slug_video'      => url_title(strtolower($this->input->post("judul_video"))),
                                'embed'           => $this->input->post("embed_video"),
                                'category_id'     => $this->input->post("category_video"),
                                'deskripsi_video' => $this->input->post("descriptions"),
                                'thumbnail'       => $data_upload['file_name'],
                                'user_id'         => $this->session->userdata("auth_id"),
                                'date_modified'   => date("Y-m-d H:i:s")

                            );
                            $this->db->update("tbl_videos", $update, $id);
                            //deklarasi session flashdata
                            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                            //redirect halaman
                            redirect('auth/videos?source=edit&utf8=✓');
                        } else {
                            $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Diupdate ' . $this->upload->display_errors('') . '
			                                                </div>');
                            redirect('auth/videos?source=edit&utf8=✓');
                        }
                    }

                } else {
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Variable Type not value
			                                                </div>');
                    redirect('auth/videos?source=edit&utf8=✓');
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
            $query  = $this->db->query("SELECT id_video, thumbnail FROM tbl_videos WHERE id_video ='$id'")->row();
            unlink(realpath('resources/images/videos/'.$query->thumbnail));
            unlink(realpath('resources/images/videos/thumb/'.$query->thumbnail));
            $key['id_video'] = $id;
            $this->db->delete("tbl_videos", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('auth/videos?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }

}