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
$jobno=$_POST['Job_NO'];

$qd="SELECT Job_Date FROM InprocessDimns WHERE Batch_ID='$batchid' AND Job_NO='$jobno' AND Operation_ID='$operationid';";
$res = mysql_query($qd, $cxn) or die(mysql_error($cxn));
while($row=mysql_fetch_assoc($res))
{
	$jobdate=$row['Job_Date'];
}

$q="DELETE FROM InprocessDimns WHERE Batch_ID='$batchid' AND Job_NO='$jobno'";
$res = mysql_query($q, $cxn) or die(mysql_error($cxn));

$i=0;
while($i<$noofdimns)
{
	if($observation[$i]!='')
	{
$query="INSERT INTO InprocessDimns (Operation_ID, IP_ID,Batch_ID, Inspector_ID, Job_NO,Job_Date,Dimn_Measured,Remarks) ";
$query.=" VALUES('$operationid','$ipid[$i]','$batchid','$inspectorid','$jobno','$jobdate','$observation[$i]','$remark[$i]');";
//print("<br>$query");
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
$result=mysql_affected_rows($cxn);
print("<p>No of records updated=$result");
	}
$i++;
}

	
?>