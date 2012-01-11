<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
    Header("Content-type: text/xml");
      echo "<?xml version='1.0' encoding='ISO-8859-1'?>"; 
	$filter = $_POST['Drawing_NO'];
	$xml = '';
$qry="SELECT * FROM Operation WHERE Drawing_ID=$filter;";
$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
     		$xml = $xml . '<drg>';
     		while ($row = mysql_fetch_assoc($resa))
        		{
        $xml = $xml . '<drawing id="'.$row['Operation_ID'].'">'.$row['Operation_Desc'].'</drawing>';
            }
        
    	  $xml = $xml . '</drg>';
	echo( $xml );
?>