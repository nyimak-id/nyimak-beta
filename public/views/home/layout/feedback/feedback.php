
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-7">
            <?php echo $this->session->flashdata('notif') ?>
            <div class="card" style="font-family: Roboto;font-weight: 300;margin-bottom: 0px;">
                <div class="card-content">
                    <?php
                    $attributes = array('id' => 'frm_login');
                    echo form_open_multipart('feedback?source=send&feedback&utf8=✓', $attributes)
                    ?>
                    <div class="form-group">
                        <label style="font-family: Roboto;font-weight: 400;">Nama Lengkap</label>
                        <input type="text" class="form-control" value="<?php echo set_value('nama') ?>" name="nama" placeholder="Nama Lengkap" style="border-radius: 0px;">
                        <?php echo form_error('nama'); ?>
                    </div>
                    <div class="form-group">
                        <label style="font-family: Roboto;font-weight: 400;">Alamat Email</label>
                        <input type="email" class="form-control" value="<?php echo set_value('email') ?>" name="email" placeholder="Alamat Email" style="border-radius: 0px;">
                        <?php echo form_error('email'); ?>
                    </div>
                    <div class="form-group">
                        <label style="font-family: Roboto;font-weight: 400;">Isi Feedback</label>
                        <textarea class="form-control" rows="6" name="isi" style="border-radius: 0px" placeholder="Masukkan Feedback Anda"><?php echo set_value('isi') ?></textarea>
                        <?php echo form_error('isi'); ?>
                    </div>
                    <div class="form-group">
                        <?php echo $recaptcha_html;?>
                        <?php echo form_error('g-recaptcha-response'); ?>
                    </div>
                    <button type="submit" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Sending..." class="btn btn-sending btn-success btn-md" style="border-radius: 0px;-webkit-box-shadow: 0 2px 2px rgba(0,0,0,0.2);-moz-box-shadow: 0 2px 2px rgba(0,0,0,0.2);box-shadow: 0 2px 2px rgba(0,0,0,0.2);transition-duration: .2s;transition-timing-function: cubic-bezier(.4,0,.2,1);transition-property: max-height,box-shadow;">Kirim Feedback <i class="fa fa-send"></i> </button>
                    <button type="reset" class="btn btn-warning btn-md" style="border-radius: 0px;-webkit-box-shadow: 0 2px 2px rgba(0,0,0,0.2);-moz-box-shadow: 0 2px 2px rgba(0,0,0,0.2);box-shadow: 0 2px 2px rgba(0,0,0,0.2);transition-duration: .2s;transition-timing-function: cubic-bezier(.4,0,.2,1);transition-property: max-height,box-shadow;">Reset <i class="fa fa-repeat"></i></button>
                    <?php echo form_close(); ?>
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