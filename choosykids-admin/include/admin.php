<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#admin").validate({
            rules: {
                FirstName: "required",
                LastName: "required",
                Status:"required",
                AdminRole: "required",
                UserName: {
                    required: true,
                    minlength: 2
                },
                Password: {
                    required: true,
                    minlength: 5
                },
                Email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                FirstName: "Please enter your firstname",
                LastName: "Please enter your lastname",
                UserName: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                Password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                Email: "Please enter a valid email address",
                Status:"Please Select your Status",
                AdminRole: "Please Select Admin Role"                
            }
        });




    });
</script>
<?php
$AdminID = loadVariable("AdminID", 0);
$UserName = loadVariable("UserName", "");
$Password = loadVariable("Password", "");
$FirstName = loadVariable("FirstName", "");
$LastName = loadVariable("LastName", "");
$Email = loadVariable("Email", "");
$IsAdmin = loadVariable("IsAdmin", "");
$AdminRole = loadVariable("AdminRole", "");
$Status = loadVariable("Status", 1);

if ($a == "")
    $a = 'list';

if ($a == "edit") {
    if ($AdminID != 0) {
        $SQL = "select * from admin where AdminID =" . $AdminID;
        $rsAdmin = $objDB->select($SQL);
        if (count($rsAdmin) > 0) {
            $UserName = $rsAdmin[0]["UserName"];
            $Password = $rsAdmin[0]["Password"];
            $FirstName = $rsAdmin[0]["FirstName"];
            $LastName = $rsAdmin[0]["LastName"];
            $Email = $rsAdmin[0]["Email"];
            $AdminRole = $rsAdmin[0]["AdminRole"];
            $Status = $rsAdmin[0]["Status"];
        }
    }
}
if ($a == "list") {
    $SQL = "select * from admin order by LastName,FirstName";
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
        <h1>Admin Registration</h1>
        <span></span>
    </div>
</div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div class="inner-page-title">
             <h2>Registration<div style="float:right; font-size:16px;">
                        <li class="buttons" style="list-style:none">
                            <form>
                                <button type="button" onclick="document.location.href = '<?php echo $AbsoluteURLAdmin; ?>index.php?p=admin_list'" class="ui-state-default ui-corner-all ui-button">Back To List </button>
                        </li>
                        </form>
                    </div></h2>
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
                unset($_SESSION['check']);
                ?>
                        </div>
                    </div>
                        <?php } ?>
                <?php if (isset($_SESSION['success']) && $_SESSION['success'] != '' && $_SESSION['check'] == 'add') { ?>
                    <div class="response-msg inf ui-corner-all">
                        <div>
                            <span>Success Message</span>
                    <?= $_SESSION['success'] ?><?php unset($_SESSION['success']);
                    unset($_SESSION['check']); ?>
                        </div>
                    </div>
<?php } ?>
                        <?php if (isset($_SESSION['error']) && $_SESSION['error'] != '' && $_SESSION['check'] == 'add') { ?>
                    <div class="response-msg inf ui-corner-all">
                        <div>
                            <span>Error Message</span>
                    <?= $_SESSION['error'] ?><?php unset($_SESSION['error']);
                unset($_SESSION['check']); ?>
                        </div>
                    </div>
<?php } ?>
                <form id="admin" method="post" action="<?php echo $AbsoluteURLAdmin ?>manage.php">
                    <input type="hidden" name="p" value="admin">
                    <input type="hidden" name="chk" id="chk"> 
<?php if ($a == "edit") { ?>
                        <input type="hidden" name="AdminID" value="<?php echo $AdminID ?>">
                        <input type="hidden" name="a" value="update"><?php } else { ?>
                        <input type="hidden" name="a" value="add"> 
<?php } ?>
                    <ul>
                        <li>

                            <label  class="desc">
                                Username <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1" onblur="checkUser(this.value)" maxlength="255" type="text" id="UserName" name="UserName" value="<?php echo $UserName ?>" />

                        </li>
                        <span id="useravabilities"></span>
                        <li>

                            <label  class="desc">
                                Password <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1" maxlength="255" type="password" id="Password" name="Password" value="" />

                        </li>
                        <li>
                            <label  class="desc">
                                Firstname <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1" maxlength="255" type="text" id="FirstName" name="FirstName" value="<?php echo $FirstName ?>" />


                        </li>
                        <li>
                            <label  class="desc">
                                Lastname <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1" maxlength="255" type="text" id="LastName" name="LastName" value="<?php echo $LastName ?>" />


                        </li>
                        <li>
                            <label  class="desc">
                                Email <em>*</em>
                            </label>

                            <input class="field text small" tabindex="1" maxlength="255" type="text" id="Email" name="Email" value="<?php echo $Email ?>" style="margin-left:24px;" />

                        </li>
                        <li>
                            <label  class="desc">
                                Admin Role
                            </label>

                            <select name="AdminRole" id="AdminRole" size="1" class="field text small" style="margin-left:-7px;">
                                <option value="">-Select-</option>
                                <option value="Super Admin" <?php if ($AdminRole == 'Super Admin') echo "selected"; ?>>Super Admin</option>
                                <option value="Admin" <?php if ($AdminRole == 'Admin') echo "selected"; ?>>Admin</option>
                            </select>

                        </li>
                        <li>
                            <label  class="desc">
                                Status
                            </label>

                            <select name="Status" id="Status" size="1" class="field text small" <?php if ($_SESSION['session_adminID'] == $AdminID) { ?> disabled="disabled" <?php } ?> style="margin-left:19px;">
                                <option value=""  >-Select-</option>
                                <option value="0" <?php if (!$Status) echo "selected"; ?>>Inactive</option>
                                <option value="1" <?php if ($Status) echo "selected"; ?>>Active</option>
                            </select>
<?php if ($_SESSION['session_adminID'] == $AdminID) { ?>
                                <input type="hidden" name="Status" id="Status" value="<?php echo $Status ?>" />
                            <?php } ?>

                        </li>
                        <li>
                            <div>
                                <input name="submit" type="submit" class="ui-state-default ui-corner-all ui-button" value="Save" />&nbsp;&nbsp;<input name="button" type="button" class="ui-state-default ui-corner-all ui-button" onclick='if (confirm("Are you sure you want to cancel?\n\nThis will cancel any changes you have made and not yet saved!")) {
            document.location.href = "index.php?p=admin_list"
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
