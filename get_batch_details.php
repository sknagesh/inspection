<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$drawingid=$_GET['drawingid'];
$qry="SELECT Batch_Desc,Batch_Qty,Heat_Code,Material_Code,Drawing_NO,Component_Name FROM
		Batch_NO as bno
		INNER JOIN Components as comp ON bno.Drawing_ID=comp.Drawing_ID
		 WHERE Batch_Under_Progress='1';";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));

		print("<table border=\"1\" cellspacing=\"1\">");
		print("<tr><th>Drawing_NO</th><th>Component Name</th><th>Batch No.</th><th>Batch Qty</th>
		<th>Heat Code</th><th>Material Code</th></tr>");
		while ($row = mysql_fetch_assoc($resa))
		{
		print("<tr><td>$row[Drawing_NO]</td><td>$row[Component_Name]</td><td>$row[Batch_Desc]</td><td>$row[Batch_Qty]</td>
		<td>$row[Heat_Code]</td><td>$row[Material_Code]</td></tr>");
 		}
		print("</table>");

?>