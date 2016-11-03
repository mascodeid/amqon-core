<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: SNmayer
 * Date: 8/8/2016
 * Time: 5:24 AM
 */

/* ini adalah helper nama bulan di indonesia */
if (!function_exists('nama_bulan')) {
  # function nama bulan
  function nama_bulan($bulan)
  {
    $nama_bulan = array(
      '01' => 'Januari',
      '02' => 'Febuari',
      '03' => 'Maret',
      '04' => 'April',
      '05' => 'Mei',
      '06' => 'Juni',
      '07' => 'Juli',
      '08' => 'Agustus',
      '09' => 'September',
      '10' => 'Oktober',
      '11' => 'November',
      '12' => 'Desember',
    );
    return $nama_bulan[$bulan];
  }
}

/* ini adalah helper untuk pop up pemberitahuan sukses */
if (!function_exists('success_alert')) {
    function success_alert($pesan)
    {
        $success_alert = '
        <div class="pesan-error">
    		  <div class="col-sm-4 col-sm-offset-8 wow bounceIn alert alert-success alert-dismissible" data-wow-delay="0.2s">
    			  <div class="row">
              <div class="col-xs-2">
                <div class="row">
                  <div class="icon-alert">
                    <i class="icon fa fa-check-circle"></i>
                  </div>
                </div>
              </div>
              <div class="col-xs-10">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <div class="row">
                  <p style="font-size:25px; margin:0;">Success!</p>
                  <p style="margin:0;">' . $pesan . '</p>
                </div>
              </div>
            </div>
          </div>
        </div>';
        return $success_alert;
    }
}

/* ini adalah helper untuk pop up pemberitahuan error */
if (!function_exists('error_alert')) {
  function error_alert($pesan)
  {
    $error_alert = '
    <div class="col-sm-12">
      <div class="row">
        <div class="wow bounceIn alert alert-error alert-dismissible" data-wow-delay="0.2s">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4 style="text-align:center"><i class="icon fa fa-exclamation-circle"></i>Error!</h4><p style="text-align:center">' . $pesan . '</p>
        </div>
      </div>
    </div>';
    return $error_alert;
  }
}

if (!function_exists('hapus_garis_bawah')) {
    function hapus_garis_bawah($content)
    {
        $hasil = str_replace('_', ' ', $content);
        return $hasil;
    }
}

if (!function_exists('huruf_besar_awal')) {
    function huruf_besar_awal($content)
    {
        $hasil = ucwords($content);
        return $hasil;
    }
}

if (!function_exists('huruf_besar')) {
    function huruf_besar($content)
    {
        $hasil = strtoupper($content);
        return $hasil;
    }
}

if (!function_exists('huruf_kecil')) {
    function huruf_kecil($content)
    {
        $hasil = strtolower($content);
        return $hasil;
    }
}

