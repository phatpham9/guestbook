<textarea status-id="<?php echo $status->id; ?>" class="form-control edit-favorite-quote" rows="2" maxlength="1000"><?php echo $status->text; ?></textarea>
<div class="edit-favorite-quote-footer">
	<span status-id="<?php echo $status->id; ?>" class="text-muted pull-left count-edit-status-content"><?php echo $status_length; ?>/1000</span>
	<button type="button" status-id="<?php echo $status->id; ?>" class="btn btn-primary btn-sm finish-editing-status-button">Finish</button>
	<button type="button" status-id="<?php echo $status->id; ?>" class="btn btn-default btn-sm cancel-editing-status-button">Cancel</button>
</div>