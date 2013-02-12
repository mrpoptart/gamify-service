<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <title><?php echo $title;?></title>
    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="/css/bootstrap.min.css"/>
    <link type="text/css" rel="stylesheet" href="/css/bootstrap-responsive.min.css"/>
    <link type="text/css" rel="stylesheet" href="/css/datepicker.css"/>
    <link type="text/css" rel="stylesheet" href="/css/gamify.css"/>



    <script src="http://code.jquery.com/jquery-latest.js"></script>

    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/datepicker.js"></script>
    <script src="/js/jquery.tablesorter.min.js"></script>
</head>
<body data-role="page">
<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <?php if($this->tank_auth->is_logged_in()):?>
        <ul class="nav">
            <li class="<?php echo $this->uri->segment(1)=="goals"?"active":""; ?>"><a href='/goals'>Goals</a></li>
            <li class="divider-vertical"></li>
            <li class="<?php echo $this->uri->segment(1)=="rewards"?"active":""; ?>"><a href='/rewards'>Rewards</a></li>
        </ul>
        <?php else: ?>
            <ul class="nav">
                <li class="<?php echo $this->uri->segment(2)=="login"?"active":""; ?>"><a href='/auth/login'>Login</a></li>
                <li class="divider-vertical"></li>
                <li class="<?php echo $this->uri->segment(2)=="register"?"active":""; ?>"><a href='/auth/register'>Register</a></li>
            </ul>
        <?php endif;?>
        <ul class="nav pull-right" role="navigation">
            <li class="dropdown">
                <a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Help <b class="caret"></b></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
                    <?php if($this->tank_auth->is_logged_in()):?>
                    <li><a href='/auth/logout'>Log Out</a></li>
                    <li><a href='/subscription'>Subscription Settings</a></li>
                    <?php endif;?>
                    <li><a href='/feedback'>Feedback</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
