<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
//print_r($_POST);	
$custid=$_POST['Customer_ID'];
$drawingid=$_POST['Drawing_ID'];
$operationid=$_POST['Operation_ID'];
$inspectorid=$_POST['Inspector_ID'];
$batchid=$_POST['Batch_ID'];
$ipid=$_POST['ipid'];
$observation=$_POST['observation'];
$ipdid=$_POST['ipdid'];
$remark=$_POST['remarks'];
$noofdimns=$_POST['noofcomps'];
$i=0;
while($i<$noofdimns)
{
$query="UPDATE InprocessDimns SET Inspector_ID='$inspectorid', Dimn_Measured='$observation[$i]',Remarks='$remark[$i]' ";
$query.=" WHERE InProcessDimn_ID='$ipdid[$i]';";
//print("<br>$query");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
$result=mysql_affected_rows($cxn);
print("<p>No of records updated=$result<p>");
$i++;
}

	
?>