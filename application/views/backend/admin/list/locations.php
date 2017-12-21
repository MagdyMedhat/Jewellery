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
				<h1>Locations</h1>
				<p>Here you can browse/add/edit/delete website locations.</p>
				<div class="alert warning no-margin"><span class="hide">x</span><strong>Warning:</strong> If you deleted a location which has deals that will delete its deals also.</div>
				<div class="alert warning no-margin"><span class="hide">x</span><strong>Warning:</strong> You can't delete a location with purchased coupons.</div>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Website Locations <a href="<?echo base_url();?>backend/admin/add_location">[Add]<img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--plus.png"/></a></h1><span></span>
					</div>
					<div class="block-content">
						<table id="table-example" class="table">
							<thead>
								<tr>
									<th>id</th>
									<th>Title</th>
									<th>City</th>
									<th>Vendor</th>
									<th>Edit / Delete</th>
								</tr>
							</thead>
							<tbody>
								{list_locations}
								<tr class="gradeX">
									<td>{id}</td>
									<td>{title}</td>
									<td>{city_name}</td>
									<td>{vendor_name}</td>
									<td>
										<a href="<?echo base_url();?>backend/admin/edit_location/{id}" rel="tooltip-top" original-title="Edit"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--pencil.png"/></a>
										<a href="<?echo base_url();?>backend/admin/delete_location/{id}" rel="tooltip-top" original-title="Delete"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--minus.png"/></a>
									</td>
								</tr>
								{/list_locations}
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
  </div> <!--! end of #main -->