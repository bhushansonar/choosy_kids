<?php
$page_title = "Site Menu";
$where = "";
if (isset($_POST['searchName']) && !empty($_POST['searchName'])) {
    $searchName = $_POST['searchName'];
    $where.= " AND UPPER( menu_name) Like UPPER('%{$_POST['searchName']}%')";
}
if (isset($_POST['searchType']) && !empty($_POST['searchType'])) {
    $searchType = $_POST['searchType'];
    $where .= " AND UPPER(type) Like UPPER('%{$_POST['searchType']}%')";
}
$SQL = "select * from site_menu where status!='-1' AND parent not in (0) {$where}";
$menu_detail = $objDB->select($SQL);
?>
<script type="text/javascript">
    $(document).ready(function() {
        /* Table Sorter */
        $("#sort-table")
                .tablesorter({
            widgets: ['zebra'],
            headers: {
                // assign the secound column (we start counting zero) 
                0: {
                    // disable it by setting the property sorter to false 
                    sorter: false
                },
                // assign the third column (we start counting zero) 
                5: {
                    // disable it by setting the property sorter to false 
                    sorter: false
                }
            }
        })

                .tablesorterPager({container: $("#pager")});
        $(".header").append('<span class="ui-icon ui-icon-carat-2-n-s"></span>');
    });
    /* Check all table rows */

    var checkflag = "false";
    function check(field) {
        if (checkflag == "false") {
            for (i = 0; i < field.length; i++) {
                field[i].checked = true;
            }
            checkflag = "true";
            return "check_all";
        }
        else {
            for (i = 0; i < field.length; i++) {
                field[i].checked = false;
            }
            checkflag = "false";
            return "check_none";
        }
    }




</script>
<style type="text/css">
    .hastable table a.btn span.ui-icon {
        left:0.2em;
    }
</style>
<div id="sub-nav"><div class="page-title">
        <?php
        if (isset($val) && $val != '') {
            $header = $val;
        } else {
            $header = 'Site Menu List';
        }
        ?>
        <h1><?= $header ?></h1>
    </div>
</div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div class="inner-page-title">
                <h2>Site Menu List<div style="float:right; font-size:16px;">
                        <li class="buttons" style="list-style:none">
                            <form name="search" id="search" method="post" action="">
                                <input type="text" value="<?= $searchName ?>" name="searchName" id="searchName" placeholder="Menu Name" />
                                <input type="text" value="<?= $searchType ?>" name="searchType" id="searchType" placeholder="Menu Type" />
                                <button type="submit" class="ui-state-default ui-corner-all ui-button">Search</button>
                                <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=list_site_menu'" class="ui-state-default ui-corner-all ui-button">Reset</button>
                        </li>
                        </form>
                    </div></h2>
                <div class="clear"></div>
            </div>
            <div class="hastable">

                <table id="sort-table"> 
                    <thead> 
                        <tr>
                            <!--<th><input type="checkbox"  name="checkall" id="checkall" value="1" onclick="return checkAll(this.id);" /></th>-->
                            <th>Menu Title</th>
                            <th>Menu Type</th> 
                            <th style="width:128px">Options</th> 
                        </tr> 
                    </thead> 
                    <tbody>  
                        <?php if (!empty($menu_detail)) { ?>
                        <form id="frmdelmember" name="frmdelmember" method="post" action="manage.php"> 				
    <!--                            <input type="hidden" name="a" value="muldelete"> -->
                            <input type="hidden" name="p" value="site_menu">
                            <?php for ($i = 0; $i < count($menu_detail); $i++) { ?>
                                <tr>

                                    <td><?php echo ucwords($menu_detail[$i]['menu_name']) ?></td>
                                    <td><?php echo $menu_detail[$i]['type'] ?></td>

                                    <td>
                                        <a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=manage_site_menu&a=edit&id=<?php echo $menu_detail[$i]['menu_id'] ?>" title="Edit" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>
                                        <?php if ($_SESSION['session_menu_id'] != $menu_detail[$i]['menu_id']) { ?>
                                            <a id="modal_confirmation_link<?= $i ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" onclick="remove_row('<?php echo $menu_detail[$i]['menu_id'] ?>', '<?php echo ucwords($page_title) ?>', this)" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                            <?php
                                            if ($menu_detail[$i]['status'] == '1') {
                                                
                                                $class = "ui-icon-bullet";
                                                $status_title = "Deactivate";
                                            } else {
                                                
                                                $class = "ui-icon-radio-on";
                                                $status_title = "Activate";
                                            }
                                            ?>
                                            <a title="<?php echo $status_title ?>" style="cursor: pointer" href="javascript:void(0);" onclick="change_status('<?php echo $menu_detail[$i]['menu_id'] ?>', '<?php echo ucwords($page_title) ?>', this)" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon <?php echo $class ?>" id="status_button"></span></a>

                                        <?php } ?>
                                    </td>
                                </tr> 
                            <?php } ?>
                        </form>
                    <?php } else { ?>
                        <tr>
                            <td colspan="10" align="center" style="text-align:center;font-weight:bolder"><?= NO_RECORD ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <div id="pager">

                    <a class="btn_no_text btn ui-state-default ui-corner-all first" title="First Page" href="#">
                        <span class="ui-icon ui-icon-arrowthickstop-1-w"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all prev" title="Previous Page" href="#">
                        <span class="ui-icon ui-icon-circle-arrow-w"></span>
                    </a>

                    <input type="text" class="pagedisplay"/>
                    <a class="btn_no_text btn ui-state-default ui-corner-all next" title="Next Page" href="#">
                        <span class="ui-icon ui-icon-circle-arrow-e"></span>
                    </a>
                    <a class="btn_no_text btn ui-state-default ui-corner-all last" title="Last Page" href="#">
                        <span class="ui-icon ui-icon-arrowthickstop-1-e"></span>
                    </a>
                    <select class="pagesize">
                        <option value="10" selected="selected">10 results</option>
                        <option value="20">20 results</option>
                        <option value="30">30 results</option>
                        <option value="40">40 results</option>
                        <option value="50">50 results</option>
                    </select>								
                </div>
                </form>
                <input type="button" class="ui-button float-right ui-state-default ui-corner-all" id="create-user" value="Create New Site Menu" onclick="document.location.href = 'index.php?p=manage_site_menu'" >
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
