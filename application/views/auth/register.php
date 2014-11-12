		<?php
		if ($use_username) {
			$username = array(
				'name'	=> 'username',
				'id'	=> 'username',
				'value' => set_value('username'),
				'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
				'size'	=> 30,
				'class'	=> 'form-control',
				'placeholder'	=> 'Username'
			);
		}
		$email = array(
			'name'	=> 'email',
			'id'	=> 'email',
			'value'	=> set_value('email'),
			'maxlength'	=> 80,
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Email'
		);
		$password = array(
			'name'	=> 'password',
			'id'	=> 'password',
			'value' => set_value('password'),
			'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Password'
		);
		$confirm_password = array(
			'name'	=> 'confirm_password',
			'id'	=> 'confirm_password',
			'value' => set_value('confirm_password'),
			'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Confirm Password'
		);
		$captcha = array(
			'name'	=> 'captcha',
			'id'	=> 'captcha',
			'maxlength'	=> 8,
			'class'	=> 'form-control',
			'placeholder'	=> 'Captcha'
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
							<h1>Register</h1>
								<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form')); ?>
									<?php if ($use_username) { ?>
									<div class="form-group">
										<?php echo form_label('Username', $username['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_input($username); ?>
											<?php echo form_error($username['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$username['name']]) ? '<span class="help-block">' . $errors[$username['name']] . '</span>' : ''; ?>
										</div>
									</div>
									<?php } ?>
									<div class="form-group">
										<?php echo form_label('Email', $email['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_input($email); ?>
											<?php echo form_error($email['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$email['name']]) ? '<span class="help-block">' . $errors[$email['name']] . '</span>' : ''; ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo form_label('Password', $password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($password); ?>
											<?php echo form_error($password['name'], '<span class="help-block">', '</span>'); ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo form_label('Confirm PW', $confirm_password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($confirm_password); ?>
											<?php echo form_error($confirm_password['name'], '<span class="help-block">', '</span>'); ?>
										</div>
									</div>

									<?php if ($captcha_registration) { ?>
									<div class="form-group">
										<?php echo form_label('Captcha', $captcha['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_input($captcha); ?>
											<?php echo form_error($captcha['name'], '<span class="help-block">', '</span>'); ?>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-6">
											Enter the code exactly as it appears:
											<?php echo $captcha_html; ?>
										</div>
									</div>
									<?php } ?>

									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary">Register</button>
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