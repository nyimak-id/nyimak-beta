<div class="jumbotron " style="margin-top: 25px; padding-top: 105px;padding-bottom:55px; background: url(<?php echo base_url(); ?>resources/images/bg-category.png) center center no-repeat #20231E;">
    <div class="container" style="text-align: center; color: white;">
        <h5 style="font-family: Roboto;font-weight: 300;font-size: 20px">KATEGORI</h5>
        <h2 style="font-family: Roboto; font-weight: 300;text-transform: uppercase;font-size: 40px"><?php echo $nama_category ?></h2>
    </div>
</div>
<div class="container" style="margin-top: 20px">
    <div class="row">
        <?php
            if($data_videos != NULL):
            foreach($data_videos->result() as $hasil):

            if(strlen($hasil->judul_video)<60)
            {
                $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.$hasil->judul_video.'</a>';
            }else{
                $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.substr($hasil->judul_video, 0,60).'...</a>';

            }
        ?>
                <div class="col-md-3">
                    <div class="card card-video" style="min-height: 230px">
                        <a href="">
                            <div class="card-image" style="height: 164px;min-height: 164px">
                                <img class="img-responsive" src="<?php echo base_url() ?>resources/images/videos/thumb/<?php echo $hasil->thumbnail ?>" style="width: 100%;height: 100%">
                            </div>
                        </a>
                        <div class="card-content" style="min-height: 60px">
                            <p style="color: #84909f;font-size: 11px;padding-bottom: 5px"><?php echo $this->web->tgl_tunggal($hasil->date_created) ?> <?php echo $this->web->bulan_inggris($hasil->date_created) ?>, <?php echo $this->web->year_tunggal($hasil->date_created) ?> </p>
                            <?php echo $judul ?>
                        </div>
                        <div class="card-autor" style="padding: 1px 18px;background: #ffffff">
                            <a style="font-size: 12px;color: #767676;font-weight: 500;text-decoration: none" href="<?php echo base_url() ?>'user/<?php echo $hasil->username ?>/"><?php echo $hasil->nama_user ?></a>
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
                        <div class="alert alert-danger" style="color: #ffffff;background-color: #940e08;border-color: #940e08;border-radius: 0px;font-family: Roboto;font-size: 18px;font-weight: 300" role="alert">Opsss... pencarian dengan kata kunci <strong>"<?php echo $keyword ?>"</strong> tidak ditemukan.</div>
                    </div>
                </div>

            <?php endif; ?>

    </div>
    <div class="row" style="text-align: center">
        <?php echo $paging ?>
    </div>
</div>
