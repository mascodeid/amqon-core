<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: SNmayer
 * Date: 8/8/2016
 * Time: 4:30 AM
 */

if (!function_exists('auth_logged')) {
    function auth_logged()
    {
        $ci =& get_instance();
        if (!$ci->ion_auth->logged_in()) {
            redirect('auth/login');
        }
    }
}

if (!function_exists('auth_baca')) {
    function auth_baca()
    {
        $ci     =& get_instance();

        // panggil model m_hak_akses
        $ci->load->model('m_hak_akses');
        // panggil id role
        $gu     = auth_user_groups()->id;
        // deklarasikan variabel controller
        $nc     = $ci->uri->segment('1');

        if($nc == null){
            $nc = 'dashboard';
        }

        $ab     = $ci->m_hak_akses->hak_akses($gu,$nc)->row();
        if($ab->baca != 1){
            redirect('auth');
        }
    }
}

if (!function_exists('auth_akses')) {
    // $content = array('buat','ubah','hapus')
    function auth_akses($content)
    {
        $ci     =& get_instance();

        // panggil model m_hak_akses
        $ci->load->model('m_hak_akses');
        // panggil id role
        $gu     = auth_user_groups()->id;
        // deklarasikan variabel controller
        $nc     = $ci->uri->segment('1');
        // deklarasikan $content
        $isi    = $content;

        if($nc == null){
            $nc = 'dashboard';
        }

        $ab     = $ci->m_hak_akses->hak_akses($gu,$nc)->row();
        return $ab->$content;
    }
}

if (!function_exists('auth_user')) {
    function auth_user()
    {
        $ci =& get_instance();
        return $ci->ion_auth->user()->row();
    }
}

if (!function_exists('auth_user_groups')){
    function auth_user_groups(){
        $ci =& get_instance();
        return $ci->ion_auth->get_users_groups(auth_user()->id)->row();
    }
}

if (!function_exists('auth_groups')){
    function auth_groups(){
        $ci =& get_instance();
        return $ci->ion_auth->groups()->result();
    }
}