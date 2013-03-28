<?php
include('dewdb.inc');

$cid1=$_POST['Customer_ID1'];
$cid2=$_POST['Customer_ID2'];

$did1=$_POST['Drawing_ID1'];
$did2=$_POST['Drawing_ID2'];

$oid1=$_POST['Operation_ID1'];
$oid2=$_POST['Operation_ID2'];
  
 
 
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());


$query="SELECT * FROM InProcess WHERE Operation_ID=$oid1;";

$res = mysql_query($query, $cxn) or die(mysql_error($cxn));
$noofdimn=mysql_affected_rows();

$query2="SELECT * FROM InProcess WHERE Operation_ID=$oid2;";
$resd = mysql_query($query2, $cxn) or die(mysql_error($cxn));
$noofdimnd=mysql_affected_rows();




if($noofdimn!=0 && $noofdimnd==0)
{
$n=0;
		while ($row = mysql_fetch_assoc($res))
		{
$q="INSERT INTO InProcess (Operation_ID,Baloon_NO,Basic_Dimn,Dimn_Desc,Tol_Lower,Tol_Upper,Instrument_ID,
	 Text_Field,Prod_Dimn,Comment_1,Comment_2,Compulsary_Dimn)
	 VALUES('$oid2','$row[Baloon_NO]','$row[Basic_Dimn]','$row[Dimn_Desc]',
	 '$row[Tol_Lower]','$row[Tol_Upper]','$row[Instrument_ID]','$row[Text_Field]','$row[Prod_Dimn]',
	 '$row[Comment_1]','$row[Comment_2]','$row[Compulsary_Dimn]');";
	 
	 print("$q<br>");
$resdd = mysql_query($q, $cxn) or die(mysql_error($cxn));

	 $n+=mysql_affected_rows();
	 
	 
 		}

	print("Total $n Dimensions Copied");
	
}else{
		print("ERROR: There are $noofdimn in Source and $noofdimnd Dimensions in Destination already Defined");
}


?>