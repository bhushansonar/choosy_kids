<?php
$where = "";
if (isset($_POST['searchName'])) {
    $searchName = $_POST['searchName'];
    $where = " AND UPPER( mu.mn_user_display_name) Like UPPER('%{$_POST['searchName']}%')";
}
$SQL = "SELECT `mn_note_title` , `mn_note_price` , `mn_note_thumbnail` , `mn_user_display_name` FROM `mn_transaction` mt LEFT JOIN mn_note mn ON mt.`mn_note_id` = mn.`mn_note_id` LEFT JOIN mn_user mu ON mt.`mn_user_id`=mu.`mn_user_id` WHERE `mn_transaction_status` = 'C' {$where}";
$purchase_detail = $objDB->select($SQL);
?>
<script type="text/javascript">
    $(document).ready(function() {
        /* Table Sorter */
        $("#sort-table")
                .tablesorter({
            widgets: ['zebra'],
            headers: {
                // assign the secound column (we start counting zero) 
//                0: {
//                    // disable it by setting the property sorter to false 
//                    sorter: false
//                },
                // assign the third column (we start counting zero) 
//                5: {
//                    // disable it by setting the property sorter to false 
//                    sorter: false
//                }
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
            $header = 'Purchase List';
        }
        ?>
        <h1><?= $header ?></h1>
    </div>
</div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div class="inner-page-title">
                <h2><div style="float:right; font-size:16px;">
                        <li class="buttons" style="list-style:none">
                            <form name="search" id="search" method="post" action="">
                                <input type="text" value="<?= $searchName ?>" name="searchName" id="searchName" />
                                <button type="submit" class="ui-state-default ui-corner-all ui-button">Search</button>
                                <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=purchase'" class="ui-state-default ui-corner-all ui-button">Reset</button>
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
                            <th>Buyer Name</th>
                            <th>Note Title</th> 
                            <!--<th>Note Thumbnail</th>-->
                            <th>Note Price</th>
                            <!--<th style="width:128px">Options</th>--> 
                        </tr> 
                    </thead> 
                    <tbody> 
                        <?php if (!empty($purchase_detail)) { ?>
                        <form id="frmdelmember" name="frmdelmember" method="post" action="manage.php"> 				
                            <input type="hidden" name="a" value="muldelete"> 
                            <input type="hidden" name="p" value="user">
                            <?php for ($i = 0; $i < count($purchase_detail); $i++) { ?>
                                <tr>
                                    <!--<td class="center"><input name="multipledel[]" type="checkbox" id="multipledel[]" value="<?= $purchase_detail[$i]['UserId'] ?>"></td>--> 
                                    <td><?php echo ucwords($purchase_detail[$i]['mn_user_display_name']) ?></td>
                                    <td><?php echo $purchase_detail[$i]['mn_note_title'] ?></td>
                                    <!--<td><?php echo $purchase_detail[$i]['mn_user_phone'] ?></td>-->
                                    <td><?php echo $purchase_detail[$i]['mn_note_price'] ?></td>

<!--                                    <td>
                                        <a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=user&a=edit&id=<?php echo $purchase_detail[$i]['mn_user_id'] ?>" title="Edit" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>
                                        <?php if ($_SESSION['session_adminID'] != $purchase_detail[$i]['mn_user_id']) { ?>
                                            <a id="modal_confirmation_link<?= $i ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                            <?php if ($purchase_detail[$i]['mn_user_status'] == '1') { ?>
                                                <a href="<?php echo $AbsoluteURLAdmin; ?>manage.php?p=user&a=status&s=0&id=<?= $purchase_detail[$i]['mn_user_id'] ?>" title="Deactivate" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-radio-on"></span></a>
                                            <?php } else { ?>
                                                <a href="<?php echo $AbsoluteURLAdmin; ?>manage.php?p=user&a=status&s=1&id=<?= $purchase_detail[$i]['mn_user_id'] ?>" title="Activate" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-bullet"></span></a>
                                            <?php } ?>
                                            <div id="modal_confirmation<?= $i ?>" title="Delete ?">
                                                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to Delete? This will Delete all the information related this User.</p>
                                            </div>
                                            <script language="javascript" type="text/javascript">
            jQuery(document).ready(function() {
            jQuery("#modal_confirmation<?= $i ?>").dialog({
            autoOpen: false,
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
                    document.location.href = "<?php echo $AbsoluteURLAdmin; ?>manage.php?p=user&a=delete&id=<?= $purchase_detail[$i]['mn_user_id'] ?>";
                    jQuery(this).dialog('close');
                },
                Cancel: function() {
                    jQuery(this).dialog('close');
                }
            }
            });

            jQuery('#modal_confirmation_link<?= $i ?>').click(function() {
            jQuery('#modal_confirmation<?= $i ?>').dialog('open');
            return false;
            });
            });
                                            </script>
                                        <?php } ?>
                                    </td>-->
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
