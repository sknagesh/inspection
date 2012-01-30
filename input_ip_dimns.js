$(document).ready(function() {

$('*[id^="obser"]').live("blur",function(event){
	var eid=$(this).attr("id");
	var id=eid.substring(12,13);
	});

$('#inputdimn').validate(); //attach form to validation engine

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
	var url="get_batch_list.php?drawingid="+drawingid;
	$('#batch').load(url);
	});

$("#batch").change(function() {      //populate operation list based on drawing no
	var drawingid=$('#Drawing_ID').val();
	var batchid=$('#Batch_ID').val();
	if(batchid!="")
  		{
		console.log(drawingid);
	 	var url="get_operation_list.php?drawingid="+drawingid;
		$('#operation').load(url);
		$('#inspector').load("get_inspector.php"); //load customer list on to div customer
		}
		else
		{
			$('#operation').empty();
			$('#ipdimns').empty();
		}
	});


$("#operation").click(function() {     //show inprocess dimensions based on operation no
	var opid=$('#Operation_ID').val();
	var url="get_ip_dimns.php?opid="+opid;
	$('#ipdimns').load(url);
	});

});

$("form#inputdimn").live("submit",function(event) {
	var	noc=$('#inprocesstble tr').length-1;
	$('#noofcomps').val(noc);
	event.preventDefault();
	var $this = $(this);
	
	$.ajax({data: $this.serializeArray(),
   			dataType: "html",
   			type: $this.attr("method"),
   			url: $this.attr("action"),
   			success: function(html) {
								document.getElementById('footer').innerHTML=html;
								$('#ipdimns').empty();
      								}
			});

	});


function indianDate(value, element) {	

var dm=/^(0[1-9]|[12][0-9]|3[01])[ //.](0[1-9]|1[012])[ //.](19|20)\d\d$/;
                return value.match(dm);
}

$.validator.addMethod("indianDate",indianDate,"Please enter a date in the format dd/mm/yyyy");

