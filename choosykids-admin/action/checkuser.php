<?php

	$a=loadVariable("a","");
	$UserName=loadVariable("q","");
	$UserName= trim($UserName);
	$ScreenName=loadVariable("r","");
	$ScreenName= trim($ScreenName);
	$CityName=loadVariable("s","");
	$CityName= trim($CityName);
	$CategoryName=loadVariable("w","");
	$CategoryName= trim($CategoryName);
	$DealSourceName=loadVariable("t","");
	$DealSourceName= trim($DealSourceName);
	if($a == "checkuser"){
		if($UserName!=''){
			$SQL = "SELECT AdminID from admin WHERE UserName='".$UserName."'";
			$rsRes=$objDB->select($SQL);
			
			if(count($rsRes)==0){
				echo "CHK_USER^_^<span style='color:#00CC00'>Available</span>";
				exit;
			} else {
				echo "CHK_USER^_^<span style='color:#FF0000'>Not Available</span>^_^1";
				exit;
			}
		} else {
			echo "CHK_USER^_^";
			exit;
		}
	}
	if($a == "checkscreen"){
		if($ScreenName!=''){
			$SQL = "SELECT MemberID from registration WHERE ScreenName='".$ScreenName."'";
			$rsRes1=$objDB->select($SQL);
			
			if(count($rsRes1)==0){
				echo "CHK_SCREEN_NAME^_^<span style='color:#00CC00'>Available</span>";
				exit;
			} else {
				echo "CHK_SCREEN_NAME^_^<span style='color:#FF0000'>Not Available</span>^_^1";
				exit;
			}
		} else {
			echo "CHK_SCREEN_NAME^_^";
			exit;
		}
	}
	if($a == "checkcity"){
		if($CityName!=''){
			$SQL = "SELECT CityID from city WHERE CityName='".$CityName."'";
			$rsRes2=$objDB->select($SQL);
			
			if(count($rsRes2)==0){
				echo "CHK_CITY_NAME^_^<span style='color:#00CC00'>Available</span>";
				exit;
			} else {
				echo "CHK_CITY_NAME^_^<span style='color:#FF0000'>Not Available</span>^_^1";
				exit;
			}
		} else {
			echo "CHK_CITY_NAME^_^";
			exit;
		}
	}
	if($a == "checkcategory"){
		if($CategoryName!=''){
			$SQL = "SELECT CategoryID from category WHERE CategoryName='".$CategoryName."'";
			$rsRes2=$objDB->select($SQL);
			
			if(count($rsRes2)==0){
				echo "CHK_CATEGORY_NAME^_^<span style='color:#00CC00'>Available</span>";
				exit;
			} else {
				echo "CHK_CATEGORY_NAME^_^<span style='color:#FF0000'>Not Available</span>^_^1";
				exit;
			}
		} else {
			echo "CHK_CATEGORY_NAME^_^";
			exit;
		}
	}
	if($a == "checkdealsource"){
		if($DealSourceName!=''){
			$SQL = "SELECT DealSourceID from dealsource WHERE DealSourceName='".$DealSourceName."'";
			$rsRes2=$objDB->select($SQL);
			
			if(count($rsRes2)==0){
				echo "CHK_DEALSOURCE_NAME^_^<span style='color:#00CC00'>Available</span>";
				exit;
			} else {
				echo "CHK_DEALSOURCE_NAME^_^<span style='color:#FF0000'>Not Available</span>^_^1";
				exit;
			}
		} else {
			echo "CHK_DEALSOURCE_NAME^_^";
			exit;
		}
	}
?>