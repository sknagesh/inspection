<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$filter = $_GET['opid'];
$fai=$_GET['fai'];
$ipd="";
	$ipd="<table border=\"1\" cellspacing=\"1\" id=\"inprocesstble\">";
	$ipd.= "<tr><th>Baloon No</th><th>Dimension Desc</th><th>Basic dimn</th><th>Tol. Lower</th><th>Tol Upper</th>";
	$ipd.='<th>Instrument</th><th>Observation</th><th>Remarks</th></tr>';



if($fai==1)
{
	$qry="SELECT Comment_1,Comment_2,InProcess_ID,Baloon_NO, Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,Compulsary_Dimn,Instrument_Desc,Instrument_SLNO,Text_Field,Prod_Dimn ";
	$qry.="FROM InProcess as ip ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID "; 
	$qry.="WHERE Operation_ID='$filter' AND Deleted!=1 ORDER BY Baloon_NO ASC;";
}
else {
	$qry="SELECT Comment_1,Comment_2,InProcess_ID,Baloon_NO, Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,Compulsary_Dimn,Instrument_Desc,Instrument_SLNO,Text_Field,Prod_Dimn ";
	$qry.="FROM InProcess as ip ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID "; 
	$qry.="WHERE Operation_ID='$filter' AND Prod_Dimn!=0 AND Deleted!=1 ORDER BY Baloon_NO ASC;";
}
//print($qry);
	$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
	$noofdimns=mysql_num_rows($resa);		




	if($noofdimns==0) //if there are no dimns
	{
		$ipd.="There are no Dimensions Defined For This Operations";
	}
		//else show the dimensions already in the database
	else {
			$i=0;
	while ($row = mysql_fetch_assoc($resa))
        		{
    	$ipd.= "<input name=\"ipid[$i]\" id=\"ipid[$i]\" type=\"hidden\" value=\"$row[InProcess_ID]\"/>";
        $ipd.= "<tr><td>$row[Baloon_NO]</td>";
		$ipd.= "<td>$row[Dimn_Desc]</td>";
		$ipd.= "<td>$row[Basic_Dimn]</td>";
		$ipd.= "<td>$row[Tol_Lower]</td>";
		$ipd.= "<input name=\"tl[$i]\" id=\"tl[$i]\" type=\"hidden\" value=\"$row[Tol_Lower]\"/>";
		$ipd.= "<td>$row[Tol_Upper]</td>";
		$ipd.= "<input name=\"tu[$i]\" id=\"tu[$i]\" type=\"hidden\" value=\"$row[Tol_Upper]\"/>";
		$ipd.="<td>$row[Instrument_SLNO], $row[Instrument_Desc]</td>";
	if($row['Compulsary_Dimn']==1){$cd='class="required number"';}else{$cd="";}	
		if($row['Text_Field']==1){
		$ipd.= "<td><input name=\"observation[$i]\" id=\"observation[$i]\" type=\"text\" $cd/></td>";	
		$ipd.= "<input name=\"bd[$i]\" id=\"bd[$i]\" type=\"hidden\" value=\"$row[Basic_Dimn]\"/>";		
		}else
		{
		$ipd.="<td><select name=\"observation[$i]\" id=\"observation[$i]\" >";
		$ipd.="<option value=\"$row[Comment_1]\">$row[Comment_1]</option>";
		$ipd.="<option value=\"$row[Comment_2]\">$row[Comment_2]</option>";
 		$ipd.="</select></td>";
//		$ipd.= "<td><input type=\"radio\" name=\"observation[$i]\" id=\"observation[$i]\" value=\"Dimension OK\" class=\"required\"/>OK</input>";
//		$ipd.= "<input type=\"radio\" name=\"observation[$i]\" id=\"observation[$i]\" value=\"Dimension Not OK\" />Not OK</input></td>";
		}
		$ipd.= "<td><input type=\"text\" name=\"remarks[$i]\" id=\"remarks[$i]\" /></td>";
		$i++;
		        }
		$ipd.='</table>';
		$ipd.="<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		$ipd.="<tr><td><input type=\"submit\" id=\"submit\"/></input></td>";
		$ipd.="</table>";
		$ipd.="</form>";

			}

	echo( $ipd );
	
	
?>