<?php
	$p = loadVariable("p","");
	$a = loadVariable("a","");
	$PID= loadVariable("PID","");
	$id= loadVariable("id","");
	$value= loadVariable("value","");
	$DB= loadVariable("DB","");
	$FIELDSHOW= loadVariable("FIELDSHOW","");
	
	$sql="UPDATE ".PROPERTY." SET ".$id."='".inserttext($value)."' where ID='".$PID."'";
	$rsUpd=$objDB->sql_query($sql);
	
	$SQL="select ".$FIELDSHOW." from ".$DB." where ".$id."='".viewtext($value)."'";
	$rsDB = $objDB->select($SQL);
	
	if($id=="Status"){
		if($rsDB[0][$FIELDSHOW]==0){
			echo "Inactive";
		}elseif($rsDB[0][$FIELDSHOW]==1){
			echo "Active";
		}elseif($rsDB[0][$FIELDSHOW]==2){
			echo "Postpond";
		}elseif($rsDB[0][$FIELDSHOW]==3){
			echo "Canclled";
		}elseif($rsDB[0][$FIELDSHOW]==4){
			echo "Sold to 3rd";
		}elseif($rsDB[0][$FIELDSHOW]==5){
			echo "Sold to Bank";
		}
		
	}
	else{
		echo $rsDB[0][$FIELDSHOW];
	}
	exit;
?>