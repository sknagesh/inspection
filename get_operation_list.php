<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];
if(isSet($_GET['id'])){$id=$_GET[id];}else{$id='';}
$qry="SELECT * FROM Operation WHERE Drawing_ID='$drawingid';";
$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		print("<label for=\"ope\">Select Operation</label>");
		print("<select name=\"Operation_ID$id\" id=\"Operation_ID$id\">");
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Operation_ID'].">";
		echo "$row[Operation_Desc]</option>";
 		}
		print("</select>");


?>