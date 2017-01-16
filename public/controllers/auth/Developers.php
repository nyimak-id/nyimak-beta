<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package  : Nyimak.ID - Kumpulan Video Indonesia
 * @author   : Fika Ridaul Maulayya <ridaulmaulayya@gmail.com>
 * @since    : 2016 - 2017
 * @license  : https://nyimak.id/license/
 */
class Developers extends CI_Controller
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
        if ($this->auth->auth_id()) {
            //config pagination
            $config['base_url'] = base_url() . 'auth/developers/index/';
            $config['total_rows'] = $this->auth->count_developers()->num_rows();
            $config['per_page'] = 10;
            //instalasi paging
            $this->pagination->initialize($config);
            //deklare halaman
            $halaman = $this->uri->segment(4);
            $halaman = $halaman == '' ? 0 : $halaman;
            //create data array
            $data = array(
                'title' => 'Developers',
                'icon' => 'pe-7s-user',
                'developers' => TRUE,
                'data_developers' => $this->auth->index_developers($halaman, $config['per_page']),
                'paging' => $this->pagination->create_links()
            );
            if ($data['data_developers'] != NULL) {

                $data['developers'] = $data['data_developers'];

            } else {

                $data['developers'] = NULL;

            }
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/developers/data');
            $this->load->view('admin/part/footer');
        } else {
            show_404();
            return FALSE;
        }
    }

    public function json_search()
    {
        //query get
        $query = $this->auth->search_developers_json();
        $data = array();
        foreach ($query as $key => $value) {
            $data[] = array('judul' => $value->nama);
        }
        echo json_encode($data);
    }

    public function search()
    {
        if ($this->auth->auth_id()) {
            $limit = 10;
            $this->load->helper('security');
            $keyword = $this->security->xss_clean($_GET['q']);
            $data['keyword'] = strip_tags($keyword);
            $check = strlen(preg_replace('/[^a-zA-Z]/', '', $keyword));
            if (!empty($keyword) && $check > 2) {
                $offset = (isset($_GET['page'])) ? $this->security->xss_clean($_GET['page']) : 0;
                $total = $this->auth->total_search_developers($keyword);
                //config pagination
                $config['base_url'] = base_url() . 'auth/developers/search?q=' . $keyword;
                $config['total_rows'] = $total;
                $config['per_page'] = $limit;
                $config['page_query_string'] = TRUE;
                $config['use_page_numbers'] = TRUE;
                $config['display_pages'] = TRUE;
                $config['query_string_segment'] = 'page';
                $config['uri_segment'] = 4;
                //instalasi paging
                $this->pagination->initialize($config);

                $data = array(
                    'title' => 'Developers',
                    'icon'  => 'pe-7s-user',
                    'developers' => TRUE,
                    'data_developers' => $this->auth->search_index_developers(strip_tags($keyword), $limit, $offset),
                    'paging' => $this->pagination->create_links()
                );
                if ($data['data_developers'] != NULL) {
                    $data['developers'] = $data['data_developers'];
                } else {
                    $data['developers'] = '';
                }
                //load view with data
                $this->load->view('admin/part/header', $data);
                $this->load->view('admin/part/sidebar');
                $this->load->view('admin/part/navbar');
                $this->load->view('admin/layout/developers/data');
                $this->load->view('admin/part/footer');
            } else {
                $data['developers'] = NULL;
            }
        } else {
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
                'title'         => 'Tambah Developers',
                'icon'          => 'pe-7s-ribbon',
                'developers'    => TRUE,
                'type'          => 'add',
                'thumbnail'     => 'userfile'
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/developers/add');
            $this->load->view('admin/part/footer');
        }else{
            show_404();
            return FALSE;
        }
    }

    public function edit($id_developer)
    {
        if($this->auth->auth_id())
        {
            //get id
            $id_developer = $this->encryption->decode($this->uri->segment(4));
            //create data array
            $data = array(
                'title'          => 'Edit Developers',
                'icon'           => 'pe-7s-ribbon',
                'developers'     => TRUE,
                'type'           => 'edit',
                'thumbnail'      => 'userfile',
                'data_developers'=> $this->auth->edit_developers($id_developer)->row_array()
            );
            //load view with data
            $this->load->view('admin/part/header', $data);
            $this->load->view('admin/part/sidebar');
            $this->load->view('admin/part/navbar');
            $this->load->view('admin/layout/developers/edit');
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
            $type              = $this->input->post("type");
            $id['id_developer'] = $this->encryption->decode($this->input->post("id_developer"));
            //check var type
            if($type == "add")
            {
                //config upload
                $config = array(
                    'upload_path'   => realpath('resources/images/developers/'),
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
                    $source             = realpath('resources/images/developers/'.$data_upload['file_name']);
                    $destination_thumb  = realpath('resources/images/developers/thumb/');

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
                        'nama'     => $this->input->post("nama"),
                        'jabatan'  => $this->input->post("jabatan"),
                        'linkedin' => $this->input->post("linkedin"),
                        'foto'     => $data_upload['file_name']
                    );
                    $this->db->insert("tbl_developers",$insert);
                    //deklarasi session flashdata
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Disimpan.
			                                                </div>');
                    //redirect halaman
                    redirect('auth/developers?source=add&utf8=✓');
                }else{
                    $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Disimpan '.$this->upload->display_errors('').'
			                                                </div>');
                    redirect('auth/developers?source=add&utf8=✓');
                }
            }elseif($type == "edit"){
                if(empty($_FILES['userfile']['name']))
                {
                    //create update array
                    $update = array(
                        'nama'     => $this->input->post("nama"),
                        'jabatan'  => $this->input->post("jabatan"),
                        'linkedin' => $this->input->post("linkedin")
                    );
                    $this->db->update("tbl_developers", $update, $id);
                    $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                    redirect('auth/developers?source=edit&utf8=✓');
                }else{
                    //config upload
                    $config = array(
                        'upload_path' => realpath('resources/images/developers/'),
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
                        $source = realpath('resources/images/developers/' . $data_upload['file_name']);
                        $destination_thumb = realpath('resources/images/developers/thumb/');
                        $source_old = realpath('resources/images/developers/thumb/' . $foto_thumbnail . '');

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
                            'nama'     => $this->input->post("nama"),
                            'jabatan'  => $this->input->post("jabatan"),
                            'linkedin' => $this->input->post("linkedin"),
                            'foto'     => $data_upload['file_name']

                        );
                        $this->db->update("tbl_developers", $update, $id);
                        //deklarasi session flashdata
                        $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Diupdate.
			                                                </div>');
                        //redirect halaman
                        redirect('auth/developers?source=edit&utf8=✓');
                    } else {
                        $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Data Gagal Diupdate ' . $this->upload->display_errors('') . '
			                                                </div>');
                        redirect('auth/developers?source=edit&utf8=✓');
                    }
                }
            }else{
                $this->session->set_flashdata('notif', '<div class="alert alert-danger alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-exclamation-circle"></i> Variable Type not value
			                                                </div>');
                redirect('auth/developers?source=edit&utf8=✓');
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
            $query  = $this->db->query("SELECT id_developer, foto FROM tbl_developers WHERE id_developer ='$id'")->row();
            unlink(realpath('resources/images/developers/'.$query->thumbnail));
            unlink(realpath('resources/images/developers/thumb/'.$query->thumbnail));
            $key['id_developer'] = $id;
            $this->db->delete("tbl_developers", $key);
            $this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible" style="font-family:Roboto">
			                                                    <i class="fa fa-check"></i> Data Berhasil Dihapus.
			                                                </div>');
            //redirect halaman
            redirect('auth/developers?source=delete&utf8=✓');
        }else{
            show_404();
            return FALSE;
        }
    }


}