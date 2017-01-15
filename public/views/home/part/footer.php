<footer class="footer">
    <div class="container">
        <div class="footer-inner">
            <div class="row">
                <div class="col-md-6">
                    © 2016 <a href="#"></a><?php echo sistem('site_footer');?>, All rights reserved.
                </div>
                <div class="col-md-6">
                    <div class="footer-menu" style="text-align: right;">
                        <div class="menu-footer-menu-container">
                            <ul id="menu-footer-menu" class="menu" style="list-style: none;padding: 0px;margin: 0px;">
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>about/">About</a></li>
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>feedback/">Feedback</a></li>
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>bug/">Report Bug</a></li>
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>terms-condition/">Term & Condition</a></li>
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>contact/">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="<?php print base_url() ?>resources/js/jquery.min.js"></script>
<script src="<?php print base_url() ?>resources/js/bootstrap.min.js"></script>
<script src="<?php print base_url() ?>resources/js/nprogress.js"></script>
<script src="<?php print base_url() ?>resources/js/nyimak.min.js"></script>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>