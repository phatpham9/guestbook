<?php $this->load->view('common/header'); ?>
<!-- Content -->
<div id="content" class="clearfix">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8">
				<?php if ($viewing == 'my_timeline') $this->load->view('timeline/new_status'); ?>
				<div id="status-container">
					<?php if (!is_null($statuses)) { 
						foreach ($statuses as $status)
							$this->load->view('timeline/status', array('status' => $status, 'is_liked' => $is_liked[$status->id]));
					} else {
						$this->load->view('timeline/no_status');
					} ?>
				</div>
			</div>
			<?php $this->load->view('timeline/timeline_nav') ?>
		</div>
		<br><br>
	</div>
</div>
<!-- End Content -->
<?php $this->load->view("common/footer"); ?>
<?php $this->load->view("timeline/delete_status_modal"); ?>

<script type="text/javascript">
$(document).ready(function(){
	/*====================================================================================================================*/
	/*
	*
	* Author: QUANG NGUYEN PHU
	* 
	*/
	var hetroi = false;
	var nextpage = 2;
	 
	$(window).scroll(function() {
	    if ($(window).scrollTop() == ( $(document).height() - $(window).height())) {
	    	 get_more_timeline();
	    }
	});

    function get_more_timeline(){
     	if (!hetroi) 
     	{
		  	$.ajax({
				type : "post",
				url  : "<?php echo site_url($this->tank_auth->get_username() . '/get_more_timeline'); ?>",
				data : {next_page:nextpage},
				success: function(response){
	    			if(response.trim() != '')
	    			{
						$('#status-container').append(response);						
						nextpage++;
					}
					else{
						alert('There is no more status available for loading');
						hetroi = true;
					}
				},
				error: function(){						
					alert('Error while request...');
				}
			});
		}
    };
	//SEE MORE STATUS - TIMELINE
	// Xem full nhung status dai va ko xuong dong
	$("#status-container").on("click",".see-more-button", function(){
		var status_id = $(this).attr("status-id");

		$.post("<?php echo site_url('timeline/see_more_status_content'); ?>/", {status_id: status_id}, function(data, status){
			if (status == "error") {
				alert("Error happens. Please try again.");
			} else {
				var result = JSON.parse(data);
				if (result.code == 0) {
					alert(result.info);
				} else {
					$(".status-body[status-id=" + status_id + "]").html(result.status_content);
					$(".see-more-button[status-id=" + status_id + "]").fadeOut(500, function(){
						$(this).remove();
					});
				}
			}
		});
		return false;
	});

	// Xem full nhung status it ki tu nhung co xuong nhieu dong
	$("#status-container").on("click",".view-more-button", function(){
		var status_id = $(this).attr("status-id");

		$.post("<?php echo site_url('timeline/see_more_status_content'); ?>/", {status_id: status_id}, function(data, status){
			if (status == "error") {
				alert("Error happens. Please try again.");
			} else {
				var result = JSON.parse(data);
				if (result.code == 0) {
					alert(result.info);
				} else {
					$(".status-body[status-id=" + status_id + "]").html(result.status_content);
					$(".view-more-button[status-id=" + status_id + "]").fadeOut(500, function(){
						$(this).remove();
					});
				}
			}
		});
		return false;
	});
	/*=================================================================================*/

	//----------------edit status--------------------
	$("#status-container").on("click", ".edit-status-button", function(){
		var status_id = $(this).attr("status-id");
		$.post("<?php echo site_url('timeline/get_edit_status'); ?>", {status_id: status_id}, function(data, status){
			if(status == "error") {
				alert("Error happens. Please try again.");
			} else {
				try {
					var result = JSON.parse(data);
					alert(result.info);
				} catch (e) {
					$(".status-body[status-id=" + status_id + "]").html(data);
					$(".edit-status-content[status-id=" + status_id + "]").focus();
				}
			}
		});
	});
	//count edit status length
	$("#status-container").on("keyup", ".edit-status-content", function(){
		var status_id = $(this).attr("status-id");
		var len = $(this).val().length;
		$(".count-edit-status-content[status-id=" + status_id + "]").text(len + "/1000");
	});
	//cancel editing
	$("#status-container").on("click", ".cancel-editing-status-button", function(){
		var status_id = $(this).attr("status-id");
		$.post("<?php echo site_url('timeline/get_status_content'); ?>", {status_id: status_id}, function(data, status){
			if(status == "error") {
				alert("Error happens. Please try again.");
			} else {
				var result = JSON.parse(data);
				if (result.code == 0) {
					alert(result.info);
				} else {
					$(".status-body[status-id=" + status_id + "]").html(result.status_content);
				}
			}
		});
	});
	//finish editing
	$("#status-container").on("click", ".finish-editing-status-button", function(){
		var status_id = $(this).attr("status-id");
		var status_content = $(".edit-status-content[status-id=" + status_id + "]").val();
		$.post("<?php echo site_url('timeline/edit_status'); ?>", {status_id: status_id, status_content: status_content}, function(data, status){
			if(status == "error") {
				alert("Error happens. Please try again.");
			} else {
				var result = JSON.parse(data);
				if (result.code == 0) {
					alert(result.info);
				} else {
					$(".status-body[status-id=" + status_id + "]").html(result.status_content);
				}
			}
		});
	});
	//----------------end edit status--------------------

	//----------------delete status--------------------
	var delete_status_id;
	$("#status-container").on("click", ".delete-status-button", function(){
		delete_status_id = $(this).attr("status-id");
	});
	$("#delete-status-button").click(function(){
		$('#delete-status-modal').modal('hide');
		delete_status(delete_status_id);
	});
	function delete_status(status_id){
		$.post("<?php echo site_url('timeline/delete_status'); ?>", {status_id: status_id}, function(data, status){
			if (status == "error") {
				alert("Error happens. Please try again.");
			} else {
				var result = JSON.parse(data);
				if (result.code == 0) {
					alert(result.info);
				} else {
					$(".status[status-id=" + status_id + "]").fadeOut(500, function(){
						$(this).remove();
					});
				}
			}
		});
	};
	//----------------end delete status--------------------

	//----------------like status--------------------
	$("#status-container").on("click", ".like-button", function(){
		var like_button = $(this);
		var status_id = $(this).attr("status-id");
		var action = $(this).attr("action");

		$.post("<?php echo site_url('timeline'); ?>/" + action + "_status", {status_id: status_id}, function(data, status){
			if (status == "error") {
				alert("Error happens. Please try again.");
			} else {
				var result = JSON.parse(data);
				if (result.code == 0) {
					alert(result.info);
				} else {
					$(".count-likes[status-id=" + status_id + "]").html(result.num_likes);
					if (action == "like") {
						$(like_button).attr("action", "unlike");
						$(like_button).attr("title", "Unlike");
						$(like_button).html("Unlike");
					} else if (action == "unlike") {
						$(like_button).attr("action", "like");
						$(like_button).attr("title", "Like");
						$(like_button).html("Like");
					}
				}
			}
		});
	});
	//----------------end like status--------------------

	//comment status
	$("#status-container").on("click", ".comment-button", function(){
		alert("Comming soon!");
	});
});
</script>