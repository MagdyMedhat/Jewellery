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
				<h1>Users</h1>
				<p>Here you can browse/add/edit/delete website users.</p>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Users <a href="<?echo base_url();?>backend/admin/add_user">[Add]<img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--plus.png"/></a></h1><span></span>
					</div>
					<div class="block-content">
						<table id="table-example" class="table">
							<thead>
								<tr>
									<th>id</th>
									<th>Full Name</th>
									<th>Username</th>
									<th>Email</th>
									<th>Default City</th>
									<th>Edit / Delete</th>
								</tr>
							</thead>
							<tbody>
								{list_users}
								<tr class="gradeX">
									<td>{id}</td>
									<td>{name}</td>
									<td>{username}</td>
									<td>{email}</td>
									<td>{city_name}</td>
									<td>
										<a href="<?echo base_url();?>backend/admin/edit_user/{id}" rel="tooltip-top" original-title="Edit"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--pencil.png"/></a>
										<a href="<?echo base_url();?>backend/admin/delete_user/{id}" rel="tooltip-top" original-title="Delete"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--minus.png"/></a>
									</td>
								</tr>
								{/list_users}
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
  </div> <!--! end of #main -->