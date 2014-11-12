		<?php
					$login = array(
						'name'	=> 'login',
						'id'	=> 'login',
						'value' => set_value('login'),
						'maxlength'	=> 80,
						'size'	=> 30,
						'class' => 'form-control'
					);
					if ($login_by_username AND $login_by_email) {
						$login['placeholder'] = 'Username or email';
					} else if ($login_by_username) {
						$login['placeholder'] = 'Username';
					} else {
						$login['placeholder'] = 'Email';
					}
					$password = array(
						'name'	=> 'password',
						'id'	=> 'password',
						'size'	=> 30,
						'class' => 'form-control',
						'placeholder'	=> 'Password'
					);
					$remember = array(
						'name'	=> 'remember',
						'id'	=> 'remember',
						'value'	=> 1,
						'checked'	=> set_value('remember')
					);
					$captcha = array(
						'name'	=> 'captcha',
						'id'	=> 'captcha',
						'maxlength'	=> 8,
						'class' => 'form-control',
						'placeholder'	=> 'Capcha'
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
							<h1>Login</h1>
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
										<?php echo form_label('Password', $password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($password); ?>
											<?php echo form_error($password['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$password['name']]) ? '<span class="help-block">' . $errors[$password['name']] . '</span>' : ''; ?>
										</div>
									</div>

									<?php if ($show_captcha) { ?>
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
											<div class="checkbox">
												<label>
													<?php echo form_checkbox($remember); echo 'Remember me'; ?>
												</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary">Login</button>
											<?php echo anchor('/auth/forgot_password/', 'Forgot Password?', array('class' => 'btn btn-link')); ?>
											<?php if ($this->config->item('allow_registration', 'tank_auth')) echo anchor('/auth/register/', 'Register', array('class' => 'btn btn-link')); ?>
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