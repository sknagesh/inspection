<?php
include('dewdb.inc');
$i=$_GET['filter']-1;
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());


        
        $ipd= "<tr><td><input type=\"text\" name=\"baloonno[$i]\" id=\"baloonno[$i]\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"dimndesc[$i]\" id=\"dimndesc[$i]\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"basicdimn[$i]\" id=\"basicdimn[$i]\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tollower[$i]\" id=\"tollower[$i]\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tolupper[$i]\" id=\"tolupper[$i]\" size=\"7\"/></td>";
		$q="select * from Instrument";
		$res = mysql_query($q, $cxn) or die(mysql_error($cxn));
		$ipd.="<td><select name=\"Instrument_ID[$i]\" id=\"Instrument_ID[$i]\" >";
		while ($r = mysql_fetch_assoc($res))
		{
		$ipd.="<option value=\"$r[Instrument_ID]\"";
		 $ipd.=" >\"";
		$ipd.="$r[Instrument_SLNO]-$r[Instrument_Desc]</option>";
 		}
		$ipd.="</select></td>";
		$ipd.= "<td><input type=\"radio\" name=\"textfield[$i]\" id=\"textfield[$i]\" value=\"1\" Checked/>Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"textfield[$i]\" id=\"textfield[$i]\" value=\"0\" />No</input></td>";
		$ipd.= "<td><input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"1\" Checked/>Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"0\" />No</input></td>";
		$ipd.= "<td><input type=\"radio\" name=\"compulsary[$i]\" id=\"compulsary[$i]\" value=\"1\" Checked/>Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"compulsary[$i]\" id=\"compulsary[$i]\" value=\"0\" />No</input></td></tr>";


	echo( $ipd );
	
	
?>