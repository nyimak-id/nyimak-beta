<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-film"></i> Tambah Videos</h4>
                </div>
                <div class="content">
                    <div class="add-video">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open_multipart('auth/videos/save?source=header&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <label>Thumbnail Videos</label>
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
                            <label>Judul Videos</label>
                            <input type="text" class="form-control" name="judul_video" placeholder="Judul Video">
                        </div>

                        <div class="form-group">
                            <label>Catgory Video</label>
                                <select class="form-control" name="category_video" id="kategori">
                                    <option value="" selected="selected">- - Pilih Category Video - -</option>
                                    <?php
                                    foreach($cat_videos->result_array() as $row)
                                    {
                                        if($row['id_category']== $category_video)
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
                            <label>Playlist Video</label>
                            <select class="form-control" name="playlist_video" id="kategori">
                                <option value="" selected="selected">- - Pilih Playlist Video - -</option>
                                <?php
                                foreach($get_playlist->result_array() as $row)
                                {
                                    if($row['id_playlist']== $playlist)
                                    {
                                        ?>
                                        <option value="<?php echo $row['id_playlist']; ?>" selected="selected"><?php echo $row['nama_playlist']; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $row['id_playlist']; ?>"><?php echo $row['nama_playlist']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Embed Videos</label>
                            <input type="text" class="form-control" name="embed_video" placeholder="Embed Video">
                        </div>
                        <div class="form-group">
                            <label>Descriptions Video</label>
                            <textarea class="ckeditor" rows="6" name="descriptions" placeholder="Descriptions Video"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Keywords</label>
                            <input type="text" class="form-control" name="meta_keywords" placeholder="Meta Keywords">
                        </div>
                        <div class="form-group">
                            <label>Descriptions Video</label>
                            <textarea class="form-control" rows="6" name="meta_descriptions" placeholder="Meta Descriptions"></textarea>
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