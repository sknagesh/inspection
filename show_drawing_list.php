<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$custid=$_GET['custid'];
$qry="SELECT * FROM Components WHERE Customer_ID='$custid';";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));


		print("<table border=\"1\" cellspacing=\"1\">");
		print("<tr><th>Drawing ID</th><th>Drawing_NO</th><th>Component Name</th></tr>");
		while ($row = mysql_fetch_assoc($resa))
		{
		print("<tr><td>$row[Drawing_ID]</td><td>$row[Drawing_NO]</td><td>$row[Component_Name]</td></tr>");
 		}
		print("</table>");


?>