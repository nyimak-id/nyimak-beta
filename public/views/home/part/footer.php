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
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>terms-conditions/">Terms & Conditions</a></li>
                                <li><a style="color: #d52f36;" href="<?php echo base_url() ?>contact/">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="<?php print base_url() ?>resources/js/application-d6e4793849780b0b6ce46ed3e6d0753782d68a02e0670b62f700e488b2a9b304.js"></script>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function initMap() {
        var uluru = {lat: -7.529314, lng: 112.239522};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }
    $(document).ready(function(){
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3ZqgqRwszAQmZhalgrq_UVuXQjeePIy0&callback=initMap">
</script>
</body>
</html>