<?php if (!is_null($news_feed)) { 
	foreach ($news_feed as $status)
		$this->load->view('common/status', array('status' => $status, 'is_liked' => $is_liked[$status->id]));
}
?>