		<?php
		$password = array(
			'name'	=> 'password',
			'id'	=> 'password',
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Password'
		);
		?>

		<?php echo $this->load->view("common/header"); ?>
		<!-- Content -->
		<div id="content" class="clearfix">
			<div class="static-content">
				<img src="<?php echo site_url(); ?>assets/upload/background.jpg">
			</div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<section class="typography">
							<h1>Delete Account</h1>
								<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form')); ?>
									<div class="form-group">
										<?php echo form_label('Password', $password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_input($password); ?>
											<?php echo form_error($password['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$password['name']]) ? '<span class="help-block">' . $errors[$password['name']] . '</span>' : ''; ?>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary">Delete Account</button>
											<?php echo anchor('/timeline/profile/', 'Back to Profile', array('class' => 'btn btn-link')); ?>
										</div>
									</div>
								<?php echo form_close();?>
						</section>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->
		<?php echo $this->load->view("common/footer"); ?>