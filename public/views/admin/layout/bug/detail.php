<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php echo $this->session->flashdata('notif'); ?>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-shield"></i> Detail Bug</h4>
                </div>
                <div class="content">
                    <div style="border-left: 3px solid #aa1c1e;    padding: 10px 20px;margin: 0 0 20px;font-size: 17.5px;">
                        <i class="fa fa-user-circle"></i> <?php echo $data_bug['nama_bug'] ?>
                        <footer style="display: block;font-size: 80%;line-height: 1.42857143;color: #777;"><i class="fa fa-envelope"></i> <?php echo $data_bug['email_bug'] ?></footer>
                    </div>
                    <hr>
                    <blockquote style="border-left: 3px solid #aa1c1e;font-size: 15px;font-family: Roboto;font-weight: 400">
                        <?php echo $data_bug['isi_bug'] ?>
                        <footer><?php echo $data_bug['date_created'] ?></footer>
                    </blockquote>
                    <hr>
                    <a href="<?php echo base_url('auth/bug?source=reload&utf8=✓') ?>" class="btn btn-danger btn-reset" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> reloading...."><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>