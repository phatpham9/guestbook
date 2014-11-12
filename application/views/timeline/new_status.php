<section class="typography new-status">
	<div class="status-body">
		<textarea id="new-status-content" class="form-control" rows="2" placeholder="What's in your mind?" maxlength="1000"></textarea>
	</div>
	<div class="status-footer">
		<span id="count-status-content" class="text-muted pull-left">0/1000</span>
		<button type="button" id="post-new-status-button" class="btn btn-primary btn-sm">Post</button>
	</div>
</section>

<script type="text/javascript">
	$(document).ready(function(){
		//focus event
		$("#new-status-content").focusin(function(){
			$(".new-status .status-footer").fadeIn(250);
		});
		
		//count status length
		$("#new-status-content").keyup(function(){
			var len = $(this).val().length;
			$("#count-status-content").text(len + "/1000");
		});

		//post new status
		$("#post-new-status-button").click(function(){
			var status_content = $("#new-status-content").val();
			if (status_content.length > 0) {
				$.post("<?php echo site_url('timeline/post_status'); ?>", {status_content: status_content}, function(data, status){
					if(status == "error") {
						alert("Error happens. Please try again.");
					} else {
						try {
							var result = JSON.parse(data);
							alert(result.info);
						} catch (e) {
							$(".no-status").remove();
							$("#new-status-content").val("");
							$("#count-status-content").text("0/1000");
							$(data).hide().prependTo("#status-container").fadeIn(500);
						}
					}
				});
			}
		});
	});
</script>