<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$partno=$_POST['partno'];
$partname=$_POST['partname'];
$custid=$_POST['Customer_ID'];
$query="INSERT INTO Components ";
$query.="(Customer_ID, Drawing_NO,Component_Name) ";
$query.=" VALUES('$custid','$partno','$partname');";
//print("<br>Query is '$query'");
$result = mysql_query($query, $cxn) or die(mysql_error($cxn));
printf("No of Records Added is: %d\n", mysql_affected_rows());


?>