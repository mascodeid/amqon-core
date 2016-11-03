<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">View Data User</h3>
                    <hr style="margin-top:10px;margin-bottom:10px;">

                    <button type="button" class="wow bounceIn btn btn-sm btn-default
                    <?php if(auth_akses('buat') != 1) {echo "disabled";} ?>"
                            data-toggle="tooltip" data-placement="top" title="Tambah"
                            data-wow-delay="0.2s"><i class="fa fa-plus"></i> Tambah</button>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="10px">ID</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>BGcolor</th>
                            <th>Action</th>
                        </tr>
                        <?php $no=0+1; foreach ($roles as $role): ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $role->name; ?></td>
                                <td><?php echo $role->description; ?></td>
                                <td>
                                    <div class="btn-sm btn-flat <?php echo $role->bgcolor;?>">
                                        <?php echo $role->bgcolor; ?>
                                    </div>
                                </td>
                                <td align="center">
                                    <button type="button" class="wow bounceIn btn btn-sm btn-default
                                        <?php if(auth_akses('ubah') != 1) {echo "disabled";} ?>"
                                            data-toggle="tooltip" data-placement="top" title="Edit"
                                            data-wow-delay="0.2s"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="wow bounceIn btn btn-sm btn-default
                                        <?php if(auth_akses('hapus') != 1) {echo "disabled";} ?>"
                                            data-toggle="tooltip" data-placement="top" title="Delete"
                                            data-wow-delay="0.2s"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <!-- /.box -->
                </div>
            </div>
        </div>
</section>
