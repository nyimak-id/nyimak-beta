<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="<?php if(isset($author)) { echo $author; }else { echo sistem('site_title'); } ?>">
    <link rel="icon" href="favicon.ico">
    <title><?php if(isset($title)) { echo $title; } ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="robots" content="no-cache">
    <meta name="description" content="<?php if(isset($descriptions)) { echo $descriptions; }else { echo sistem('description'); } ?>">
    <meta name="keywords" content="<?php if(isset($keywords)) { echo $keywords; }else { echo sistem('site_title'); } ?>">
    <meta property="og:url" content="<?php print base_url() ?><?php print $this->uri->uri_string() ?>/">
    <meta property="og:site_name" content="<?php if(isset($title)) { echo $title; } ?>">
    <meta property="og:title" content="<?php if(isset($title)) { echo $title; } ?>">
    <meta property="og:description" content="<?php if(isset($descriptions)) { echo $descriptions; }else { echo sistem('description'); } ?>">
    <meta property="og:image" content="">
    <meta property="twitter:site" content="<?php if(isset($title)) { echo $title; } ?>">
    <meta property="twitter:site:id" content="<?php if(isset($title)) { echo $title; } ?>">
    <meta property="twitter:card" content="summary">
    <meta property="twitter:title" content="<?php if(isset($title)) { echo $title; } ?>">
    <meta property="twitter:description" content="<?php if(isset($descriptions)) { echo $descriptions; }else { echo sistem('description'); } ?>">
    <link rel="canonical" href="<?php print base_url() ?><?php print $this->uri->uri_string() ?>/" />
    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php if(isset($title)) { echo $title; } ?>" />
    <meta property="og:description" content="<?php if(isset($descriptions)) { echo $descriptions; }else { echo sistem('description'); } ?>" />
    <meta property="og:url" content="<?php print base_url() ?><?php print $this->uri->uri_string() ?>/" />
    <meta property="og:site_name" content="<?php print base_url() ?>" />
    <meta property="article:publisher" content="https://www.facebook.com/nyimak.id" />
    <meta property="og:image" content="" />
    <meta property="og:image:width" content="700" />
    <meta property="og:image:height" content="350" />
    <meta property="language" content="Indonesia" />
    <meta property="revisit-after" content="7" />
    <meta property="webcrawlers" content="all" />
    <meta property="rating" content="general" />
    <meta property="spiders" content="all" />
    <meta property="robots" content="all" />
    <link href="<?php print base_url() ?>resources/css/application-cd717b2b5b13e210278009fd083914493edd7b190e3fd2a30e8fa0cc40cff459.css" rel="stylesheet">
</head>
<body style="background: #FAFAFA;">

<nav class="navbar-tube navbar-fixed-top navbar-default" style="background-color: #ffffff;border-color: #ffffff;">
    <div class="container">
        <div class="navbar-header" style="margin-right: -15px;margin-left: -15px;">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="background: #d52f36;border-color: #d52f36;margin-top: 15px">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar" style="background-color: #ffffff;"></span>
                <span class="icon-bar" style="background-color: #ffffff;"></span>
                <span class="icon-bar" style="background-color: #ffffff;"></span>
            </button>
            <a class="tube-logo-navbar" href="<?php echo base_url() ?>">
                <img class="tube-logo" src="<?php print base_url() ?>resources/images/logo.png" alt=""/>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php if($this->session->userdata('auth_id')) { ?>
                <div class="search">
                    <form class="navbar-form navbar-left" style="padding-left: 40px;padding-right: 40px;margin-top: 15px" action="<?php echo base_url() ?>search" accept-charset="UTF-8" method="get">
                        <div class="input-group">
                            <input type="text" id="q" class= "typeahead tt-query" name="q" placeholder="Search" style="border-radius: 0px;font-size: 16px;">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" style="border-radius: 0px;background: #f8f8f8;font-weight: 400;font-size:14px;text-transform: uppercase"><i class="fa fa-search" style="margin: 0 15px;"></i></button>
                  </span>
                        </div>
                    </form>
                </div>
            <ul class="nav navbar-nav navbar-right" style="margin-right: 0px">
                <li class="dropdown">
                    <a class="dropdown-toggle" style="padding-top: 11px;line-height: 30px;padding-bottom:9px;background-color: #ddd" data-toggle="dropdown" href="#"><img src="<?php echo base_url('resources/images/avatar/'.$this->session->userdata('auth_foto').'') ?>" width="45" height="45" alt="" style="border-radius:25px" class="avatar alignnone photo avatar-default"> <?php print $this->session->userdata('auth_nama'); ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu" style="min-width:200px;font-family: Roboto;font-weight: 300">
                        <div style="color:#333;margin-left:17px">Signed in as</div>
                        <div style="color:#333;margin-left:17px;font-weight: 500;"><?php print $this->session->userdata('auth_username'); ?></div>
                        <li class="divider"></li>
                        <li><a style="font-family: Roboto;font-weight: 300" href="<?php print base_url() ?>auth/dashboard/"><i class="fa fa-home"></i> Dashboard</a></li>
                        <li><a style="font-family: Roboto;font-weight: 300" href="<?php print base_url() ?>auth/videos/"><i class="fa fa-youtube-play"></i> My Videos</a></li>
                        <li class="divider"></li>
                        <li><a style="font-family: Roboto;font-weight: 300" href="<?php print base_url() ?>auth/sistem/"><i class="fa fa-cogs"></i> Setting</a></li>
                        <li><a style="font-family: Roboto;font-weight: 300" href="<?php print base_url() ?>auth/dashboard/logout/"><i class="fa fa-sign-out"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <?php }else{ ?>
            <div class="search">
                <form class="navbar-form navbar-left" style="padding-left: 40px;padding-right: 40px;margin-top: 15px" action="<?php echo base_url() ?>search" accept-charset="UTF-8" method="get">
                    <div class="input-group">
                        <input type="text" id="q" class= "typeahead tt-query" name="q" placeholder="Search" style="border-radius: 0px;font-size: 16px;">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" style="border-radius: 0px;background: #f8f8f8;font-weight: 400;font-size:14px;text-transform: uppercase"><i class="fa fa-search" style="margin: 0 15px;"></i></button>
                  </span>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</nav>