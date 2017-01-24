<div class="container" style="margin-top: 80px">
    <div class="row">
        <?php
            if($detail_video != NULL) :
        ?>
        <div class="col-md-7">
            <div class="card" style="box-shadow: none;margin-bottom: 0px">
                <iframe style="width: 100%;height: 400px" src="<?php echo $detail_video->embed ?>?rel=0&modestbranding=1&autohide=1&showinfo=0&controls=1&autoplay=1" frameborder="0" allowfullscreen></iframe>
            </div>
            <div class="card" style="margin-bottom: 0px">
                <div class="card-content" style="font-size: 18px;font-family: Roboto;font-weight: 300">
                    <p style="font-family: Roboto;font-weight: 400;"><?php echo $detail_video->judul_video ?></p>
                </div>

                <div class="card-action">
                    <div class="chip">
                        <img src="<?php print base_url() ?>resources/images/avatar/thumb/<?php echo $detail_video->foto_user ?>" alt="Person" width="96" height="96">
                        <?php echo $detail_video->nama_user ?>
                        <p>
                        <div class="btn-group">
                            <a a href="<?php print base_url() ?>user/<?php echo $detail_video->username ?>/" class="btn btn-danger btn-sm" style="margin-right: 0px;color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none"><i class="fa fa-youtube-play"></i> <?php echo $detail_video->username ?></a>
                            <button class="btn btn-default btn-sm" data-toggle="tooltip" title="videos" data-placement="right" style="color: #333;background-color: #ffffff; border-color:#ccc;border-radius: 1px;margin-top: 0px;text-transform: none"> <?php echo $this->db->where("user_id", $detail_video->user_id)->count_all_results("tbl_videos") ?></button>
                        </div>
                        <div class="views" style="float: right;margin-top: -10px;font-size: 15px;">
                            <?php echo $detail_video->views ?>x ditonton
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-content">
                        <div class="tabbable-line">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#share" data-toggle="tab" style="font-family: Roboto;font-weight: 300"><i class="fa fa-share"></i> Share </a>
                                </li>
                                <li>
                                    <a href="#descriptions" data-toggle="tab" style="font-family: Roboto;font-weight: 300"><i class="fa fa-info-circle"></i> Descriptions </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="share">
                                    <label style="font-family: Roboto;font-weight: 400"><i class="fa fa-share-alt"></i> Social Media</label>
                                    <p>
                                        <a data-original-title="Facebook" rel="tooltip" data-toggle="tooltip" title="Facebook" data-placement="top" href="http://www.facebook.com/share.php?u=<?php echo base_url()?>watch/<?php echo $detail_video->slug_video ?>/" target="_blank" class="btn btn-facebook" data-placement="left">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a data-original-title="Twitter" rel="tooltip" data-toggle="tooltip" title="Twitter" data-placement="top"  href="http://www.twitter.com/home/?status=<?php echo base_url()?>watch/<?php echo $detail_video->slug_video ?>/" target="_blank" class="btn btn-twitter" data-placement="left">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a data-original-title="Google+" rel="tooltip" data-toggle="tooltip" title="Google +" data-placement="top"  href="https://plus.google.com/share?url=<?php echo base_url()?>watch/<?php echo $detail_video->slug_video ?>/" target="_blank" class="btn btn-google" data-placement="left">
                                            <i class="fa fa-google-plus"></i>
                                        </a>
                                        <a data-original-title="LinkedIn" rel="tooltip" data-toggle="tooltip" title="Linkedin" data-placement="top"  href="#!" class="btn btn-linkedin" data-placement="left">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                        <a data-original-title="Pinterest" rel="tooltip" data-toggle="tooltip" title="Pinterest" data-placement="top" href="#!"  class="btn btn-pinterest" data-placement="left">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                    </p>
                                    <label style="margin-top: 15px;font-family: Roboto;font-weight: 400"><i class="fa fa-external-link"></i> Embed Youtube</label>
                                    <p>
                                        <input type="text" class="form-control" value="<?php echo $detail_video->embed ?>" style="border-radius: 0px;-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.1);-moz-box-shadow: 0 1px 2px rgba(0,0,0,.1);box-shadow: 0 1px 2px rgba(0,0,0,.1);">
                                    </p>
                                </div>
                                <div class="tab-pane" id="descriptions" style="font-family: Roboto;font-weight: 400">
                                    <p>
                                        <?php echo $detail_video->deskripsi_video ?>
                                    </p>
                                    <hr>
                                    <p><strong>Category </strong>  <a href="<?php echo base_url() ?>category/<?php echo $detail_video->slug_category ?>/" style="margin-left: 20px"> <?php echo $detail_video->nama_category ?></a></p>
                                    <p><strong>Publish</strong>   <span style="margin-left: 30px"><?php echo $this->web->tgl_tunggal($detail_video->date_created) ?> <?php echo $this->web->bulan_inggris($detail_video->date_created) ?>, <?php echo $this->web->year_tunggal($detail_video->date_created) ?></span></p>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-content">
                    <?php echo $disqus ?>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card" style="margin-bottom: 0px">
                <div class="card-content">
                    <?php
                        foreach($related_video->result() as $hasil) {
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
                    <?php } ?>
                </div>
            </div>
            <div class="card" style="margin-bottom: 0px">
                <div class="card-content">
                    <p style="font-family: Roboto;font-size: 25px;font-weight: 300;margin-bottom: 15px">Follow Us!</p>
                    <div class="fb-page" data-href="https://www.facebook.com/nyimak.id" data-width="427" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/nyimak.id" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/nyimak.id">Nyimak.ID</a></blockquote></div>
                </div>
            </div>
        </div>
        <?php
            else:
        ?>

        <?php endif; ?>
    </div>
</div>