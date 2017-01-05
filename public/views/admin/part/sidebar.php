<div class="wrapper">
    <div class="sidebar" data-color="red" data-image="<?php echo base_url('resources/admin/img/sidebar-5.jpg') ?>">

        <!--

            Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
            Tip 2: you can also add an image using data-image tag

        -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?php echo base_url('auth/dashboard/') ?>" class="simple-text">
                    <img src="<?php echo base_url('resources/images/logo-dashboard.png') ?>" style="width: 160px">
                </a>
            </div>
            <ul class="nav">
                <li <?php if(isset($dashboard)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/dashboard/') ?>">
                        <i class="pe-7s-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li <?php if(isset($category)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/category/') ?>">
                        <i class="pe-7s-photo-gallery"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li <?php if(isset($videos)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/videos/') ?>">
                        <i class="pe-7s-film"></i>
                        <p>Data Videos</p>
                    </a>
                </li>
                <li <?php if(isset($pages)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/pages/') ?>">
                        <i class="pe-7s-exapnd2"></i>
                        <p>Pages </p>
                    </a>
                </li>
                <li <?php if(isset($feedback)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/feedback/') ?>">
                        <i class="pe-7s-bell"></i>
                        <p>Feedback </p>
                    </a>
                </li>
                <li <?php if(isset($feedback)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/bug/') ?>">
                        <i class="pe-7s-shield"></i>
                        <p>Report Bug </p>
                    </a>
                </li>
                <li <?php if(isset($user)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/user/') ?>">
                        <i class="pe-7s-user"></i>
                        <p>User Management</p>
                    </a>
                </li>
                <li <?php if(isset($setting)) { echo 'class="active"'; } ?>>
                    <a href="<?php echo base_url('auth/sistem/') ?>">
                        <i class="pe-7s-config"></i>
                        <p>Setting Sistem</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="<?php echo base_url('auth/dashboard/logout/') ?>">
                        <p>Logout Sistem <i class="pe-7s-power"></i></p>

                    </a>
                </li>
            </ul>
        </div>
    </div>