<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
$opid = $_GET['opid'];
$jobno=$_GET['jobno'];
$batchid=$_GET['batchid'];
$ipd="";



/*SELECT InProcess_ID, InprocessDimns.Operation_ID, Basic_Dimn, InProcessDimn_ID, IP_ID, Batch_ID, Job_NO, Dimn_Measured
FROM InProcess
LEFT OUTER JOIN InprocessDimns
ON InProcess.InProcess_ID = InprocessDimns.IP_ID AND InprocessDimns.Job_NO=35
WHERE InProcess.Operation_ID = 10*/ 





	$qry="SELECT Comment_1,Comment_2,Dimn_Measured,Remarks,InProcessDimn_ID,InProcess_ID,Baloon_NO, Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,Compulsary_Dimn,Instrument_Desc,Instrument_SLNO,Text_Field,Prod_Dimn,Job_Date ";
	$qry.="FROM InProcess as ip ";
	$qry.="LEFT OUTER JOIN InprocessDimns AS ipd ON ip.InProcess_ID=ipd.IP_ID AND ipd.Job_NO='$jobno' AND Batch_ID='$batchid' ";
	$qry.="INNER JOIN Instrument AS inst ON inst.Instrument_ID=ip.Instrument_ID "; 
	$qry.="WHERE ip.Operation_ID='$opid' AND ip.Deleted!=1 ORDER BY Baloon_NO ASC;";

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
	if($row['Dimn_Measured']==$row['Comment_1']){$cm1="Selected=Selected";$cm2="";}else{$cm1='';$cm2='';}
	if($row['Dimn_Measured']==$row['Comment_2']){$cm2="Selected=Selected";$cm1="";}else{$cm1='';$cm2='';}
		$ipd.="<td><select name=\"observation[$i]\" id=\"observation[$i]\" >";
		$ipd.="<option value=\"$row[Comment_1]\" $cm1>$row[Comment_1]</option>";
		$ipd.="<option value=\"$row[Comment_2]\" $cm2>$row[Comment_2]</option>";
 		$ipd.="</select></td>";
	
		}
		$ipd.= "<td><input type=\"text\" name=\"remarks[$i]\" id=\"remarks[$i]\" value=\"$row[Remarks]\"/></td>";
		$i++;
		        }
		$ipd.='</table>';
		$ipd.="<table border=\"1px\" cellspacing=\"1px\" id=\"bottomtable\">";
		$ipd.="<tr><td><input type=\"submit\" id=\"submit\"/></input></td>";
		$ipd.="</table>";
		$ipd.="</form>";


	echo( $ipd );
	
	
?>