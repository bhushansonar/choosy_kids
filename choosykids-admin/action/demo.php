<?php
	$p = loadvariable('p','');
	$a = loadvariable('a','');	
	$SettingsID = loadvariable('SettingsID','0');	
	$column_name = loadvariable('column_name','');
	$value = implode(":",$column_name);
	$submit = loadvariable('submit','');
	$s = loadvariable('s','');		
	if($p == 'demo'){
		if($submit == 'Save'){
			if($a == 'update' && $SettingsID != '0'){
						// update
					$SQL="UPDATE ".SETTINGS." set KeyName='demouser',ValueName='".inserttext($value)."' WHERE SettingsID='".$SettingsID."'";
					$objDB->sql_query($SQL);
					$success = "Demo User Restriction Updated";
					$_SESSION['success'] = $success;
					header("Location:".$AbsoluteURL."admin/index.php?p=".$p."&SettingsID=".$SettingsID);		
					exit;		
			}
		}
	}
?>