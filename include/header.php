<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Choosy Kids</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600italic,600,400italic,300italic,300,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Oswald:400,700,300' rel='stylesheet' type='text/css'>	
        <link media="all" rel="stylesheet" type="text/css" href="<?php echo $AbsoluteURL; ?>css/all.css" />

        <!-- get jQuery from the google apis -->
        <script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/jquery-1.7.1.min.js"></script>

        <script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/jquery.main.js"></script>
        <script src="<?php echo $AbsoluteURL; ?>js/tabs.js" type="text/javascript"></script>		
        <!-- jQuery KenBurn Slider  -->
        <script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
        <script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
        <!-- REVOLUTION BANNER CSS SETTINGS -->
        <link rel="stylesheet" type="text/css" href="<?php echo $AbsoluteURL; ?>js/rs-plugin/css/settings.css" media="screen" />
        <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" />
        <script src="<?php echo $AbsoluteURL; ?>js/jquery.prettyPhoto.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("a[rel^='prettyPhoto']").prettyPhoto({
                    animation_speed: 'fast', /* fast/slow/normal */
                    slideshow: 5000, /* false OR interval time in ms */
                    autoplay_slideshow: false, /* true/false */
                    opacity: 0.70, /* Value between 0 and 1 */
                    show_title: true, /* true/false */
                    allow_resize: true, /* Resize the photos bigger than viewport. true/false */
                    default_width: 500,
                    default_height: 344,
                    counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
                    theme: 'pp_default' /* light_rounded / dark_rounded / light_square / dark_square / facebook */
                });
            });
        </script>
        <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="css/ie.css" /><![endif]-->

    </head>
    <body>
        <!-- wrapper -->
        <div id="wrapper">
            <div class="w1">
                <div class="w2">
                    <!-- header -->
                    <header id="header">
                        <!-- section -->
                        <div class="section">

                            <div class="contact-box">
                                <strong class="login" style="margin-right:5px;color: #000000;font-size: 16px;">
                                    <?php
                                    echo $_SESSION["username"];
                                    if (isset($_SESSION["username"]) == "") {
                                        ?><a style="margin-right:5px; color: #000000;font-size: 16px;" href="index.php?p=login">LOGIN</a><?php } elseif (isset($_SESSION["username"]) != "") {
                                        ?>
                                        </font><a style="margin-right:5px; color: #000000;font-size: 16px;" href="index.php?p=logout" style=" font-size:15px; margin-left:0px;">,Logout</a>     
                                    <?php } ?> | <a style="margin-right:5px; color: #000000;font-size: 16px;" href="index.php?p=registration"> REGISTER</a>
                                </strong>
                                <strong class="phone">
                                    <a href="<?php echo $AbsoluteURL; ?>index.php?p=home"><span>HOME</span>|</a>
                                    <span>CONTACT US</span>|
                                    <span>SITEMAP</span>
                                </strong>
                                <!-- social -->
                                <ul class="social">
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/twitter-hover.png" width="24" height="25"></li>
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/facebook-hover.png" width="24" height="25"></li>
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/pinterest-hover.png" width="24" height="25"></li>
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/dribbble-hover.png" width="24" height="25"></li>
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/vimeo-hover.png" width="24" height="25"></li>
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/google-hover.png" width="24" height="25"></li>
                                    <li><img alt="" src="<?php echo $AbsoluteURL; ?>images/rss-hover.png" width="24" height="25"></li>
                                </ul>
                            </div>
                            <h1 class="logo"><a href="<?php echo $AbsoluteURL; ?>index.php?p=home"></a></h1>
                            <div class="join-us"><img alt="" src="<?php echo $AbsoluteURL; ?>images/join-us.png" ></div>

                            <img style="float:right;margin-top:44px;" alt="" src="<?php echo $AbsoluteURL; ?>images/call.png" width="215" height="53">
                        </div>
                        <!-- nav-box -->
                        <nav class="nav-box">
                            <?php
                            echo getSfMenu($p);
                            ?>
                            <select class="mobile-menu">
                                <option selected="selected" value="index.html">Home</option>
                                <option value="#">Layouts</option>
                                <option value="index-2.html">- Home Version 2</option>
                                <option value="index-3.html">- Home Version 3</option>
                                <option value="index-4.html">- Home Version 4</option>
                                <option value="index-5.html">- Home Version 5</option>
                                <option value="index-6.html">- Home Version 6</option>
                                <option value="index-7.html">- Home Version 7</option>
                                <option value="index-8.html">- Home Version 8</option>								
                                <option value="#">Sliders</option>
                                <option value="slider-revolution.html">- Revolution Slider</option>							
                                <option value="slider-onebyone.html">- OnebyOne Slider</option>
                                <option value="slider-nivo.html">- Nivo Slider</option>
                                <option value="slider-flex-1.html">- FlexSlider (Basic)</option>
                                <option value="slider-flex-2.html">- FlexSlider (Thumbnail)</option>
                                <option value="slider-carousel.html">- Carousel Slider</option>
                                <option value="slider-accordion.html">- Accordion Slider</option>
                                <option value="slider-piecemaker.html">- Piecemaker 3D Slider</option>							
                                <option value="#">Pages</option>
                                <option value="pages-about.html">- About Us</option>
                                <option value="pages-services.html">- Services</option>
                                <option value="pages-faq.html">- FAQ</option>
                                <option value="pages-team.html">- Meet The Team</option>
                                <option value="pages-testimonials.html">- Testimonials</option>
                                <option value="pages-site-tour.html">- Site Tour</option>
                                <option value="contact-1.php">- Contact Layout 1</option>
                                <option value="contact-2.php">- Contact Layout 2</option>								
                                <option value="#">Shortcodes</option>
                                <option value="shortcodes-typography.html">- Typography</option>
                                <option value="shortcodes-buttons.html">- Buttons</option>
                                <option value="shortcodes-pricing-tables.html">- Pricing Tables</option>
                                <option value="shortcodes-tabs.html">- Accordions, Tabs & Toggles</option>
                                <option value="shortcodes-message-boxes.html">- Alert Messages & Boxes</option>
                                <option value="shortcodes-video.html">- Videos</option>							
                                <option value="#">Portfolio</option>
                                <option value="portfolio-one-column.html">- One Column Portfolio</option>
                                <option value="portfolio-two-columns.html">- Two Columns Portfolio</option>
                                <option value="portfolio-three-columns.html">- Three Columns Portfolio</option>
                                <option value="portfolio-four-columns.html">- Four Columns Portfolio</option>
                                <option value="portfolio-sortable.html">- Sortable Portfolio</option>
                                <option value="#">Blog</option>
                                <option value="blog-large-image.html">- Blog Large Image</option>
                                <option value="blog-medium-image.html">- Blog Medium Image</option>
                                <option value="blog-single-post.html">- Blog Single Post</option>					
                            </select>
                        </nav>						
                    </header>
