<?php
	echo "subcat^_^";
?>
<?php
/* Member Information */
$p = loadVariable("p",'');
$a=loadVariable("a","list");
$CategoryID=loadVariable("CategoryID","");



//$Company=loadVariable("Company","");
//$Particular=loadVariable("Particular","");


	
	$SQL="select * from subcategory where CategoryID='".$CategoryID."' order by SubCategoryName  ASC";
	$rsSubCate = $objDB->select($SQL);
	
	

?>

 							<select name="SubCategoryID" id="SubCategoryID" size="1" class="field select large">
                            	<option value="">Select</option>
                                 <?php if(empty($rsSubCate)){ ?>
                                 	<option value="">No Sub Category Found</option>
                                  <?php } ?>
                            	<?php for($i=0;$i<count($rsSubCate);$i++){ ?>
                                 <option value="<?=$rsSubCate[$i]["SubCategoryID"]?>" <?php if($rsPro[0]['SubCategoryID']==$rsSubCate[$i]["SubCategoryID"]){ ?> selected="selected" <?php } ?>> <?=$rsSubCate[$i]["SubCategoryName"]?></option>
                                <?php } ?>
                            </select>
                             

