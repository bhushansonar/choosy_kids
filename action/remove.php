<?php
$ProductId=loadVariable("ProductId","");
$a=loadVariable("a","");

if($a == 'delete'){
	$No=loadVariable("No","");
	$sql1="delete from shoppingcart where ProductId='".$ProductId."'";
	mysql_query($sql1);
	$sql="select * from shoppingcart";
	$rspro=$objDB->select($sql);
	echo "DELETE^_^".$No."^_^".$_REQUEST['totid']."^_^".count($rspro);
} elseif($a == 'update') {
	$Qyt=loadVariable("Qyt","");
	$sql="UPDATE shoppingcart SET Quantity='".$Qyt."' where ProductId='".$ProductId."'";
	mysql_query($sql);
}
?>


                                             
                                       		