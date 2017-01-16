<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-coffee"></i> Tambah Developers</h4>
                </div>
                <div class="content">
                    <div class="add-developers">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('auth/developers/save?source=header&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Foto Developer</label>
                            <input type="file" class="form-control" name="userfile" style="margin-bottom: 10px">
                            <input type="hidden" name="type" value="<?php echo $type ?>">
                            <span class="label label-danger">
                                   NOTE!
                                </span>
                            <span>
                                    Gambar thumbnail disarankan ukuran 600X300 PX
                                 </span>
                        </div>
                        <div class="form-group">
                            <label>Nama Developer</label>
                            <input type="text" class="form-control" name="nama" placeholder="Nama Developer">
                        </div>
                        <div class="form-group">
                            <label>Jabatan Developer</label>
                            <input type="text" class="form-control" name="jabatan" placeholder="Jabatan Developer">
                        </div>
                        <div class="form-group">
                            <label>Linkedin Developer</label>
                            <input type="text" class="form-control" name="linkedin" placeholder="Linkedin Developer">
                        </div>
                        <div class="submit" style="margin-bottom: 7px">
                            <button type="submit" class="btn btn-danger btn-save" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..."><i class="fa fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-warning btn-reset" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Resetting..."><i class="fa fa-repeat"></i> Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>