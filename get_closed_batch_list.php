<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];
$qry="SELECT * FROM Batch_NO WHERE Drawing_ID='$drawingid' AND Batch_Under_Progress='0';";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		print("<label for=\"draw\">Select Batch No</label>");
		print("<select name=\"Batch_ID\" id=\"Batch_ID\">");
		print("<option value=\"\">Select Batch No</option>");
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Batch_ID'].">";
		echo "$row[Batch_Desc]</option>";
 		}
		print("</select>");

?>