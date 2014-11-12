<?php $this->load->view('common/header'); ?>
<!-- Content -->
<div id="content" class="clearfix">
	<div class="container-fluid">
		<div class="row">
			<?php foreach ($friends_list as $friend) { ?>
			<div class="col-md-6">
				<section class="friend">
					<a class="friend-ava pull-left" href="<?php echo $friend->username; ?>">
						<img src="<?php echo $this->common->get_thumb_url($friend->id); ?>">
					</a>
					<div class="friend-info">
						<div class="friend-full-name">
							<span class="glyphicon glyphicon-user"></span> 
							<?php echo $friend->full_name; ?>
						</div>
						<div class="friend-birth-date">
							<span class="glyphicon glyphicon-time"></span> 
							<?php echo isset($friend->date_of_birth) ? date('m/d/Y', strtotime($friend->date_of_birth)) : 'N/A'; ?>
						</div>
						<div class="friend-phone">
							<span class="glyphicon glyphicon-phone-alt"></span> 
							<?php echo isset($friend->phone) ? $friend->phone : 'N/A'; ?>
						</div>
						<div class="friend-email">
							<span class="glyphicon glyphicon-envelope"></span> 
							<?php echo isset($friend->email) ? '<a href="email:' . $friend->email . '">' . $friend->email . '</a>' : 'N/A'; ?>
						</div>
					</div>
				</section>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php $this->load->view("common/footer"); ?>