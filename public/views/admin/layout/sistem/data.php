<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php echo $this->session->flashdata('notif'); ?>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-config"></i> Sistem Configuration</h4>
                </div>
                <div class="content">
                        <div class="edit-sistem">
                            <?php
                            $attributes = array('id' => 'frm_login');
                            echo form_open_multipart('auth/sistem/save?source=header&utf8=✓', $attributes)
                            ?>
                            <div class="form-group">
                                <label>Admin Title</label>
                                <input type="text" class="form-control" value="<?php echo sistem('admin_title') ?>" name="admin_title" placeholder="Title Administrator">
                                <input type="hidden" name="id_sistem" value="<?php echo $this->encryption->encode(sistem('id_sistem')) ?>">
                            </div>
                            <div class="form-group">
                                <label>Admin Footer</label>
                                <input type="text" class="form-control" value="<?php echo sistem('admin_footer') ?>" name="admin_footer" placeholder="Footer Administrator">
                            </div>
                            <div class="form-group">
                                <label>Site Title</label>
                                <input type="text" class="form-control" value="<?php echo sistem('site_title') ?>" name="site_title" placeholder="Title Site">
                            </div>
                            <div class="form-group">
                                <label>Site Footer</label>
                                <input type="text" class="form-control" value="<?php echo sistem('site_footer') ?>" name="site_footer" placeholder="Footer Site">
                            </div>
                            <div class="form-group">
                                <label>Keywords SEO</label>
                                <input type="text" class="form-control" value="<?php echo sistem('keywords') ?>" name="keywords" placeholder="Keywords">
                            </div>
                            <div class="form-group">
                                <label>Descriptions SEO</label>
                                <textarea class="form-control" rows="4" name="descriptions" placeholder="Descriptions"><?php echo sistem('descriptions') ?></textarea>
                            </div>
                            <div class="submit" style="margin-bottom: 7px">
                                <button type="submit" class="btn btn-danger btn-update btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating..."><i class="fa fa-save"></i> Update</button>
                                <button type="reset" class="btn btn-warning btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Resetting..."><i class="fa fa-repeat"></i> Reset</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
            </div>

            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-config"></i> Session Information</h4>
                </div>
                <div class="content">
                    <table class="table table-bordered table-striped" style="font-family: Roboto;font-weight: 300;">
                        <tbody>
                        <thead>
                        <tr>
                            <th class="text-center" style="color: #000;"><i class="fa fa-file-text-o"></i> DATA</th>
                            <th class="text-center" style="color: #000;"><i class="fa fa-map-marker"></i> IP ADDRESS</th>
                        </tr>
                        </thead>
                        <?php
                        if($data_session != NULL):
                        foreach($data_session->result() as $hasil):
                            ?>
                            <tr>
                                <td><?php echo $hasil->data ?></td>
                                <td><?php echo $hasil->ip_address ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                        </tbody>
                    </table>
                    <?php else : ?>
                        </tbody>
                        </table>
                        <div class="alert alert-danger">
                            <span><b> Warning! </b> Data tidak ada didatabase </span>
                        </div>
                        <div class="reload" style="text-align: center;margin-bottom: 7px">
                            <a  href="<?php echo base_url('auth/sistem?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Reloading..."><i class="fa fa-repeat"></i> Reload Page</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>