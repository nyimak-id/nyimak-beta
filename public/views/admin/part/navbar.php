<div class="main-panel">
    <nav class="navbar navbar-default navbar-fixed">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="<?php echo base_url() ?>" target="_blank" class="btn btn-danger btn-sm" style="color: #FF4A55;"> Visit Site <i class="fa fa-external-link"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle btn btn-danger btn-sm" data-toggle="dropdown" style="color: #FF4A55;">
                            <i class="fa fa-user-circle"></i> <?php echo $this->session->userdata("auth_nama") ?>
                            <b class="caret" style="margin-left: 10px"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url() ?>auth/users/edit/<?php echo $this->encryption->encode($this->session->userdata("auth_id")) ?>/"><i class="fa fa-user-circle"></i> My Profile</a></li>
                                <div style="text-align: center;font-size: 12px;font-weight: 500">@<?php echo $this->session->userdata("auth_username") ?></div>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url() ?>auth/feedback/"><i class="fa fa-bell"></i> Feedback</a></li>
                            <li><a href="<?php echo base_url() ?>auth/bug/"><i class="fa fa-bug"></i> Report Bug</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url() ?>auth/sistem/"><i class="fa fa-cogs"></i> Setting Sistem</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo base_url() ?>auth/dashboard/logout/">Logout <i class="fa fa-sign-out"></i></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>