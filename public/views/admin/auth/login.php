<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title><?php print $title ?> </title>
    <link href="<?php print base_url() ?>resources/css/login.css" rel="stylesheet">
    <link href="<?php print base_url() ?>resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php print base_url() ?>resources/css/toastr.css" rel="stylesheet">
    <link href="<?php print base_url() ?>resources/css/font-awesome/css/font-awesome.css" rel="stylesheet">
</head>
<body style="background: #F1F1F1;">
<div class="container" style="margin-top: 80px">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div class="login-logo">
                <a href="<?php echo base_url() ?>"> <img src="<?php echo base_url() ?>resources/images/logo.png" style="margin-bottom:10px;padding:0px 0px;width: 200px;"></a>
            </div>
            <div class="card" style="font-family:'Roboto';margin-top: 0px;height: 300px;">
                <div class="panel-body body-login" style="padding : 40px 40px;">
                    <div class="thumb-login">
                        <canvas id="canvas" class="circle" width="96" height="96"></canvas>
                    </div>
                    <div class="form-login-username" style="margin-bottom: 15px">
                        <?php
                        $attributes = array('id' => 'frm_login');
                        echo form_open('auth/login?source=login&utf8=✓', $attributes)
                        ?>
                        <div class="form-group">
                            <input type="text" name="username" class="input-login"  style="height:36px;border-radius:1px;font-size:16px" value="<?php echo set_value('username') ?>" placeholder="Enter username">
                            <?php echo form_error('username'); ?>
                            <div  style="color: #a20008">
                                <?php if(isset($error)) { echo $error; }; ?>
                            </div>
                        </div>
                        <button type="submit" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Checking..." class="btn-login btn-md">Next</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p class="text-footer">
                    © 2016 <?php echo sistem('admin_footer');?>, <br>All Rights Reserved.
                </p>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>

<script src="<?php print base_url() ?>resources/js/jquery.min.js"></script>
<script src="<?php print base_url() ?>resources/js/bootstrap.min.js"></script>
<script src="<?php print base_url() ?>resources/js/nprogress.js"></script>
<script src="<?php print base_url() ?>resources/js/toastr.min.js"></script>
<script src="<?php print base_url() ?>resources/js/ajax_login.js"></script>
    <script>
        jQuery(document).ready(function() {
            NProgress.start();
            NProgress.done();
        });
        $('.btn-login').on('click', function() {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 1000);
        });
    </script>
</body>
</html>