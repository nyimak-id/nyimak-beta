<div class="jumbotron " style="margin-top: 25px; padding-top: 105px;padding-bottom:90px; background: url(<?php echo base_url(); ?>resources/images/bg.png) center center no-repeat #20231E;">
    <div class="container" style="text-align: center; color: white;">
        <h1 style="font-family: Comforta; font-weight: 300;">About Us</h1>
        <p style="font-family: Roboto; font-weight: 200;">This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
        <p><a class="btn btn-danger btn-lg " href="#developers" role="button" style="border-radius: 0px;font-family: Roboto;font-weight: 300;color: #fefefe;background-color: #e62117;border-color: #e62117;">Core Developer</a></p>
    </div>
</div>
<?php foreach ($data_pages->result() as $hasil) { ?>
<div class="container" style="margin-top: 20px">
    <div class="row">
        <div class="col-md-7">
            <div class="card" style="font-family: Roboto;font-weight: 300;margin-bottom: 0px;">
                <div class="card-content">
                    <p style="font-size: 25px;"><?php echo $hasil->judul_page ?></p>
                    <hr>
                        <div style="font-family: Roboto;font-weight: 300;font-size: 18px;margin-bottom: 5px">
                            <?php echo $hasil->isi_page ?>
                        </div>
                    <span style="font-size: 13px;color: #9d9d9d;">Last Update : <?php echo $this->web->tgl_tunggal($hasil->date_modified) ?> <?php echo $this->web->bulan_inggris($hasil->date_modified) ?>,  <?php echo $this->web->year_tunggal($hasil->date_modified) ?></span>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card" style="margin-bottom: 0px;">
                <div class="card-content">
                    <p style="font-family: Roboto;font-size: 25px;font-weight: 300;margin-bottom: 15px">Follow Us</p>
                    <div class="fb-page" data-href="https://www.facebook.com/nyimak.id" data-width="427" data-small-header="false" data-adapt-container-width="false" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/nyimak.id" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/nyimak.id">Nyimak.ID</a></blockquote></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="margin-top: 30px" id="developers">
        <div clas="developer" style="text-align: center;font-family: Roboto;font-size: 40px;font-weight: 300">
            Core Developer
            <p style="font-size: 20px">Nyimak.ID - Make Me Happy adalah situs dari kumpulan-kumpulan video lucu yang ada didunia ini yang bersumber dari youtube.</p>
            <hr>
        </div>
        <div id="developers"></div>
    </div>
    <div class="row">
        <div class="container" style="text-align: center">
            <button class="btn btn-danger" id="load_more_developers" data-val = "0" style="color: #fefefe;background-color: #e62117; border-color:#e62117;border-radius: 1px;margin-top: 0px;text-transform: none">More developers <img style="display: none" id="loader" src="<?php echo base_url('resources/images/loader.svg') ?>" style="width: 5px;height: 5px"></button>
        </div>
    </div>
</div>
<?php } ?>