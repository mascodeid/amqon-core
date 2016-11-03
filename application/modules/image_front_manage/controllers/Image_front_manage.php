<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Image_front_manage extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        auth_logged();
        auth_baca();
        $this->load->model('m_front_image_manage', '', TRUE);
        $this->load->library(array('form_validation', 'pagination', 'user_agent', 'upload'));
    }

    public function index($id = NULL)
    {
        /* setting input */
        $cari_judul = $this->input->post('cari_judul');
        /* query untuk mengambil nilai dari tabel texts */
        $query = $this->db->query("SELECT * FROM images ORDER BY nama_image");
        $n = $query->num_rows(count($query));
        /* setting pagination */
        $config["base_url"] = base_url() . 'index.php/image_front_manage/index';
        $config["per_page"] = 2;
        $config["total_rows"] = $n;
        $config['full_tag_open'] = "<ul class='pagination pagination-sm no-margin pull-right'>";
        $config['full_tag_close'] = "</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href=''>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        /* instal pagination */
        $this->pagination->initialize($config);
        /* call pagination in view */
        $data['halaman'] = $this->pagination->create_links();
        /* set if btn cari judul empty */
        if (!empty($cari_judul)) {
            /* set no limit list page in pagination */
            $config["per_page"] = '';
            /* configure database */
            $data["tampil"] = $this->m_front_image_manage->tampil_data($config['per_page'], $id);
        } else {
            /* configure database */
            $data["tampil"] = $this->m_front_image_manage->tampil_data($config['per_page'], $id);
        }
        /* if validation true */
        if ($this->form_validation->run() == TRUE) {
        }
        /* set no in view */
        $data["no"] = $id;

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_index';
        $this->load->view('template/adminLTE/index', $data);
    }

    public function add()
    {
        /* setting input */
        $menu_id = $this->input->post('menu_id');
        $nama_image = $this->input->post('nama_image');
        $deskripsi = $this->input->post('deskripsi');
        $tgl_input = date('Y-m-d h:i:s');
        /* button submit */
        $btn_add = $this->input->post('btn_add');
        /* setting error NULL */
        $data['error'] = "";
        /* if click submit */
        if ($btn_add) {
            /* set validation in form */
            $this->form_validation->set_rules('menu_id', 'Menu ID', 'required');
            $this->form_validation->set_rules('nama_image', 'Nama Image', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
            /* set message validation */
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            if ($this->form_validation->run() == TRUE) {
                /* Configure upload */
                $this->upload->initialize(array(
                    "allowed_types" => "gif|jpg|png|jpeg",
                    "upload_path" => "./assets/images/upload/",
                    "max_size" => "1000"
                ));
                /* if upload filed*/
                if (!$this->upload->do_upload('images')) {
                    /* set message all error file upload */
                    $data['error'] = $this->upload->display_errors('', '');
                } else {
                    /* get data upload */
                    $uploaded = $this->upload->data();
                    /* get name data upload first */
                    $image = $uploaded['file_name'];
                    /* set input database */
                    $simpan = $this->m_front_image_manage->add($menu_id, $nama_image, $deskripsi, $image, $tgl_input);
                    if ($simpan) {
                        $this->session->set_flashdata('message', 'Data <b>' . $nama_image . '</b> Berhasil Di Tambahkan.');
                        redirect('image_front_manage');
                    } else {
                        $data['error'] = "Data Sudah Pernah Tersimpan";
                        unlink('./assets/images/upload/' . $image);
                    }
                }
            }
        }
        /* get data menu */
        $data['navs'] = $this->m_front_image_manage->tampil_data_menu();
        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_add';
        $this->load->view('template/adminLTE/index', $data);
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        /* setting input */
        $menu_id = $this->input->post('menu_id');
        $nama_image = $this->input->post('nama_image');
        $deskripsi = $this->input->post('deskripsi');
        /* button submit */
        $btn_edit = $this->input->post('btn_edit');
        /* setting error NULL */
        $data['error'] = "";
        /* setting action NULL */
        $data['act'] = "0";
        if ($btn_edit) {
            /* setting action value */
            $data['act'] = "1";
            /* set validation in form */
            $this->form_validation->set_rules('menu_id', 'Menu ID', 'required');
            $this->form_validation->set_rules('nama_image', 'Nama Image', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
            /* set message validation */
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            /* set if validation true */
            if ($this->form_validation->run() == TRUE) {
                /* set update database */
                $simpan = $this->m_front_image_manage->edit($id, $menu_id, $nama_image, $deskripsi);
                if ($simpan) {
                    $this->session->set_flashdata('message', 'Data <b>' . $nama_image . '</b> Berhasil Di Ubah.');
                    redirect('image_front_manage');
                } else {
                    $data['error'] = "Data Sudah Pernah Tersimpan";
                }
            }
        }
        /* set if url false */
        $cek = $this->m_front_image_manage->cek_detail($id);
        if ($cek != 1) {
            redirect('image_front_manage');
        }
        /* get data texts berdasarkan id */
        $data['detail'] = $this->m_front_image_manage->detail($id);
        /* get data nav_menu */
        $data['navs'] = $this->m_front_image_manage->tampil_data_menu();

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_edit';
        $this->load->view('template/adminLTE/index', $data);
    }

    public function ubah_image($id)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if (!empty($_FILES)) {
            /* Configure upload */
            $this->upload->initialize(array(
                "allowed_types" => "gif|jpg|png|jpeg",
                "upload_path" => "./assets/images/upload/",
                "max_size" => "1000"
            ));

            if (!$this->upload->do_upload("imagesx")) {
                $message = $this->upload->display_errors('', '');
                $data['error_string'][] = error_alert($message);
                $data['status'] = FALSE;
            } else {
                $uploaded = $this->upload->data();//untuk mengambil data upload
                $image = $uploaded['file_name'];//data upload yang pertama
                $ubah_image = $this->m_front_image_manage->ubah_image($id, $image);

            }
        }
        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
        echo json_encode(array("status" => TRUE));
    }

    public function delete($id)
    {
        $nama_image = $this->m_front_image_manage->get_nama_image($id);
        $sukses = $this->m_front_image_manage->delete($id);
        if ($sukses == 1) {
            $this->session->set_flashdata('message', 'Data <b>' . $nama_image->nama_image . '</b> Berhasil Di Hapus.');
            redirect('image_front_manage');
        } else {
            redirect('image_front_manage');
        }
    }
}
