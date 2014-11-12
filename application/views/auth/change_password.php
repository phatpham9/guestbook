		<?php
		$old_password = array(
			'name'	=> 'old_password',
			'id'	=> 'old_password',
			'value' => set_value('old_password'),
			'size' 	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Current Password'
		);
		$new_password = array(
			'name'	=> 'new_password',
			'id'	=> 'new_password',
			'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
			'size'	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'New Password'
		);
		$confirm_new_password = array(
			'name'	=> 'confirm_new_password',
			'id'	=> 'confirm_new_password',
			'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
			'size' 	=> 30,
			'class'	=> 'form-control',
			'placeholder'	=> 'Confirm new Password'
		);
		?>

		<?php echo $this->load->view("common/header"); ?>
		<!-- Content -->
		<div id="content" class="clearfix">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<section class="typography">
							<h1>Change Password</h1>
								<?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'role' => 'form')); ?>
									<div class="form-group">
										<?php echo form_label('Current', $old_password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($old_password); ?>
											<?php echo form_error($old_password['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$old_password['name']]) ? '<span class="help-block">' . $errors[$old_password['name']] . '</span>' : ''; ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo form_label('New', $new_password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($new_password); ?>
											<?php echo form_error($new_password['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$new_password['name']]) ? '<span class="help-block">' . $errors[$new_password['name']] . '</span>' : ''; ?>
										</div>
									</div>
									<div class="form-group">
										<?php echo form_label('Confirm New', $confirm_new_password['id'], array('class' => 'col-sm-3 control-label')); ?>
										<div class="col-sm-6">
											<?php echo form_password($confirm_new_password); ?>
											<?php echo form_error($confirm_new_password['name'], '<span class="help-block">', '</span>'); ?>
											<?php echo isset($errors[$confirm_new_password['name']]) ? '<span class="help-block">' . $errors[$confirm_new_password['name']] . '</span>' : ''; ?>
										</div>
									</div>

									<div class="form-group">
										<div class="col-sm-offset-3 col-sm-9">
											<button type="submit" class="btn btn-primary">Change password</button>
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