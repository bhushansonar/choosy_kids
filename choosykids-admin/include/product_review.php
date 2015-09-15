<?php
$p = loadvariable('p', '');
$a = loadvariable('a', '');
$review_Id = loadvariable('review_Id', '');
$ProductId = loadVariable("$ProductId", "");
$ProductName = loadvariable('ProductName', '');
$review_name = loadvariable('review_name', '');
$review_title = loadVariable('review_title', '');
$review_description = loadvariable('review_description', '');
$add_date = date('Y-m-d');
$status = loadvariable('status', '');
$searchName = loadVariable("searchName", "");
$page_title = "product_review";
$product_detail = $objDB->getDataArray('product', 'ProductId', 'ProductName', 'ProductName');

if ($a == "")
    $a = 'list';

if ($a == "edit") {
    if ($review_Id != 0) {
        $SQL = "select * from product_review where status!='-1' AND review_Id =" . $review_Id;
        $rsUser = $objDB->select($SQL);
        if (count($rsUser) > 0) {
            $review_Id = $rsUser[0]["review_Id"];
            $ProductId = $rsUser[0]["ProductName"];
            $review_name = $rsUser[0]["review_name"];
            $review_title = $rsUser[0]["review_title"];
            $review_description = $rsUser[0]["review_description"];
            $add_date = $rsUser[0]['add_date'];
        }
    }
}
if ($a == "list") {
    $where = "";
    if ($searchName != "") {
        $where.= "AND ProductId IN (select ProductId from product where 1 AND ProductName like '%{$searchName}%' )";
    }
    $where.=" AND Status!='-1' order by review_Id ASC";
    $SQL = "select * from product_review where 1 $where ";

    $rsUser = $objDB->select($SQL);
    ?>
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
                $header = 'Manage Product Review';
            }
            ?>
            <h1><?php echo $header ?></h1>
        </div>
    </div>
    <div id="page-layout">
        <div id="page-content">
            <div id="page-content-wrapper">
                <div class="inner-page-title">
                    <h2>Product Review<div style="float:right; font-size:16px;">
                            <li class="buttons" style="list-style:none">
                                <form name="search" id="search" method="post" action="">
                                    <input type="text" value="<?= $searchName ?>" name="searchName" id="searchName" placeholder="Product Name" />
                                    <button type="submit" class="ui-state-default ui-corner-all ui-button">Search</button>
                                    <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=product_review'" class="ui-state-default ui-corner-all ui-button">Reset</button>
                                </form>
                            </li>
                        </div></h2>

                    <div class="clear"></div>
                </div>
                <div class="hastable">
                    <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '' && $_SESSION['check'] == 'add') { ?>
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
                    <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '' && $_SESSION['check'] == 'add') { ?>
                        <div class="response-msg inf ui-corner-all">
                            <div>
                                <span>Error Message</span>
                                <?php echo $_SESSION['error'] ?><?php
                                unset($_SESSION['error']);
                                unset($_SESSION['check']);
                                ?>
                            </div>
                        </div>
                    <?php } ?>
    <!--                    <p> <button type="button" id="deleteall_msg" class="ui-state-default ui-corner-all ui-button">Delete All</button></p>-->
                    <script language="javascript" type="text/javascript">
                                        var me = this;
                                        jQuery(document).ready(function() {
                                            jQuery("#delete_all").dialog({
                                                autoOpen: false,
                                                bgiframe: true,
                                                resizable: false,
                                                width: 500,
                                                modal: true,
                                                overlay: {
                                                    backgroundColor: '#000',
                                                    opadealsource: 0.5
                                                },
                                                buttons: {
                                                    'Delete': function() {
                                                        me.checkdeletion('delete');
                                                        jQuery(this).dialog('close');
                                                    },
                                                    Cancel: function() {
                                                        jQuery(this).dialog('close');
                                                    }
                                                }
                                            });

                                            jQuery('#deleteall_msg').click(function() {
                                                jQuery('#delete_all').dialog('open');
                                                return false;
                                            });
                                        });
                    </script>
                    <!--                    <div id="delete_all" title="Delete ?">
                                            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Are you sure you want to Delete all?</p>
                                        </div>-->
                    <form id="frmdelmember" name="frmdelmember" method="post" action="manage.php" enctype="multipart/form-data"> 				
                        <input type="hidden" name="a" value="muldelete">
                        <input type="hidden" name="todo" id="todo" value=""> 
                        <input type="hidden" name="p" value="<?php echo $p ?>">
                        <table id="sort-table"> 
                            <thead> 
                                <tr>
    <!--                                    <th><input type="checkbox"  name="checkall" id="checkall" value="1" onclick="return checkAll(this.id);" /></th>-->
                                    <th>Name</th>
                                    <th>Product Name</th>
                                    <th>Review Title </th>
                                    <th>Review Description</th>

                                    <th style="width:128px">Options</th> 
                                </tr> 
                            </thead> 
                            <tbody> 

                                <?php if (!empty($rsUser)) { ?>
                                    <?php
                                    for ($i = 0; $i < count($rsUser); $i++) {
                                        for ($r = 0; $r < count($rsUser); $r++) {
                                            if ($rsUser[$i]['review_Id'] == $rsUser[$r]['review_Id']) {
                                                ?>
                                                <tr>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <!--                                                    <td class="center"><input name="multipledel[]" type="checkbox" id="multipledel[]" value="<?php //echo $rsUser[$i]['review_Id']                             ?>"></td> -->
                                                    <td><?php echo viewtext($rsUser[$i]['review_name']); ?></td>
                                                    <td><?php
                                                        echo viewtext($product_detail[$rsUser[$i]['ProductId']]);
                                                        ?></td>

                                                    <td><?php echo viewtext($rsUser[$i]['review_title']); ?>
                                                    </td>

                                                    <td><?php echo viewtext($rsUser[$i]['review_description']); ?>
                                                    </td>

                                                    <td>
                    <!--                                                        <a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=product&a=edit&review_Id=<?php echo $rsUser[$i]['review_Id'] ?>" title="Edit" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>-->
                                                        <?php if ($_SESSION['session_review_Id'] != $rsUser[$i]['review_Id']) { ?>
                                                            <a id="modal_confirmation_link<?= $i ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" onclick="remove_row('<?php echo $rsUser[$i]['review_Id'] ?>', '<?php echo ucwords($page_title) ?>', this)" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                                            <?php
                                                            if ($rsUser[$i]['status'] == '1') {
                                                                $status_title = "Deactivate";
                                                                $class = "ui-icon-bullet";
                                                            } else {
                                                                $status_title = "Activate";
                                                                $class = "ui-icon-radio-on";
                                                            }
                                                            ?>
                                                            <a title="<?php echo $status_title ?>" style="cursor: pointer" href="javascript:void(0);" onclick="change_status('<?php echo $rsUser[$i]['review_Id'] ?>', '<?php echo ucwords($page_title) ?>', this)"  class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon <?php echo $class ?>" id="status_button"></span></a>

                                                        <?php } ?>

                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>

                                    </tr> 
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="10" align="center" style="text-align:center;font-weight:bolder"><?php echo NO_RECORD ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>
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


                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>

<?php } ?>           
<?php if ($a == "edit" || $_POST['a'] == 'add') { ?>
    <script type="text/javascript" language="javascript">
                                        $(document).ready(function() {
                                            $('#tab1').css("display", "none");
                                            $('#tab2').css("display", "block");
                                        });
    </script>
<?php } ?>
<script type="text/javascript" language="javascript">
    function checkdeletion(val) //for submitting form 
    {
        if (val != '') {
            document.getElementById('todo').value = val;
            document.frmdelmember.submit();
            return true;
        }
    }
</script>
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