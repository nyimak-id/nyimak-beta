<div class="container" style="margin-top: 80px">
    <di class="row">
        <?php
        if(isset($keyword)) {
            echo '<p style="text-align: center;font-family: Roboto;font-weight: 300;font-size: 20px">Menampilakn Hasil Pencarian Dengan kata Kunci <strong>"'.$keyword.'"</strong></p>';
        }
        ?>
        <hr>
    </di>
    <div class="row">
        <div class="col-md-8">
            <?php
            if($data_video != NULL):
            foreach($data_video->result() as $hasil):

                if(strlen($hasil->judul_video)<200)
                {
                    $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.$hasil->judul_video.'</a>';
                }else{
                    $judul = '<a href="'.base_url('watch').'/'.$hasil->slug_video.'/" style="font-size: 14px;font-family: Roboto;font-weight: 400;text-decoration: none" title="'.$hasil->judul_video.'">'.substr($hasil->judul_video, 0,200).'...</a>';

                }
                ?>
                <div class="card" style="margin-bottom: 0px;">
                    <div class="card-content">
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

            <div class="row" style="text-align: center">
                <?php echo $paging ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-content">
                    <div id="category-sidebar"></div>
                    <button class="btn btn-danger" id="load_more_sidebar" data-val = "0" style="color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none;margin-top: 10px;width: 100%">More Category <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
                </div>
            </div>
        </div>
    </div>
</div>

