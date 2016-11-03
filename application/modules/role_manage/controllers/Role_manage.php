<?php

/**
 * Created by PhpStorm.
 * User: SNmayer
 * Date: 8/10/2016
 * Time: 9:50 PM
 */
class Role_manage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_logged();
        auth_baca();
        $this->load->library(array('form_validation','pagination'));
    }

    function index()
    {
        //list the users
        $data['roles'] = auth_groups();

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_index';
        $this->load->view('template/adminLTE/index',$data);
    }
}