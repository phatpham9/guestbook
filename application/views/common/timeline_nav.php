<div class="col-md-4">
	<section class="right-nav">
		<?php if ($viewing != 'friend_timeline' && $viewing != 'friend_profile') { ?>
		<div class="ava-container">
			<?php if ($viewing != 'news_feed') { ?>
			<div class="ava">
				<img id="ava" src="<?php echo $this->tank_auth->get_ava_url(); ?>" />
			</div>
			<!-- Change ava -->
			<a role="button" class="change-ava" id="change-ava-button" title="Change avatar">
				<div class="change-ava-text">
					<span class="glyphicon glyphicon-camera"></span> &nbsp;Change avatar
				</div>
			</a>
			<form enctype="multipart/form-data" id="upload-ava-form" class="hidden">
				<input type="file" id="ava-file" name="ava_file">
				<input type="submit" id="upload-ava-button">
			</form>
			<!-- End change ava -->
			<?php 
		} 
		else { 
		?>
			<div class="ava">
				<a role="button" href="<?php echo $this->tank_auth->get_username(); ?>">
					<img src="<?php echo $this->tank_auth->get_ava_url(); ?>" />
				</a>
			</div>
			<?php 
		} ?>
		</div>
		<ul class="nav">
			<li <?php if($this->uri->segment(1) == $this->tank_auth->get_username() && $this->uri->segment(2) == '') echo 'class="active"'; ?>>
				<a href="<?php echo site_url($this->tank_auth->get_username()); ?>">
					<?php echo $this->tank_auth->get_full_name(); ?>
				</a>
			</li>
			<li <?php if($this->uri->segment(1) == $this->tank_auth->get_username() && $this->uri->segment(2) == 'profile') echo 'class="active"'; ?>>
				<a href="<?php echo site_url($this->tank_auth->get_username() . '/profile'); ?>">
					Profile
				</a>
			</li>
			<li <?php if($this->uri->segment(1) == $this->tank_auth->get_username() && $this->uri->segment(2) == 'account_settings') echo 'class="active"'; ?>>
				<a href="<?php echo site_url($this->tank_auth->get_username() . '/account_settings'); ?>">
					Account Settings
				</a>
			</li>
		</ul>
		<?php } else { ?>
		<div class="ava-container">
			<div class="ava">
				<a role="button" href="<?php echo site_url($username); ?>">
					<img src="<?php echo $ava_url; ?>" />
				</a>
			</div>
		</div>
		<ul class="nav">
			<li <?php if($this->uri->segment(1) == $username && $this->uri->segment(2) == '') echo 'class="active"'; ?>>
				<a href="<?php echo site_url($username); ?>">
					<?php echo $full_name; ?>
				</a>
			</li>
			<li <?php if($this->uri->segment(1) == $username && $this->uri->segment(2) == 'profile') echo 'class="active"'; ?>>
				<a href="<?php echo site_url($username . '/profile'); ?>">
					Profile
				</a>
			</li>
		</ul>
		<?php } ?>
	</section>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		$("#change-ava-button").click(function(){
			$("#ava-file").click();
		});
		$("#ava-file").change(function(){
			$("#upload-ava-button").click();
		});
		$("#upload-ava-form").submit(function(event){
			event.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: "<?php echo site_url('timeline/upload_ava'); ?>",
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: "json",
				success: function(data){
					if (data.code == 0) {
						alert(data.info);
					} else {
						//$("#ava").attr("src", data.file_path);
						location.reload();
					}
				},
				error: function(){
					alert("Error happens. Please try again.")
				}
			});
		});
	});
</script>