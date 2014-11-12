<section status-id="<?php echo $status->id; ?>" class="typography status">
	<div class="status-header">
		<a class="status-avatar pull-left" href="<?php echo site_url($status->username); ?>">
			<img class="media-object" src="<?php echo $this->common->get_thumb_url($status->user_id); ?>">
		</a>
		<?php if($status->user_id == $this->tank_auth->get_user_id()) { ?>
		<div class="status-controls pull-right">
			<span class="dropdown">
				<button type="button" class="btn-link dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right">
					<li><a status-id="<?php echo $status->id; ?>" class="edit-status-button">Edit</a></li>
					<li><a status-id="<?php echo $status->id; ?>" class="delete-status-button" data-toggle="modal" href="#delete-status-modal">Delete</a></li>
				</ul>
			</span>
		</div>
		<?php }; ?>
		<div class="status-title">
			<div><a href="<?php echo site_url($status->username); ?>"><strong><?php echo $status->full_name; ?></strong></a></div>
			<div class="text-muted" title="<?php echo date('d/m/Y H:i:s', strtotime($status->created)); ?>"><?php echo $this->common->calculate_time_ago($status->created); ?></div>
		</div>
	</div>
	<!-- <div status-id="<?php echo $status->id; ?>" class="status-body">
		<?php echo auto_link(nl2br($status->text), 'both', TRUE); ?>
	</div> -->
	<!-- ================================================================================================ -->
	<!-- *       	      			 * 
	     *  Author: QUANG NGUYEN PHU * 
	     *                			 *
	 -->
	<div status-id="<?php echo $status->id; ?>" class="status-body">
		<?php
			$str = $status->text; //Chuỗi cần cắt
			$str = strip_tags($str); //Lược bỏ các tags HTML
			
			$lines_arr = preg_split('/\n|\r/',$str);
			$num_newlines = count($lines_arr); // Ki tu ghi thanh dong dai, ko xuong dong
			
			// ================= Kiem tra status dai, ko xuong dong
			if($num_newlines >0 && strlen($str) > 500)
			{	
				$strCut = substr($str, 0, 500); //Cắt 500 kí tự đầu
				echo auto_link(nl2br($strCut), 'both', TRUE);
		?>
				....<br>
 					 <a role="button" href="#" status-id="<?php echo $status->id; ?>" title="View more" id="see-more-button" class="see-more-button">View More</a>
		<?php
			}
			// =================  Kiem tra status ngan nhung co xuong dong
			else if($num_newlines > 5) {
				for($i=0; $i<=5; $i++){
					echo auto_link(nl2br($lines_arr[$i]), 'both', TRUE)."<br>";
				}
		?>
				....<br>
					 <a role="button" href="#" status-id="<?php echo $status->id; ?>" title="View more" id="view-more-button" class="view-more-button">View More</a>
		<?php
			}
			// =================  Kiem tra status co xuong dong nhung ngan
			else if ($num_newlines >0 && $num_newlines <5) {
				for($i=0; $i<$num_newlines; $i++){
					echo auto_link(nl2br($lines_arr[$i]), 'both', TRUE)."<br>";
				}
			}

			// ================= status ko xuong dong, ngan
			else
			{	
				echo auto_link(nl2br($str), 'both', TRUE);
			}
		?>
	</div>
	<!-- ================================================================================================ -->	
	
	<div class="status-footer">
		<?php if (!$is_liked) { ?>
		<a role="button" status-id="<?php echo $status->id; ?>" action="like" class="like-button" title="Like">Like</a>
		<?php } else { ?>
		<a role="button" status-id="<?php echo $status->id; ?>" action="unlike" class="like-button" title="Unlike">Unlike</a>
		<?php } ?>
		&nbsp;
		<a role="button" status-id="<?php echo $status->id; ?>" class="comment-button" title="Comment">Comment</a>

		<div class="text-muted pull-right">
			<span class="count-likes-container" data-toggle="tooltip" data-placement="top" title="<?php echo $status->num_likes > 1 ? $status->num_likes . ' likes' : $status->num_likes . 'like'; ?>">
				<span class="glyphicon glyphicon-heart"></span>
				<span status-id="<?php echo $status->id; ?>" class="count-likes"><?php echo $status->num_likes; ?></span>
			</span>
			&nbsp;
			<span class="count-comments-container">
				<span class="glyphicon glyphicon-comment"></span>
				<span status-id="<?php echo $status->id; ?>" class="count-comments"><?php echo $status->num_comments; ?></span>
			</span>
		</div>
	</div>
</section>