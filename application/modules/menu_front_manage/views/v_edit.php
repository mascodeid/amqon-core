<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">Edit Data Nav</h3>
                    <hr style="margin-top:10px;margin-bottom:10px;">
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post"
                      action="<?php echo site_url("menu_front_manage/edit/" . md5(sha1($detail->id_nav))); ?>">
                    <div class="box-body">
                        <div class="container-fuild">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-sm-12">
                                    <?php if (!empty($error)) : echo error_alert($error); endif; ?>
                                    <div class="form-group <?php if (form_error('nama_menu')) {
                                        echo "has-error";
                                    } ?>">
                                        <label for="nama_menu">Nama Menu</label>
                                        <input type="text" name="nama_menu" class="form-control" id="nama_menu"
                                               value="<?php if ($act == "0") echo $detail->nama_nav;
                                               if ($act == "1") echo set_value('nama_menu'); ?>"
                                               placeholder="Nama Menu">
                                        <?php if (form_error('nama_menu')) {
                                            echo '<span class="control-label" for="nama_menu">' . form_error('nama_menu') . '</span>';
                                        } ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="parent">Parent Menu</label><br>
                                        <select name="parent" id="parent" class="form-control">
                                            <option value="">- Pilih -</option>
                                            <?php ini_set("display_errors", 0);
                                            if ($detail_parent->id_nav != 0): ?>
                                                <option value="<?php echo $detail_parent->id_nav; ?>"
                                                        selected="selected"><?php echo $detail_parent->nama_nav; ?></option>
                                            <?php endif; ?>
                                            <?php foreach ($navs as $nav): ?>
                                                <option <?php if (!(strcmp(set_value("parent"), "$nav->id_nav"))) {
                                                    echo "selected=\"selected\"";
                                                } ?>
                                                    value="<?php echo $nav->id_nav; ?>"><?php echo $nav->nama_nav; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="child">Child Menu</label><br>
                                        <select name="child" id="child" class="form-control">
                                            <option value="">- Pilih -</option>
                                            <?php if ($detail_child->id_nav != 0): ?>
                                                <option value="<?php echo $detail_child->id_nav; ?>"
                                                        selected="selected"><?php echo $detail_child->nama_nav; ?></option>
                                            <?php endif; ?>
                                            <?php foreach ($navs as $nav): ?>
                                                <option <?php if (!(strcmp(set_value("child"), "$nav->id_nav"))) {
                                                    echo "selected=\"selected\"";
                                                } ?>
                                                    value="<?php echo $nav->id_nav; ?>"><?php echo $nav->nama_nav; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group <?php if (form_error('url_menu')) {
                                        echo "has-error";
                                    } ?>">
                                        <label for="url_menu">Url Menu</label>
                                        <input type="text" name="url_menu" class="form-control" id="url_menu"
                                               value="<?php if ($act == "0") echo $detail->url_page;
                                               if ($act == "1") echo set_value('url_menu'); ?>" placeholder="Url Menu">
                                        <?php if (form_error('url_menu')) {
                                            echo '<span class="control-label" for="url_menu">' . form_error('url_menu') . '</span>';
                                        } ?>
                                    </div>
                                    <!-- textarea -->
                                    <div class="form-group <?php if (form_error('deskripsi')) {
                                        echo "has-error";
                                    } ?>">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3"
                                                  placeholder="Deskripsi ..."><?php if ($act == "0") echo $detail->description;
                                            if ($act == "1") echo set_value('deskripsi'); ?></textarea>
                                        <?php if (form_error('deskripsi')) {
                                            echo '<span class="control-label" for="deskripsi">' . form_error('deskripsi') . '</span>';
                                        } ?>
                                    </div>
                                    <div class="form-group <?php if (form_error('status')) {
                                        echo "has-error";
                                    } ?>">
                                        <p><b>Status</b></p>
                                        <label class="radio-inline">
                                            <input <?php if (!(strcmp($detail->status, "1"))) {
                                                echo "checked=\"checked\"";
                                            } ?> type="radio" name="status" id="radio"
                                                 value="1" <?php echo set_radio('status', '1'); ?>/>
                                            &nbsp; Aktif
                                        </label>
                                        <label class="radio-inline">
                                            <input <?php if (!(strcmp($detail->status, "0"))) {
                                                echo "checked=\"checked\"";
                                            } ?> type="radio" name="status" id="radio2"
                                                 value="0" <?php echo set_radio('status', '0'); ?>/>
                                            &nbsp; Tidak Aktif
                                        </label>
                                        <?php if (form_error('status')) {
                                            echo '<br><span class="control-label" for="status">' . form_error('status') . '</span>';
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-header">
                        <div class="container-fuild">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 col-sm-12"
                                     style="padding-bottom:30px; text-align:right;">
                                    <input type="submit" name="btn_edit" class="btn btn-success" value="Simpan">
                                    &nbsp;
                                    <button type="button" class="btn btn-default"
                                            onClick="location.href='<?php echo site_url("menu_front_manage"); ?>'"><span
                                            class="fa fa-times"></span> Batal
                                    </button>
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
