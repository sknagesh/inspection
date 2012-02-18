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
	$jobno[$z]=$i['Job_NO'];  //store unique job nos to display in headding	
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
	$qry.="WHERE ip.Operation_ID='$opid' ORDER BY Baloon_NO ASC;";
//print("<br>$qry");
	$j=0;
	$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
	while ($row = mysql_fetch_assoc($resa))  //get all dimensions for thi operation and store them in an array
        		{
	$lrows[$j]=array($row['Baloon_NO'],$row['Dimn_Desc'],$row['Basic_Dimn'],$row['Tol_Lower'].'/'.$row['Tol_Upper'],$row['Instrument_Desc']);		
	$j++;
		        }
//print("<br>lrows");
//print_r($lrows);

$jobq="SELECT DISTINCT(Job_NO) FROM InprocessDimns WHERE Operation_ID='$opid' AND Batch_ID='$batchid';";
$r = mysql_query($jobq, $cxn) or die(mysql_error($cxn));

	$z=0;
	while($i=mysql_fetch_assoc($r))  //loop through each job inspected
	{
	$qry="SELECT InProcess_ID, InprocessDimns.Operation_ID, 
					Basic_Dimn, InProcessDimn_ID, IP_ID, Batch_ID,
					Job_NO, Dimn_Measured FROM InProcess
					LEFT OUTER JOIN InprocessDimns
					ON InProcess.InProcess_ID = InprocessDimns.IP_ID AND InprocessDimns.Job_NO='$i[Job_NO]'  AND Batch_ID='$batchid'
					WHERE InProcess.Operation_ID = '$opid' ORDER BY Baloon_NO ASC";
//		print($qry);
		$res = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		$x=0;
		while($row=mysql_fetch_assoc($res))  //for each job get dimensions measured and store it in an array
		{
			$rrow[$z][$x]=$row['Dimn_Measured'];
			$x+=1;
		}
//	$jobno[$z]=$i['Job_NO'];	
	$z+=1;
	}

//print("<br>rrows<br>");
//print_r($rrow);


if(!isSet($rrow))
{ //if no jobs are measured for this operation
	print("<br>No Dimensions entered for this operation for this batch number");
}
else { 
		print("<table border=\"1\" cellspacing=\"1\" id=\"inprocesstble\">");
		print("<tr><th>Baloon No</th><th>Dimension Desc</th><th>Basic dimn</th>");
		print("<th>Tolerance</th><th>Instrument</th>");
		$z=0;
		while($z<count($jobno))  //append job nos to first row heading
		{
		print("<th>$jobno[$z]</th>");
		$z++;
		}
		print("</tr>");  

		$z=0;
		while($z<count($lrows))  //while no of dimensions defined for this operation
		{
			print("<tr>");
			foreach($lrows[$z] as $x) //print dimension details
			{
			print("<td>$x</td>");
			$x+=1;
			}
			$s=0;
			while($s<count($jobno))  //print relavant dimensions measured
			{
			print("<td>");
			print($rrow[$s][$z]);
			print("</td>");
			$s+=1;
			}
			print("</tr>");   //end of each row
		$z++;		
		}

  		print("</table>");
  
  }        				





	
?>