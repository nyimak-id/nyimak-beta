<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-menu"></i> Tambah Playlist</h4>
                </div>
                <div class="content">
                    <div class="add-category">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('auth/playlist/save?source=header&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Thumbnail Playlist</label>
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
                            <label>Nama Playlist</label>
                            <input type="text" class="form-control" name="nama_playlist" placeholder="Nama Playlist">
                        </div>
                        <div class="form-group">
                            <label>Descriptions Playlist</label>
                            <textarea class="ckeditor" rows="6" name="descriptions" placeholder="Descriptions Playlist"></textarea>
                        </div>
                        <div class="submit" style="margin-bottom: 7px">
                            <button type="submit" class="btn btn-danger btn-save btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Saving..."><i class="fa fa-save"></i> Simpan</button>
                            <button type="reset" class="btn btn-warning btn-reset btn-fill" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Resetting..."><i class="fa fa-repeat"></i> Reset</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>