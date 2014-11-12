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
							<h1>Message</h1>
							<p>
								<?php echo $message; ?>
							</p>
						</section>
					</div>
				</div>
			</div>
		</div>
		<!-- End Content -->
		<?php echo $this->load->view("common/footer"); ?>