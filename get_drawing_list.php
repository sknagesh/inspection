<?php
include('dewdb.inc');
$cxn = mysql_connect($dewhost,$dewname,$dewpswd) or die(mysql_error());
mysql_select_db('Inspection',$cxn) or die("error opening db: ".mysql_error());
    header("Content-type: text/xml");
    echo "<?xml version='1.0' encoding='ISO-8859-1'?>"; 
	$filter = $_POST['Customer_ID'];
	$xml = '';
$qry="SELECT * FROM Components WHERE Customer_ID=$filter;";

$resa = mysql_query($qry, $cxn) or die(mysql_error($cxn));
		
     		$xml = $xml . '<drgs>';
     		
while ($row = mysql_fetch_assoc($resa))
        		{
        $xml = $xml . '<drawing id="'.$row['Drawing_ID'].'">'.$row['Drawing_NO'].$row['Component_Name'].'</drawing>';
            }
                 		
        
    	  $xml = $xml . '</drgs>';
	echo( $xml );
?>