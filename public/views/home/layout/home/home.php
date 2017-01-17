<div class="container" style="margin-top: 80px">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-7">
            <?php
                if($video_personal != NULL):
                foreach($video_personal->result() as $hasil):
            ?>
            <div class="card" style="box-shadow: none;margin-bottom: 0px">
                <iframe style="width: 100%;height: 400px" src="<?php echo $hasil->embed ?>?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="card" style="margin-bottom: 0px">
                <div class="card-content" style="font-size: 18px;font-family: Roboto;font-weight: 300">
                    <p style="font-family: Roboto;font-weight: 400;"><?php echo $hasil->judul_video ?></p>
                </div>

                <div class="card-action">
                    <div class="chip">
                        <img src="<?php print base_url() ?>resources/images/9c5e4d65dfd14f5bc5b6948fb433ec66.jpg" alt="Person" width="96" height="96">
                        <?php echo $hasil->nama_user ?>
                        <p>
                        <div class="btn-group">
                            <a href="<?php print base_url() ?>user/<?php echo $hasil->username ?>/" class="btn btn-danger btn-sm" style="margin-right:0px;color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none"><i class="fa fa-youtube-play"></i> <?php echo $hasil->username ?></a>
                            <button class="btn btn-default btn-sm" data-toggle="tooltip" title="videos" data-placement="right" style="color: #333;background-color: #ffffff; border-color:#ccc;border-radius: 1px;margin-top: 0px;text-transform: none"> <?php echo $this->db->where("user_id", $hasil->user_id)->count_all_results("tbl_videos") ?></button>
                        </div>
                        <div class="views" style="float: right;margin-top: -10px;font-size: 15px;">
                            <?php echo $hasil->views ?>x ditonton
                        </div>
                    </div>
                </div>
            </div>
            <?php
                endforeach;
            ?>
            <?php
                endif;
            ?>
        </div>
        <div class="col-md-5">
            <div class="card" style="margin-bottom: 0px">
                <div class="card-content">
                    <?php
                        if($video_popular != NULL) :
                        foreach ($video_popular->result() as $hasil):
                    ?>
                     <?php
                         if(strlen($hasil->judul_video)<60)
                         {
                             $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.$hasil->judul_video.'</a>';
                          }else{
                             $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.substr($hasil->judul_video, 0,60).'...</a>';

                         }
                     ?>
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="<?php echo base_url() ?>resources/images/videos/thumb/<?php echo $hasil->thumbnail ?>" style="width: 168px;height: 94px" alt="<?php echo $hasil->judul_video ?>">
                            </a>
                        </div>
                        <div class="media-body">
                            <a class="link-videos" href="" style="color: #333;text-decoration: none">
                                <h4 style="font-family: Roboto;font-weight: 400;font-size: 14px" class="media-heading"><?php echo $judul ?></h4>
                            </a>
                            <a href="<?php echo base_url() ?>user/<?php echo $hasil->username ?>/" style="text-decoration: none;font-size: 13px;font-family: Roboto;font-weight: 400;color: #84909f;"><?php echo $hasil->nama_user ?> </a>
                            <br>
                            <span style="font-size: 11px;font-family: Roboto;font-weight: 400;color: #84909f;"><?php echo $hasil->views ?>x ditonton</span>
                        </div>
                    </div>
                    <?php
                        endforeach;
                    ?>
                     <?php
                        else:
                      ?>
                      <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"><div class="video-baru" style="margin-top: 15px;margin-bottom: 5px;font-family: Roboto;font-weight: 300;font-size: 20px"><i class="fa fa-youtube-play fa-lg"></i> Video Terbaru</div></div>
        <div id="videos_terbaru">

        </div>
    </div>
    <div class="row">
        <div class="container" style="text-align: center">
            <button class="btn btn-danger" id="load_more" data-val = "0" style="color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none">More videos <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12"><div class="video-popular" style="margin-top: 15px;margin-bottom: 5px;font-family: Roboto;font-weight: 300;font-size: 20px;"><i class="fa fa-youtube-play fa-lg"></i> Video Popular</div></div>
        <div id="videos_popular">

        </div>
    </div>
    <div class="row">
        <div class="container" style="text-align: center">
            <button class="btn btn-danger" id="load_more_popular" data-val = "0" style="color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none">More videos <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
        </div>
    </div>

</div>