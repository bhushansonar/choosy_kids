<script language="javascript"type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.validate.js"></script>
<!--<script language="javascript"type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery-ui.js"></script>-->
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
        var category_value = $('#category').val();
        var link_content_value = $('#link_content').val();
        var external_link_value = $('#external_link').val();
        var external_link_error = $("#error").attr("for", "external_link");
        $("#frm_site_menu").validate({
            rules: {
                menu_name: "required",
                parent: "required",
                type: "required",
                link_content: "required",
                description: "required",
                status:"required",
                external_link: {
                    required: true,
                    url: true
                }
            },
            messages: {
                menu_name: "Please enter your Menu Name",
                parent: "Please Select your Parent",
                type: "Please Select your Type",
                link_content: "Please Select your Link Content",
                description: "Please enter your Description",
                external_link: "Please enter a valid URL.",
                status:"Please Select your Status"
            }
        });
        $('#category').change(function(e) {
            var category = $('#category').val();
            $.ajax({
                type: 'POST',
                url: 'manage.php',
                data: {
                    v: category,
                    p: 'common',
                    a: 'get_link_content'
                },
                success: function(data) {
                    $('#external_link').val('');
                    $('#link_content').html(data);
                }
            })
            if (category == 'external') {
                document.getElementById('external_link').disabled = false;
                document.getElementById('link_content').disabled = true;
                $("#link_content").removeClass('error');
                $('#link_content').siblings("label.error").hide();
            } else {
                document.getElementById('external_link').disabled = true;
                document.getElementById('link_content').disabled = false;
                $("#external_link").removeClass('error');
                $('#external_link').siblings("label.error").hide();
                //$('#external_link').css("border-color":"#7C7C7C #C3C3C3 #DDDDDD;","border-style":"solid;","border-width": "1px");
            }
             if (category == 'category') {
                document.getElementById('external_link').disabled = true;
                document.getElementById('link_content').disabled = true;
                $("#link_content").removeClass('error');
                $('#link_content').siblings("label.error").hide();
            }
        });
    });

</script>
<?php
$menu_id = loadVariable("id", "");
$menu_name = loadVariable("menu_name", "");
$parent = loadVariable("parent", "");
$description = loadVariable("description", "");
$type = loadVariable("type", "");
$link_content = loadVariable("link_content", "");
$external_link = loadVariable("external_link", "");
$menu_order = loadVariable("menu_order", "");
$status = loadVariable("status", "");
$link_content_opt = array("" => "SELECT");
if ($a == "")
    $a = 'list';
$heading = "Add";
if ($a == "edit") {
    $heading = "Edit";
    if ($menu_id != 0) {
        $SQL = "select * from site_menu WHERE menu_id='" . $menu_id . "'";
        $rsAdmin = $objDB->select($SQL);
        if (count($rsAdmin) > 0) {
            $menu_id = $rsAdmin[0]["menu_id"];
            $menu_name = $rsAdmin[0]["menu_name"];
            $parent = $rsAdmin[0]["parent"];
            $description = $rsAdmin[0]["description"];
            $type = $rsAdmin[0]["type"];
            $link_content_opt = get_link_content($type, FALSE);
            $link_content = $rsAdmin[0]["link_content"];
            print_r($link_content);
            $external_link = $rsAdmin[0]["external_link"];
            $menu_order = $rsAdmin[0]["menu_order"];
            $status = $rsAdmin[0]["status"];
        }
    }
}
if ($a == "list") {
    $SQL = "select * from site_menu order by menu_name";
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
        <h1><?php echo $heading;?> Site Menu</h1>
        <span></span>
    </div>
</div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div class="inner-page-title">
                <h2><?php echo $heading;?> Site Menu<div style="float:right; font-size:16px;">
                        <li class="buttons" style="list-style:none">

                            <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_menu'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                        </li>

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
                <form id="frm_site_menu" method="post" action="<?php echo $AbsoluteURLAdmin ?>manage.php">
                    <input type="hidden" name="p" value="site_menu">
                    <input type="hidden" name="chk" id="chk"> 
                    <?php if ($a == "edit") { ?>
                        <input type="hidden" name="id" value="<?php echo $menu_id ?>">
                        <input type="hidden" name="a" value="update"><?php } else { ?>
                        <input type="hidden" name="a" value="add"> 
                    <?php } ?>
                    <?php if ($a == "delete") { ?>
                        <input type="hidden" name="menu_id" value="<?php echo $menu_id ?>">
                        <input type="hidden" name="a" value="add"> 
                    <?php } ?>
                    <ul>
                        <li>

                            <label for="menu_name"  class="desc">
                                Menuname <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1"   type="text" id="menu_name" name="menu_name" value="<?php echo viewtext($menu_name) ?>" />

                        </li>
                        <span id="useravabilities"></span>
                        <li>

                            <label for="parent"  class="desc">
                                Parent <em>*</em>
                            </label>
                            <?php
                            $SQL = "select menu_id,menu_name from site_menu ";
                            $result = mysql_query($SQL);
                            $parent_opt[''] = 'Select';
                            while ($row = mysql_fetch_array($result)) {
                                $parent_opt[$row['menu_id']] = $row['menu_name'];
                            }
                            $attr['name'] = 'parent';
                            $attr['id'] = 'parent';
                            $attr['size'] = '1';
                            $attr['class'] = 'field text small';
                            echo dropdown($attr, $parent_opt, $parent);
                            ?>
                        </li>
                        <li>
                            <label for="description" class="desc">
                                Description <em>*</em>
                            </label>

                            <textarea class="field text small" tabindex="1"  type="text" id="description" name="description"><?php echo viewtext($description) ?></textarea>

                        </li>
                        <li>
                            <label for="type"  class="desc">
                                Type <em>*</em>
                            </label>
                            <?php
                            $type_opt[''] = 'Select';
                            $type_opt['category'] = 'Category';
                            $type_opt['page'] = 'Page';
                            $type_opt['post'] = 'Post';
                            $type_opt['external'] = 'External';
                            $attr['name'] = 'type';
                            $attr['id'] = 'category';
                            $attr['size'] = '1';
                            $attr['class'] = 'field text small';
                            echo dropdown($attr, $type_opt, $type);
                            ?>

                        </li>
                        <li>
                            <label  class="desc">
                                Link Content
                            </label>
                            <?php
                            $str1 = '';
                            if ($type == 'external') {
                                $str1 = 'disabled';
                            }
                            if($type == 'category'){
                                $str1 = 'disabled';
                            }
                            $attri[$str1] = '';
                            $attri['name'] = 'link_content';
                            $attri['id'] = 'link_content';
                            $attri['class'] = 'field text small';
                            echo dropdown($attri, $link_content_opt, $link_content);
                            ?> 

                        </li>
                        <li>
                            <label  class="desc">
                                External Link
                            </label>
                            <?php
                            if ($type == 'external') {
                                $str = "";
                            } else {
                                $str = "disabled='true'";
                            }
                            ?>
                            <input class="field text small" <?php echo $str ?> tabindex="1"  type="text" id="external_link" name="external_link" value="<?php echo viewtext($external_link) ?>"  />

                        </li>
                        <li>
                            <label  class="desc">
                                Menu Order
                            </label>

                            <input class="field text small" tabindex="1"  type="text" id="small-input" name="menu_order" value="<?php echo viewtext($menu_order) ?>" />

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