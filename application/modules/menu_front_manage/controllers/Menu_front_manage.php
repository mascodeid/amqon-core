<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Menu_front_manage extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        auth_logged();
        auth_baca();
        $this->load->model('m_nav_manage', '', TRUE);
        $this->load->library(array('form_validation', 'pagination'));
    }

    public function index()
    {
        $data['navs'] = $this->m_nav_manage->tampil_data();

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_index';
        $this->load->view('template/adminLTE/index', $data);
    }

    public function deactivate($id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        $value = '0';
        $sukses = $this->m_nav_manage->deactivate($id, $value);
        $nama_nav = $this->m_nav_manage->get_nama_nav($id);
        if ($sukses == 1) {
            $this->session->set_flashdata('message', 'Data Menu <b>' . $nama_nav->nama_nav . '</b> Berhasil Di Nonaktifkan.');
            redirect('menu_front_manage');
        } else {
            redirect('menu_front_manage');
        }
    }

    public function activate($id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }
        $value = '1';
        $sukses = $this->m_nav_manage->activate($id, $value);
        $nama_nav = $this->m_nav_manage->get_nama_nav($id);
        if ($sukses == 1) {
            $this->session->set_flashdata('message', 'Data Menu <b>' . $nama_nav->nama_nav . '</b> Berhasil Di Aktifkan.');
            redirect('menu_front_manage');
        } else {
            redirect('menu_front_manage');
        }
    }

    public function add()
    {
        /* setting input */
        $nama_menu = $this->input->post('nama_menu');
        $parent = $this->input->post('parent');
        $child = $this->input->post('child');
        $url_menu = $this->input->post('url_menu');
        $deskripsi = $this->input->post('deskripsi');
        $status = $this->input->post('status');
        /* button submit */
        $btn_add = $this->input->post('btn_add');
        /* setting error NULL */
        $data['error'] = "";
        /* if click submit */
        if ($btn_add) {
            /* set validation in form */
            $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
            $this->form_validation->set_rules('url_menu', 'Url Menu', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi Menu', 'required');
            $this->form_validation->set_rules('status', 'Status Menu', 'required');
            /* set message validation */
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            /* set if validation true */
            if ($this->form_validation->run() == TRUE) {
                /* set input database */
                $simpan = $this->m_nav_manage->add($nama_menu, $parent, $child, $url_menu, $deskripsi, $status);
                if ($simpan) {
                    $this->session->set_flashdata('message', 'Data Menu <b>' . $nama_menu . '</b> Berhasil Di Tambahkan.');
                    redirect('menu_front_manage');
                } else {
                    $data['error'] = "Data Sudah Pernah Tersimpan";
                }
            }
        }
        /* get data nav_menu */
        $data['navs'] = $this->m_nav_manage->tampil_data();

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_add';
        $this->load->view('template/adminLTE/index', $data);
    }

    public function edit()
    {
        $id = $this->uri->segment(3);
        /* setting input */
        $nama_menu = $this->input->post('nama_menu');
        $parent = $this->input->post('parent');
        $child = $this->input->post('child');
        $url_menu = $this->input->post('url_menu');
        $deskripsi = $this->input->post('deskripsi');
        $status = $this->input->post('status');
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
            $this->form_validation->set_rules('nama_menu', 'Nama Menu', 'required');
            $this->form_validation->set_rules('url_menu', 'Url Menu', 'required');
            $this->form_validation->set_rules('deskripsi', 'Deskripsi Menu', 'required');
            $this->form_validation->set_rules('status', 'Status Menu', 'required');
            /* set message validation */
            $this->form_validation->set_message('required', '%s Tidak Boleh Kosong');
            /* set if validation true */
            if ($this->form_validation->run() == TRUE) {
                /* set update database */
                $simpan = $this->m_nav_manage->edit($id, $nama_menu, $parent, $child, $url_menu, $deskripsi, $status);
                if ($simpan) {
                    $this->session->set_flashdata('message', 'Data Menu <b>' . $nama_menu . '</b> Berhasil Di Ubah.');
                    redirect('menu_front_manage');
                } else {
                    $data['error'] = "Data Sudah Pernah Tersimpan";
                }
            }
        }
        /* set if url false */
        $cek = $this->m_nav_manage->cek_detail($id);
        if ($cek != 1) {
            redirect('menu_front_manage');
        }
        /* get data nav_menu berdasarkan id */
        $data['detail'] = $this->m_nav_manage->detail($id);
        /* detail parent */
        $data['detail_parent'] = $this->m_nav_manage->detail_parent($id);
        /* detail child */
        $data['detail_child'] = $this->m_nav_manage->detail_child($id);
        /* get data nav_menu */
        $data['navs'] = $this->m_nav_manage->tampil_data();

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_edit';
        $this->load->view('template/adminLTE/index', $data);
    }

    public function delete($id)
    {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            redirect('auth', 'refresh');
        }

        $nama_nav = $this->m_nav_manage->get_nama_nav($id);
        $sukses = $this->m_nav_manage->delete($id);
        if ($sukses == 1) {
            $this->session->set_flashdata('message', 'Data Menu <b>' . $nama_nav->nama_nav . '</b> Berhasil Di Hapus.');
            redirect('menu_front_manage');
        } else {
            redirect('menu_front_manage');
        }
    }
}
