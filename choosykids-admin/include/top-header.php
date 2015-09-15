<style>
    #modal_confirmation{display:none}
</style>
<script type="text/javascript">
    function remove_row(id, page_type, obj) {
        $("#msg_type").html(page_type);
        jQuery("#modal_confirmation").dialog({
            autoOpen: true,
            bgiframe: true,
            resizable: false,
            width: 500,
            modal: true,
            overlay: {
                backgroundColor: '#000',
                opacity: 0.5
            },
            buttons: {
                'Delete': function() {
                    var msg = "";
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo $AbsoluteURLAdmin; ?>manage.php?p=common&page_type=" + page_type + "&a=delete&&id=" + id,
                        dataType: 'json',
                        success: function(reply) {
                            if (reply.error) {
                                msg = reply.error;
                            } else if (reply.msg) {
                                msg = reply.msg;
                                $(obj).parent().parent().slideUp('slow');
                            }

                        }
                    });
                    jQuery(this).dialog('close');
                },
                Cancel: function() {
                        jQuery(this).dialog('close');
                    }
                }
            });
        }
</script>
<script type="text/javascript">
        var status_btn = $("#status_button").val();
        var msg = "";
        function change_status(id, page, object)
                $.ajax( {
            type: 'POST',
            url: "<?php echo $AbsoluteURLAdmin; ?>manage.php?p=common&page_type=" + page + "&a=status&&id=" + id,
            datatype: 'json',
            success: function(data) {
                if ($(object).children('span').hasClass("ui-icon-radio-on")) {
                    $(object).children('span').removeClass('ui-icon-radio-on').addClass('ui-icon-bullet');
                    $(object).removeAttr('title').attr('title','Deactivate');
                    msg = "Successfully Activate";
                } else {
                    $(object).children('span').addClass('ui-icon-radio-on').removeClass('ui-icon-bullet');
                    $(object).removeAttr('title').attr('title','Activate');;
                    msg = "Successfully Deactivate"
                }
                if (msg != "") {
                    var $msg = '<div class="response-msg inf ui-corner-all">'
                            + '<div>'
                            + '<span>' + msg + '</span>'
                            + '</div></div>';

                }
                $(".hastable").prepend($msg);
                setTimeout(function($msg) {
                    $('.response-msg').slideUp();
                }, 2000);
            }
    }
    )
</script>
<?php
$SQL = "SELECT * FROM admin WHERE AdminID='" . $_SESSION['session_adminID'] . "'";
$rsAdmin = $objDB->select($SQL);
if ($rsAdmin[0]['AdminRole'] == '1') {
    if ($_REQUEST['p'] == 'admin' || $_REQUEST['p'] == 'admin_list') {
        header("Location:" . $AbsoluteURLAdmin . "index.php?p=authorize");
    }
}
if ($p != 'login' && isset($_SESSION['session_adminID']) && $_SESSION['session_adminID'] != '') {
    ?>
                                                                                                                                                                                       <!--<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>js/custom.js"></script>-->
<?php } ?>
<div id="modal_confirmation" title="Delete ?">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
        Are you sure you want to Delete? This will Delete all the information related this <span id="msg_type"></span>.
    </p>
</div>
<div id="page-header">
    <div id="page-header-wrapper">
        <div id="top">
            <?php
            if ($p != 'login' && isset($_SESSION['session_adminID']) && $_SESSION['session_adminID'] != '') {
                $sqllogin = "SELECT * FROM admin where AdminID = '" . $_SESSION['session_adminID'] . "'";
                $namedata = $objDB->select($sqllogin);
                ?>
                <div class="welcome">
                    <span class="note"><a class="note" style="color:red" href="<?php echo $AbsoluteURL; ?>" target="_blank">Go To Site</a></span>
                    <span class="note">Welcome, <?php echo ucwords($namedata[0]['FirstName'] . " " . $namedata[0]['LastName']); ?></span>
                    <a class="btn ui-state-default ui-corner-all" href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=login&a=logout">
                        <span class="ui-icon ui-icon-power"></span>
                        Logout
                    </a>					
                </div>
            <?php } ?>                    
        </div>
        <?php if ($p != 'login') { ?>
            <script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>js/superfish.js"></script>                
            <ul id="navigation">
                <li><a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=home" class="sf-with-ul <?php if ($p == 'home') { ?> current<?php } ?>">Dashboard</a></li>
                <li><a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=admin_list">Administrator</a></li>
                <li><a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=user_list">Users</a></li>
                <li><a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_menu">Site Menu</a></li>
                <li><a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_content">Site Content</a></li>
                <li><a href="<?php echo $AbsoluteURLAdmin;?>index.php?p=product">Product</a></li>
<!--                <li><a href="<?php echo $AbsoluteURLAdmin;?>index.php?p=category">Category</a></li>-->
                <li><a href="<?php echo $AbsoluteURLAdmin;?>index.php?p=product_review">Product Review</a></li>
            </ul>
        <?php } ?>
    </div>
</div>