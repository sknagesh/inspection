<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$custid=$_GET['custid'];
$qry="SELECT * FROM Components WHERE Customer_ID='$custid';";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		print("<label for=\"draw\">Select Drawing</label>");
		print("<select name=\"Drawing_ID\" id=\"Drawing_ID\">");
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Drawing_ID'].">";
		echo "$row[Component_Name] - $row[Drawing_NO]</option>";
 		}
		print("</select>");

?>