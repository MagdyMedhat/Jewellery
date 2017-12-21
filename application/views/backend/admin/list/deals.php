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
				<h1>Deals</h1>
				<p>Here you can browse/add/edit/delete website deals.</p>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Website Deals <a href="<?echo base_url();?>backend/admin/add_deal">[Add]<img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--plus.png"/></a></h1><span></span>
					</div>
					<div class="block-content">
						<table id="table-example" class="table">
							<thead>
								<tr>
									<th>id</th>
									<th>Title / Sub Title</th>
									<th>Image</th>
									<th>Price Before/After</th>
									<th>Discount</th>
									<th>End Date</th>
									<th>Featured</th>
									<th>Edit / Delete</th>
								</tr>
							</thead>
							<tbody>
								{list_deals}
								<tr class="gradeX">
									<td>{id}</td>
									<td>{title} <br/> {sub_title}</td>
									<td><img src="<?echo base_url();?>uploads/deals_logos/{image}" width="100px"/></td>
									<td>{price}/{price_after}</td>
									<td>{discount}</td>
									<td>{end_date}</td>
									<td><a href="<?echo base_url();?>backend/admin/change_featured/{id}/{featured}"><img src="{featured_image}"/></a></td>
									<td>
										<a href="<?echo base_url();?>backend/admin/edit_deal/{id}" rel="tooltip-top" original-title="Edit"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--pencil.png"/></a>
										<a href="<?echo base_url();?>backend/admin/delete_deal/{id}" rel="tooltip-top" original-title="Delete"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/blog--minus.png"/></a>
									</td>
								</tr>
								{/list_deals}
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
  </div> <!--! end of #main -->