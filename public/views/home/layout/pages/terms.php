<?php foreach ($data_pages->result() as $hasil) { ?>
    <div class="container" style="margin-top: 80px">
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
    </div>
<?php } ?>