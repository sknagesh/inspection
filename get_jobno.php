<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$opid=$_GET['opid'];
$batchid=$_GET['batchid'];
$query="SELECT distinct(Job_NO) FROM InprocessDimns WHERE Operation_ID='$opid' AND Batch_ID='$batchid';";


		print("<label for=\"jobno\">Select Job NO</label>");
		print("<select name=\"Job_NO\" id=\"Job_NO\">");
		$resa = mysql_query($query, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Job_NO'].">";
		echo "$row[Job_NO]</option>";
 		}
		print("</select>");
?>