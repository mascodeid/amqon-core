<?php

/**
 * Created by PhpStorm.
 * User: SNmayer
 * Date: 8/8/2016
<<<<<<< HEAD
 * Time: 8:24 PM
 */
class M_hak_akses extends CI_Model{

    function hak_akses($gu,$nc)
    {
        $this->db->select(array('b.baca','b.buat','b.ubah','b.hapus'));
        $this->db->from('menu a');
        $this->db->join('menu_access b','a.id_menu=b.menu_id');
        $this->db->where('a.url_pages', $nc);
        $this->db->where('a.status',    '1');
        $this->db->where('b.group_id',  $gu);
        return $this->db->get();
    }
}