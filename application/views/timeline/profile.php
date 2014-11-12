<?php $this->load->view("common/header"); ?>
<!-- Content -->
<div id="content" class="clearfix">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<section class="typography profile">
					<h1>Profile</h1>
					<?php if($viewing == 'my_profile' || ($viewing != 'my_profile' && !is_null($favorite_quote))) { ?>
					<div class="row">
						<div class="col-md-12">
							<h4>My Memory</h4>
							<div id="favorite-quote-container">
								<?php if ($viewing == 'my_profile') {
									if (!is_null($favorite_quote)) { ?>
										<textarea id="favorite-quote" class="form-control" name="favorite_quote" rows="2" maxlength="1000" placeholder="What is your memory about Van Lang University?"><?php echo $favorite_quote->favorite_quote; ?></textarea>
									<?php } else { ?>
										<a id="add-favorite-quote-button">Add your memory</a>
									<?php }
								} else { ?>
									<?php echo auto_link(nl2br($favorite_quote->favorite_quote), 'both', TRUE); ?>
								<?php } ?>
							</div>
						</div>
					</div>
					<?php }; ?>
					<div class="row">
						<div class="col-md-6">
							<h4>Basic Information</h4>
							<?php if($viewing == 'my_profile' || ($viewing != 'my_profile' && !is_null($basic_info))) { ?>
							<table class="table">
								<!---------- Start gender ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Gender</td>
									<td id="gender-container">
										<?php if (!is_null($basic_info) && !is_null($basic_info->gender)) { ?>
											<select id="gender" class="form-control" name="gender">
												<?php $genders_list = array('' => '', '0' => 'Female', '1' => 'Male');
												foreach ($genders_list as $key => $value) { ?>
													<option value="<?php echo $key ?>" <?php echo $basic_info->gender == $key ? 'selected' : ''; ?>>
														<?php echo $value ?>
													</option>
												<?php } ?>
											</select>
										<?php } else { ?>
											<a id="add-gender-button">Add gender</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($basic_info->gender)) { ?>
								<tr>
									<td>Gender</td>
									<td>
										<?php echo $basic_info->gender == 0 ? 'Female' : 'Male'; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start date of birth ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Birth date</td>
									<td basic-info="date_of_birth" class="basic-info-container">
										<?php if (!is_null($basic_info) && !is_null($basic_info->date_of_birth)) { ?>
											<input type="text" basic-info="date_of_birth" class="form-control basic-info" name="date_of_birth" maxlength="10" value="<?php echo date('m/d/Y', strtotime($basic_info->date_of_birth)); ?>">
										<?php } else { ?>
											<a basic-info="date_of_birth" class="add-basic-info-button">Add birth date</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($basic_info->date_of_birth)) { ?>
								<tr>
									<td>Birth date</td>
									<td>
										<?php echo date('m/d/Y', strtotime($basic_info->date_of_birth)); ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start place of birth ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Birth place</td>
									<td basic-info="place_of_birth" class="basic-info-container">
										<?php if (!is_null($basic_info) && !is_null($basic_info->place_of_birth)) { ?>
											<input type="text" basic-info="place_of_birth" class="form-control basic-info" name="place_of_birth" maxlength="100" value="<?php echo $basic_info->place_of_birth; ?>">
										<?php } else { ?>
											<a basic-info="place_of_birth" class="add-basic-info-button">Add birth place</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($basic_info->place_of_birth)) { ?>
								<tr>
									<td>Birth place</td>
									<td>
										<?php echo $basic_info->place_of_birth; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start relationship status ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Status</td>
									<td basic-info="relationship_status" class="basic-info-container">
										<?php if (!is_null($basic_info) && !is_null($basic_info->relationship_status)) { ?>
											<input type="text" basic-info="relationship_status" class="form-control basic-info" name="relationship_status" maxlength="100" value="<?php echo $basic_info->relationship_status; ?>">
										<?php } else { ?>
											<a basic-info="relationship_status" class="add-basic-info-button">Add relationship status</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($basic_info->relationship_status)) { ?>
								<tr>
									<td>Status</td>
									<td>
										<?php echo $basic_info->relationship_status; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start language ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Language</td>
									<td basic-info="language" class="basic-info-container">
										<?php if (!is_null($basic_info) && !is_null($basic_info->language)) { ?>
											<input type="text" basic-info="language" class="form-control basic-info" name="language" maxlength="100" value="<?php echo $basic_info->language; ?>">
										<?php } else { ?>
											<a basic-info="language" class="add-basic-info-button">Add language</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($basic_info->language)) { ?>
								<tr>
									<td>Language</td>
									<td>
										<?php echo $basic_info->language; ?>
									</td>
								</tr>
								<?php } ?>
							</table>
							<?php } else {
								echo 'N/A';
							} ?>
						</div>
						<div class="col-md-6">
							<h4>Contact Information</h4>
							<?php if($viewing == 'my_profile' || ($viewing != 'my_profile' && !is_null($contact_info))) { ?>
							<table class="table">
								<!---------- Start address ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Address</td>
									<td contact-info="address" class="contact-info-container">
										<?php if (!is_null($contact_info) && !is_null($contact_info->address)) { ?>
											<input type="text" contact-info="address" class="form-control contact-info" name="address" maxlength="100" value="<?php echo $contact_info->address; ?>">
										<?php } else { ?>
											<a contact-info="address" class="add-contact-info-button">Add address</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($contact_info->address)) { ?>
								<tr>
									<td>Address</td>
									<td>
										<?php echo $contact_info->address; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start phone ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Phone</td>
									<td contact-info="phone" class="contact-info-container">
										<?php if (!is_null($contact_info) && !is_null($contact_info->phone)) { ?>
											<input type="text" contact-info="phone" class="form-control contact-info" name="phone" maxlength="100" value="<?php echo $contact_info->phone; ?>">
										<?php } else { ?>
											<a contact-info="phone" class="add-contact-info-button">Add phone</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($contact_info->phone)) { ?>
								<tr>
									<td>Phone</td>
									<td>
										<?php echo $contact_info->phone; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start Email ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Email</td>
									<td contact-info="email" class="contact-info-container">
										<?php if (!is_null($contact_info) && !is_null($contact_info->email)) { ?>
											<input type="text" contact-info="email" class="form-control contact-info" name="email" maxlength="100" value="<?php echo $contact_info->email; ?>">
										<?php } else { ?>
											<a contact-info="email" class="add-contact-info-button">Add email</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($contact_info->email)) { ?>
								<tr>
									<td>Email</td>
									<td>
										<?php echo '<a href="email:' . $contact_info->email . '">' . $contact_info->email . '</a>'; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start facebook ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Facebook</td>
									<td contact-info="facebook" class="contact-info-container">
										<?php if (!is_null($contact_info) && !is_null($contact_info->facebook)) { ?>
											<input type="text" contact-info="facebook" class="form-control contact-info" name="facebook" maxlength="100" value="<?php echo $contact_info->facebook; ?>">
										<?php } else { ?>
											<a contact-info="facebook" class="add-contact-info-button">Add facebook</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($contact_info->facebook)) { ?>
								<tr>
									<td>Facebook</td>
									<td>
										<?php echo '<a href="http://' . $contact_info->facebook . '" target="_blank">' . $contact_info->facebook . '</a>'; ?>
									</td>
								</tr>
								<?php } ?>

								<!---------- Start skype ---------->
								<?php if ($viewing == 'my_profile') { ?>
								<tr>
									<td>Skype</td>
									<td contact-info="skype" class="contact-info-container">
										<?php if (!is_null($contact_info) && !is_null($contact_info->skype)) { ?>
											<input type="text" contact-info="skype" class="form-control contact-info" name="skype" maxlength="100" value="<?php echo $contact_info->skype; ?>">
										<?php } else { ?>
											<a contact-info="skype" class="add-contact-info-button">Add skype</a>
										<?php } ?>
									</td>
								</tr>
								<?php } else if (!is_null($contact_info->skype)) { ?>
								<tr>
									<td>Skype</td>
									<td>
										<?php echo '<a href="skype:' . $contact_info->skype . '">' . $contact_info->skype . '</a>'; ?>
									</td>
								</tr>
								<?php } ?>
							</table>
							<?php } else {
								echo 'N/A';
							} ?>
						</div>
					</div>
				</section>
				<section class="typography profile">
					<h1>Career</h1>
					<div class="row">
						<div class="col-md-6">
							<h4>Last Jobs</h4>
							<div id="last-job-container">
								<?php if($viewing == 'my_profile' || ($viewing != 'my_profile' && !is_null($last_jobs))) {
									if(!is_null($last_jobs)) {
										foreach ($last_jobs as $last_job) {
											$this->load->view('timeline/job', array('job' => $last_job));
										}
										if($viewing == 'my_profile') { ?>
										<div class="job">
											<a id="add-last-job-button">Add another last job</a>
										</div>
										<?php }
									} else { ?>
										<div class="job">
											<a id="add-last-job-button">Add last job</a>
										</div>
									<?php }
								} else {
									echo 'N/A';
								} ?>
							</div>
						</div>
						<div class="col-md-6">
							<h4>Current Jobs</h4>
							<div id="current-job-container">
								<?php if($viewing == 'my_profile' || ($viewing != 'my_profile' && !is_null($current_jobs))) {
									if(!is_null($current_jobs)) {
										foreach ($current_jobs as $current_job) {
											$this->load->view('timeline/job', array('job' => $current_job));
										}
										if($viewing == 'my_profile') { ?>
										<div class="job">
											<a id="add-current-job-button">Add another current job</a>
										</div>
										<?php }
									} else { ?>
										<div class="job">
											<a id="add-current-job-button">Add current job</a>
										</div>
									<?php }
								} else {
									echo 'N/A';
								} ?>
							</div>
						</div>
					</div>
				</section>
				<section class="typography profile">
					<h1>Favorites & Hates</h1>
					<div class="row">
						<div class="col-md-12">
							<?php foreach ($questions as $question) {
								echo $question->content; ?>
								<input type="text" class="form-control">
							<?php } ?>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('timeline/timeline_nav') ?>
		</div>
	</div>
</div>
<!-- End Content -->
<?php $this->load->view("common/footer"); ?>
<?php $this->load->view("timeline/delete_job_modal"); ?>


<script type="text/javascript">
	$(document).ready(function(){
		//----------------------------------favorite quote---------------------------------------//
		var current_favorite_quote;
		//show favorite quote textarea
		$("#favorite-quote-container").on("click", "#add-favorite-quote-button", function(){
			var textarea = $('<textarea id="favorite-quote" class="form-control" name="favorite_quote" rows="2" maxlength="1000" placeholder="What is your memory about Van Lang University?"></textarea>').autosize();
			$("#favorite-quote-container").html(textarea);
			$("#favorite-quote").focus();
		});
		//get current favorite quote content
		$("#favorite-quote-container").on("focusin", "#favorite-quote", function(){
			current_favorite_quote = $(this).val().trim();
		});
		//finish editing
		$("#favorite-quote-container").on("focusout", "#favorite-quote", function(){
			var favorite_quote = $(this).val().trim();
			//edit if has changes
			if (favorite_quote != current_favorite_quote) {
				$.post("<?php echo site_url('timeline/add_favorite_quote'); ?>", {favorite_quote: favorite_quote}, function(data, status){
					if(status == "error") {
						alert("Error happens. Please try again.");
					} else {
						var result = JSON.parse(data);
						if (result.code == 0) {
							alert(result.info);
						}
					}
				});
			}
			if (favorite_quote.length == 0) {
				$("#favorite-quote-container").html('<a id="add-favorite-quote-button">Add favorite quote</a>');
			}
		});

		//----------------------------------Contact info---------------------------------------//
		//show input
		$(".contact-info-container").on("click", ".add-contact-info-button", function(){
			var contact_info_name = $(this).attr("contact-info");
			$(".contact-info-container[contact-info=" + contact_info_name + "]").html('<input type="text" contact-info="' + contact_info_name + '" class="form-control contact-info" name="' + contact_info_name + '" maxlength="100">');
			$(".contact-info[contact-info=" + contact_info_name + "]").focus();
		});
		var current_contact_info;
		//get current contact info
		$(".contact-info-container").on("focusin", ".contact-info", function(){
			current_contact_info = $(this).val().trim();
		});
		//finish editing
		$(".contact-info-container").on("focusout", ".contact-info", function(){
			var contact_info = $(this).val().trim();
			var contact_info_name = $(this).attr("contact-info");
			//edit if has changes
			if (contact_info != current_contact_info) {
				$.post("<?php echo site_url('timeline/add_contact_info'); ?>/" + contact_info_name, {contact_info: contact_info}, function(data, status){
					if(status == "error") {
						alert("Error happens. Please try again.");
					} else {
						var result = JSON.parse(data);
						if (result.code == 0) {
							alert(result.info);
						}
					}
				});
			}
			if (contact_info.length == 0) {
				$(".contact-info-container[contact-info=" + contact_info_name + "]").html('<a  contact-info="' + contact_info_name + '" class="add-contact-info-button">Add ' + contact_info_name + '</a>');
			}
		});

		//----------------------------------gender---------------------------------------//
		//show gender input
		$("#gender-container").on("click", "#add-gender-button", function(){
			$("#gender-container").html('<select id="gender" class="form-control basic-info" name="gender"><option value=""></option><option value="0">Female</option><option value="1">Male</option></select>');
			$("#gender").focus();
		});
		var current_gender;
		//get current gender
		$("#gender-container").on("focusin", "#gender", function(){
			current_gender = $(this).val().trim();
		});
		//finish editing
		$("#gender-container").on("change", "#gender", function(){
			var gender = $(this).val().trim();
			//edit if has changes
			if (gender != current_gender) {
				$.post("<?php echo site_url('timeline/add_basic_info/gender'); ?>", {basic_info: gender}, function(data, status){
					if(status == "error") {
						alert("Error happens. Please try again.");
					} else {
						var result = JSON.parse(data);
						if (result.code == 0) {
							alert(result.info);
						}
					}
				});
			}
		});
		$("#gender-container").on("focusout", "#gender", function(){
			var gender = $(this).val().trim();
			if (gender.length == 0) {
				$("#gender-container").html('<a id="add-gender-button">Add gender</a>');
			}
		});

		//----------------------------------Basic info---------------------------------------//
		//show input
		$(".basic-info-container").on("click", ".add-basic-info-button", function(){
			var basic_info_name = $(this).attr("basic-info");
			if (basic_info_name == 'date_of_birth')
				$(".basic-info-container[basic-info=" + basic_info_name + "]").html('<input type="text" basic-info="' + basic_info_name + '" class="form-control basic-info" name="' + basic_info_name + '" maxlength="10">');
			else
				$(".basic-info-container[basic-info=" + basic_info_name + "]").html('<input type="text" basic-info="' + basic_info_name + '" class="form-control basic-info" name="' + basic_info_name + '" maxlength="100">');
			$(".basic-info[basic-info=" + basic_info_name + "]").focus();
		});
		var current_basic_info;
		//get current contact info
		$(".basic-info-container").on("focusin", ".basic-info", function(){
			current_basic_info = $(this).val().trim();
		});
		//finish editing
		$(".basic-info-container").on("focusout", ".basic-info", function(){
			var basic_info = $(this).val().trim();
			var basic_info_name = $(this).attr("basic-info");
			//edit if has changes
			if (basic_info != current_basic_info) {
				$.post("<?php echo site_url('timeline/add_basic_info'); ?>/" + basic_info_name, {basic_info: basic_info}, function(data, status){
					if(status == "error") {
						alert("Error happens. Please try again.");
					} else {
						var result = JSON.parse(data);
						if (result.code == 0) {
							alert(result.info);
						}
					}
				});
			}
			if (basic_info.length == 0) {
				$(".basic-info-container[basic-info=" + basic_info_name + "]").html('<a  basic-info="' + basic_info_name + '" class="add-basic-info-button">Add ' + basic_info_name.replace(/_/g, " ") + '</a>');
			}
		});

		//----------------------------------Last job---------------------------------------//
		//show add last job form
		$("#last-job-container").on("click", "#add-last-job-button", function(){
			$.post("<?php echo site_url('timeline/get_add_job_form/last_job'); ?>", function(data, status){
				if(status == "error") {
					alert("Error happens. Please try again.");
				} else {
					$("#last-job-container").prepend(data);
					$("#add-last-job-button").hide();
				}
			});
		});
		//show add current job form
		$("#current-job-container").on("click", "#add-current-job-button", function(){
			$.post("<?php echo site_url('timeline/get_add_job_form/current_job'); ?>", function(data, status){
				if(status == "error") {
					alert("Error happens. Please try again.");
				} else {
					$("#current-job-container").prepend(data);
					$("#add-current-job-button").hide();
				}
			});
		});

		//cancel adding job
		$(".profile").on("click", ".cancel-adding-job-button", function(){
			var cat = $(this).attr("cat");

			$(".add-job[cat=" + cat + "]").remove();

			if (cat == "last_job")
				$("#add-last-job-button").show();
			else if (cat == "current_job")
				$("#add-current-job-button").show();
		});
		//finish adding last job
		$(".profile").on("click", ".finish-adding-job-button", function(){
			var cat = $(this).attr("cat");

			var company = $(".job-company[cat=" + cat + "]").val();
			var company_website = $(".job-company-website[cat=" + cat + "]").val();
			var position = $(".job-position[cat=" + cat + "]").val();

			$.post("<?php echo site_url('timeline/add_job'); ?>/" + cat,
				{company : company, company_website : company_website, position : position},
				function(data, status){
				if(status == "error") {
					alert("Error happens. Please try again.");
				} else {
					try {
						var result = JSON.parse(data);
						alert(result.info);
					} catch (e) {
						$(".add-job[cat=" + cat + "]").remove();
						if (cat == "last_job") {
							$("#last-job-container").prepend(data);
							$("#add-last-job-button").show();
						} else if (cat == "current_job") {
							$("#current-job-container").prepend(data);
							$("#add-current-job-button").show();
						}
					}
				}
			});
		});

		//delete job
		var delete_job_id;
		$(".profile").on("click", ".delete-job-button", function(){
			delete_job_id = $(this).attr("job-id");
		});
		$("#delete-job-button").click(function(){
			$('#delete-job-modal').modal('hide');
			delete_job(delete_job_id);
		});
		function delete_job(job_id){
			$.post("<?php echo site_url('timeline/delete_job'); ?>", {job_id: job_id}, function(data, status){
				if (status == "error") {
					alert("Error happens. Please try again.");
				} else {
					var result = JSON.parse(data);
					if (result.code == 0) {
						alert(result.info);
					} else {
						$(".job[job-id=" + job_id + "]").remove();
					}
				}
			});
		};
	});
</script>