<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
		print("<label for=\"cust\">Select Inspector</label>");
		print("<select name=\"Inspector_ID\" id=\"Inspector_ID\">");
		$querya = "SELECT * FROM Inspector ORDER BY Inspector_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Inspector_ID'].">";
		echo "$row[Inspector_Name]</option>";
 		}
		print("</select>");
?>