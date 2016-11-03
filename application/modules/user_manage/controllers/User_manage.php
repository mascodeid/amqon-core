<?php

/**
 * Created by PhpStorm.
 * User: SNmayer
 * Date: 8/10/2016
 * Time: 9:50 PM
 */
class User_manage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        auth_logged();
        $this->load->library(array('form_validation','pagination'));
    }

    function index()
    {
        //list the users
        $data['users'] = $this->ion_auth->users()->result();
        foreach ($data['users'] as $k => $user)
        {
            $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        $data['plugtop'] = 'plugin/plugtop';
        $data['plugbot'] = 'plugin/plugbot';
        $data['content'] = 'v_index';
        $this->load->view('template/adminLTE/index',$data);
    }
}