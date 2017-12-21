<!-- Begin of #main -->
    <div id="main" role="main">
    	
    	<!-- Begin of titlebar/breadcrumbs -->
		<div id="title-bar">
			<ul id="breadcrumbs">
				{breadcrumb}
			</ul>
		</div> <!--! end of #title-bar -->
		
		<div class="shadow-bottom shadow-titlebar"></div>
		
		<!-- Begin of #main-content -->
		<div id="main-content">
			<div class="container_12">
			
			<div class="grid_12">
				<h1>Edit User</h1>
				<p>Here you can Edit the website users.</p>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Edit User</h1><span></span>
					</div>
					<form id="validate-form" class="block-content form" action="<?echo base_url();?>backend/admin/edit_user_done/{id}" method="post">
						<div class="_100">
							<p><label for="textfield">Username</label><input id="username" name="username" class="required" type="text" value="{username}" /></p>
						</div>
						
						<div class="_100">
							<p><label for="textfield">Password</label><input id="password" name="password" class="required" type="password" value="{password}" /></p>
						</div>
						
						<div class="_100">
							<p><label for="textfield">Email</label><input id="email" name="email" class="required" type="text" value="{email}" /></p>
						</div>
						
						<div class="_100">
							<p><label for="textfield">Name</label><input id="name" name="name" class="required" type="text" value="{name}" /></p>
						</div>
						<div class="_50">
							<p>
								<label for="select">City</label>
								<select name="cities_id">
									{cities}
									<option value="{id}">{name}</option>
									{/cities}
								</select>
							</p>
						</div>
						
						<div class="clear"></div>
						<div class="block-actions">
							<ul class="actions-right">
								<li><input type="submit" class="button" value="Save"></li>
							</ul>
						</div>
					</form>
				</div>
			</div>
			
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
</div>