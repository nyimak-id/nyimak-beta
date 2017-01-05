<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-film"></i> Edit Videos</h4>
                </div>
                <div class="content">
                    <div class="edit-video">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('auth/videos/save?source=header&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Thumbnail Videos</label>
                            <input type="file" class="form-control" name="userfile" style="margin-bottom: 10px">
                            <input type="hidden" name="type" value="<?php echo $type ?>">
                            <input type="hidden" name="id_video" value="<?php echo $this->encryption->encode($data_videos['id_video']) ?>">
                            <span class="label label-danger">
                                   NOTE!
                                </span>
                            <span>
                                    Gambar thumbnail disarankan ukuran 600X300 PX
                                 </span>
                        </div>
                        <div class="form-group">
                            <label>Judul Videos</label>
                            <input type="text" class="form-control" value="<?php echo $data_videos['judul_video'] ?>" name="judul_video" placeholder="Judul Video">
                        </div>

                        <div class="form-group">
                            <label>Catgory Video</label>
                            <select class="form-control" name="category_video" id="kategori">
                                <option value="" selected="selected">- - Pilih Category Video - -</option>
                                <?php
                                foreach($cat_videos->result_array() as $row)
                                {
                                    if($row['id_category']== $data_videos['category_id'])
                                    {
                                        ?>
                                        <option value="<?php echo $row['id_category']; ?>" selected="selected"><?php echo $row['nama_category']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $row['id_category']; ?>"><?php echo $row['nama_category']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Embed Videos</label>
                            <input type="text" class="form-control" value="<?php echo $data_videos['embed'] ?>" name="embed_video" placeholder="Embed Video">
                        </div>
                        <div class="form-group">
                            <label>Descriptions Video</label>
                            <textarea id="editor" rows="6"  name="descriptions" placeholder="Descriptions Video"><?php echo $data_videos['deskripsi_video'] ?></textarea>
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