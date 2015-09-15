<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        CKEDITOR.replace("content");
        
        $("#frm_site_content").validate({
            rules: {
                content_title: "required",
                content_type: "required",
                content_uri: "required",
                status:"required",
            },
            messages: {
                content_title: "Please enter Page title",
                content_type: "Please Select Content Type",
                content_uri: "Please enter a valid URL",
                status:"Please Select your Status"
            }
        });

    });
</script>

    <?php
$content_id = loadVariable("id", "");
$content_title = loadVariable("content_title", "");
$content_type = loadVariable("content_type", "");
$content_excerpt = loadVariable("content_excerpt", "");
$seo_introductory_text = loadVariable("seo_introductory_text", "");
$seo_text = loadVariable("seo_text", "");
$content = loadVariable("content", "");
$content_orderr = loadVariable("content_orderr", "");
$content_uri = loadVariable("content_uri", "");
$status = loadVariable("status", 1);

if ($a == "")
    $a = 'list';
$heading="Add";
if ($a == "edit") {
    $heading="Edit";
    if ($content_id != 0) {
        $SQL = "select * from site_content WHERE content_id='" . $content_id . "'";
        $rsAdmin = $objDB->select($SQL);
        if (count($rsAdmin) > 0) {
            $content_id = $rsAdmin[0]["content_id"];
            $content_title = $rsAdmin[0]["content_title"];
            $content_type = $rsAdmin[0]["content_type"];
            $content_excerpt = $rsAdmin[0]["content_excerpt"];
            $seo_introductory_text = $rsAdmin[0]["seo_introductory_text"];
            $seo_text = $rsAdmin[0]["seo_text"];
            $content = $rsAdmin[0]["content"];
            $content_orderr = $rsAdmin[0]["content_orderr"];
            $content_uri = $rsAdmin[0]["content_uri"];
            $status = $rsAdmin[0]["status"];
        }
    }
}
if ($a == "list") {
    $SQL = "select * from site_content order by content_title";
    $rsAdmin = $objDB->select($SQL);
    $numPerPage = 10;
    $iCount = count($rsAdmin);
    $page = loadVariable("page", 1);

    $totalPages = ceil($iCount / $numPerPage);
    $start = ($page * $numPerPage) - $numPerPage;
    $end = $numPerPage;
    if ($end > count($rsAdmin))
        $end = $iCount;

    $SQL.=" LIMIT " . $start . " , " . $end;
    $rsAdmin = $objDB->select($SQL);
}
?>
<style>
    label {
        display: inline-block;
        width: 80px;
    }
</style>
<div id="sub-nav"><div class="page-title">
        <h1><?php echo $heading;?> Site Content</h1>
        <span></span>
    </div>
