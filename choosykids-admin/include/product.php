<style>
    label {
        display: inline-block;
        width: 80px;
    }
</style>
<script type="text/javascript">

    $(document).ready(function() {

        $('#product_type').change(function() {
            var $product_audio = $("#product_type").val();
            if ($product_audio == 2) {
                $('.get_file_input1').hide('');
                $('.get_file_input').show('');

            }

            else {
                $('.get_file_input1').show('');
                $('.get_file_input').hide('');

            }

        });


    });

</script>
<?php
$p = loadVariable("p", "");
$a = loadVariable("a", "");
$ProductId = loadVariable("ProductId", 0);
$sz = loadVariable("Size", '0');
$CategoryId = loadVariable("CategoryId", '');
$description = loadVariable('description', '');
$product_type = loadVariable('product_type', '');
$audio = loadVariable('audio', '');
$preview_audio = loadVariable('preview_audio', '');
$file = loadVariable('file', '');
$quantity = loadVariable('quantity', '');
$price = loadVariable('price', '');
$productname = loadVariable('productname', '');
$searchName = loadVariable("searchName", "");
$page_title = "product";

if ($a == "")
    $a = 'list';

if ($a == "edit") {
    if ($ProductId != 0) {
        $SQL = "select * from product where status!='-1' AND ProductId =" . $ProductId;
        $rsUser = $objDB->select($SQL);

        if (count($rsUser) > 0) {
            $ProductId = $rsUser[0]["ProductId"];
            $productname = $rsUser[0]["ProductName"];
            $CategoryId = $rsUser[0]["CategoryId"];
            $price = $rsUser[0]["ProductPrice"];
            $productimage = $rsUser[0]['ProductImage'];
            $description = $rsUser[0]['description'];
            $product_type = $rsUser[0]['product_type'];
            $audio = $rsUser[0]['audio'];

            $preview_audio = $rsUser[0]['preview_audio'];
        }
    }
}
if ($a == "list") {
    $SQL = "select * from product where";
    if ($searchName != '') {
        $SQL .= "(ProductName LIKE '%" . $searchName . "%') and ";
    }
    $SQL .= " Status!='-1' order by ProductId ASC";
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
                $header = 'Manage Product';
            }
            ?>
            <h1><?php echo $header ?></h1>
        </div>
    </div>
    <div id="page-layout">
        <div id="page-content">
            <div id="page-content-wrapper">
                <div class="inner-page-title">
                    <h2>Product List<div style="float:right; font-size:16px;">
                            <li class="buttons" style="list-style:none">
                                <form name="search" id="search" method="post" action="">
                                    <input type="text" value="<?= $searchName ?>" name="searchName" id="searchName" placeholder="Product Name" />
                                    <button type="submit" class="ui-state-default ui-corner-all ui-button">Search</button>
                                    <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=product'" class="ui-state-default ui-corner-all ui-button">Reset</button>
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
                                    <th> ProductName</th>
                                        <th>Category</th>
                                    <th>Image</th>
                                    <th> Price</th>
                                    <th>Description</th>
                                    <th style="width:128px">Options</th> 
                                </tr> 
                            </thead> 
                            <tbody> 

                                <?php if (!empty($rsUser)) { ?>
                                    <?php
                                    for ($i = 0; $i < count($rsUser); $i++) {
                                        for ($r = 0; $r < count($rsUser); $r++) {
                                            if ($rsUser[$i]['ProductId'] == $rsUser[$r]['ProductId']) {
                                                ?>
                                                <tr>

                                                                                                                                                                                                                                                                                                            <!--                                                    <td class="center"><input name="multipledel[]" type="checkbox" id="multipledel[]" value="<?php //echo $rsUser[$i]['ProductId']                 ?>"></td> -->
                                                    <td><?php echo viewtext($rsUser[$i]['ProductName']); ?></td>
                                                    <td>
                                                        <?php
                                                        $where = " AND type = 'category' AND status = '1'";
                                                        $rsmcat = $objDB->getDataArray('site_menu', 'menu_id', 'menu_name', 'menu_id', $where);
                                                        echo viewtext($rsmcat[$rsUser[$i]['CategoryId']]);
                                                        ?>
                                            
                                                      
                                            </td>
                                            
                                                  <td>
                                                        <img src="<?php echo $AbsoluteAdminURL; ?>images/Product_Image/<?php echo $rsUser[$i]['ProductImage']; ?>" height="80" width="80"  id="pimage" name="pimage"/>

                                                    </td>

                                            <td><?php echo viewtext($rsUser[$i]['ProductPrice']); ?>
                                            </td>

                                            <td><?php echo viewtext($rsUser[$i]['description']); ?>
                                            </td>

                                            <td>
                                                <a href="<?php echo $AbsoluteURLAdmin; ?>index.php?p=product&a=edit&ProductId=<?php echo $rsUser[$i]['ProductId'] ?>" title="Edit" style="float:left" class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon ui-icon-wrench"></span></a>
                                                <?php if ($_SESSION['session_ProductId'] != $rsUser[$i]['ProductId']) { ?>
                                                    <a id="modal_confirmation_link<?= $i ?>" class="btn_no_text btn ui-state-default ui-corner-all tooltip" href="javascript:void(0);" onclick="remove_row('<?php echo $rsUser[$i]['ProductId'] ?>', '<?php echo ucwords($page_title) ?>', this)" title="Delete"><span class="ui-icon ui-icon-circle-close"></span></a>
                                                    <?php
                                                    if ($rsUser[$i]['status'] == '1') {
                                                        $status_title = "Deactivate";
                                                        $class = "ui-icon-bullet";
                                                    } else {
                                                        $status_title = "Activate";
                                                        $class = "ui-icon-radio-on";
                                                    }
                                                    ?>
                                                    <a title="<?php echo $status_title ?>" style="cursor: pointer" href="javascript:void(0);" onclick="change_status('<?php echo $rsUser[$i]['ProductId'] ?>', '<?php echo ucwords($page_title) ?>', this)"  class="btn_no_text btn ui-state-default ui-corner-all tooltip"><span class="ui-icon <?php echo $class ?>" id="status_button"></span></a>

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

                    <input type="button" class="ui-button float-right ui-state-default ui-corner-all" id="create-user" value="Add Product" onclick="document.location.href = 'index.php?p=product&a=add'" >
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
                productname: "required",
                maincategory: "required",
                price: "required",
                description: "required",
            },
            messages: {
                productname: "Please Enter Product Name",
                maincategory: "Please Select Category",
                price: "Please Enter Price",
                description: "Please Enter Description",
            }
        });

    });
    </script>

    <div id="page-layout">
        <div id="page-content">
            <div id="page-content-wrapper">
                <div class="inner-page-title">
                    <?php if ($a == 'add') { ?>
                        <h2>Add Product<div style="float:right; font-size:16px;">
                                <li class="buttons" style="list-style:none">
                                    <form>
                                        <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=product'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                                </li>
                                </form>
                            </div></h2>
                    <?php } else { ?>
                        <h2>View Product/Edit Product<div style="float:right; font-size:16px;">
                                <li class="buttons" style="list-style:none">
                                    <form>
                                        <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=product'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                                </li>
                                </form>
                            </div></h2>
                    <?php } ?>
                </div>
                <div class="content-box">

                    <form onSubmit="return checkcity();" name="FrmTestimonials" id="FrmTestimonials" method="post" action="<?php echo $AbsoluteURLAdmin; ?>manage.php" enctype="multipart/form-data">
                        <input type="hidden" name="chk" id="chk"> 
                        <input type="hidden" name="p" value="product">
                        <?php if ($a == "edit") { ?>
                            <input type="hidden" name="ProductId" value="<?php echo $ProductId ?>">


                            <input type="hidden" name="a" value="update">                            
                        <?php } else { ?>
                            <input type="hidden" name="a" value="add"> 
                        <?php } ?>


                        <ul>

                            <li>
                                <label class="desc123">
                                    Product Type
                                </label>
                                <?php
                                $str = '';
                                $product_class = "style='display:none'";
                                if ($product_type == 1 || $product_type == 2) {
                                    $str = "Select";
                                    $product_class = "";
                                }

                                $product_opt[''] = 'Select';
                                $product_opt['1'] = 'General';
                                $product_opt['2'] = 'Audio';
                                $attr['name'] = 'product_type';
                                $attr['id'] = 'product_type';
                                $attr['size'] = '1';
                                $attr['class'] = 'field text small';
                                echo dropdown($attr, $product_opt, $product_type);
                                ?>

                            </li>

                            <li>
                                <label  class="desc123">
                                    ProductName<em>*</em>

                                </label>

                                <input name="productname" type="text" class="field text small" id="productname" value="<?php echo viewtext($productname); ?>" />

                            </li>
                            <li>
                                <label  class="desc123">
                                    Category  <em>*</em>

                                </label>

                                <select name="maincategory" id="maincategory" onChange="funGetSubCat(this.value)" class="field text small">
                                    <?php
                                    $where = " AND type = 'category' AND status = '1'";
                                    $rsmcat = $objDB->getDataArray('site_menu', 'menu_id', 'menu_name', 'menu_id', $where);
                                    ?>
                                    <option value="">Select Category</option>
                                    <?php foreach ($rsmcat as $key => $value) { ?>
                                        <option value="<?php echo $key; ?>" <?php if ($CategoryId == $key) { ?> selected="selected" <?php } ?> ><?php echo $value; ?></option>
                                    <?php } ?>
                                </select>

                            </li>
                            <?php
                            $str = '';
                            $audio_class = "";
                            $a_class = "";
                            $a2_class = "";
                            if ($product_type == 1) {
                                $str = "Select";
                                $a2_class = "style='display: none;'";
                                $a_class = "style='display: none;'";
                            } elseif ($product_type == 2) {
                                $str = "Select";
                                $audio_class = "style='display: none;'";
                            }
                            ?>
                            <div <?php echo $audio_class ?>  class="get_file_input1" >
                                <li>

                                    <label  class="desc123" >
                                        ProductImage
                                    </label>

                                    <img src="<?php echo $AbsoluteAdminURL; ?>images/Product_Image/<?php echo $rsUser[0]['ProductImage']; ?>" height="80" width="80"  />

                                    <input  type="file" id="file" name="product_image" class="field text small" style="margin-left:-5px;">



                                </li>
                            </div>

                            <div <?php echo $a_class ?> <?php echo $product_class ?> class="get_file_input">
                                <li>
                                    <label class="desc123" >
                                        Audio:
                                    </label>
                                    <img src="<?php echo $AbsoluteAdminURL; ?>images/UNSET1.jpg" height="80" width="80"  id="pimage" name="pimage"/>
    <?php echo $audio ?>
                                    <input  type="file" id="audio" name="audio" class="field text small" style="margin-left:-5px;">
                                </li>
                            </div>

                            <div <?php echo $a2_class ?> <?php echo $product_class ?>  class="get_file_input">
                                <li>
                                    <label   class="desc123" >
                                        Preview:
                                    </label>
                                    <img src="<?php echo $AbsoluteAdminURL; ?>images/UNSET1.jpg" height="80" width="80"  id="pimage" name="pimage"/>
    <?php echo $preview_audio ?>
                                    <input  type="file" id="priview" name="priview" class="field text small" style="margin-left:-5px;">
                                </li>
                            </div>

                            <li>
                                <label  class="desc123">
                                    Price<em>*</em>

                                </label>

                                <input type="text" name="price" id="price"    value="<?php echo viewtext($price); ?>" class="field text small" />

                            </li>

                            <li>
                                <label  class="desc123">
                                    Description<em>*</em>

                                </label>

                                <textarea class="field text small" tabindex="1"  type="text" id="description" name="description"><?php echo viewtext($description) ?></textarea>

                            </li>


    <?php /* ?><input type='button' class="ui-state-default ui-corner-all ui-button" value='Remove Button' id='removeButton'></div><?php */ ?>
                            <li>
                                <div>
                                    <input name="submit" type="submit" class="ui-state-default ui-corner-all ui-button" value="Save" />&nbsp;&nbsp;<input name="button" type="button" class="ui-state-default ui-corner-all ui-button" onclick='if (confirm("Are you sure you want to cancel?\n\nThis will cancel any changes you have made and not yet saved!")) {
                document.location.href = "index.php?p=product"
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
