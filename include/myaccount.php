<?php

if(isset($_SESSION["email"])=="")
	{
		Header("Location: index.php?p=login");
	}
	else{?>
<?php 

error_reporting(0);

$email=loadvariable("email","");
$sql="select * from user where email='".$_SESSION["email"]."'";
$rsuser=$objDB->select($sql);

for($i=0;$i<count($rsuser);$i++)
{
	$firstname=$rsuser[$i]['firstname'];
	$lastname=$rsuser[$i]['lastname'];
	$gender=$rsuser[$i]['gender'];
	$bdate=explode("-",$rsuser[$i]['bdate']);
	$mobile=$rsuser[$i]['mobile'];
	$pics=$rsuser[$i]['pics'];
	
	$_SESSION["image"]=$pics;
	
}
		
?>
<form action="manage.php" name="pinfo" enctype="multipart/form-data" method="post">
<input type="hidden" value="myaccount" name="p" id="p">
<div class="contain">
                		<?php include("include/accountsidebar.php") ?>
                        <div class="contain_right">
<div class="h_line1"></div>
                   		  <div class="heading">Personal Information</div>
                          <div class="h_line1"></div>
                                <div class="gallery_box">
                                                
    FirstName:
    <span id="spryfname">
    <div class="login_text_box"><input type="text" name="firstname" size="23" value="<?php echo $firstname;?>"/>
    <span class="textfieldRequiredMsg" style="margin-left:120px;">*FirstName</span>
    </div>
    </span>
 LastName:
 <span id="sprylname">
 <div class="login_text_box"><input type="text" name="lastname" size="23" value="<?php echo $lastname;?>"/>
 <span class="textfieldRequiredMsg" style="margin-left:120px;">*LastName</span>   
 </div></span>
                                                <span style="margin-left:0px;;">Gender:</span>
    <span id="RadioGender">
    <div style=" margin-left:120px;"><input name="gender" type="radio" value="Male" <?php if($gender=="Male"){	?> checked="checked"<?php }?>/>Male</div>
                                                 <div style="  margin-left:120px;">
<input name="gender" type="radio" value="Female" <?php if($gender=="Female"){?> checked="checked"<?php }?>/>Female
<span class="radioRequiredMsg" style="margin-left:120px;">Plese select the Gender </span> 
</div></span><br>                                                
                                                Birth-Date:
        <span id="sprydate">                                          
	<select name='date'  style="margin-left:30px;">
     <option value="">Date</option>
	<?php for ( $date=1; $date <=31; $date++){?>
		<option value="<?php echo $date?>" <?php if($date == $bdate[2]){?> selected <?php }?>><?php echo $date?></option>
	 <?php }?>
    </select>
    <span class="selectRequiredMsg" >Date*</span></span>
    
    <span id="sprymonth"> 
    <select name='month'>
     <option value="">Month</option>
     <option value="01" <?php if($bdate[1]=="01"){?> selected <?php }?>>Jan</option>
     <option value="02" <?php if($bdate[1]=="02"){?> selected <?php }?>>Feb</option>
     <option value="03" <?php if($bdate[1]=="03"){?> selected <?php }?>>Mar</option>
     <option value="04" <?php if($bdate[1]=="04"){?> selected <?php }?>>Apr</option>
     <option value="05" <?php if($bdate[1]=="05"){?> selected <?php }?>>May</option>
     <option value="06" <?php if($bdate[1]=="06"){?> selected <?php }?>>Jun</option>
     <option value="07" <?php if($bdate[1]=="07"){?> selected <?php }?>>July</option>
     <option value="08" <?php if($bdate[1]=="08"){?> selected <?php }?>>Aug</option>
     <option value="09" <?php if($bdate[1]=="09"){?> selected <?php }?>>Sept</option>
     <option value="10" <?php if($bdate[1]=="10"){?> selected <?php }?>>Oct</option>
     <option value="11" <?php if($bdate[1]=="11"){?> selected <?php }?>>Nov</option>
     <option value="12" <?php if($bdate[1]=="12"){?> selected <?php }?>>Dec</option>
    </select>
    <span class="selectRequiredMsg">Month*</span></span>
    
    <span id="spryyear"> 
    <select name='year'>
     <option value="">Year</option>
    	<?php for ( $year=1950; $year <=2012; $year++) {?>
		<option value="<?php echo $year ?>" <?php if($year == $bdate[0]) { ?> selected <?php } ?>><?php echo $year ?></option>
		<?php } ?>
		</select>
        <span class="selectRequiredMsg">Year*</span></span>
            <br><br>
            
    Mobile Number:
    <span id="sprymobile">
    <div class="login_text_box"><input type="text" name="mobile" size="23" value="<?php echo $mobile;?>"/>
    <span class="textfieldRequiredMsg" style="margin-left:120px;">Enter Mobile Number</span>
                          <span class="textfieldInvalidFormatMsg" style="margin-left:120px;">Invalid Mobile Number</span>
    </div></span>
                                                Profile Picture:
                                                <img src="<?php echo $AbsoluteURL;?>uploaded/<?php echo $pics;?>" height="80" width="80" style="margin-left:10px;"/><br>
    <div class="login_text_box"><input type="file" name="file"  id="file"/> </div>
                                                
                                                <div class="login_submit_button"><input name="button" type="image" src="images/save_changes.jpg" alt=""  style="margin-left:120px;"/></div>
                                        </div>      
                                        
                                </div>
                        </div>
                        <div class="clear"></div>
                </div><br />
                </form>
  <script type="text/javascript">



var radiogender  = new Spry.Widget.ValidationRadio("RadioGender",{validateOn:["blur", "change"]});

var spryfname = new Spry.Widget.ValidationTextField("spryfname","none",{ validateOn:["change"]});

var sprylname = new Spry.Widget.ValidationTextField("sprylname","none",{ validateOn:["change"]});

var spraymobile = new Spry.Widget.ValidationTextField("sprymobile", "phone_number", {format:"phone_custom", pattern:"0000000000", validateOn:["blur"]});

var sprydate = new Spry.Widget.ValidationSelect("sprydate", {validateOn:["change"]});

var sprymonth = new Spry.Widget.ValidationSelect("sprymonth", {validateOn:["change"]});

var spryyear = new Spry.Widget.ValidationSelect("spryyear", {validateOn:["change"]});



</script> <?php  } ?>