</div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div class="inner-page-title">
                <h2><?php echo $heading;?> Site Content<div style="float:right; font-size:16px;">
                        <li class="buttons" style="list-style:none">
                            <form>
                                <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_content'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                        </li>
                        </form>
                    </div></h2>
                <div class="clear"></div>
            </div>
            <div class="content-box">
                <?php if (isset($_POST['error']) && $_POST['error'] != '') { ?>
                    <div class="response-msg inf ui-corner-all">
                        <div>
                            <span>Error Message</span>
                            <?php echo $_POST['error'] ?><?php unset($_POST['error']); ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '' && $_SESSION['check'] == 'edit') { ?>
                    <div class="response-msg inf ui-corner-all">
                        <div>
                            <span>Success Message</span>
                            <?php echo $_SESSION['success'] ?><?php
                            unset($_SESSION['success']);
                            unset($_SESSION['check']);
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '' && $_SESSION['check'] == 'add') { ?>
                    <div class="response-msg inf ui-corner-all">
                        <div>
                            <span>Success Message</span>
                            <?= $_SESSION['success'] ?><?php
                            unset($_SESSION['success']);
                            unset($_SESSION['check']);
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '' && $_SESSION['check'] == 'add') { ?>
                    <div class="response-msg inf ui-corner-all">
                        <div>
                            <span>Error Message</span>
                            <?= $_SESSION['error'] ?><?php
                            unset($_SESSION['error']);
                            unset($_SESSION['check']);
                            ?>
                        </div>
                    </div>
                <?php } ?>
                <form id="frm_site_content" method="post" action="<?php echo $AbsoluteURLAdmin ?>manage.php">
                    <input type="hidden" name="p" value="site_content">
                    <input type="hidden" name="chk" id="chk"> 
                    <?php if ($a == "edit") { ?>
                        <input type="hidden" name="id" value="<?php echo $content_id ?>">
                        <input type="hidden" name="a" value="update"><?php } else { ?>
                        <input type="hidden" name="a" value="add"> 
                    <?php } ?>
                    <?php if ($a == "delete") { ?>
                        <input type="hidden" name="content_id" value="<?php echo $content_id ?>">
                        <input type="hidden" name="a" value="add"> 
                    <?php } ?>
                    <ul>
                        <li>

                            <label  class="desc">
                                Page title <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1"type="text" id="content_title" name="content_title" value="<?php echo viewtext($content_title) ?>" />

                        </li>
                        <li>
                            <label   class="desc">
                                Content Type <em>*</em>
                            </label>
                            <?php
                            $content_type_opt[''] = 'Select';
                            $content_type_opt['page'] = 'Page';
                            $content_type_opt['post'] = 'Post';
                            $attr['name'] = 'content_type';
                            $attr['id'] = 'content_type';
                            $attr['size'] = '1';
                            $attr['class'] = 'field text small';
                            echo dropdown($attr, $content_type_opt, $content_type);
                            ?>   
                        </li>
                        <li>

                            <label  class="desc">
                                Web URL <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1"type="text" id="content_uri" name="content_uri" value="<?php echo viewtext($content_uri) ?>" />
                        </li>

                        <li>
                            <label  class="desc">
                                Excerpt 
                            </label>

                            <textarea class="field text small" tabindex="1" type="text" id="content_excerpt" name="content_excerpt"><?php echo viewtext($content_excerpt) ?></textarea>

                        </li>
                        <li>
                            <label  class="desc">
                                SEO Introductory Text 
                            </label>

                            <textarea class="field text small" tabindex="1" type="text" id="seo_introductory_text" name="seo_introductory_text"><?php echo viewtext($seo_introductory_text) ?></textarea>

                        </li>
                        <li>
                            <label  class="desc">
                                Content
                            </label>
                            <textarea  id="content" name="content"><?php echo $content ?></textarea>

                        </li>
                        <li>
                            <label  class="desc">
                                SEO Footer Text 
                            </label>

                            <textarea class="field text small" tabindex="1" type="text" id="seo_text" name="seo_text"><?php echo viewtext($seo_text) ?></textarea>

                        </li>
                        <li>
                            <label  class="desc">
                                Status
                            </label>
                            <?php
                            
                            $status_opt[''] = 'Select';
                            $status_opt['0'] = 'Inactive';
                            $status_opt['1'] = 'Active';
                            $attr['name'] = 'status';
                            $attr['id'] = 'status';
                            $attr['size'] = '1';
                            $attr['class'] = 'field text small';
                            echo dropdown($attr, $status_opt, $status);
                            ?>


                        </li>

                        <li>
                            <div>
                                <input name="submit" type="submit" class="ui-state-default ui-corner-all ui-button" value="Save" />&nbsp;&nbsp;<input name="button" type="button" class="ui-state-default ui-corner-all ui-button" onclick='if (confirm("Are you sure you want to cancel?\n\nThis will cancel any changes you have made and not yet saved!")) {
            document.location.href = "index.php?p=list_site_menu"
        }' value="Cancel" />
                            </div>
                        </li>
                    </ul>
                </form>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>	
<?php if ($a == "edit" || $_POST['a'] == 'add') { ?>
    <script type="text/javascript" language="javascript">
    $(document).ready(function() {
        $('#tab1').css("display", "none");
        $('#tab2').css("display", "block");
    });
    </script>
<?php } ?>

