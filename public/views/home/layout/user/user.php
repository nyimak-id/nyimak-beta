<div class="nyimak-profile" style="margin-top: 45px">
    <img align="left" class="nyimak-image-lg" src="<?php print base_url('resources/images/bg-user.png') ?>" alt="Profile image example" style="background: #20231E;"/>
    <img align="left" class="nyimak-image-profile thumbnail" src="<?php echo base_url() ?>resources/images/avatar/thumb/<?php echo $data_user['foto_user'] ?>" alt="Profile image example"/>
    <div class="nyimak-profile-text">
        <h2 style="font-family:Roboto;font-weight:300"><?php echo $data_user['nama_user'] ?></h2>
        <div class="user-username" style="font-size:20px;font-weight:300">
            <div class="btn-group">
                <a href="<?php print base_url() ?>user/<?php echo $data_user['username'] ?>/" class="btn btn-danger btn-sm" style="margin-right:0px;color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none;"><i class="fa fa-youtube-play"></i> <?php echo $data_user['username'] ?></a>
                <button class="btn btn-default btn-sm" data-toggle="tooltip" title="videos" data-placement="right" style="color: #333;background-color: #ffffff; border-color:#ccc;border-radius: 1px;margin-top: 0px;text-transform: none"> <?php echo $this->db->where("user_id", $data_user['id_user'])->count_all_results("tbl_videos") ?></button>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="container" style="margin-top: 40px">
    <div class="row">
            <?php
                if($data_videos != NULL):
                foreach($data_videos->result() as $hasil):

                    if(strlen($hasil->judul_video)<57)
                    {
                        $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.$hasil->judul_video.'</a>';
                    }else{
                        $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.substr($hasil->judul_video, 0,57).'...</a>';

                    }
            ?>
                    <div class="col-md-3">
                        <div class="card card-video" style="min-height: 230px">
                            <a href="<?php echo base_url() ?>watch/<?php echo $hasil->slug_video ?>/">
                                <div class="card-image" style="height: 150px;min-height: 150px">
                                    <img class="img-responsive" src="<?php echo base_url() ?>resources/images/videos/thumb/<?php echo $hasil->thumbnail ?>" style="width: 100%;height: 100%">
                                </div>
                            </a>
                            <div class="card-content" style="min-height: 60px">
                                <p style="color: #84909f;font-size: 11px;padding-bottom: 5px"><?php echo $this->web->tgl_tunggal($hasil->date_created) ?> <?php echo $this->web->bulan_inggris($hasil->date_created) ?>, <?php echo $this->web->year_tunggal($hasil->date_created) ?> </p>
                                <?php echo $judul ?>
                            </div>
                            <div class="card-autor" style="padding: 1px 18px;background: #ffffff">
                                <a style="font-size: 12px;color: #767676;font-weight: 500;text-decoration: none" href="<?php echo base_url() ?>user/<?php echo $hasil->username ?>/"><?php echo $hasil->nama_user ?></a>
                                <p style="color: #84909f;font-size: 11px;margin-top: 5px;padding-bottom: 5px"><?php echo $hasil->views ?>x ditonton </p>
                            </div>
                        </div>
                    </div>
            <?php
                endforeach;
            ?>

                <?php else : ?>

                    <div class="card" style="margin-bottom: 0px;">
                        <div class="card-content">
                            <div class="alert alert-danger" style="color: #ffffff;background-color: #940e08;border-color: #940e08;border-radius: 0px;font-family: Roboto;font-size: 18px;font-weight: 300" role="alert">Belum ada video</div>
                        </div>
                    </div>

                <?php endif; ?>
    </div>
    <div class="row" style="text-align: center">
        <?php echo $paging ?>
    </div>
</div>

