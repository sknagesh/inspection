<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
    header("Content-type: text/xml");
	$filter = $_GET['filter'];
$ipd="";
	if($filter!=0)
{
	$ipd= "<tr><th>Baloon No</th><th>Basic dimn</th><th>Tol. Lower</th><th>Tol Upper</th>";
	$ipd.='<th>Instrument ID</th><th>Text Field?</th><th>Production Dimn?</th><th>Delete Dimn?</th></tr>';
	$qry="SELECT * FROM InProcess WHERE Operation_ID=$filter;";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
$noofdimns=mysql_num_rows($resa);		




	if($noofdimns==0) //if there are no dimns add ields so that we can add dimensions
	{
	$i=0;
        $ipd.= "<tr><td><input type=\"text\" name=\"baloonno[$i]\" id=\"baloonno[$i]\" class=\"required number\" /></td>";
		$ipd.= "<td><input type=\"text\" name=\"basicdimn[$i]\" id=\"basicdimn[$i]\" class=\"required\" /></td>";
		$ipd.= "<td><input type=\"text\" name=\"tollower[$i]\" id=\"tollower[$i]\" /></td>";
		$ipd.= "<td><input type=\"text\" name=\"tolupper[$i]\" id=\"tolupper[$i]\" /></td>";
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
		$ipd.= "<td><input type=\"radio\" name=\"textfield[$i]\" id=\"textfield[$i]\" value=\"1\" Checked />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"textfield[$i]\" id=\"textfield[$i]\" value=\"0\" />No</input></td>";
		$ipd.= "<td><input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"1\" Checked />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"0\" />No</input></td></tr>";
		$ipd.='</table>';
		$ipd.= "<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		$ipd.= '<tr><td><input type="submit" id="submit"/></input></td>';
    	$ipd.='<td><input type="button" id="Add" class="new-button" name="Add" value="Add" onClick="addrow()"/></input></td></tr></table></form>';
		$ipd.='<div id="footer"><label for="baloonno[$i]" generated="true" class="error"><label for="basicdimn[$i]" generated="true" class="error"></label></div>';
	


	}
//else show the dimensions already in the database
	else {
			$i=0;
	while ($row = mysql_fetch_assoc($resa))
        		{
        	$tf1="";$tf0="";$pd1="";$pd0="";
        	if($row['Text_Field']==1){$tf1="Checked";} else{$tf0="Checked";};
			if($row['Prod_Dimn']==1){$pd1="Checked";} else{$pd0="Checked";};
        $ipd.= "<tr><td><input type=\"text\" name=\"baloonno[$i]\" id=\"baloonno[$i]\" value=\"$row[Baloon_NO]\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"basicdimn[$i]\" id=\"basicdimn[$i]\" value=\"$row[Basic_Dimn]\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tollower[$i]\" id=\"tollower[$i]\" value=\"$row[Tol_Lower]\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tolupper[$i]\" id=\"tolupper[$i]\" value=\"$row[Tol_Upper]\"/></td>";
		$q="select * from Instrument";
		$res = mysql_query($q, $cxn) or die(mysql_error($cxn));
		$ipd.="<td><select name=\"Instrument_ID[$i]\" id=\"Instrument_ID[$i]\" >";
		while ($r = mysql_fetch_assoc($res))
		{
		$ipd.="<option value=\"$r[Instrument_ID]\"";
		 if($r['Instrument_ID']==$row['Instrument_ID']){$ipd.="Selected=Selected";}
		 $ipd.=" >\"";
		$ipd.="$r[Instrument_SLNO]-$r[Instrument_Desc]</option>";
 		}
		$ipd.="</select></td>";
		$ipd.= "<td><input type=\"radio\" name=\"textfield[$i]\" id=\"textfield[$i]\" value=\"1\" $tf1 />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"textfield[$i]\" id=\"textfield[$i]\" value=\"0\" $tf0 />No</input></td>";
		$ipd.= "<td><input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"1\" $pd1 />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"0\" $pd0 />No</input></td>";
		$ipd.= "<td><input type=\"checkbox\" name=\"deldimn[$i]\" id=\"deldimn[$i]\" value=\"1\" /></input></td></tr>";
		$ipd.="<input type=\"hidden\" name=\"InProcess_ID[$i]\" id=\"InProces_ID[$i]\" value=\"$row[InProcess_ID]\"/>";
		$i++;
		        }
		$ipd.='</table>';
		$ipd.= "<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		  $ipd.= '<tr><td><input type="submit" id="submit"/></input></td>';
    	  $ipd.='<td><input type="button" id="Add" class="new-button" name="Add" value="Add" onClick="addrow()"/></input></td>';
    	  $ipd.='<td><input type="button" id="Delete" name="Delete" value="Delete" onClick="delrow()"/></input></td>';
    	  $ipd.='</tr></table></form>';
		  $ipd.='<div id="footer"></div>';

}
}
	echo( $ipd );
	
	
?>