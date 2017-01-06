<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul>
                <li>
                    <a href="<?php echo base_url('about/') ?>">
                        About
                    </a>
                </li>
                <li>
                    <a href="<?php echo 'http://developer.nyimak.id' ?>">
                        Developer
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('bug/') ?>">
                        Report Bug
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url('feedback/') ?>">
                        Feedback
                    </a>
                </li>
            </ul>
        </nav>
        <p class="copyright pull-right">
            &copy; 2016 Nyimak.ID - Kumpulan Video Lucu Indonesia, All Rights Reserved.
        </p>
    </div>
</footer>

</div>
</div>


</body>
<script src="<?php echo base_url('resources/admin/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('resources/admin/js/bootstrap-checkbox-radio-switch.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/bootstrap-notify.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/light-bootstrap-dashboard.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/moment.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/moment-with-locales.js') ?>"></script>
<script src="<?php echo base_url('resources/js/nprogress.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/demo.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/typeahead.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/highcharts/highcharts.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/highcharts/exporting.js') ?>"></script>
<script src="<?php echo base_url('resources/js/toastr.min.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/ckeditor/ckeditor.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/ajax_validation.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/visitor.js') ?>"></script>
<script src="<?php echo base_url('resources/admin/js/ajax_search.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        NProgress.start();
        $('.btn-save').on('click', function() {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 1000);
        });
        $('.btn-update').on('click', function() {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 1000);
        });
        $('.btn-reset').on('click', function() {
            var $this = $(this);
            $this.button('loading');
            setTimeout(function() {
                $this.button('reset');
            }, 800);
        });
        $('[data-toggle="tooltip"]').tooltip();
        NProgress.done();
        window.base_url = <?php echo json_encode(base_url()); ?>;
        <?php if(isset($js_ready)) { echo $js_ready; } ?>
    });
</script>
</html>