<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                  <h3 class="box-title">Add Data Text</h3>
                  <hr style="margin-top:10px;margin-bottom:10px;">
                </div>
                <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" method="post" action="<?php echo site_url("text_front_manage/add"); ?>" >
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
                              <div class="form-group <?php if(form_error('judul_text')){echo "has-error";} ?>">
                                <label for="judul_text">Judul</label>
                                <input type="text" name="judul_text" class="form-control" id="judul_text" value="<?php echo set_value('judul_text') ?>" placeholder="Judul">
                                <?php if(form_error('judul_text')){echo '<span class="control-label" for="judul_text">'.form_error('judul_text').'</span>';} ?>
                              </div>
                              <!-- textarea -->
                              <div class="form-group <?php if(form_error('isi_text')){echo "has-error";} ?>">
                                <label>Text</label>
                                <textarea name="isi_text" class="textarea form-control" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="text ..."><?php echo set_value("isi_text"); ?></textarea>
                                <?php if(form_error('isi_text')){echo '<span class="control-label" for="isi_text">'.form_error('isi_text').'</span>';} ?>
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
                              <button type="button" class="btn btn-default" onClick="location.href='<?php echo site_url("text_front_manage");?>'"><span class="fa fa-times"></span> Batal</button>
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
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5({
      toolbar: {
        'html': true,
        'size': 'sm',
        'color': true
      },
    });
  });
</script>
