<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$opedesc=$_POST['opdesc'];
$drawingid=$_POST['Drawing_ID'];
$query="INSERT INTO Operation ";
$query.="(Drawing_ID,Operation_Desc) ";
$query.=" VALUES('$drawingid','$opedesc');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d\n", mysql_affected_rows());


?>