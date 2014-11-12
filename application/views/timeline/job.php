<div job-id="<?php echo $job->id; ?>" class="job">
	<?php if ($viewing == 'my_profile') { ?>
	<div class="job-controls pull-right">
		<span class="dropdown">
			<button type="button" job-id="<?php echo $job->id; ?>" class="close delete-job-button" data-toggle="modal" href="#delete-job-modal" aria-hidden="true">&times;</button>
		</span>
	</div>
	<?php } ?>
	<div class="job-content">
		<?php echo $job->company; ?> - <a href="<?php echo 'http://' . $job->company_website; ?>" target="_blank"><?php echo $job->company_website; ?></a>
		</br>
		<?php echo $job->title; ?>
	</div>
</div>