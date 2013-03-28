<?php
$tlow=$_GET['tlow'];
$tup=$_GET['tup'];
$bdim=$_GET['bdim'];
$edimn=$_GET['edimn'];

$tl=$bdim+$tlow;
$tu=$bdim+$tup;
//print("$tl $tu");
if($edimn<$tl)
{
	print("0");
	exit;
}else if($edimn>$tu)
{
	print("0");
	exit;
}else{print("1");}

?>