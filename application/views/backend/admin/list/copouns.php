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
				<h1>Coupons</h1>
				<p>Here you can deliver your coupons.</p>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Copouns [Orders]</h1><span></span>
					</div>
					<div class="block-content">
						{error}
						<table id="table-example" class="table">
							<thead>
								<tr>
									<th>Deal</th>
                                                                        <th>Date</th>
									<th>User Name</th>
									<th>Deliver</th>
								</tr>
							</thead>
							<tbody>
								{list_copouns}
								<tr class="gradeX">
									<td>{item}</td>
                                                                        
                                                                        <td>{date}</td>
									<td>{username}</td>
                                                                        
									<td>
										<a href="<?echo base_url();?>backend/admin/deliver_coupon/{copoun_id}/" rel="tooltip-top" original-title="Deliver It"><img src="<?echo base_url();?>backend_includes/img/icons/packs/fugue/16x16/ticket--arrow.png"/></a>
									</td>
								</tr>
								{/list_copouns}
							</tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
  </div> <!--! end of #main -->