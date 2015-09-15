<script language="javascript"type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#login").validate({
            debug: false,
            errorClass: "authError",
            errorElement: "div",
            rules: {
               username:"required",

                password: {
                    required: true,
                    minlength: 7
                },
            },
            messages: {
                email:"This field cannot be empty",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 7 characters long"
                },
            },
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            }
        });




    });
</script>
<?php
$p = loadVariable("p", "");
$a = loadVariable("a", "");
$email = loadVariable("email", "");
$password = loadVariable("password", "");
$username = loadVariable("username", "");
$firstname = loadVariable("firstname", "");
?>
<style>
    div.authError {
        color: #FF0000;
        float: right;
        margin-bottom: 10px;
        margin-right: -18px;
        padding-left: 56px;
        vertical-align: top;
    }
</style>
<form action="manage.php" method="post" name="login" id="login">

    <input type="hidden" name="p" id="p" value="login" />
    <div id="login-error">
        <?php
        if (isset($_GET['error'])) {
            echo $_GET['error'];
        }
        ?>
    </div>
    <div class="main-container holder">
    <div class="contain">
        <div class="contain_right">
            <div class="h_line1"></div>
            <div class="heading">Login</div>
            <div class="h_line1"></div>
            <div class="gallery_box1">

                <div class="login_box">
                    <div class="login_heading">Not yet a member? <a href="index.php?p=registration" style="color:#000000;">Click here to register a new account.</a></div><br />

                   Username:
                    <span>
                        <div class="login_text_box"><input type="text"  name="email" id="email" class="required" />
                        </div>
                    </span>

                    Password:
                    <span>
                        <div class="login_text_box"><input type="password"  name="password" id="password"/>
                        </div>
                    </span>

                    <div class="login_submit_button"><a href="index.php?p=forgot-password" style="margin-left:120px;">I Forgot Password.</a></div>
                    <div class="login_submit_button"><input name="button" type="image" src="images/login.1.png" alt="" style="margin-left:120px;" /></div>
                </div>      
                <font size="2" color="#800000";> <?php
        if (isset($_SESSION["nologin"]) != "") {
            echo $_SESSION["nologin"];
            unset($_SESSION["nologin"]);
            unset($_SESSION["email"]);
            unset($_SESSION["username"]);
            unset($_SESSION["password3"]);
        }
        ?></font>
            </div>
        </div>
        <div class="clear"></div>
    </div>
 </div>
</form>
