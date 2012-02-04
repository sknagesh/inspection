<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$opid = $_GET['opid'];
$batchid=$_GET['batchid'];


$jobq="SELECT DISTINCT(Job_NO) FROM InprocessDimns WHERE Operation_ID='$opid' AND Batch_ID='$batchid';";
$r = mysql_query($jobq, $cxn) or die(mysql_error($cxn));

	$z=0;
	while($i=mysql_fetch_assoc($r))
	{
	$jobno[$z]=$i['Job_NO'];	
	$z++;
	}
//print("<br>jobno");
//print_r($jobno);


	$jobq="SELECT Job_NO FROM InprocessDimns WHERE Operation_ID='$opid' AND Batch_ID='$batchid';";
	$r = mysql_query($jobq, $cxn) or die(mysql_error($cxn));

	$qry="SELECT ip.Operation_ID, Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,ip.Instrument_ID,Instrument_Desc,";
	$qry.="Baloon_NO FROM InProcess as ip ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID ";
	$qry.="INNER JOIN Operation AS op ON ip.Operation_ID=op.Operation_ID ";
	$qry.="INNER JOIN Components AS comp ON op.Drawing_ID=comp.Drawing_ID ";
	$qry.="WHERE ip.Operation_ID='$opid' ORDER BY Baloon_NO;";
//print("<br>$qry");
	$j=0;
	$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
	while ($row = mysql_fetch_assoc($resa))
        		{
	$lrows[$j]=array($row['Baloon_NO'],$row['Dimn_Desc'],$row['Basic_Dimn'],$row['Tol_Lower'].'/'.$row['Tol_Upper'],$row['Instrument_Desc']);		
	$j++;
		        }
//print("<br>lrows");
//print_r($lrows);

  	$qry="SELECT Baloon_NO,Group_concat(Dimn_Measured order by Job_NO) as dimensions FROM InprocessDimns as ipd ";
	$qry.="LEFT JOIN InProcess AS ip ON ipd.IP_ID=ip.InProcess_ID ";
	$qry.="INNER JOIN Batch_NO AS bno ON ipd.Batch_ID=bno.Batch_ID ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID ";
	$qry.="INNER JOIN Operation AS op ON ipd.Operation_ID=op.Operation_ID ";
	$qry.="INNER JOIN Components AS comp ON op.Drawing_ID=comp.Drawing_ID ";
	$qry.="WHERE ipd.Operation_ID='$opid' AND ipd.Batch_ID='$batchid' GROUP BY Baloon_NO;";
	$job = mysql_query($qry, $cxn) or die(mysql_error($cxn));
$z=0;
	while($jobv=mysql_fetch_assoc($job))
	{
				$rrow[$z]=explode(",",$jobv['dimensions']);
//			print("$jobv[Baloon_NO] - $jobv[dimensions]<br>");
	$z+=1;
	}

//print("<br>rrows<br>");
//print_r(array_values($rrow));
if(!isSet($rrow))
{
	$ipd="<br>No Dimensions entered for this operation for this batch number";
}
else {
	$ipd="<table border=\"1\" cellspacing=\"1\" id=\"inprocesstble\">";
	$ipd.= "<tr><th>Baloon No</th><th>Dimension Desc</th><th>Basic dimn</th>";
	$ipd.='<th>Tolerance</th><th>Instrument</th>';
	$z=0;
	while($z<count($jobno))
	{
	$ipd.="<th>$jobno[$z]</th>";
	$z++;
	}
	$ipd.='</tr>';  



	$z=0;
	while($z<count($lrows))
	{
		$ipd.="<tr>";
		foreach($lrows[$z] as $x)
		{
		$ipd.="<td>$x</td>";
		}

		foreach($rrow[$z] as $x)
		{
		$ipd.="<td>$x</td>";
		}

	
	$ipd.="</tr>";
	$z++;
	}
  		$ipd.='</table>';
  
  }        				




	echo( $ipd );
	
	
?>