<!-- Begin of #main -->
    <div id="main" role="main">
    	
    	<!-- Begin of titlebar/breadcrumbs -->
		<div id="title-bar">
			<ul id="breadcrumbs">
				<li><a href="" title="Home"><span id="bc-home"></span></a></li>
			</ul>
		</div> <!--! end of #title-bar -->
		
		<div class="shadow-bottom shadow-titlebar"></div>
		
		<!-- Begin of #main-content -->
		<div id="main-content">
			<div class="container_12">
			
			<div class="grid_12">
				<h1>Deliver Coupon</h1>
				<p>Here you can deliver any item.</p>
			</div>
			
			<div class="grid_12">
				<div class="block-border">
					<div class="block-header">
						<h1>Deliver Coupon</h1><span></span>
					</div>
					<form id="validate-form" class="block-content form" action="<?echo base_url();?>backend/vendor/deliver_done" method="post">
                                            <?php if(isset($error) && $error == "error"): ?>
						<div class="alert error no-margin top">invalid coupon</div>
                                            <?php endif; ?>
						<div class="_100">
							<p><label for="textfield">Coupon</label><input id="coupon" name="coupon" class="required" type="text" value="" /></p>
						</div>
						
						
						<div class="clear"></div>
						<div class="block-actions">
							<ul class="actions-right">
								<li><input type="submit" class="button" value="Deliver"></li>
							</ul>
						</div>
					</form>
				</div>
			</div>
			
			<div class="clear height-fix"></div>

		</div></div> <!--! end of #main-content -->
  </div> <!--! end of #main -->