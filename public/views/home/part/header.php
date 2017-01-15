<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="<?php if(isset($author)) { echo $author; } ?>">
    <link rel="icon" href="favicon.ico">
    <title><?php if(isset($title)) { echo $title; } ?></title>
    <link href="<?php print base_url() ?>resources/css/custom.css" rel="stylesheet">
    <link href="<?php print base_url() ?>resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php print base_url() ?>resources/css/font-awesome/css/font-awesome.css" rel="stylesheet">
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
            <span class="green-red" style="color: #d52f36;"><strong> BETA </strong></span>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" style="border-color: #ffffff;margin-top: 9px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search" style="margin-top:6px;border-radius: 0px;-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.1);-moz-box-shadow: 0 1px 2px rgba(0,0,0,.1);box-shadow: 0 1px 2px rgba(0,0,0,.1);font-size: 15px;">
                    <span class="input-group-btn">
                <button type="submit" class="btn btn-default" style="margin-top:6px;border-radius: 0px;-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.1);-moz-box-shadow: 0 1px 2px rgba(0,0,0,.1);box-shadow: 0 1px 2px rgba(0,0,0,.1);background: #ddd;"><i class="fa fa-search"></i> Search</button>
              </span>
                </div>
            </form>

        </div>
    </div>
</nav>