<?php
	//Add CSS file for form formatting
	$plugin_directory_name =  plugin_basename(dirname(__FILE__)); 
	wp_enqueue_style( 'nav_bar_style', plugin_dir_url(dirname(__FILE__)).$plugin_directory_name.'/css/bootstrap.min.css' );
?>

<div class="col-lg-12">	
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4 class="page-header">Onboard Nav Script code paste below</h4>
		<form class="form" method="POST">
			<!-- some inputs here ... -->
			<?php wp_nonce_field( 'obnv_custom_onboard_nav_display', 'custom_onboard_nav_display_field' ); ?>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<div class="form-group">
					<label>Enter address 1</label>
					<input type="text" placeholder="Enter address 1"  name="navbar_address1" class="form-control" id="navbar_address1" value='<?php echo $navbar_address1; ?>'/>
					<em id="navbar_address1_err"></em>
					<em>Eg : 90 Broad St. Suite 2001</em>
				</div>	
			</div>	
			
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">	
				<div class="form-group">
					<label>Enter address 2</label>
					<input type="text" placeholder="Enter address 2"  name="navbar_address2" class="form-control" id="navbar_address2" value='<?php echo $navbar_address2; ?>'/>
					<em id="navbar_address2_err"></em>
					<em>Eg : New York, NY </em>
				</div>	
			</div>	
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
				<div class="form-group">
					<label>Enter zipcode</label>
					<input type="text" placeholder="Enter zip code"  name="navbar_zip" class="form-control" id="navbar_zip" value="<?php echo $navbar_zip; ?>"/>
					<em id="navbar_zip_err"></em>
				</div>	
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
						
				<div class="form-group">
					<label>Nav widget script</label>
					<textarea name="navbar_script" placeholder="Copy your report widget script"  required style="height:300px" class="form-control" id="navbar_script"><?php echo $navbar_script; ?></textarea>
					<em id="navbar_script"></em>
				</div>	
				
				<div class="form-group">
					<input type="submit" value="Save" id="publishNav" class="btn btn-success">
				</div>	
			</div>	
			
		</form>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<h4 class="page-header">Copy your shortcode</h4>	
		<label>&nbsp;</label>
		<figure class="highlight"><pre><code class="codeS language-html" data-lang="html" id="copyTNavarget">[onboard-nav <?php if($navbar_address1!='') {?>address1="<?php echo $navbar_address1; ?>" <?php } ?><?php if($navbar_zip!='') {?>zip="<?php echo $navbar_zip; ?>" <?php } ?><?php if($navbar_address2!='') {?>address2="<?php echo $navbar_address2; ?>" <?php } ?>]</code></pre></figure>
		<button onclick="return copy_nav('copyTNavarget');" id="copybtn" class="pull-right btn btn-success">Copy</button>
	
	</div>
</div>