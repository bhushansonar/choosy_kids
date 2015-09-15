<script language="javascript" type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>js/validator.js"></script>
<link href="<?php echo $AbsoluteURLAdmin; ?>css/ui/ui.login.css" rel="stylesheet" media="all" />
<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>js/ui/ui.tabs.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // Tabs
        $('#tabs').tabs();
    });
</script>
<div id="sub-nav">
    <div class="page-title">
        <h1>Login Area</h1>
        <span>Add your username and password.</span>
    </div>
</div>
<div class="clear"></div>
<div id="page-layout">
    <div id="page-content">
        <div id="page-content-wrapper">
            <div id="tabs">
                <ul>
                    <li><a href="#login">Login</a></li>
                    <li><a href="#forgot">Recover password</a></li>                        
                </ul>
                <div id="login">
                    <?php if ($error) { ?>
                        <div class="response-msg error ui-corner-all">
                            <div><span>In Valid Login</span><?php echo $error; ?></div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['logout']) && $_SESSION['logout'] != '') { ?>
                        <div class="response-msg inf ui-corner-all">
                            <div><span>Logout Message</span><?php echo $_SESSION['logout']; ?><?php unset($_SESSION['logout']); ?></div>
                        </div>
                    <?php } ?>
                    <form name="login" id="login" method="post" action="index.php" onsubmit="return ValidateForm(this);" > 
                        <input type="hidden" name="a" value="login">
                        <ul>
                            <li>
                                <label for="email" class="desc">

                                    Username:
                                </label>
                                <div>
                                    <input name="UserName" tabindex="1" maxlength="255" id="UserName" class="field text full" type="text"/>
                                </div>
                            </li>
                            <li>
                                <label for="password" class="desc">
                                    Password:
                                </label>

                                <div>
                                    <input name="Password" tabindex="2" maxlength="255" id="Password" class="field text full" type="password" />
                                </div>
                            </li>
                            <li class="buttons">
                                <div>
                                    <button class="ui-state-default ui-corner-all float-right ui-button" type="submit">Login</button>
                                </div>
                            </li>
                        </ul>
                        <input type="hidden" name="Validation" id="Validation" value="Field=UserName|Alias=User Name|Validate=Blank^
                               Field=Password|Alias=Password|Validate=Blank">
                    </form>
                </div>
                <script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>js/validate.js"></script>
                <script type="text/javascript">
    $().ready(function() {
        // validate signup form on keyup and submit
        $("#forgotpassword").validate({
            rules: {
                email: "required",
            },
            messages: {
                email: "Please enter your email."
            }
        });
    });

                </script>

                <div id="forgot">
                    <?php if (isset($_SESSION['WrongMsg']) && $_SESSION['WrongMsg'] != '') { ?>
                        <div class="response-msg error ui-corner-all">
                            <div><span>Error Message</span><?php echo $_SESSION['WrongMsg']; ?><?php unset($_SESSION['WrongMsg']); ?></div>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['Success']) && $_SESSION['Success'] != '') { ?>
                        <div class="response-msg inf ui-corner-all">
                            <div><span>Message</span><?php echo $_SESSION['Success']; ?> <?php unset($_SESSION['Success']); ?></div>
                        </div>
                    <?php } ?>
                    <form method="post" name="forgotpassword" id="forgotpassword" action="manage.php">
                        <input type="hidden" name="p" id="p" value="forgotpassword" />
                        <input type="hidden" name="a" id="a" value="forgotpassword" />
                        <ul>
                            <li>
                                <label for="email" class="desc">
                                    Email:
                                </label>
                                <div>
                                    <input type="text" tabindex="1" maxlength="255" value="" class="field text full" name="email" id="email" />
                                </div>
                            </li>
                            <li class="buttons">
                                <div>
                                    <button class="ui-state-default ui-corner-all float-right ui-button" type="submit">Send new password</button>
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div> 