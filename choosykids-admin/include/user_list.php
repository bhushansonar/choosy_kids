<?php
$page_title = "User List";
$where = "";
if (isset($_POST['searchName'])&& !empty($_POST['searchName'])) {
    $searchName = $_POST['searchName'];
    $where.= " AND UPPER( mn_user_display_name) Like UPPER('%{$_POST['searchName']}%')";
}
if (isset($_POST['searchEmail']) && !empty($_POST['searchEmail'])) {
    $searchEmail= $_POST['searchEmail'];
    $where.= " AND UPPER(mn_user_email) Like UPPER('%{$_POST['searchEmail']}%')";
}
$SQL = "select * from mn_user where mn_user_type!='A' And status!='-1' {$where}";
$student_detail = $objDB->select($SQL);
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
            $header = 'User List';
        }
        ?>
        <h1><?= $header ?></h1>
    </div>
</div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div class="inner-page-title">
                <h2>User List<div style="float:right; font-size:16px;">
                        <li class="buttons" style="list-style:none">
                            <form name="search" id="search" method="post" action="">
                                <input type="text" value="<?= $searchName ?>" name="searchName" id="searchName" placeholder="User Name" />
                                <input type="text" value="<?= $searchEmail ?>" name="searchEmail" id="searchEmail"  placeholder="User Email"/>
                                <button type="submit" class="ui-state-default ui-corner-all ui-button">Search</button>
                                <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=user_list'" class="ui-state-default ui-corner-all ui-button">Reset</button>
                        </li>
                        </form>
                    </div></h2>
                <div class="clear"></div>
            </div>
            <div class="hastable">

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
                <table id="sort-table"> 
                    <thead> 
                        <tr>
                            <!--<th><input type="checkbox"  name="checkall" id="checkall" value="1" onclick="return checkAll(this.id);" /></th>-->
                            <th>Name</th>
                            <th>Email</th> 
                            <th>Phone</th>
                            <th>Address</th>
                            <th style="width:128px">Options</th> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php if (!empty($student_detail)) { ?>
                        <form id="frmdelmember" name="frmdelmember" method="post" action="manage.php"> 				
                            <input type="hidden" name="a" value="muldelete"> 
                            <input type="hidden" name="p" value="user">
    <?php for ($i = 0; $i < count($student_detail); $i++) { ?>
                                <tr>
                                    <!--<td class="center"><input name="multipledel[]" type="checkbox" id="multipledel[]" value="<?= $student_detail[$i]['UserId'] ?>"></td>--> 
                                    <td><?php echo ucwords($student_detail[$i]['mn_user_display_name']) ?></td>
                                    <td><?php echo $student_detail[$i]['mn_user_email'] ?></td>
                                    <td><?php echo $student_detail[$i]['mn_user_phone'] ?></td>
                                    <td><?php echo $student_detail[$i]['mn_user_address'] ?></td>

                                    <td>
                                        <a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=user&a=edit&id=<?php echo $student_detail[$i]['mn_user_id'] ?>" title="Edit" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>
                                        <?php if ($_SESSION['session_adminID'] != $student_detail[$i]['mn_user_id']) { ?>
                                            <a id="modal_confirmation_link<?= $i ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" onclick="remove_row('<?php echo $student_detail[$i]['mn_user_id'] ?>', '<?php echo ucwords($page_title) ?>', this)" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                            <?php
                                            if ($student_detail[$i]['status'] == '1') {
                                                $status_title = "Deactivate";
                                                $class = "ui-icon-bullet";
                                                
                                            } else {
                                                $status_title = "Activate";
                                                $class = "ui-icon-radio-on";
                                            }
                                            ?>
                                                
                                                <a title="<?php echo $status_title ?>" style="cursor: pointer" href="javascript:void(0);" onclick="change_status('<?php echo $student_detail[$i]['mn_user_id'] ?>', '<?php echo ucwords($page_title) ?>', this)"   class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon <?php echo $class ?>" id="status_button"></span></a>
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

                    </select>								
                </div>
                </form>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
