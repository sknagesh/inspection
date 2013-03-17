$(document).ready(function() {

$('#viewipdimn').validate(); //attach form to validation engine

$('#customer').load("get_customer.php"); //load customer list on to div customer

$('#customer').click(function() {     //populate drawing list based on customer
	var custid=$('#Customer_ID').val();
	var url="get_drawing_list.php?custid="+custid;
	$('#drawing').load(url);
	$('#operation').empty();
	$('#ipdimns').empty();
    });

$("#drawing").click(function() {      //populate operation list based on drawing no
	var drawingid=$('#Drawing_ID').val();
	console.log(drawingid);
	var url="get_all_batch_list.php?drawingid="+drawingid;
	$('#batch').load(url);
	});

$("#batch").change(function() {      //populate operation list based on drawing no
	var drawingid=$('#Drawing_ID').val();
	var batchid=$('#Batch_ID').val();
	if(batchid!="")
  		{
	 	var url="get_operation_list.php?drawingid="+drawingid;
		$('#operation').load(url);
		}
		else
		{
			$('#operation').empty();
			$('#ipdimns').empty();
		}
	});

$("#operation").click(function() {     //show inprocess dimensions based on operation no
var opid=$('#Operation_ID').val();
var batchid=$('#Batch_ID').val();
var url="view_report_inprocess_dimns.php?opid="+opid+"&batchid="+batchid;
			$('#ipdimns').load(url);

	});

$('#viewipdimn').submit(function(){
if (!$('*[id^="jobno"]').is(':checked')){
	alert("Please Select At Least One job for Report");
	return false;
}else if (!$('*[id^="bno"]').is(':checked')){
	alert("Please Select At Least One Dimension for Report");
	return false;
}else{
	return true;
}
});

});

