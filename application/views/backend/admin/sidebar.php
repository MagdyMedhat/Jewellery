
	
	<!-- Begin of Sidebar -->
    <aside id="sidebar">
    	
    	<!-- Search -->
    	<!--
    	<div id="search-bar">
			<form id="search-form" name="search-form" action="search.php" method="post">
				<input type="text" id="query" name="query" value="" autocomplete="off" placeholder="Search">
			</form>
		</div> <!--! end of #search-bar -->
		
		<!-- Begin of #login-details -->
		<section id="login-details">
    		<img class="img-left framed" src="<?echo base_url();?>backend_includes/img/misc/avatar_small.png" alt="Hello Admin">
    		<h3>Logged in as</h3>
    		<h2><a class="user-button" href="javascript:void(0);"><?echo $this->session->userdata("username");?>&nbsp;<span class="arrow-link-down"></span></a></h2>
    		<ul class="dropdown-username-menu">
    			<li><a href="#">Profile</a></li>
    			<li><a href="#">Logout</a></li>
    		</ul>
    		
    		<div class="clearfix"></div>
  		</section> <!--! end of #login-details -->
    	
    	<!-- Begin of Navigation -->
    	<nav id="nav">
	    	<ul class="menu collapsible shadow-bottom">
	    		<li><a href="<?echo base_url();?>backend/admin/" {dashboard}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/application-home.png">Dashboard</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_admins" {admins}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/xfn.png">Admins</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_vendors" {vendors}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/xfn-sweetheart.png">Vendors</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_users" {users}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/xfn-colleague.png">Users</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_categories" {categories}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/ui-menu.png">Categories</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_cities" {cities}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/globe-green.png">Cities</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_locations" {locations}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/map-pin.png">Locations</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_deals" {deals}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/currency.png">Deals</a></li>
	    		<li><a href="<?echo base_url();?>backend/admin/list_copouns" {copouns}><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/moneys.png">Coupons [Orders]</a></li>
	    		
	    		
	    		
	    	</ul>
    	</nav> <!--! end of #nav -->
    	
    </aside> <!--! end of #sidebar -->