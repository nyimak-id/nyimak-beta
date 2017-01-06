<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-exapnd2"></i> Edit Pages</h4>
                </div>
                <div class="content">
                    <div class="edit-category">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('auth/pages/save?source=header&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Judul Pages</label>
                            <input type="text" class="form-control" value="<?php echo $data_pages['judul_page'] ?>" name="judul_page" placeholder="Judul Page">
                            <input type="hidden" name="id_page" value="<?php echo $this->encryption->encode($data_pages['id_page']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Isi Pages</label>
                            <textarea class="ckeditor" rows="6" name="descriptions" placeholder="isi Page"><?php echo $data_pages['isi_page'] ?></textarea>
                        </div>
                        <div class="submit" style="margin-bottom: 7px">
                            <button type="submit" class="btn btn-danger btn-update" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating..."><i class="fa fa-save"></i> Update</button>
                            <button type="reset" class="btn btn-warning btn-reset" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Resetting..."><i class="fa fa-repeat"></i> Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>