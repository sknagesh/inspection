<?php

include('dewdb.inc');

$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening inspection: ".mysql_error());
print("<script src=\"inspection.js\"></script>");
		print("<h2 align=Center>Add New Production Batch No</h2>");
		print("<form name=\"newbatch\" action=\"result.php\" method=\"post\" enctype = \"multipart/form-data\">\n");
		print("<input type=\"hidden\" name=\"Activity_ID\" value=\"batch\">");
		print("<table border=\"0\" width = \"100%\" cellspacing=\"10\">");		
		print("<tr>");	
		print("<td>Customer</td>");		
		print("<td><select name=\"Customer_ID\" id=\"Customer_ID\"onClick=\"return CustomerListOnChange()\">");
		$querya = "SELECT * FROM Customer ORDER BY Customer_ID;";
		$resa = mysql_query($querya, $cxn) or die(mysql_error($cxn));
		while ($row = mysql_fetch_assoc($resa))
		{
		echo "<option value=".$row['Customer_ID'].">";
		echo "$row[Customer_Name]</option>";
 		}
		print("</select></td></tr>");
		print("<tr><td>Drawing No.</td>");
		print("<td><select name=\"Drawing_NO\" id=\"Drawing_NO\">");
		printf('<option value=""></option>');
		print("</select></td></tr>");
		print("<tr><td>Batch No</td>");
		print("<td><input type=\"Text\" name=\"Batch_Desc\" />");
		print("Auto Generate Batch No");
		print("<input type=\"checkbox\" name=\"autobatch\" onClick=\"return AutoBatchClicked(newbatch)\"></td></tr>");
		print("<tr><td>Quantity</td>");
		print("<td><input type=\"Text\" name=\"Batch_Qty\" /></td></tr>");
		print("<td colspan=4 align=\"center\"><input type=\"submit\" name=\"Submit\" value=\"Submit\" />");
		print("</table>");		
		print("</form>");

		print("<script language=\"JavaScript\">");
 		print("new validateForm(document.forms['newbatch']);");
 		print("</script>");


bottomlink();


?>