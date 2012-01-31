<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$Drawing_ID=$_POST['Drawing_ID'];
$Batch_Qty=$_POST['Batch_Qty'];
	if(isset($_POST['Batch_Desc']))
	{
	$Batch_Desc=$_POST['Batch_Desc'];	
	} else{$Batch_Desc=date("W")."-".date("Y")."-".$Batch_Qty;}


$query="INSERT INTO Batch_NO ";
$query.="(Drawing_ID, Batch_Desc,Batch_Qty,Batch_Under_Progress) ";
$query.=" VALUES('$Drawing_ID','$Batch_Desc','$Batch_Qty',1);";
print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d\n", mysql_affected_rows());


?>