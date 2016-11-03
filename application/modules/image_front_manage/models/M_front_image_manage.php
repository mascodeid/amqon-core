<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 */
class M_front_image_manage extends CI_Model
{

  function __construct()
  {
    # code...
  }

  /* membuat id otomatis */
  function id_otomatis(&$idnya)
	{
		$query=$this->db->query("SELECT id_image FROM images ORDER BY id_image DESC");
		$cek = $query->num_rows(count($query));
		if ($cek == 0)
		{
			$id = 1;
		}
		else
		{
			$row = $query->row();
			$id = $row->id_image+1;
      //((int)$row->id)+1;
		}
		$idnya = $id;
	}

  function tampil_data($perpage,$uri)
  {
    $cari_nama = $this->input->post('cari_nama');

    if (empty($cari_nama))
    {
      $this->db->select("a.*,b.nama_nav");
      $this->db->from("images a, nav_menu b");
      $this->db->where("b.id_nav = a.menu_id");
      $this->db->order_by("a.nama_image","ASC");
    }
    else
    {
      $this->db->select("a.*,b.nama_nav");
      $this->db->from("images a, nav_menu b");
      $this->db->where("b.id_nav = a.menu_id AND a.nama_image LIKE '$cari_nama%'");
      $this->db->order_by("a.nama_image","ASC");
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

  function add($menu_id,$nama_image,$deskripsi,$image,$tgl_input)
  {
    /* check data in database */
    $this->db->select(array('menu_id','nama_image'));
    $this->db->from('images');
    $this->db->where('menu_id',$menu_id);
    $this->db->where('nama_image',$nama_image);
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
        'id_image' => $id,
        'menu_id' => $menu_id,
        'nama_image' => $nama_image,
        'image' => $image,
        'deskripsi' => $deskripsi,
        'tgl_input_image' => $tgl_input
      );
      /* insert data in database */
      $this->db->insert('images', $data);
      return true;
    }
  }

  function cek_detail($id)
  {
    $query = $this->db->get_where('images', array('md5(sha1(id_image))' => $id));
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
    $this->db->from("images a, nav_menu b");
    $this->db->where("b.id_nav = a.menu_id");
    $this->db->where("md5(sha1(a.id_image))",$id);
    $query = $this->db->get();
    return $query->row();
  }

  function edit($id,$menu_id,$nama_image,$deskripsi)
  {
    /* check data in database */
    $this->db->select(array('menu_id','nama_image'));
    $this->db->from('images');
    $this->db->where('menu_id', $menu_id);
    $this->db->where('nama_image', $nama_image);
    $this->db->where('md5(sha1(id_image)) !=', $id);
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
      /* set array column in tabel */
      $data = array(
        'menu_id' => $menu_id,
        'nama_image' => $nama_image,
        'deskripsi' => $deskripsi
      );
      /* update table nav_menu */
      $this->db->set($data);
      $this->db->where('md5(sha1(id_image))', $id);
      $this->db->update('images');
      return true;
    }
  }

  function delete($id)
  {
    $query = $this->db->get_where('images', array('md5(sha1(id_image))' => $id));
    $cek = $query->num_rows(count($query));
    if ($cek != 1) {
      return false;
    }
    else {
      $this->db->where('md5(sha1(id_image))', $id);
      $query = $this->db->get('images');
      $row = $query->row();
      $image = unlink('./assets/images/upload/'.$row->image);

      $this->db->where('md5(sha1(id_image))', $id);
      $this->db->delete('images');
      return true;
    }
  }

  function get_nama_image($id)
  {
    $query = $this->db->get_where('images', array('md5(sha1(id_image))' => $id));
    return $query->row();
  }

  function ubah_image($id,$image)
  {

    $this->db->where('md5(sha1(id_image))',$id);
    $query = $this->db->get('images');
    $row = $query->row();
    $hapus = unlink('./assets/images/upload/'.$row->image);//untuk hapus foto
    /* set array column in tabel */
    $data = array(
      'image' => $image
    );
    /* update table nav_menu */
    $this->db->set($data);
    $this->db->where('md5(sha1(id_image))', $id);
    $this->db->update('images');
    return true;

  }
}
