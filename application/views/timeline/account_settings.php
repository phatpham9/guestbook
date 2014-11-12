<?php $this->load->view('common/header'); ?>
<!-- Content -->
<div id="content" class="clearfix">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<section class="typography">
					<h1>Account Settings</h1>
					<table class="table">
						<tr>
							<td>Username</td>
							<td><?php echo $user->username; ?></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><?php echo anchor('auth/change_password', 'Change password'); ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $user->email; ?> <?php echo anchor('auth/change_email', 'Change email'); ?></td>
						</tr>
						<tr>
							<td>Last login</td>
							<td><?php echo date('m/d/Y H:m:s', strtotime($user->last_login)); ?></td>
						</tr>
						<tr>
							<td>Last IP</td>
							<td><?php echo $user->last_ip; ?></td>
						</tr>
					</table>
				</section>
			</div>
			<?php $this->load->view('timeline/timeline_nav') ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php $this->load->view("common/footer"); ?>