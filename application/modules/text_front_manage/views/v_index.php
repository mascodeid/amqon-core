<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box box-default">
            <div class="box-header">
              <h3 class="box-title">View Data Text</h3>
              <hr style="margin-top:10px;margin-bottom:10px;">
              <div class="col-sm-2">
                <div class="row" style="margin-bottom:5px;">
                  <button type="button" onClick="location.href=('<?php echo site_url("text_front_manage/add");?>');" class="wow bounceIn btn btn-sm btn-default"
                  <?php if(auth_akses('buat') != 1) {echo "disabled='disabled'";} ?>
                  data-toggle="tooltip" data-placement="right" title="Add Data"
                  data-wow-delay="0.2s"><i class="fa fa-plus"></i></button>
                </div>
    				  </div>
    				  <div class="col-md-4 col-md-offset-6 col-sm-8 col-sm-offset-2 ">
                <div class="row">
                  <form action="<?php echo site_url('text_front_manage')?>" class="form-horizontal" method="post">
          					<div class="input-group">
          					  <input type="text" name="cari_judul"  size="25" class="form-control" placeholder="Cari berdasarkan judul...">
          					  <span class="input-group-btn">
          						<button type="submit" class="btn btn-default" ><i class="fa fa-search"></i></button>
          					  </span>
          					</div>
                  </form>
                </div>
    				  </div>
            </div>
            <?php
              if($tampil)
              {
            ?>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                <tr>
                  <th width="10px">No</th>
                  <th>Judul</th>
                  <th>Menu ID</th>
                  <th>Teks</th>
                  <th>Action</th>
                </tr>
                <?php
                $no = $no+1;
                foreach($tampil as $baris)
                {
                ?>
                <tr>
                  <td align="center"><?php echo $no;?></td>
                  <td><?php echo $baris->judul_text; ?></td>
                  <td><?php echo $baris->nama_nav; ?></td>
                  <td><?php echo substr($baris->isi_text,0,100).'...'; ?></td>
                  <td align="center">
                    <button type="button" class="wow bounceIn btn btn-sm btn-default" <?php if(auth_akses('ubah') != 1) {echo "disabled='disabled'";} ?>
                      onClick="location.href=('<?php echo site_url("text_front_manage/edit/".md5(sha1($baris->id_text)));?>');" data-toggle="tooltip" data-placement="top" title="Edit" data-wow-delay="0.2s"><i class="fa fa-edit"></i></button>
                    <button type="button" class="wow bounceIn btn btn-sm btn-default" <?php if(auth_akses('hapus') != 1) {echo "disabled='disabled'";} ?>
                      onclick="return hapus('<?php echo $baris->judul_text; ?>','<?php echo site_url("text_front_manage/delete/".md5(sha1($baris->id_text))); ?>');"
                      data-toggle="tooltip" data-placement="top" title="Delete" data-wow-delay="0.2s"><i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
                <?php
                $no++;
                }
                ?>
              </table>
            </div>
            <div class="box-footer clearfix">
              <?php
      					if(set_value('cari_judul') == "")
      					{
      						echo $halaman;
      					}
      					else
      					{
    					?>
              <a href="<?php echo site_url("text_front_manage"); ?>">
              <span class="glyphicon glyphicon-list-alt"></span> Tampilkan Seluruh Data
              </a>
              <?php
                }
              ?>
            </div>
            <!-- /.box-body -->
            <!-- tutup if($tampil) -->
            <?php
              }
              else
              {
            ?>
            <div class="box-body">
              <br>
              <center>
                <h1><span class="glyphicon glyphicon-floppy-remove"></span> Data Tidak Ditemukan</h1>
              </center>
              <br>
              <br>
              <br>
              <div class="box-footer clearfix">
                <a href="<?php echo site_url("text_front_manage"); ?>">
                  <span class="glyphicon glyphicon-list-alt"></span> Tampilkan Seluruh Data
                </a>
              </div>
            </div>
            <?php
              }
            ?>
          </div>
        </div>
    </div>
    <?php if($this->session->flashdata('message')) { echo success_alert($this->session->flashdata('message')); } ?>
</section>
