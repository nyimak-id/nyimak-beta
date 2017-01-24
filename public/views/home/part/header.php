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
    <link href="<?php print base_url() ?>resources/css/toastr.css" rel="stylesheet">
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
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="search">
                <form class="navbar-form navbar-left" style="padding-left: 40px;padding-right: 40px;margin-top: 15px" action="/pencarian" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="&#x2713;" />
                    <div class="input-group">
                        <input type="text" id="q" class= "typeahead tt-query" name="q" placeholder="Search" style="border-radius: 0px;font-size: 16px;">
                        <span class="input-group-btn">
                    <button type="submit" class="btn btn-default" style="border-radius: 0px;background: #f8f8f8;font-weight: 400;font-size:14px;text-transform: uppercase"><i class="fa fa-search" style="margin: 0 15px;"></i></button>
                  </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</nav>