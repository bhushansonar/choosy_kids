<?php
$p = loadVariable("p","");
$a = loadVariable("a","");
$CategoryId = loadVariable("CategoryId",0);
$Category = loadVariable('Category','');
$s = loadVariable("s","");

if($p == "category")
{	
	if($a == "add")
	{
		$SQL = "INSERT INTO category SET Category='".inserttext($Category)."'";
		$inserttextproperty = $objDB->insert($SQL);
		$success = "Category Added SuccessFully";
			$_SESSION['success'] = $success;
			$_SESSION['check'] = 'add';
		header("Location:".$AbsoluteURLAdmin."index.php?p=".$p);
		exit;
	}
		
		elseif($a == "update")
		{
		$SQL = "UPDATE category SET Category='".inserttext($Category)."' where CategoryId ='".$CategoryId."'";
		$updatetextproperty=$objDB->sql_query($SQL);		
		$success = "Category Updated SuccessFully";
			$_SESSION['success'] = $success;
			$_SESSION['check'] = 'add';
		header("Location:".$AbsoluteURLAdmin."index.php?p=".$p);
		exit;	
		}
		
	
	if ($a == "muldelete") //code for deleting multiple data form the table
		{
	  		$multipledel = loadvariable('multipledel','');
			$todo = loadvariable('todo','');
		if($multipledel != '')
		{
			if(count($multipledel)>0)
			{	
				for($i=0;$i<count($multipledel);$i++)
				{
					$del_id = $multipledel[$i];
					//echo $del_id.'<br/>';
					if($todo == "delete"){
						$SQL="delete from category where CategoryId ='".$del_id."' ";
						$rsExtPro = $objDB->sql_query($SQL);
					}else{
						$erro = "Something Wrong.";
					}
				}					
			}
			$_SESSION['success'] = "<span>Selected Category Deleted.</span>";
			$_SESSION['check'] = 'add';
			header("Location:".$AbsoluteURLAdmin."index.php?p=".$p);
			exit;
		}
		else
		{
			$success = "Selected atleast one Category";
			$_SESSION['error'] = $success;
			$_SESSION['check'] = 'add';
			header("Location:".$AbsoluteURLAdmin."index.php?p=".$p);
			exit;
		}
	}
}
?>