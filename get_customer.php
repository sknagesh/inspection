<?php
include('dewdb.inc');
if(isSet($_GET['id'])){$id=$_GET[id];}else{$id='';}
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
		print("<label for=\"cust\">Select Customer</label>");
		print("<select name=\"Customer_ID$id\" id=\"Customer_ID$id\">");
		$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Customer_ID'].">";
		echo "$row[Customer_Name]</option>";
 		}
		print("</select>");
?>