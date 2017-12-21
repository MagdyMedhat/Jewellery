<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  
  <!-- DNS prefetch -->
  <link rel=dns-prefetch href="//fonts.googleapis.com">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Backend :: Jewellery Project</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  <!-- CSS: implied media=all -->
  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/style.css"> <!-- Generic style (Boilerplate) -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/960.fluid.css"> <!-- 960.gs Grid System -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/main.css"> <!-- Complete Layout and main styles -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/buttons.css"> <!-- Buttons, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/lists.css"> <!-- Lists, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/icons.css"> <!-- Icons, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/notifications.css"> <!-- Notifications, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/typography.css"> <!-- Typography -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/forms.css"> <!-- Forms, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/tables.css"> <!-- Tables, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/charts.css"> <!-- Charts, optional -->
  <link rel="stylesheet" href="<?echo base_url();?>backend_includes/css/jquery-ui-1.8.15.custom.css"> <!-- jQuery UI, optional -->
  <!-- end CSS-->
  
  <!-- Fonts -->
  <link href="//fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
  <!-- end Fonts-->

  <!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->

  <!-- All JavaScript at the bottom, except for Modernizr / Respond.
       Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
       For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
  <script src="<?echo base_url();?>backend_includes/js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body id="top">

  <!-- Begin of #container -->
  <div id="container">
  	<!-- Begin of #header -->
    <div id="header-surround"><header id="header">
    	
    	<!-- Place your logo here -->
		<img src="<?echo base_url();?>backend_includes/img/logo.png" alt="Grape" class="logo">
		
		<!-- Divider between info-button and the toolbar-icons -->
		<div class="divider-header divider-vertical"></div>
		
		<!-- Info-Button -->
		<a href="javascript:void(0);" onclick="$('#info-dialog').dialog({ modal: true });"><span class="btn-info"></span></a>
		
			<!-- Modal Box Content -->
			<div id="info-dialog" title="About" style="display: none;">
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
				<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			</div> <!--! end of #info-dialog -->
		
		
		<!-- Begin of #user-info -->
		<div id="user-info">
			<p>
				<span class="messages">Hello  <a href="javascript:void(0);"><?echo $this->session->userdata("username");?></a></span>
				<a href="javascript:void(0)" class="toolbox-action button">Profile</a> <a href="<?echo base_url();?>backend/login/logout" class="button red">Logout</a>
			</p>
		</div> <!--! end of #user-info -->
		
    </header></div> <!--! end of #header -->
    <div class="fix-shadow-bottom-height"></div>