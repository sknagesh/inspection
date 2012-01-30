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
$jobno=$_POST['jobno'];
$date=change_date_format_for_db($_POST['date']);
$observation=$_POST['observation'];
$remark=$_POST['remarks'];
$noofdimns=$_POST['noofcomps'];
$i=0;
while($i<$noofdimns)
{
$query="INSERT INTO InprocessDimns (Operation_ID, Batch_ID, Inspector_ID, Job_NO,Job_Date,Dimn_Measured,Remarks) ";
$query.=" VALUES('$operationid','$batchid','$inspectorid','$jobno','$date','$observation[$i]','$remark[$i]');";
//print("<br>$query");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
$result=mysql_affected_rows($cxn);
print("<p>No of records updated=$result<p>");
$i++;
}

	
?>