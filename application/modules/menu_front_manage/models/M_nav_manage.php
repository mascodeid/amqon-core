<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class M_nav_manage extends CI_Model
{

  function __construct()
  {
    # code...
  }
  /* membuat id otomatis */
  function id_otomatis(&$idnya)
	{
		$query=$this->db->query("SELECT id_nav FROM nav_menu ORDER BY id_nav DESC");
		$cek = $query->num_rows(count($query));
		if ($cek == 0)
		{
			$id = 1;
		}
		else
		{
			$row = $query->row();
			$id = $row->id_nav+1;
      //((int)$row->id)+1;
		}
		$idnya = $id;
	}


  function tampil_data()
  {
    $this->db->select('*');
    $this->db->order_by('id_nav');
    $query = $this->db->get('nav_menu')->result();
    return $query;
  }

  function add($nama_menu,$parent,$child,$url_menu,$deskripsi,$status)
  {
    /* check data in database */
    $this->db->select('nama_nav');
    $this->db->from('nav_menu');
    $this->db->where('nama_nav',$nama_menu);
    $query = $this->db->get();
    /* set num row */
    $cek = $query->num_rows(count($query));
    /* set if $cek not zero */
    if ($cek != 0)
    {
      return false;
    }
    else
    {
      /* set id automatic */
      $id = "";
			$this->id_otomatis($id);
      /* set array column from table nav_menu */
      $data = array(
        'id_nav' => $id,
        'id_parent' => $parent,
        'id_child' => $child,
        'nama_nav' => $nama_menu,
        'url_page' => $url_menu,
        'description' => $deskripsi,
        'status' => $status
      );
      /* insert data in database */
      $this->db->insert('nav_menu', $data);
      return true;
    }
  }

  function deactivate($id,$value)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      $this->db->set('status', $value);
      $this->db->where('md5(sha1(id_nav))', $id);
      $this->db->update('nav_menu');
      return true;
    }
  }

  function activate($id,$value)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      $this->db->set('status', $value);
      $this->db->where('md5(sha1(id_nav))', $id);
      $this->db->update('nav_menu');
      return true;
    }
  }

  function delete($id)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      $this->db->where('md5(sha1(id_nav))', $id);
      $this->db->delete('nav_menu');
      return true;
    }
  }

  function detail($id)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    return $query->row();
  }

  function cek_detail($id)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      return true;
    }
  }

  function edit($id,$nama_menu,$parent,$child,$url_menu,$deskripsi,$status)
  {
    /* check data in database */
    $this->db->select('nama_nav');
    $this->db->from('nav_menu');
    $this->db->where('nama_nav', $nama_menu);
    $this->db->where('md5(sha1(id_nav)) !=', $id);
    $query = $this->db->get();
    /* set num row */
    $cek = $query->num_rows(count($query));
    /* set if $cek not zero */
    if ($cek != 0)
    {
      return false;
    }
    else
    {
      /* set array column in tabel nav_menu */
      $data = array(
        'id_parent' => $parent,
        'id_child' => $child,
        'nama_nav' => $nama_menu,
        'url_page' => $url_menu,
        'description' => $deskripsi,
        'status' => $status
      );
      /* update table nav_menu */
      $this->db->set($data);
      $this->db->where('md5(sha1(id_nav))', $id);
      $this->db->update('nav_menu');
      return true;
    }
  }

  function detail_parent($id)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    $parent = $query->row()->id_parent;
    $data = $this->db->get_where('nav_menu', array('id_nav' => $parent));
    return $data->row();
  }

  function detail_child($id)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    $child = $query->row()->id_child;
    $data = $this->db->get_where('nav_menu', array('id_nav' => $child));
    return $data->row();
  }

  function get_nama_nav($id)
  {
    $query = $this->db->get_where('nav_menu', array('md5(sha1(id_nav))' => $id));
    return $query->row();
  }
}
