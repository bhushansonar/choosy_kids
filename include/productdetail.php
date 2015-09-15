<link href="css/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.jplayer.min.js"></script>
<script src="<?php echo $AbsoluteURL; ?>js/jquery.ui.core.js"></script>
<script src="<?php echo $AbsoluteURL; ?>js/jquery.ui.widget.js"></script>
<link href="css/jquery.fancybox.css?v=2.1.4" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.fancybox.pack.js?v=2.1.4"></script>
<script type="text/javascript" src="<?php echo $AbsoluteURL; ?>js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".various").fancybox({
            maxWidth: 800,
            maxHeight: 600,
            fitToView: false,
            width: '100%',
            height: '100%',
            autoSize: true,
            closeClick: false,
            openEffect: 'none',
            closeEffect: 'none'
        });
        $('.various').click(function() {
            var $reply_to = $(this).attr('reply-to');
            $('#reply_jar_name').val($reply_to);

        });
        $('#set_passwd').click(set_password);


        $('#chng_passwd_form').submit(function() {
            return false;
        });


    });

    function set_password() {
        if ($("#review").valid()) {
            $.ajax({
                type: 'POST',
                url: '<?php $AbsoluteURL ?>manage.php',
                data: {p: 'review', a: 'add', ProductId: $('#reply_jar_name').val(), review_name: $('#review_name').val(), review_title: $('#review_title').val(), review_description: $('#review_description').val()},
                success: function(data) {
                    if (data == 1) {
                        alert('REVIEW Updated Successfully');
                        $.fancybox.close()
                    } else {
                        alert(data);
                    }
                }
            });
        }
    }
</script>
<script>
    $(document).ready(function() {
        $("#jquery_jplayer_1").jPlayer({
            swfPath: "js",
            supplied: "mp3",
            wmode: "window",
            smoothPlayBar: true,
            keyEnabled: true
        });
        $('.play').click(function() {

            var $path = $(this).attr("data-path");
            var $title = $(this).attr("title");
            $('.jp-title ul li').html($title);
            $('#jquery_jplayer_1').jPlayer('setMedia', {
                mp3: $path
            });
            $("#jquery_jplayer_1").jPlayer("play");
        });
    });
</script>
<style>
    .ui-state-default, .ui-widget-content .ui-state-default, .pagination a, #dashboard-buttons ul li, .ui-tabs-nav .ui-tabs-focus {
        background: url("images/ui-bg_highlight-soft_100_f6f6f6_1x100.png") repeat-x scroll 50% 50% #F6F6F6;
        border: 1px solid #DDDDDD;
        color: #1A4A85;
        font-weight: bold;
        outline: medium none;
    }
    .ui-button {
        cursor: pointer;
        margin: 0;
        padding: 0.5em 1em;
        position: relative;
        text-align: center;
        text-decoration: none;
    }
    p.element_p, p.lable_p{float:left;width: 40%;margin-right: 1%;margin-top:2%}
    p.lable_p{margin-top:3.5%}

</style>
<div style="width: 800px; display: none;" id="inline">
    <h3>product Review</h3>
    <form id="review"  style="width:450px; margin:0 auto;margin-top: 15px;">
        <input class="field text small" tabindex="1"type="hidden" name="ProductId" id="reply_jar_name" />
        <label  class="desc">YOUR NAME:<input class="field text small" tabindex="1"type="text" id="review_name" name="review_name" style="margin-left: 27px;"/></label><br>
        <label  class="desc">REVIEW TITLE:<input class="field text small" tabindex="1"type="text" id="review_title" name="review_title" style="margin-left: 9px;"/></label><br>
        <label  class="desc">YOUR REVIEW:<textarea rows="5" cols="19" name="review_description" id="review_description" style="margin-left: 13px;" ></textarea></label>
        <p class="lable_p"></p>
        <p class="element_p"><input type="button" id="set_passwd" name="submit" class="ui-state-default ui-corner-all ui-button" value="SUBMIT" ></p>
    </form>
