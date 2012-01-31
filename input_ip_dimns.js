$(document).ready(function() {

$('#insp').hide();

$('*[id^="obser"]').live("blur",function(event){ //function to check if observed dimn is with in tolerance
	var ok="";
	var eid=$(this).attr("id");
	var id=eid.substring(12,13);
	var tl='tl['+id+']';
	var tu='tu['+id+']';
	var bd='bd['+id+']';
	var tlow=document.getElementById(tl).value;
	var tup=document.getElementById(tu).value;
	var bdim=document.getElementById(bd).value;
	var edimn=$(this).val();

	if(edimn!="")
		{
			var url="checkvalue.php?tlow="+tlow+"&tup="+tup+"&bdim="+bdim+"&edimn="+edimn;
			$.ajax({  //calling php script because js math abilities are worse at best
      					type: "GET",
      					url: url,
      					async:false,
      					success: function(html) {
						ok=html;
													}
    							});
						if(ok=="0"){$(this).css("background-color","red");}else{$(this).css("background-color","#00FF99");}

		}
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
			$('#ipdimns').empty();
			$('#inspector').load("get_inspector.php"); //load customer list on to div customer
			$('#insp').show();

	});




$('input[id^="fai"]').click(function() {      //show dimensions based on selection
	var drawingid=$('#Drawing_ID').val();
	var fai=$(this).val();
	var opid=$('#Operation_ID').val();
console.log(fai);
	var url="get_ip_dimns.php?opid="+opid+'&fai='+fai;
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

