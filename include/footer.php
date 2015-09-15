<section class="clients">
    <div class="holder">

        <div style="width:530px; border-right: 1px solid #fff; float:left;">
            <div style=" float:left; "><h3 style="color:#fff;">Photo Gallery</h3></div><br/><br/><br/>      
            <p><img style="margin-right:30px;" src="images/Photo-1.jpg" alt="image description" ><img src="images/Photo-2.jpg" alt="image description" ></p>
        </div>


        <div style="width:300px; float:right;">
            <div style=" float:left; "><h3 style="color:#fff;">champions</h3></div><br/><br/><br/>      
            <p><img style="margin-right:30px;" src="images/box-3.png" alt="image description" ></p>
        </div>


    </div>
</section>
</div>
</div>
<!-- footer -->
<div id="footer">
    <div class="footer-holder">
        <div class="footer-frame">
            <footer>
                <div class="case" >
                    <!-- grid-cols -->
                    <div class="grid-cols">
                        <!-- col25 -->
                        <div class="col25">
                            <div class="col-holder">
                                <!-- contact -->	
                                <h4></h4>
                                <address>
                                    Copyright @ 2013 <br />
                                    all right reserved <br />
                                    to choosykids.com
                                </address>
                                <a href="<?php echo $AbsoluteURL; ?>index.php?p=home"><ul class="social2">
                                        <li><img src="<?php echo $AbsoluteURL; ?>images/fotter-logo.png" border="0"/>
                                        </li>
                                    </ul></a>
                            </div>
                        </div>

                        <!-- col25 -->
                        <div class="col25">
                            <div class="">
                                <!-- useful-links -->									
                                <h4>Useful Links</h4>
                                <ul class="fotter-links">
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                    <li><a href="#">Other Information 1</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- col25 -->
                        <div class="col25" >
                            <div class="col-holder" >

                                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FChoosyKidsLLC&amp;width=250&amp;height=250&amp;colorscheme=light&amp;show_faces=false&amp;header=true&amp;stream=true&amp;show_border=true" scrolling="no" frameborder="0" style="border:2px #000000;background-color: white;  width:200px; height:250px;" allowTransparency="true"></iframe>

                            </div>
                        </div>
                        <!-- col25 -->
                        <div class="col25">
                            <div class="col-holder">
                                <a class="twitter-timeline" href="https://twitter.com/choosykids" data-widget-id="389681441929326592">Tweets by @choosykids</a>
                                <script>!function(d, s, id) {
                                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                                        if (!d.getElementById(id)) {
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = p + "://platform.twitter.com/widgets.js";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }
                                    }(document, "script", "twitter-wjs");</script>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- add-block -->
            </footer>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('a[data-rel]').each(function() {
        $(this).attr('rel', $(this).attr('data-rel')).removeAttr('data-rel');
    });
</script>
<script type="text/javascript" src="js/dropdown-menu.js"></script>
<script>
    var api;
    jQuery(document).ready(function() {
        api = jQuery('.fullwidthabnner').revolution(
                {
                    delay: 9000,
                    startwidth: 940,
                    startheight: 491,
                    hideThumbs: 10,
                    thumbWidth: 100, // Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                    thumbHeight: 50,
                    thumbAmount: 5,
                    navigationType: "none", // bullet, thumb, none
                    navigationArrows: "solo", // nexttobullets, solo (old name verticalcentered), none

                    navigationStyle: "round", // round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom


                    navigationHAlign: "center", // Vertical Align top,center,bottom
                    navigationVAlign: "bottom", // Horizontal Align left,center,right
                    navigationHOffset: 0,
                    navigationVOffset: 20,
                    soloArrowLeftHalign: "left",
                    soloArrowLeftValign: "center",
                    soloArrowLeftHOffset: 20,
                    soloArrowLeftVOffset: 0,
                    soloArrowRightHalign: "right",
                    soloArrowRightValign: "center",
                    soloArrowRightHOffset: 20,
                    soloArrowRightVOffset: 0,
                    touchenabled: "on", // Enable Swipe Function : on/off
                    onHoverStop: "on", // Stop Banner Timet at Hover on Slide on/off



                    stopAtSlide: -1,
                    stopAfterLoops: -1,
                    shadow: 1, //0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                    fullWidth: "on"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
                });
    });
</script>
</body>
</html>