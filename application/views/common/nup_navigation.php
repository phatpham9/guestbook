<?php
/**
 * @name Navigation
 * @author Mr. Nup <buihuynh.kinhluan@gmail.com>
 */
?>

<div class="main-header clearfix">
    <div id="logo"> <!-- Logo -->
        <a href="<?php echo site_url(); ?>">
            <img alt="" src="<?php echo site_url(); ?>assets/images/logo.png">
        </a>
    </div>
</div>

<div id="menu" class="clearfix"> <!-- Navigation -->

    <nav id="my-timeline">
        <ul>
            <li <?php if ($this->uri->segment(1) == $this->tank_auth->get_username()) echo 'class="active"'; ?>>
                <a href="<?php echo site_url($this->tank_auth->get_username()); ?>">
                    <img alt="" src="<?php echo site_url(); ?>assets/images/features.png">
                    <?php echo $this->tank_auth->is_logged_in() ? $this->tank_auth->get_full_name() : 'My Timeline'; ?>
                    <span></span>
                </a>
                <?php if ($this->tank_auth->is_logged_in()) { ?>
                    <ul class="sub-list">
                        <li><a href="<?php echo site_url($this->tank_auth->get_username() . '/profile'); ?>">Profile</a></li>
                        <li><a href="<?php echo site_url($this->tank_auth->get_username() . '/account_settings'); ?>">Account Settings</a></li>
                        <li><a href="<?php echo site_url('auth/logout'); ?>">Logout</a></li>
                    </ul>
                <?php } ?>
            </li>
        </ul>
    </nav>
    <nav>
        <ul>
            <li <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'news_feed') echo 'class="active"'; ?>>
                <a href="<?php echo site_url(); ?>">
                    <img alt="" src="<?php echo site_url(); ?>assets/images/home.png">Home
                    <span></span>
                </a>
            </li>
            <li <?php if ($this->uri->segment(1) == 'friends_list') echo 'class="active"'; ?>>
                <a href="<?php echo site_url('friends_list'); ?>">
                    <img alt="" src="<?php echo site_url(); ?>assets/images/contact.png">Friends List
                    <span></span>
                </a>
            </li>
            <li <?php if ($this->uri->segment(1) == 'gallery') echo 'class="active"'; ?>>
                <a href="<?php echo site_url('gallery'); ?>">
                    <img alt="" src="<?php echo site_url(); ?>assets/images/gallery.png">Gallery
                    <span></span>
                </a>
            </li>
        </ul>
    </nav>
</div>
