<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
print_r($_POST);	
$baloonno=$_POST['baloonno'];
$inprocessid=$_POST['InProcess_ID'];
$deldimn=$_POST['deldimn'];
$len=count($inprocessid);
$a=0;
while ($a <= $len-1) {
	if(isset($deldimn[$a]))
	{
$query="DELETE FROM InProcess WHERE InProcess_ID=$inprocessid[$a];";		
//print("$query");		
$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
$result=mysql_affected_rows($cxn);
print("<p>No of dimensions deleted=$result<p>");
	}
$a++;	
}

	
?>