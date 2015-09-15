<?php
$p = loadVariable("p", "");
$a = loadVariable("a", "");
$CategoryId = loadVariable("CategoryId", 0);
$Category = loadVariable('Category', '');
$searchName = loadVariable("searchName", "");
$page_title = "category";
$SQL = "SELECT * FROM admin WHERE AdminID='" . $_SESSION['session_adminID'] . "'";
$rsAdmin = $objDB->select($SQL);

if ($a == "")
    $a = 'list';

if ($a == "edit") {
    if ($CategoryId != 0) {
        $SQL = "select * from category where status!='-1' AND  CategoryId =" . $CategoryId;
        $rsUser = $objDB->select($SQL);
        if (count($rsUser) > 0) {
            $CategoryId = $rsUser[0]["CategoryId"];
            $Category = $rsUser[0]["Category"];
        }
    }
}
if ($a == "list") {
    $SQL = "select * from category where";
     if ($searchName != '') {
        $SQL .= "(Category LIKE '%" . $searchName . "%') and ";
    }
    $SQL .= " Status!='-1' order by CategoryId ASC";
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
                $header = 'Manage Main Category';
            }
            ?>
            <h1><?php echo $header ?></h1>
        </div>
    </div>
    <div id="page-layout">
        <div id="page-content">
            <div id="page-content-wrapper">
                <div class="inner-page-title">
                    <h2>Category List<div style="float:right; font-size:16px;">
                             <li class="buttons" style="list-style:none">
                                <form name="search" id="search" method="post" action="">
                                    <input type="text" value="<?= $searchName ?>" name="searchName" id="searchName" placeholder="Category Name" />
                                    <button type="submit" class="ui-state-default ui-corner-all ui-button">Search</button>
                                    <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=category'" class="ui-state-default ui-corner-all ui-button">Reset</button>
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
                    <form id="frmdelmember" name="frmdelmember" method="post" action="manage.php"> 				
                        <input type="hidden" name="a" value="muldelete">
                        <input type="hidden" name="todo" id="todo" value=""> 
                        <input type="hidden" name="p" value="<?php echo $p ?>">
                        <table id="sort-table"> 
                            <thead> 
                                <tr>
<!--                                    <th><input type="checkbox"  name="checkall" id="checkall" value="1" onclick="return checkAll(this.id);" /></th>-->
                                    <th>Category Name</th>
                                    <th style="width:128px">Options</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                <?php if (!empty($rsUser)) { ?>
                                    <?php for ($i = 0; $i < count($rsUser); $i++) { ?>
                                        <tr>
<!--                                            <td class="center"><input name="multipledel[]" type="checkbox" id="multipledel[]" value="<?php echo $rsUser[$i]['CategoryId'] ?>"></td> -->
                                            <td><?php echo viewtext($rsUser[$i]['Category']); ?></td>


                                            <td><a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=category&a=edit&CategoryId=<?php echo $rsUser[$i]['CategoryId'] ?>" title="Edit" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>

                                                <?php if ($_SESSION['session_CategoryId'] != $rsUser[$i]['CategoryId']) { ?>
                                                    <a id="modal_confirmation_link<?= $i ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" onclick="remove_row('<?php echo $rsUser[$i]['CategoryId'] ?>', '<?php echo ucwords($page_title) ?>', this)" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                                    <?php
                                                    if ($rsUser[$i]['status'] == '1') {
                                                        $status_title = "Deactivate";
                                                        $class = "ui-icon-bullet";
                                                    } else {
                                                        $status_title = "Activate";
                                                        $class = "ui-icon-radio-on";
                                                    }
                                                    ?>
                                                    <a title="<?php echo $status_title ?>" style="cursor: pointer" href="javascript:void(0);" onclick="change_status('<?php echo $rsUser[$i]['CategoryId'] ?>', '<?php echo ucwords($page_title) ?>', this)"  class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon <?php echo $class ?>" id="status_button"></span></a>

                                                <?php } ?>

                                            <?php } ?>
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

                    <input type="button" class="ui-button float-right ui-state-default ui-corner-all" id="create-user" value="Add New Category" onclick="document.location.href = 'index.php?p=category&a=add'" >
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php } elseif ($a == "edit" || $a == "add") { ?>
    <script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.validate.js"></script>
    <script type="text/javascript">
                        $(document).ready(function() {
                            $("#FrmTestimonials").validate({
                                rules: {
                                    Category: "required",
                                   
                                    
                                },
                                messages: {
                                    Category: "Please Enter Category Name",
                                    
                                    
                                }
                            });

                        });
    </script>
    <style>
        label {
            display: inline-block;
            width: 80px;
        }
    </style>
    <div id="page-layout">
        <div id="page-content">
            <div id="page-content-wrapper">
                <div class="inner-page-title">
                    <?php if ($a == 'add') { ?>
                        <h2>Add Category<div style="float:right; font-size:16px;">
                                <li class="buttons" style="list-style:none">
                                    <form>
                                        <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=category'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                                </li>
                                </form>
                            </div></h2>
                    <?php } else { ?>
                        <h2>View Category/Edit Category<div style="float:right; font-size:16px;">
                                <li class="buttons" style="list-style:none">
                                    <form>
                                        <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=category'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                                </li>
                                </form>
                            </div></h2>

                    <?php } ?>
                </div>
                <div class="content-box">

                    <form onSubmit="return checkcity();" name="FrmTestimonials" id="FrmTestimonials" method="post" action="<?php echo $AbsoluteURLAdmin; ?>manage.php">
                        <input type="hidden" name="chk" id="chk"> 
                        <input type="hidden" name="p" value="category">
                        <?php if ($a == "edit") { ?>
                            <input type="hidden" name="CategoryId" value="<?php echo $CategoryId ?>">
                            <input type="hidden" name="a" value="update">                            
                        <?php } else { ?>
                            <input type="hidden" name="a" value="add"> 
                        <?php } ?>
                        <ul>
                            <li>
                                <label  class="desc">
                                    Category Name<em>*</em>
                                </label>

                                <input type="text" name="Category" id="Category"  class="field text small"  value="<?php echo viewtext($Category); ?>" />

                            </li>
                            <li>
                                <div>
                                <input name="submit" type="submit" class="ui-state-default ui-corner-all ui-button" value="Save" />&nbsp;&nbsp;<input name="button" type="button" class="ui-state-default ui-corner-all ui-button" onclick='if (confirm("Are you sure you want to cancel?\n\nThis will cancel any changes you have made and not yet saved!")) {
            document.location.href = "index.php?p=category"
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