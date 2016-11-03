<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                  <h3 class="box-title">Add Data Image</h3>
                  <hr style="margin-top:10px;margin-bottom:10px;">
                </div>
                <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" method="post" action="<?php echo site_url("image_front_manage/add"); ?>" enctype="multipart/form-data" >
                      <div class="box-body">
                        <div class="container-fuild">
                          <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-12">
                              <?php if(!empty($error)) : echo error_alert($error); endif;?>
                              <div class="form-group <?php if(form_error('menu_id')){echo "has-error";} ?>">
                                <label for="menu_id">ID Menu</label><br>
                                <select name="menu_id" id="menu_id" class="form-control">
                                  <option value="" >- Pilih -</option>
                                  <?php foreach($navs as $nav):?>
                                  <option <?php if (!(strcmp(set_value("menu_id"),"$nav->id_nav"))) {echo "selected=\"selected\"";} ?> value="<?php echo $nav->id_nav;?>" ><?php echo $nav->nama_nav;?></option>
                                  <?php endforeach; ?>
                                </select>
                                <?php if(form_error('menu_id')){echo '<span class="control-label" for="menu_id">'.form_error('menu_id').'</span>';} ?>
                              </div>
                              <div class="form-group <?php if(form_error('nama_image')){echo "has-error";} ?>">
                                <label for="nama_image">Nama Image</label>
                                <input type="text" name="nama_image" class="form-control" id="nama_image" value="<?php echo set_value('nama_image') ?>" placeholder="Nama Image">
                                <?php if(form_error('nama_image')){echo '<span class="control-label" for="nama_image">'.form_error('nama_image').'</span>';} ?>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">Upload Image</label>
                                <input type="file" name="images[]" id="exampleInputFile">

                                <p class="help-block">Format gambar JPG,PNG,GIF dan ukuran Max 2mb</p>
                              </div>
                              <!-- textarea -->
                              <div class="form-group <?php if(form_error('deskripsi')){echo "has-error";} ?>">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="textarea form-control" style="width: 100%; height: 200px; min-width:100%; min-height:200px; max-width:100%; max-height:200px; font-size: 14px; padding: 10px;" placeholder="deskripsi ..."><?php echo set_value("deskripsi"); ?></textarea>
                                <?php if(form_error('deskripsi')){echo '<span class="control-label" for="deskripsi">'.form_error('deskripsi').'</span>';} ?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.box-body -->

                      <div class="box-header">
                        <div class="container-fuild">
                          <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-12" style="padding-bottom:30px; text-align:right;">
                              <input type="submit" name="btn_add" class="btn btn-success" value="Simpan">
                              &nbsp;
                              <button type="button" class="btn btn-default" onClick="location.href='<?php echo site_url("image_front_manage");?>'"><span class="fa fa-times"></span> Batal</button>
                            </div>
                          </div>
                        </div>
                      </div>
                  </form>
                <!-- /.box -->
            </div>
        </div>
    </div>
</section>
<script>
        $('[type="file"]').ezdz({
            text: '<i class="fa  fa-download"></i> Choose a file or drag here'
        });
</script>
