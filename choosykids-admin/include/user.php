<?php
if (($_GET['id']) && ($_GET['id'] != "")) {
    $userid = $_GET['id'];
    if ($a == "")
        $a = 'list';
    if ($a == "edit") {
        $SQL = "select * from mn_user where mn_user_id =" . $userid;
        $student = $objDB->select($SQL);
        if (count($student) > 0) {
            $displayname = $student[0]["mn_user_display_name"];
            $email = $student[0]["mn_user_email"];
            $phone = $student[0]["mn_user_phone"];
            $address = $student[0]["mn_user_address"];
            $Status = $student[0]["mn_user_status"];
        }
    }
    ?>
    <script src="<?php echo $AbsoluteURLAdmin ?>admin/js/ajax1.js" type="text/javascript"></script>
    <script language="javascript" type="text/javascript">
        function checkUser(userval) {
            var url = "<?php echo $AbsoluteURLAdmin ?>admin/manage.php?p=checkuser";
            url = url + "&a=checkuser&q=" + userval;
            xmlHttp = GetXmlHttpObject(stateChangeHandler);
            xmlHttp_Get(xmlHttp, url);
        }
        function checkcity() {
            if (document.getElementById('chk').value == '0') {
                return false;
            } else {
                return true;
            }
        }
    </script>

    <div id="sub-nav"><div class="page-title">
            <h1>Student Registration</h1>
            <span></span>
        </div>
    </div>
    <div id="page-layout">
        <div id="page-content">
            <div id="page-content-wrapper">
                <div class="inner-page-title">
                    <h2>Registration</h2>
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
                                <?php echo $_SESSION['success'] ?><?php unset($_SESSION['success']);
                        unset($_SESSION['check']); ?>
                            </div>
                        </div>
    <?php } ?>
                    <form onSubmit="return checkcity();" method="post" action="<?php echo $AbsoluteURLAdmin ?>manage.php">
                        <input type="hidden" name="p" value="user">
                        <input type="hidden" name="chk" id="chk"> 
                        <input type="hidden" name="id" value="<?php echo $userid ?>">
    <?php if ($a == "edit") { ?>
                            <input type="hidden" name="AdminID" value="<?php echo $AdminID ?>">
                            <input type="hidden" name="a" value="update"><?php } ?>


                        <ul>

                            <li>
                                <label  class="desc">
                                    Email:
                                </label>
    <?php echo $email; ?>

                            </li>

                            <li>
                                <label  class="desc">
                                    Display Name
                                </label>

                                <input class="field text small" tabindex="1" maxlength="255" type="text" id="small-input" name="FirstName" value="<?php echo $displayname ?>" />


                            </li>

                            <li>
                                <label  class="desc">
                                    Phone No
                                </label>

                                <input class="field text small" tabindex="1" maxlength="255" type="text" id="small-input" name="phone" value="<?php echo $phone ?>" />


                            </li>

                            <li>
                                <label  class="desc">
                                    Address
                                </label>

                                <input class="field text small" tabindex="1" maxlength="255" type="text" id="small-input" name="address" value="<?php echo $address ?>" />


                            </li>

                            <li>
                                <label  class="desc">
                                    Status
                                </label>

                                <select name="Status" id="Status" size="1" class="field text small" <?php if ($_SESSION['session_adminID'] == $userid) { ?> disabled="disabled" <?php } ?> style="margin-left:19px;">

                                    <option value="0" <?php if (!$Status) echo "selected"; ?>>Inactive</option>
                                    <option value="1" <?php if ($Status) echo "selected"; ?>>Active</option>
                                </select>
                                <?php if ($_SESSION['session_adminID'] == $userid) { ?>
                                    <input type="hidden" name="Status" id="Status" value="<?php echo $Status ?>" />
    <?php } ?>

                            </li>
                            <li>
                                <div>
                                    <input name="submit" type="submit" class="ui-state-default ui-corner-all ui-button" value="Save" />&nbsp;&nbsp;<input name="button" type="button" class="ui-state-default ui-corner-all ui-button" onclick='if (confirm("Are you sure you want to cancel?\n\nThis will cancel any changes you have made and not yet saved!" )) { document.location.href ="index.php?p = user_list"}' value="Cancel" />
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
<?php
}?>