if (!function_exists('menu_samping')) {
    function menu_samping()
    {
        $ci =& get_instance();

        // panggil model m_menu_samping
        $ci->load->model('m_menu_samping');
        // buat variabel untuk user group
        $gu = auth_user_groups()->id;
        // panggil function untuk menu label
        $ml = $ci->m_menu_samping->ambil_menu_label($gu);

        foreach ($ml->result() as $menuLabel) {

            // menampilkan menu label
            ?>
            <li class="header"><?php echo huruf_besar($menuLabel->nama_menu); ?></li>
            <?php

            // memangil id menu label
            $idl = $menuLabel->id_menu;
            // panggil function untuk menu parent
            $mp = $ci->m_menu_samping->ambil_menu_parent($gu, $idl);

            foreach ($mp->result() as $menuParent) {

                // panggil id menu parent
                $idp = $menuParent->id_menu;
                // menghitung jumlah menu child jika memang di miliki oleh menu parent
                $cc = $ci->m_menu_samping->ambil_count_child($gu,$idp);

                foreach ($cc->result() as $c) {
                    // buat variabel baru untuk count data
                    $x = $c->jml;
                    if($x != 0){
                        ?>
      				    <li class="treeview">
      				        <?php echo anchor("#","
      				            <i class='".$menuParent->icon."'></i>
      				            <span>".huruf_besar_awal($menuParent->nama_menu)."</span>
      				            <span class='pull-right-container'>
      				                <i class='fa fa-angle-left pull-right'></i>
      				            </span>");?>
      				        <ul class="treeview-menu">
      				    <?php

      				    // panggil function untuk menu child
      				    $mc = $ci->m_menu_samping->ambil_menu_child($gu,$idp);

                        foreach($mc->result() as $menuChild){
                            ?>
      					    <li>
      					        <?php echo anchor("$menuChild->url_pages","
                                    <i class='fa fa-circle-o'></i>
                                    <span>".$menuChild->nama_menu."</span>");?>
                            </li>
      				        <?php
      				    }

      				    /* call close tag <ul> and <li> */
      				    echo "</ul></li>";
                    }
                    else{
                        ?>
                        <li>
                            <?php echo anchor("$menuParent->url_pages","
                                <i class='".$menuParent->icon."'></i>
                                <span>".huruf_besar_awal($menuParent->nama_menu)."</span>");?>
                        </li>
                        <?php
                    }
                }
            }
        }
    }
}

if (!function_exists('breadcrumbs')) {
    function breadcrumbs()
    {
        $ci =& get_instance();

        // load Breadcrumbs
        $ci->load->library('breadcrumbs');

        // add breadcrumbs
        if($ci->uri->segment('1') == null){
            $ci->breadcrumbs->push('Dashboard', 'dashboard');
        }
        else{
            $ci->breadcrumbs->push(huruf_besar_awal(hapus_garis_bawah($ci->uri->segment('1'))), $ci->uri->segment('1'));
            if($ci->uri->segment('2') == null){
            }
            else{
                $ci->breadcrumbs->push(huruf_besar_awal($ci->uri->segment('2')), $ci->uri->segment('2'));
                if($ci->uri->segment('3') == null){
                }
                else{
                    $ci->breadcrumbs->push(huruf_besar_awal($ci->uri->segment('3')), $ci->uri->segment('3'));
                }
            }
        }
        // output
        return $ci->breadcrumbs->show();
    }
}

function tv_menu_access($role){
    $CI =& get_instance();
    $induk = $CI->db->query(" SELECT menu.*, menu_akses.id_akses, menu_akses.buat, menu_akses.baca, menu_akses.ubah, menu_akses.hapus
    FROM menu INNER JOIN menu_akses ON menu.id_menu=menu_akses.id_menu WHERE id_role=$role AND id_parent=0");
    foreach($induk->result() as $row){?>
        <tr>
            <td><?php echo "<i class='".$row->icon."'></i> ".$row->nama_menu; ?></td>
            <td><?php if ($row->buat == 0){echo "<input id=cr".$row->id_akses." class='minimal' type='checkbox' value=".$row->buat." onclick='create(".$row->id_akses.")'>";}else{echo "<input id=cr".$row->id_akses." class='minimal' type='checkbox' value=".$row->buat." onclick='create(".$row->id_akses.")' checked >";} ?></td>
            <td><?php if ($row->baca == 0){echo "<input id=re".$row->id_akses." class='minimal' type='checkbox' value=".$row->baca." onclick='read(".$row->id_akses.")'>";}else{echo "<input id=re".$row->id_akses." class='minimal' type='checkbox' value=".$row->baca." onclick='read(".$row->id_akses.")' checked >";} ?></td>
            <td><?php if ($row->ubah == 0){echo "<input id=up".$row->id_akses." class='minimal' type='checkbox' value=".$row->ubah." onclick='update(".$row->id_akses.")'>";}else{echo "<input id=up".$row->id_akses." class='minimal' type='checkbox' value=".$row->ubah." onclick='update(".$row->id_akses.")' checked >";} ?></td>
            <td><?php if ($row->hapus == 0){echo "<input id=de".$row->id_akses." class='minimal' type='checkbox' value=".$row->hapus." onclick='delet(".$row->id_akses.")'>";}else{echo "<input id=de".$row->id_akses." class='minimal' type='checkbox' value=".$row->hapus." onclick='delet(".$row->id_akses.")' checked >";} ?></td>
        </tr>

    <?php $anak = $CI->db->query(" SELECT menu.*, menu_akses.id_akses, menu_akses.buat, menu_akses.baca, menu_akses.ubah, menu_akses.hapus
    FROM menu INNER JOIN menu_akses ON menu.id_menu=menu_akses.id_menu WHERE id_role=$role AND id_parent=$row->id_menu");
        foreach ($anak->result() as $baris){?>
            <tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "<i class='".$baris->icon."'></i> ". $baris->nama_menu;?></td>
            <td><?php if ($baris->buat == 0){echo "<input id=cr".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->buat." onclick='create(".$baris->id_akses.")'>";}else{echo "<input id=cr".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->buat." onclick='create(".$baris->id_akses.")' checked >";} ?></td>
            <td><?php if ($baris->baca == 0){echo "<input id=re".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->baca." onclick='read(".$baris->id_akses.")'>";}else{echo "<input id=re".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->baca." onclick='read(".$baris->id_akses.")' checked >";} ?></td>
            <td><?php if ($baris->ubah == 0){echo "<input id=up".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->ubah." onclick='update(".$baris->id_akses.")'>";}else{echo "<input id=up".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->ubah." onclick='update(".$baris->id_akses.")' checked >";} ?></td>
            <td><?php if ($baris->hapus == 0){echo "<input id=de".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->hapus." onclick='delet(".$baris->id_akses.")'>";}else{echo "<input id=de".$baris->id_akses." class='minimal' type='checkbox' value=".$baris->hapus." onclick='delet(".$baris->id_akses.")' checked >";} ?></td>
        </tr>
        <?php }
    }
}
