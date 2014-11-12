$(document).ready(function(){
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
		var status_content = $(".edit-status-content").val();
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