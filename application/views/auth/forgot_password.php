		<?php
			$login = array(
				'name'	=> 'login',
				'id'	=> 'login',
				'value' => set_value('login'),
				'maxlength'	=> 80,
				'size'	=> 30,
				'class'	=> 'form-control'
			);
			if ($this->config->item('use_username', 'tank_auth')) {
				$login['placeholder'] = 'Username or email';
			} else {
				$login['placeholder'] = 'Email';
			}
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
							<h1>Forgot Password?</h1>
								<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form')); ?>
									<div class="form-group">
										<?php echo form_label('Login', $login['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_input($login); ?>
											<?php echo form_error($login['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$login['name']]) ? '<span class="help-block">' . $errors[$login['name']] . '</span>' : ''; ?>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary">New password</button>
											<?php echo anchor('/auth/login/', 'Back to Login', array('class' => 'btn btn-link')); ?>
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