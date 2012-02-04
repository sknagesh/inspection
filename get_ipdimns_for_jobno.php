<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$opid = $_GET['opid'];
$jobno=$_GET['jobno'];
$batchid=$_GET['batchid'];
$ipd="";


if($jobno!="")
{

	$qry="SELECT Dimn_Measured,Remarks,InProcessDimn_ID,InProcess_ID,Baloon_NO, Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,Compulsary_Dimn,Instrument_Desc,Instrument_SLNO,Text_Field,Prod_Dimn ";
	$qry.="FROM InProcess as ip ";
	$qry.="INNER JOIN InprocessDimns AS ipd ON ipd.IP_ID=ip.Inprocess_ID ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID "; 
	$qry.="WHERE ipd.Operation_ID='$opid' AND Batch_ID='$batchid' AND Job_NO='$jobno' ORDER BY Baloon_NO ASC;";

//print($qry);
	$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
	$noofdimns=mysql_num_rows($resa);		

	$ipd="<table border=\"1\" cellspacing=\"1\" id=\"inprocesstble\">";
	$ipd.= "<tr><th>Baloon No</th><th>Dimension Desc</th><th>Basic dimn</th><th>Tol. Lower</th><th>Tol Upper</th>";
	$ipd.='<th>Instrument</th><th>Observation</th><th>Remarks</th></tr>';



			$i=0;
	while ($row = mysql_fetch_assoc($resa))
        		{
    	$ipd.= "<input name=\"ipid[$i]\" id=\"ipid[$i]\" type=\"hidden\" value=\"$row[InProcess_ID]\"/>";
    	$ipd.= "<input name=\"ipdid[$i]\" id=\"ipdid[$i]\" type=\"hidden\" value=\"$row[InProcessDimn_ID]\"/>";
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
		$ipd.= "<td><input name=\"observation[$i]\" id=\"observation[$i]\" type=\"text\" $cd value=\"$row[Dimn_Measured]\"]/></td>";	
		$ipd.= "<input name=\"bd[$i]\" id=\"bd[$i]\" type=\"hidden\" value=\"$row[Basic_Dimn]\"/>";		
		}else
		{
	if($row['Dimn_Measured']=="Dimension OK"){$ok='checked';$notok="";}else{$notok="checked";$ok="";}
		$ipd.= "<td><input type=\"radio\" name=\"observation[$i]\" id=\"observation[$i]\" value=\"Dimension OK\" class=\"required\" $ok/>OK</input>";
		$ipd.= "<input type=\"radio\" name=\"observation[$i]\" id=\"observation[$i]\" value=\"Dimension Not OK\" $notok />Not OK</input></td>";
		}
		$ipd.= "<td><input type=\"text\" name=\"remarks[$i]\" id=\"remarks[$i]\" value=\"$row[Remarks]\"/></td>";
		$i++;
		        }
		$ipd.='</table>';
		$ipd.="<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		$ipd.="<tr><td><input type=\"submit\" id=\"submit\"/></input></td>";
		$ipd.="</table>";
		$ipd.="</form>";
}
else{
	$ipd="No Dimensions to Edit";
}



	echo( $ipd );
	
	
?>