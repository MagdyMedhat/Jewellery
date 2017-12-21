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
				<h1>Add Deal</h1>
				<p>Here you can add new deal to the website.</p>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Add new Deal</h1><span></span>
					</div>
					<form id="validate-form" class="block-content form" action="<?echo base_url();?>backend/admin/add_deal_done" method="post" enctype="multipart/form-data">
						<div class="_50">
							<p><label for="textfield">Title</label><input id="title" name="title" class="required" type="text" value="" /></p>
						</div>
						
						<div class="_50">
							<p><label for="textfield">Sub Title</label><input id="sub_title" name="sub_title" class="required" type="text" value="" /></p>
						</div>
						
						<div class="_100">
							<p><label for="textfield">Description</label><textarea id="description" name="description" class="required" type="text"></textarea></p>
						</div>
						
                                                <div class="_50">
							<p><label for="textfield">Stock Amount</label><input id="unit_left" name="unit_left" class="required" type="text" value="" /></p>
						</div>
                                            
                                                <div class="_50">
							<p><label for="datepicker">End Date</label><input id="datepicker" name="end_date" class="required" type="text" value="" /></p>
						</div>
                                            
						<div class="_50">
							<p><label for="textfield">Price</label><input id="price_before" name="price" class="required" type="text" value="" /></p>
						</div>
						
						<div class="_50">
							<p><label for="datepicker">Discount</label><input id="discount_percentage" name="discount" class="required" type="text" value="" /></p>
						</div>

                                                <div class="_50">
							<p>
								<label for="select">Category</label>
								<select name="categories_id">
									{categories}
									<option value="{id}">{title}</option>
									{/categories}
								</select>
							</p>
						</div>
                                            
						<div class="_50">
							<p>
								<label for="select">Featured</label>
								<select name="featured">
									<option value="1">Yes</option>
									<option value="0">No</option>
								</select>
							</p>
						</div>


                                            
						<div class="_50">
							<p>
								<label for="select">Vendor</label>
								<select name="vendors_id">
									{vendors}
									<option value="{id}">{title}</option>
									{/vendors}
								</select>
							</p>
						</div>
                                            
                                                <div class="_50">
							<p>
								<label for="select">Location</label>
								<select name="locations_id">
									{locations}
									<option value="{id}">{title} - {name}</option>
									{/locations}
								</select>
							</p>
						</div>

						<div class="_50">
							<p>
								<label for="file">Deal Image 1</label>
								<input type="file" name="image">
							</p>
							<p>
								<img width="161" height="100" src="<?echo base_url();?>uploads/deals_logos/{image}"/>
							</p>
						</div>
						
						<div class="_50">
							<p>
								<label for="file">Deal Image 2</label>
								<input type="file" name="image2">
							</p>
							<p>
								<img width="161" height="100" src="<?echo base_url();?>uploads/deals_logos/{image2}"/>
							</p>
						</div>
						
						<div class="_50">
							<p>
								<label for="file">Deal Image 3</label>
								<input type="file" name="image3">
							</p>
							<p>
								<img width="161" height="100" src="<?echo base_url();?>uploads/deals_logos/{image3}"/>
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
  </div> <!--! end of #main -->