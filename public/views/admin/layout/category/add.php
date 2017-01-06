<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-ribbon"></i> Tambah Category</h4>
                </div>
                <div class="content">
                    <div class="add-category">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('auth/category/save?source=header&utf8=✓', $attributes)
                        ?>
                            <div class="form-group">
                                <label>Thumbnail Category</label>
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
                                <label>Nama Category</label>
                                <input type="text" class="form-control" name="nama_category" placeholder="Nama Category">
                            </div>
                            <div class="form-group">
                                <label>Descriptions Category</label>
                                <textarea class="ckeditor" rows="6" name="descriptions" placeholder="Descriptions Category"></textarea>
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