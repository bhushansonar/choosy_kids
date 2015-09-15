<script type="text/javascript" src="<?php echo $AbsoluteURLAdmin; ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Letters only please");
        
        $("#registration").validate(
                {
                    debug: false,
                    errorClass: "authError",
                    errorElement: "div",
                    rules: {
                        firstname: {
                            
                             required: true,
                            lettersonly: true
                        },
                        username: {
                            required: true,
                            lettersonly: true
                            
                        },
                        lastname: {required: true,lettersonly: true},
                        address: {required: true,},
                        country: {required: true,lettersonly: true},
                        state: {required: true, lettersonly: true},
                        city: {required: true,lettersonly: true},
                        pincode: {
                            required: true,
                            number: true
                        },
                        //gender:"required",
                        email: {
                            required: true,
                            email: true,
                            remote: '<?php $AbsoluteURL ?>manage.php?p=common&a=check',
                        },
                        password: {
                            required: true,
                            minlength: 5
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#password"
                        },
                    },
                    messages: {
                        firstname: "Please enter your firstname",
                        username: "Please enter your username",
                        lastname: "Please enter your lastname",
                        address: "Please enter your address",
                        country: "Please enter your country",
                        state: "Please enter your State",
                        city: "Please enter your city",
                        pincode: "Please enter your pincode",
                        //gender: "Please enter your gender",
                        email: {
                            required: "Please enter your address",
                            email: "Please enter a valid email address",
                            remote: "Email is already Taken",
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Your password must be at least 5 characters long"
                        },
                        confirm_password: {
                            required: "Please Enter Confirm Password",
                            equalTo: "Did Not Match Password"
                        },
                    },
                    highlight: function(element, errorClass) {
                        $(element).removeClass(errorClass);
                    }

                });

    });
</script>
<style>


    div.authError {
        color: #FF0000;
        float: right;
        margin-bottom: 35px;
        margin-right: -18px;
        padding-left: 56px;
        vertical-align: top;
    }
</style>
<style>
    label {
        display: inline-block;
        width: 80px;
    }
</style>
<form name="registration" action="manage.php" method="post" id="registration">
    <input type="hidden" value="registration" name="p" id="p"/>
    <div class="main-container holder">
    <div class="contain">
        <div class="contain_right">
            <div class="h_line1"></div>
            <div class="heading">Registration</div>
            <div class="h_line1"></div>
            <div class="gallery_box1">
                <div class="login_box">

                    User Name:
                    <span>
                        <div class="login_text_box"><input type="text" name="username" id="username"/>

                        </div>
                    </span>
                    FirstName:
                    <span>
                        <div class="login_text_box"><input type="text" name="firstname" id="firstname"/>

                        </div>
                    </span>
                    LastName:
                    <span>
                        <div class="login_text_box">
                            <input type="text" name="lastname" id="lastname"/>

                        </div>
                    </span>
                    Gender:
                    <span>
                        <div style=" margin-bottom: 15px;margin-left: 130px;margin-top: -17px;">
                            <input name="gender"  id="gender" type="radio" value="Male" <?php if ($gender == "Male") { ?> checked="checked"<?php } ?>/>Male
                            <input name="gender" id="gender" type="radio" value="Female" <?php if ($gender == "Female") { ?> checked="checked"<?php } ?>/>Female
                        </div>
                    </span>  
                    E-Mail:
                    <span>
                        <div class="login_text_box"><input type="text" value="" name="email" id="email" />

                        </div>
                    </span>
                    Password:
                    <span>
                        <div class="login_text_box"><input type="password"  name="password" id="password"/>


                        </div>
                    </span>
                    Verify Password:
                    <span>
                        <div class="login_text_box"><input type="password" name="confirm_password" id="confirm_password"/>

                        </div>
                    </span>  

                    Country:

                    <span>
                        <div class="login_text_box">

                            <input type="text" name="country" id="country" value="<?php echo $country ?>" >
                        </div>
                    </span>





                    State:

                    <span>
                        <div class="login_text_box">
                            <input type="text" name="state" id="state" value="<?php echo $state ?>" >
                        </div>
                    </span>



                    City:
                    <span>

                        <div class="login_text_box"><input type="text" name="city" id="city" size="23" value="<?php echo $city; ?>" /> 
                        </div></span>
                    PinCode:

                    <span>

                        <div class="login_text_box"><input type="text" name="pincode" id="pincode" size="23" value="<?php echo $pincode; ?>"/>
                        </div></span>
                    ShippingAddress:
                    <span>
                        <div class="login_text_box"><textarea  name="address" id="address" style="margin-left: 48%; width:250px; margin-top: -39px;"></textarea>

                        </div>
                    </span>
                    <div class="login_submit_button"><input name="button" type="image" src="images/submit.1.png" alt="" style="margin-left:120px;"  /></div>
                </div>      


            </div>
        </div>
        <div class="clear"></div>
    </div>
        </div>
</form>
