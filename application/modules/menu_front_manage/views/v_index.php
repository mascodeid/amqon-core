<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                  <h3 class="box-title">View Data Nav</h3>
                  <hr style="margin-top:10px;margin-bottom:10px;">

                  <button type="button" onClick="location.href=('<?php echo site_url("menu_front_manage/add");?>');" class="wow bounceIn btn btn-sm btn-default"
                  <?php if(auth_akses('buat') != 1) {echo "disabled='disabled'";} ?>
                  data-toggle="tooltip" data-placement="top" title="Tambah"
                  data-wow-delay="0.2s"><i class="fa fa-plus"></i> Tambah</button>

                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-bordered table-hover">
                      <tr>
                          <th width="10px">No</th>
                          <th>Nama Nav</th>
                          <th>Url Page</th>
                          <th>Deskripsi</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      <?php $no=0+1; foreach ($navs as $nav): ?>
                          <tr>
                              <td align="center"><?php echo $no++; ?></td>
                              <td><?php echo $nav->nama_nav; ?></td>
                              <td><?php echo $nav->url_page; ?></td>
                              <td><?php echo $nav->description; ?></td>
                              <td>
                              <?php
                                if($nav->status == 1)
                                { ?>
                                  <label>
                                    <?php if (auth_akses('ubah') != 1): ?>
                                        Active
                                    <?php else: ?>
                                      <a href="#" onClick="return deactive('<?php echo $nav->nama_nav; ?>','<?php echo site_url("menu_front_manage/deactivate/".md5(sha1($nav->id_nav))); ?>');">
                                        Active
                                      </a>
                                    <?php endif; ?>
                                  </label>
                              <?php
                                }
                                else
                                { ?>
                                  <label>
                                    <?php if (auth_akses('ubah') != 1): ?>
                                        Deactive
                                    <?php else: ?>
                                      <a href="#" onClick="return active('<?php echo $nav->nama_nav; ?>','<?php echo site_url("menu_front_manage/activate/".md5(sha1($nav->id_nav))); ?>');">
                                        Deactive
                                      </a>
                                    <?php endif; ?>
                                  </label>
                              <?php
                                } ?>
                              </td>
                              <td align="center">
                                <button type="button" class="wow bounceIn btn btn-sm btn-default" <?php if(auth_akses('ubah') != 1) {echo "disabled='disabled'";} ?>
                                  onClick="location.href=('<?php echo site_url("menu_front_manage/edit/".md5(sha1($nav->id_nav)));?>');" data-toggle="tooltip" data-placement="top" title="Edit" data-wow-delay="0.2s"><i class="fa fa-edit"></i></button>
                                <button type="button" class="wow bounceIn btn btn-sm btn-default" <?php if(auth_akses('hapus') != 1) {echo "disabled='disabled'";} ?>
                                  onClick="return hapus('Menu <?php echo $nav->nama_nav; ?>','<?php echo site_url("menu_front_manage/delete/".md5(sha1($nav->id_nav))); ?>');"
                                   data-toggle="tooltip" data-placement="top" title="Delete" data-wow-delay="0.2s"><i class="fa fa-trash"></i>
                                </button>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                  </table>
                </div>
                <!-- /.box-body -->
                <!-- /.box -->
            </div>
        </div>
    </div>
    <?php if($this->session->flashdata('message')) { echo success_alert($this->session->flashdata('message')); } ?>
</section>
