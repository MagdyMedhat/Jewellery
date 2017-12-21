<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Jewellery</title>
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "includes/"; ?>styles/jquery.hoverscroll.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "includes/"; ?>styles/jquery.countdown.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "includes/"; ?>styles/ui-lightness/jquery-ui-1.8.16.custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo site_url() . "includes/"; ?>styles/style.css">
<script src="<?php echo site_url() . "includes/"; ?>scripts/jquery-1.6.4.min.js"></script>
<script src="<?php echo site_url() . "includes/"; ?>scripts/superfish.js"></script>
<script src="<?php echo site_url() . "includes/"; ?>scripts/jquery.countdown.min.js"></script>
<script src="<?php echo site_url() . "includes/"; ?>scripts/jquery-ui-1.8.16.custom.min.js"></script>
<script src="<?php echo site_url() . "includes/"; ?>scripts/jquery.hoverscroll.js"></script>
<script src="<?php echo site_url() . "includes/"; ?>scripts/script-home.js"></script>
<!--[if lt IE 9]><script src="scripts/html5.js"></script><![endif]-->
<!--[if IE 8 ]> <body class="ie8"><![endif]-->
<!--[if IE 7 ]><body class="ie7"><![endif]-->
<!--[if IE 6 ]><body class="ie6"><![endif]-->
</head>
<body>
<header id="header">
  <nav class="container_16">
      <div id="logo" class="grid_4"><a href="<?php echo site_url(); ?>"><img src="<?php echo site_url() . "includes/"; ?>images/Logo.png" width="190" height="65" alt="Site Logo"></a></div>
    <div class="grid_12">
      <ul id="menu-main-menu">
        <li class="cities"><a class="link" href="#">City</a>
          <ul class="sub-menu">
            <li><a href="#">Airdrie</a></li>
            <li><a href="#">Brooks</a></li>
            <li><a href="#">Calgary</a></li>
            <li><a href="#">Camrose</a></li>
            <li><a href="#">Cold Lake</a></li>
            <li><a href="#">Edmonton</a></li>
            <li><a href="#">Wetaskiwin</a></li>
            <li><a href="#">Grande Prairie</a></li>
            <li><a href="#">Lacombe</a></li>
            <li><a href="#">Leduc</a></li>
          </ul>
        </li>
        <li><a href="<?php echo site_url(); ?>">Deals</a></li>
        
        <?php if($logged): ?>
            <li><a href="<?php echo site_url('web/logout'); ?>">Logout</a></li>
            <li><a href="<?php echo site_url('web/transactions'); ?>"> transactions </a></li>
        <?php else: ?>
            <li><a href="<?php echo site_url('web/login'); ?>">Login</a></li>
        <?php endif; ?>
        <li><a href="<?php echo site_url('web/about'); ?>">About</a> 
          <!--<ul class="sub-menu"><li><a href="#">Full Width Simple Gallery</a></li></ul>--> 
        </li>
      </ul>
    </div>
  </nav>
</header>
