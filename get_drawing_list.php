<?php
include('dewdb.inc');
$Customer_ID=$_POST['Customer_ID'];

print(Customer_ID=$Customer_ID");

$query="SELECT * FROM Component WHERE Customer_ID='$Customer_ID';";

$res=mysql_query($query,$cxn) or die(mysql_error());

while($row=mysql_fetch_assoc($res))
{

}



?>
