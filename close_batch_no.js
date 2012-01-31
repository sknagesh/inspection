$(document).ready(function() {

$('#submit').attr("disabled",true);

$('#batchno').validate(); //attach form to validation engine

$('#customer').load("get_customer.php"); //load customer list on to div customer

$('#customer').click(function() {     //populate drawing list based on customer
	var custid=$('#Customer_ID').val();
	var url="get_drawing_list.php?custid="+custid;
	$('#drawing').load(url);
    });


$('#drawing').click(function() {     //populate drawing list based on customer
var drawingid=$('#Drawing_ID').val();

var url="get_batch_list.php?drawingid="+drawingid;
$('#batch').load(url);
    });

$('#batch').click(function() {     //populate drawing list based on customer

var batchid=$('#Batch_ID').val();
if(batchid=="")
{
	$('#submit').attr("disabled",true);
}else
{
	$('#submit').attr("disabled",false);
}

    });


});

$("form#batchno").live("submit",function(event) {
	event.preventDefault();
	var $this = $(this);
	
	$.ajax({data: $this.serializeArray(),
   			dataType: "html",
   			type: $this.attr("method"),
   			url: $this.attr("action"),
   			success: function(html) {
								document.getElementById('footer').innerHTML=html;
								$('#batchno')[0].reset();							
      								}
			});

	});
