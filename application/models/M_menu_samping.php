<?php

/**
 * Created by PhpStorm.
 * User: SNmayer
 * Date: 8/8/2016
<<<<<<< HEAD
 * Time: 8:24 PM
 */
class M_menu_samping extends CI_Model{

    function ambil_menu_label($gu)
    {
        $this->db->select(array('a.nama_menu','a.id_menu'));
        $this->db->from('menu a');
        $this->db->join('menu_access b','a.id_menu=b.menu_id');
        $this->db->where('a.id_parent', '0');
        $this->db->where('a.status',    '1');
        $this->db->where('b.baca',      '1');
        $this->db->where('b.group_id',  $gu);
        return $this->db->get();
    }

    function ambil_menu_parent($gu, $idl)
    {
        $this->db->select(array('a.nama_menu','a.id_menu','a.url_pages','a.icon'));
        $this->db->from('menu a');
        $this->db->join('menu_access b','a.id_menu=b.menu_id');
        $this->db->where('a.id_parent', $idl);
        $this->db->where('a.status',    '1');
        $this->db->where('b.baca',      '1');
        $this->db->where('b.group_id',  $gu);
        return $this->db->get();
    }

    function ambil_menu_child($gu, $idp)
    {
        $this->db->select(array('a.nama_menu','a.id_menu','a.url_pages','a.icon'));
        $this->db->from('menu a');
        $this->db->join('menu_access b','a.id_menu=b.menu_id');
        $this->db->where('a.id_parent',  $idp);
        $this->db->where('a.status',    '1');
        $this->db->where('b.baca',      '1');
        $this->db->where('b.group_id',  $gu);
        return $this->db->get();
    }

    function ambil_count_child($gu, $idp)
    {
        $this->db->select(array('a.id_menu','COUNT(a.id_parent)as jml'));
        $this->db->from('menu a');
        $this->db->join('menu_access b','a.id_menu=b.menu_id');
        $this->db->where('a.id_parent',  $idp);
        $this->db->where('a.status',    '1');
        $this->db->where('b.baca',      '1');
        $this->db->where('b.group_id',  $gu);
        return $this->db->get();
    }

}