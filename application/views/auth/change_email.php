		<?php
		$password = array(
			'name'	=> 'password',
			'id'	=> 'password',
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Password'
		);
		$email = array(
			'name'	=> 'email',
			'id'	=> 'email',
			'value'	=> set_value('email'),
			'maxlength'	=> 80,
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'New Email'
		);
		?>

		<?php echo $this->load->view("common/header"); ?>
		<!-- Content -->
		<div id="content" class="clearfix">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<section class="typography">
							<h1>Change Email</h1>
								<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form')); ?>
									<div class="form-group">
										<?php echo form_label('New Email', $email['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($email); ?>
											<?php echo form_error($email['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$email['name']]) ? '<span class="help-block">' . $errors[$email['name']] . '</span>' : ''; ?>
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
									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary">Send confirmation email</button>
											<?php echo anchor($this->tank_auth->get_username() . '/account_settings', 'Back to Settings', array('class' => 'btn btn-link')); ?>
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