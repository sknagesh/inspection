<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
	
$baloonno=$_POST['baloonno'];
$basicdimn=$_POST['basicdimn'];
$tollower=$_POST['tollower'];
$tolupper=$_POST['tolupper'];
$instrumentid=$_POST['Instrument_ID'];
$proddimn=$_POST['proddimn'];
$textfield=$_POST['textfield'];
$operationno=$_POST['Operation_NO'];
$len=count($instrumentid);
$query="DELETE FROM InProcess WHERE Operation_ID='$operationno'";
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
$a=0;
while ($a <= $len-1) {
$qry="INSERT INTO InProcess (Baloon_NO,Basic_Dimn,Tol_Lower,Tol_Upper,Instrument_ID,Prod_Dimn,Text_Field,Operation_ID) ";
$qry.="VALUES('$baloonno[$a]','$basicdimn[$a]','$tollower[$a]','$tolupper[$a]','$instrumentid[$a]','$proddimn[$a]','$textfield[$a]','$operationno');";
//print("$qry");
$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
$result=mysql_affected_rows($cxn);
print("<p>No of records updated=$result<p>");
$a++;	
}

	
?>