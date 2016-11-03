<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_front_text_manage extends CI_Model
{

  function __construct()
  {
    # code...
  }

  /* membuat id otomatis */
  function id_otomatis(&$idnya)
	{
		$query=$this->db->query("SELECT id_text FROM texts ORDER BY id_text DESC");
		$cek = $query->num_rows(count($query));
		if ($cek == 0)
		{
			$id = 1;
		}
		else
		{
			$row = $query->row();
			$id = $row->id_text+1;
      //((int)$row->id)+1;
		}
		$idnya = $id;
	}

  function tampil_data($perpage,$uri)
  {
    $cari_judul = $this->input->post('cari_judul');

    if (empty($cari_judul))
    {
      $this->db->select("a.*,b.nama_nav");
      $this->db->from("texts a, nav_menu b");
      $this->db->where("b.id_nav = a.menu_id");
      $this->db->order_by("a.judul_text","ASC");
    }
    else
    {
      $this->db->select("a.*,b.nama_nav");
      $this->db->from("texts a, nav_menu b");
      $this->db->where("b.id_nav = a.menu_id AND a.judul_text LIKE '$cari_judul%'");
      $this->db->order_by("a.judul_text","ASC");
    }
    $query = $this->db->get('',$perpage,$uri);
		return $query->result();
  }

  function tampil_data_menu()
  {
    $this->db->select('*');
    $this->db->order_by('nama_nav');
    $query = $this->db->get('nav_menu')->result();
    return $query;
  }

  function add($menu_id,$judul_text,$isi_text,$tgl_input)
  {
    /* check data in database */
    $this->db->select(array('menu_id','judul_text'));
    $this->db->from('texts');
    $this->db->where('menu_id',$menu_id);
    $this->db->where('judul_text',$judul_text);
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
        'id_text' => $id,
        'menu_id' => $menu_id,
        'judul_text' => $judul_text,
        'isi_text' => $isi_text,
        'tgl_input_text' => $tgl_input
      );
      /* insert data in database */
      $this->db->insert('texts', $data);
      return true;
    }
  }

  function cek_detail($id)
  {
    $query = $this->db->get_where('texts', array('md5(sha1(id_text))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      return true;
    }
  }

  function detail($id)
  {
    $this->db->select("a.*,b.nama_nav");
    $this->db->from("texts a, nav_menu b");
    $this->db->where("b.id_nav = a.menu_id");
    $this->db->where("md5(sha1(a.id_text))",$id);
    $query = $this->db->get();
    return $query->row();
  }

  function edit($id,$menu_id,$judul_text,$isi_text)
  {
    /* check data in database */
    $this->db->select(array('menu_id','judul_text'));
    $this->db->from('texts');
    $this->db->where('menu_id', $menu_id);
    $this->db->where('judul_text', $judul_text);
    $this->db->where('md5(sha1(id_text)) !=', $id);
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
        'menu_id' => $menu_id,
        'judul_text' => $judul_text,
        'isi_text' => $isi_text
      );
      /* update table nav_menu */
      $this->db->set($data);
      $this->db->where('md5(sha1(id_text))', $id);
      $this->db->update('texts');
      return true;
    }
  }

  function delete($id)
  {
    $query = $this->db->get_where('texts', array('md5(sha1(id_text))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      $this->db->where('md5(sha1(id_text))', $id);
      $this->db->delete('texts');
      return true;
    }
  }

  function get_judul_text($id)
  {
    $query = $this->db->get_where('texts', array('md5(sha1(id_text))' => $id));
    return $query->row();
  }
}
