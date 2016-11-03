<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_logged();
    }

    public function index()
    {
        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_index';
        $this->load->view('template/adminLTE/index', $data);
    }

}
