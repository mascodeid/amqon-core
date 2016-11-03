<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header">
                    <h3 class="box-title">View Data User</h3>
                    <hr style="margin-top:10px;margin-bottom:10px;">
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th width="10px">ID</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Groups</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php $no=0+1; foreach ($users as $user): ?>
                            <tr>
                                <td align="center"><?php echo $no++; ?></td>
                                <td><?php echo $user->first_name; ?> <?php echo $user->last_name; ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td>
                                    <?php foreach ($user->groups as $group): ?>
                                        <a href="auth/edit_group/<?php echo $group->id; ?>" class="btn-sm btn-flat <?php echo $group->bgcolor;?>">
                                            <?php echo $group->name; ?>
                                        </a>
                                    <?php endforeach ?>
                                </td>
                                <td>
                                    <?php if($user->active == 1){
                                        ?>
                                        <label>
                                            <a href="auth/deactivate/<?php echo $user->id; ?>">
                                                Active
                                            </a>
                                        </label>
                                        <?php
                                    }else{
                                        ?>
                                        <label>
                                            <a href="auth/activate/<?php echo $user->id; ?>" class='icheckbox_minimal-blue'>
                                                Deactive
                                            </a>
                                        </label>
                                        <?php
                                    }?>
                                <td><?php echo anchor("auth/edit_user/" . $user->id, 'Edit'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <!-- /.box -->
                </div>
            </div>
        </div>
</section>
