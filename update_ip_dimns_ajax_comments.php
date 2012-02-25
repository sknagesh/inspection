<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$filter = $_GET['opid'];
$ipd="";
if($filter!=0)
{
	$ipd="<table border=\"1\" cellspacing=\"1\" id=\"inprocesstble\">";
	$ipd.= "<tr><th>Baloon No</th><th>Dimn. Desc</th><th>Basic dimn</th><th>Tol. Lower</th><th>Tol Upper</th>";
	$ipd.='<th>Instrument ID</th><th>Text Field?</th><th>Comment 1</th><th>Comment 2</th><th>Production Dimn?</th><th>Compulsary Dimn?</th><th>Delete Dimn?</th></tr>';

	$qry="SELECT * FROM InProcess WHERE Operation_ID=$filter AND Deleted=0;";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
$noofdimns=mysql_num_rows($resa);		




	if($noofdimns==0) //if there are no dimns add ields so that we can add dimensions
	{
	$i=0;
        $ipd.= "<tr><td><input type=\"text\" name=\"baloonno[$i]\" id=\"baloonno[$i]\" class=\"validate[required,custom[float]] text-input\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"dimndesc[$i]\" id=\"dimndesc[$i]\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"basicdimn[$i]\" id=\"basicdimn[$i]\" class=\"validate[required,custom[float]] text-input\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tollower[$i]\" id=\"tollower[$i]\" class=\"validate[funcCall[checktol]] text-input\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tolupper[$i]\" id=\"tolupper[$i]\" class=\"validate[funcCall[checktol]] text-input\" size=\"7\"/></td>";
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
		$ipd.= "<td><input type=\"text\" name=\"comm1[$i]\" id=\"comm1[$i]\" size=\"7\" /></td>";
		$ipd.= "<td><input type=\"text\" name=\"comm2[$i]\" id=\"comm2[$i]\" size=\"7\" /></td>";
		$ipd.= "<td><input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"1\" Checked />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"0\" />No</input></td>";
		$ipd.= "<td><input type=\"radio\" name=\"compulsary[$i]\" id=\"compulsary[$i]\" value=\"1\" Checked />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"compulsary[$i]\" id=\"compulsary[$i]\" value=\"0\" />No</input></td></tr>";
		$ipd.='</table>';
		$ipd.="<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		$ipd.="<tr><td><input type=\"submit\" id=\"submit\"/></input></td>";
    	$ipd.="<td><input type=\"button\" id=\"Add\" class=\"new-button\" name=\"Add\" value=\"Add\" onClick=\"addrow()\"/></input>";
    	$ipd.="<td><input type=\"button\" id=\"Del\" class=\"new-button\" name=\"Delete\" value=\"Delete\" onClick=\"delrow()\"/></input></td></tr></table></form>";
		$ipd.="</table>";
		$ipd.="</form>";
	}
//else show the dimensions already in the database
	else {
			$i=0;
	while ($row = mysql_fetch_assoc($resa))
        		{
        	$tf1="";$tf0="";$pd1="";$pd0="";$cd1="";$cd0="";
        	if($row['Text_Field']==1){$tf1="Checked";} else{$tf0="Checked";};
			if($row['Prod_Dimn']==1){$pd1="Checked";} else{$pd0="Checked";};
			if($row['Compulsary_Dimn']==1){$cd1="Checked";} else{$cd0="Checked";};
        $ipd.= "<tr><td><input type=\"text\" name=\"baloonno[$i]\" id=\"baloonno[$i]\" value=\"$row[Baloon_NO]\" class=\"validate[required,custom[float]] text-input\"size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"dimndesc[$i]\" id=\"dimndesc[$i]\" size=\"7\" value=\"$row[Dimn_Desc]\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"basicdimn[$i]\" id=\"basicdimn[$i]\" value=\"$row[Basic_Dimn]\" class=\"validate[required,custom[float]] text-input\"size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tollower[$i]\" id=\"tollower[$i]\" value=\"$row[Tol_Lower]\" class=\"validate[required,funcCall[checktol]] text-input\" text-input\" size=\"7\"/></td>";
		$ipd.= "<td><input type=\"text\" name=\"tolupper[$i]\" id=\"tolupper[$i]\" value=\"$row[Tol_Upper]\" class=\"validate[required,funcCall[checktol]] text-input\" size=\"7\"/></td>";
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
		$ipd.= "<td><input type=\"text\" name=\"comm1[$i]\" id=\"comm1[$i]\" size=\"7\" value=\"$row[Comment_1]\" /></td>";
		$ipd.= "<td><input type=\"text\" name=\"comm2[$i]\" id=\"comm2[$i]\" size=\"7\" value=\"$row[Comment_2]\" /></td>";
		$ipd.= "<td><input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"1\" $pd1 />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"proddimn[$i]\" id=\"proddimn[$i]\" value=\"0\" $pd0 />No</input></td>";
		$ipd.= "<td><input type=\"radio\" name=\"compulsary[$i]\" id=\"compulsary[$i]\" value=\"1\" $cd1 />Yes</input>";
		$ipd.= "<input type=\"radio\" name=\"compulsary[$i]\" id=\"compulsary[$i]\" value=\"0\" $cd0 />No</input></td>";
		$ipd.= "<td><input type=\"checkbox\" name=\"deldimn[$i]\" id=\"deldimn[$i]\" value=\"1\" /></input></td></tr>";
		$ipd.="<input type=\"hidden\" name=\"InProcess_ID[$i]\" id=\"InProces_ID[$i]\" value=\"$row[InProcess_ID]\"/>";
		$i++;
		        }
		$ipd.='</table>';
		$ipd.="<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		$ipd.="<tr><td><input type=\"submit\" id=\"submit\"/></input></td>";
    	$ipd.="<td><input type=\"button\" id=\"Add\" class=\"new-button\" name=\"Add\" value=\"Add\" onClick=\"addrow()\"/></input>";
    	$ipd.="<td><input type=\"button\" id=\"Del\" class=\"new-button\" name=\"Delete\" value=\"Delete\" onClick=\"delrow()\"/></input></td></tr></table></form>";
		$ipd.="</table>";
		$ipd.="</form>";

}
}
	echo( $ipd );
	
	
?>