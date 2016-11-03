<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                  <h3 class="box-title">Edit Data Image</h3>
                  <hr style="margin-top:10px;margin-bottom:10px;">
                </div>
                <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" method="post" action="<?php echo site_url("image_front_manage/edit/".md5(sha1($detail->id_image))); ?>" enctype="multipart/form-data" >
                      <div class="box-body">
                        <div class="container-fuild">
                          <div class="row">
                            <div class="col-md-6 col-md-offset-3 col-sm-12">
                              <?php if(!empty($error)) : echo error_alert($error); endif;?>
                              <div class="form-group <?php if(form_error('menu_id')){echo "has-error";} ?>">
                                <label for="menu_id">ID Menu</label><br>
                                <select name="menu_id" id="menu_id" class="form-control">
                                  <option value="<?php echo $detail->menu_id; ?>" selected="selected" >- <?php echo $detail->nama_nav; ?> -</option>
                                  <?php foreach($navs as $nav):?>
                                  <option <?php if (!(strcmp(set_value("menu_id"),"$nav->id_nav"))) {echo "selected=\"selected\"";} ?> value="<?php echo $nav->id_nav;?>" ><?php echo $nav->nama_nav;?></option>
                                  <?php endforeach; ?>
                                </select>
                                <?php if(form_error('menu_id')){echo '<span class="control-label" for="menu_id">'.form_error('menu_id').'</span>';} ?>
                              </div>
                              <div class="form-group <?php if(form_error('nama_image')){echo "has-error";} ?>">
                                <label for="nama_image">Nama Image</label>
                                <input type="text" name="nama_image" class="form-control" id="nama_image" value="<?php if($act == "0") echo $detail->nama_image; if($act == "1") echo set_value('nama_image') ?>" placeholder="Nama Image">
                                <?php if(form_error('nama_image')){echo '<span class="control-label" for="nama_image">'.form_error('nama_image').'</span>';} ?>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputFile">Upload Image</label>
                                <br>
                                <div class="col-md-12">
                                <center>
                                  <a class="image-popup-no-margins" href="<?php echo base_url(); ?>assets/images/upload/<?php echo $detail->image; ?>">
                                    <img src="<?php echo base_url(); ?>assets/images/upload/<?php echo $detail->image; ?>" width="150" height="150" class="img" alt="" />
                                  </a>
                                  <br>
                                  <br>
                                </center>
                                </div>
                                <br/>
                                <div class="col-md-12">
                                <center>
                                  <button type="button" name="ubah_image" id="ubah_image" class="btn btn-default" onClick="ubah_foto()"><span class="glyphicon glyphicon-picture"></span>  Ubah Image</button>
                                </center>
                                <br>
                                </div>
                              </div>
                              <!-- textarea -->
                              <div class="form-group <?php if(form_error('deskripsi')){echo "has-error";} ?>">
                                <label>Deskripsi</label>
                                <textarea name="deskripsi" class="textarea form-control" style="width: 100%; height: 200px; min-width:100%; min-height:200px; max-width:100%; max-height:200px; font-size: 14px; padding: 10px;" placeholder="deskripsi ..."><?php if($act == "0") echo $detail->deskripsi; if($act == "1") echo set_value("deskripsi"); ?></textarea>
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
                              <input type="submit" name="btn_edit" class="btn btn-success" value="Simpan">
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
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_ubah_image" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h3 class="modal-title"><span class="glyphicon glyphicon-picture"></span> Ubah Image</h3>
            </div>
            <div class="modal-body form">
              <div class="col-lg-8 col-lg-offset-2 ">
                <div id="error-data"></div>
              </div>
              <div class="clear"></div>
                <form action="" id="form_ubah_image" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-12">Upload Image</label>
                            <div class="col-md-12">
                                <input type="file" name="imagesx[]" id="imagesx"/>
                                <span style="color:#8a8a8a">
                                  <br/>
                                  - Ukuran Max. File = 2mb. <br/>
                                  - Format File = jpg,png,gif.
                                </span>
                                <br/>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <input type="submit" value="Ubah" onclick="save_image()" class="btn btn-success"/>
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Batal</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
  $('[type="file"]').ezdz({
      text: '<i class="fa  fa-download"></i> Choose a file or drag here'
  });

  $(document).ready(function() {

    $('.image-popup-vertical-fit').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      mainClass: 'mfp-img-mobile',
      image: {
        verticalFit: true
      }

    });

    $('.image-popup-fit-width').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      image: {
        verticalFit: false
      }
    });

    $('.image-popup-no-margins').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      closeBtnInside: false,
      fixedContentPos: true,
      mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
      image: {
        verticalFit: true
      },
      zoom: {
        enabled: true,
        duration: 300 // don't foget to change the duration also in CSS
      }
    });

  });

  //modal bootstrap
    function ubah_foto()
    {
      save_method = 'image';
      $('#form_ubah_image')[0].reset(); // reset form on modals
      $('#modal_form_ubah_image').modal('show');

    }
    //ajax ubah image
    function save_image()
    {
    $(document).ready(function (e){
      $("#form_ubah_image").on('submit',(function(e){
      e.preventDefault();
        $.ajax({
        url: "<?php echo site_url('image_front_manage/ubah_image/'.md5(sha1($detail->id_image)));?>",
        type: "POST",
        data:  new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
        dataType: "JSON",
        success: function(data){
          if(data.status) //if success close modal and reload ajax table
          {
              $('#modal_form_ubah_image').modal('hide');
              location.reload();
          }
          else
          {
            $("#error-data").html(data.error_string);
          }
        },
        error: function(){}
        });
      }));
    });
    }



</script>
