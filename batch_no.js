$(document).ready(function() {

$('#bdetails').hide();

$('#batchno').validate(); //attach form to validation engine

$('#customer').load("get_customer.php"); //load customer list on to div customer

$('#customer').click(function() {     //populate drawing list based on customer
	var custid=$('#Customer_ID').val();
	var url="get_drawing_list.php?custid="+custid;
	$('#drawing').load(url);
    });


$('#drawing').click(function() {     //populate drawing list based on customer
$('#bdetails').show();
    });

$('#autobatch').live("click",function(){

	if($('#autobatch').is(':checked'))
	{
	$('#Batch_Desc').attr("disabled",true);
	}
	else{
		$('#Batch_Desc').attr("disabled",false);
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
								$('#bdetails').hide();								
      								}
			});

	});
