<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);
$batchid=$_POST['Batch_ID'];

$query="UPDATE Batch_NO ";
$query.="SET Batch_Under_Progress='0' ";
$query.=" WHERE Batch_Id='$batchid';";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Updated is: %d\n", mysql_affected_rows());


?>