<?php if (!is_null($statuses)) { 
	foreach ($statuses as $status)
		$this->load->view('common/status', array('status' => $status, 'is_liked' => $is_liked[$status->id]));
} 
 ?>