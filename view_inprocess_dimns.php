<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$opid = $_GET['opid'];
$batchid=$_GET['batchid'];


$jobq="SELECT DISTINCT(Job_NO) FROM InprocessDimns WHERE Operation_ID='$opid' AND Batch_ID='$batchid';";
$r = mysql_query($jobq, $cxn) or die(mysql_error($cxn));

	$ipd="<table border=\"1\" cellspacing=\"1\" id=\"inprocesstble\">";
	$ipd.= "<tr><th>Baloon No</th><th>Dimension Desc</th><th>Basic dimn</th>";
	$ipd.='<th>Tol Lo</th><th>Tol Upp</th><th>Instrument</th><th>Job No</th>';

	$jobq="SELECT Job_NO FROM InprocessDimns WHERE Operation_ID='$opid' AND Batch_ID='$batchid';";
	$r = mysql_query($jobq, $cxn) or die(mysql_error($cxn));
while($i=mysql_fetch_assoc($r))
{
$ipd.="<th>Job No $i[Job_NO]</th>";	
}

$ipd.='</tr>';


	$qry="SELECT ipd.Operation_ID, ipd.Batch_ID, IP_ID,Inspector_ID, Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,ip.Instrument_ID,Instrument_Desc,Text_Field,Prod_Dimn,";
	$qry.="Baloon_NO,Job_Date,Job_NO,Dimn_Measured,Remarks FROM InprocessDimns as ipd ";
	$qry.="INNER JOIN InProcess AS ip ON ipd.IP_ID=ip.InProcess_ID ";
	$qry.="INNER JOIN Batch_NO AS bno ON ipd.Batch_ID=bno.Batch_ID ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID ";
	$qry.="INNER JOIN Operation AS op ON ipd.Operation_ID=op.Operation_ID ";
	$qry.="INNER JOIN Components AS comp ON op.Drawing_ID=comp.Drawing_ID ";
	$qry.="WHERE ipd.Operation_ID='$opid' AND ipd.Batch_ID='$batchid';";

	$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
	while ($row = mysql_fetch_assoc($resa))
        		{
	$ipd.="<tr><td>$row[Baloon_NO]</td><td>$row[Dimn_Desc]</td><td>$row[Basic_Dimn]</td>";
	$ipd.="<td>$row[Tol_Lower]</td><td>$row[Tol_Upper]</td><td>$row[Instrument_Desc]</td><td>$row[Job_NO]</td>";
		if($row['Text_Field']==0)
		{
			if($row['Dimn_Measured']=="1")
				{
				$ipd.="<td>With In Tolerance ";
				}else
				{
				$ipd.="<td>Out Of Tolerance ";
				}
		}else
				{
				$ipd.="<td>$row[Dimn_Measured]";
				}
	$ipd.="$row[Remarks]</td></tr>";        				
        			
		        }
		$ipd.='</table>';






	echo( $ipd );
	
	
?>