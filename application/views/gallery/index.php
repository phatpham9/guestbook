<?php
/**
 * @name Gallery Index
 * @author Mr. Nup <buihuynh.kinhluan@gmail.com>
 */
?>

<!doctype html>
<html lang="en">

    <head>
        <?php
        $this->load->view("common/nup_header");
        ?>
    </head>

    <body>
        <!-- Container -->
        <div id="container">
            <!--            
            <div class="loader"><img id="loading" src="images/kollar-loader.gif">
                <img id="center-logo" alt="" src="images/logo-big.png">
            </div>
            -->
            <!-- Header -->
            <header>
                <?php $this->load->view('common/nup_navigation'); ?>
            </header>

            <!-- Content -->
            <div id="content" class="clearfix gallery">

                <div class="post">
                    <a class="post-gallery" href="#">
                        <img class="open" alt="" src="<?php echo site_url(); ?>assets/upload/photo12.jpg">
                    </a>
                    <div class="post-content">
                        <a class="zoom1" href="<?php echo site_url(); ?>assets/upload/photo12.jpg" rel="gallery" title="image"></a>
                    </div>
                </div>

                <div class="post">
                    <a class="post-gallery" href="#"><img class="open" alt="" src="<?php echo site_url(); ?>assets/upload/photo12.jpg"></a>
                    <div class="post-content">
                        <a class="zoom1" href="<?php echo site_url(); ?>assets/upload/photo12.jpg" rel="gallery" title="image"></a>
                    </div>
                </div>

                <div class="post">
                    <a class="post-gallery" href="#"><img class="open" alt="" src="<?php echo site_url(); ?>assets/upload/photo12.jpg"></a>
                    <div class="post-content">
                        <a class="zoom1" href="<?php echo site_url(); ?>assets/upload/photo12.jpg" rel="gallery" title="image"></a>
                    </div>
                </div>

                <div class="post print furniture">
                    <a class="post-gallery" href="#"><img class="open" alt="" src="<?php echo site_url(); ?>assets/upload/photo15.jpg"></a>
                    <div class="post-content">
                        <a class="zoom1 video" href="http://www.youtube.com/embed/L9szn1QQfas?autoplay=1" rel="video" title="video"></a>
                    </div>
                </div> 

                <div class="post">
                    <a class="post-gallery" href="#"><img class="open" alt="" src="<?php echo site_url(); ?>assets/upload/photo12.jpg"></a>
                    <div class="post-content">
                        <a class="zoom1" href="<?php echo site_url(); ?>assets/upload/photo12.jpg" rel="gallery" title="image"></a>
                    </div>
                </div>

                <div class="post">
                    <a class="post-gallery" href="#"><img class="open" alt="" src="<?php echo site_url(); ?>assets/upload/photo12.jpg"></a>
                    <div class="post-content">
                        <a class="zoom1" href="<?php echo site_url(); ?>assets/upload/photo12.jpg" rel="gallery" title="image"></a>
                    </div>
                </div>

            </div>
            <!-- End Content -->
        </div>
        <!-- End Container -->

        <?php $this->load->view("common/footer"); ?>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.imagesloaded.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/js/jquery.fancybox.js"></script>

    </body>

</html>