<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$Drawing_ID=$_POST['Drawing_ID'];
$Batch_Qty=$_POST['Batch_Qty'];
if(isSet($_POST['heatcode'])){$Heat_Code=$_POST['heatcode'];}else{$Heat_Code='';}
if(isSet($_POST['mcode'])){$Material_Code=$_POST['mcode'];}else{$Material_Code='';}
	if(isset($_POST['Batch_Desc']))
	{
	$Batch_Desc=$_POST['Batch_Desc'];	
	} else{$Batch_Desc=$Drawing_ID."-".date("Y")."-".date("m")."-".date("d")."-".$Batch_Qty;}


$query="INSERT INTO Batch_NO ";
$query.="(Drawing_ID, Batch_Desc,Batch_Qty,Batch_Under_Progress,Heat_Code,Material_Code) ";
$query.=" VALUES('$Drawing_ID','$Batch_Desc','$Batch_Qty',1,'$Heat_Code','$Material_Code');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d\n", mysql_affected_rows());


?>