</div>
<div class="main-container holder">
    <!-- grid-cols -->
    <div class="grid-cols">
        <!-- col67 -->
        <div style="width:100%;" class="col67">
            <div class="col-holder">
                <h3>product description</h3>
                <div id="result">
                    <?php
                    global $objDB;

                    $result = $objDB->getRow('product', 'ProductId', $_GET['ID']);
                    if (!empty($result)) {
                        $ProductId = $result['ProductId'];
                        $ProductName = $result['ProductName'];
                        $ProductImage = $result['ProductImage'];
                        $ProductPrice = $result['ProductPrice'];
                        $description = $result['description'];
                        $image_file = $result['ProductImage'];
                        $preview_audio = $result['preview_audio'];
                        ?>
                        <p><img src="<?php echo $AbsoluteURLAdmin ?>images/Product_Image/<?php echo $ProductImage; ?>" alt="" style="   border: 2px solid #CE1C1E;float: left;margin: 20px 30px 9px 0 ;width: 250px;">   
                        <h2 style="font-family:Calibri; font-size:30px; text-transform:uppercase; color:#672A8B; font-weight:bold;"><?php echo $ProductName ?></h2>
                        <b style="font-size:30px; font-weight:normal; color:#d93a4e; font-weight:bold;">$<?php echo $ProductPrice ?></b>
                        <p style="text-transform:uppercase;font-size:14px;font-family:Calibri;text-align:justify; line-height:22px;padding-top:15px; "><?php echo $description ?> </p> <br>
                        <?php
                        if ($preview_audio) {
                            ?>
                            <div class="mp3player" style="width:282px;margin-top: 150px" >
                                <div class="jp-jplayer" id="jquery_jplayer_1" style="width: 0px; height: 0px;">
                                    <img id="jp_poster_0" style="width: 0px; height: 0px; display: none;">
                                    <audio  preload="metadata"  src="" href = "javascript:void(0)"  title="<?php echo $preview_audio ?>" data-path="" class="play"></audio>

                                </div>
                                <div class="jp-audio" id="jp_container_1">
                                    <div class="jp-type-single">
                                        <div class="jp-gui jp-interface">
                                            <ul class="jp-controls">
                                                <li><a  href = "javascript:void(0)"  title="<?php echo $preview_audio ?>" data-path="<?php echo $AbsoluteURLAdmin ?>images/Product_audio/<?php echo $preview_audio ?>" class="play jp-play">play</a>

                                                <li><a tabindex="1" class="jp-pause" href="javascript:;" style="display: none;">pause</a></li>
                                                <li><a tabindex="1" class="jp-stop" href="javascript:;">stop</a></li>
                                                <li><a title="mute" tabindex="1" class="jp-mute" href="javascript:;">mute</a></li>
                                                <li><a title="unmute" tabindex="1" class="jp-unmute" href="javascript:;" style="display: none;">unmute</a></li>
                                                <li><a title="max volume" tabindex="1" class="jp-volume-max" href="javascript:;">max volume</a></li>
                                            </ul>
                                            <div class="jp-progress">
                                                <div class="jp-seek-bar" style="width: 0%;">
                                                    <div class="jp-play-bar" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                            <div class="jp-volume-bar">
                                                <div class="jp-volume-bar-value" style="width: 80%;"></div>
                                            </div>
                                            <div class="jp-time-holder">
                                                <div class="jp-current-time">00:00</div>
                                                <div class="jp-duration">00:00</div>

                                                <ul class="jp-toggles">
                                                    <li><a title="repeat" tabindex="1" class="jp-repeat" href="javascript:;">repeat</a></li>
                                                    <li><a title="repeat off" tabindex="1" class="jp-repeat-off" href="javascript:;" style="display: none;">repeat off</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="jp-no-solution" style="display: none;">
                                            <span>Update Required</span>
                                            To play the media you will need to either update your browser to a recent version or update your <a target="_blank" href="http://get.adobe.com/flashplayer/">Flash plugin</a>.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>                   
                    <?php } ?>
                    <a href="#inline" class="various" reply-to="<?php echo $ProductId ?>" ><div style="background-color:#f2f2f2; color:#672A8B; padding:5px; padding-left:10px;margin:15px 0 15px 0; font-size:14px;font-family:Calibri; font-weight:bolder;height: 17px;width: 157px;float: right;margin-top: 103px;">Write a Review</div></a>

                    <div style="background-color:#f2f2f2; color:#672A8B; padding:5px; padding-left:10px;margin:15px 0 15px 0; font-size:14px;font-family:Calibri; font-weight:normal; margin-top: 103px;">The Review is Written  For Product Name</div>
                    <div style="width:100%;margin:0; padding:0;float:left; border-bottom:1px solid #ccc;">
                        <?php
                        global $objDB;
                        $where = "";

                        if ($ProductId != "") {
                            $where.= " AND `ProductId`=$ProductId";
                        }
                        $query = "SELECT * FROM `product_review` WHERE `status` = '1' $where";
                        $result = $objDB->select($query);
                        $i = 0;
                        foreach ($result as $review) {
                            $review_name[$i] = $review['review_name'];
                            $review_title[$i] = $review['review_title'];
                            $review_description[$i] = $review['review_description'];
                            $add_date[$i] = $review['add_date'];
                            $status[$i] = $review['status'];
                            ?>
                            <div style="width:150px;float:left;margin:0;padding:0;height:auto;">
                                <p style="padding-left:10px;font-family:Calibri;font-size:20px; color:#672A8B; margin: -7px 0 0;"><?php echo ucwords($review_name[$i]) ?></p>
                                <span style="padding-left:10px;font-family:Calibri;font-size:15px;"><?php echo $add_date[$i] ?></span>
                            </div>
                            <div style="width:788px;float:left;margin-left:2px;padding:0 0 15px 0px;;height:auto;">
                                <h4 style="font-size:20px;font-family:Calibri; color:#D93A4E;"><?php echo ucwords($review_title[$i]) ?></h4>
                                <p style="font-size:14px;font-family:Calibri; line-height:22px;text-align:justify;"><?php echo $review_description[$i] ?></p>

                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>


                </div>
            </div>
        </div>					
        <!-- col33 -->
    </div>
    <!-- grid-cols -->
</div>