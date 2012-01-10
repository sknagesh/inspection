<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
		print("<script src=\"jquery.js\"></script>");
//		print("<script src=\"jquery.validate.js\"></script>");
		print("<script src=\"inspection.js\"></script>");
		print("<h2 align=Center>Add Inprocess Dimensions To An Operation</h2>");
		print("<form name=\"add_ip_dimn\" id=\"add_ip_dimn\" action=\"update_ip_dimns_ajax.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
		print("<tr>");	
		print("<td>Customer</td>");		
		print("<td><select name=\"Customer_ID\" id=\"Customer_ID\">");
		$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Customer_ID'].">";
		echo "$row[Customer_Name]</option>";
 		}
		print("</select></td>");
		print("<td>Drawing No.</td>");
		print("<td><select name=\"Drawing_NO\" id=\"Drawing_NO\">");
		printf('<option value=""></option>');
		print("</select></td>");
		print("<td>Operation No.</td>");
		print("<td><select name=\"Operation_NO\" id=\"Operation_NO\" >");
		printf('<option value=""></option>');
		print("</select></td></tr>");		
		print("</table>");
		print("<table border=\"1px\" cellspacing=\"1px\" id=\"inprocesstble\">");
		print("<div id=\"ipdimns\"></div>");		
		print("</form>");
		print("<div id=\"footer\"></div>");
		print("</div>");


?>