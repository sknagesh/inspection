$(document).ready(function() {
$('#customer').load("get_customer.php"); //load customer list on to div customer

$('#customer').click(function() {     //populate drawing list based on customer
var custid=$('#Customer_ID').val();
var url="get_drawing_list.php?custid="+custid;
$('#drawing').load(url);
    });

$("#drawing").click(function() {      //populate operation list based on drawing no
var drawingid=$('#Drawing_ID').val();
console.log(drawingid);
var url="get_operation_list.php?drawingid="+drawingid;
$('#operation').load(url);
});

$("#operation").click(function() {     //show inprocess dimensions based on operation no
var opid=$('#Operation_ID').val();
var url="update_ip_dimns_ajax.php?opid="+opid;
$('#ipdimns').load(url);
});

$("#add_ip_dimn").validationEngine('attach', {promptPosition : "centerRight"}); //attach form to validation engine

});

$("form#add_ip_dimn").live("submit",function(event) {
event.preventDefault();
var $this = $(this);
if(validateipdimn()){
	
$.ajax({data: $this.serializeArray(),
   		dataType: "html",
   		type: $this.attr("method"),
   		url: $this.attr("action"),
   		success: function(html) {
							document.getElementById('footer').innerHTML=html;
							$('#ipdimns').empty();
      							}
		});
	}
	});

function addrow()
{
	var noofrows=$('#inprocesstble tr').size();
//	alert("no of rows="+noofrows);

    $.ajax({
      data: noofrows,
      dataType: "html",
      type: "GET",
      url: "add_inprocess_dimn_row.php"+ "?filter="+noofrows,
      success: function(html) {
	$('#inprocesstble').append(html);
						      }
    });
}


function validateipdimn()
{
var fields=$("form#add_ip_dimn").serializeArray();
var j=$('#inprocesstble tr').size();
for(var i=0;i<j-1;i++){

	var baloonno="baloonno["+i+"]";
	var basicdimn="basicdimn["+i+"]";
	var tollower="tollower["+i+"]";
	var tolupper="tolupper["+i+"]";
	var textfield="textfield["+i+"]";
	var proddimn="proddimn["+i+"]";
	var baloonno=document.getElementById(baloonno).value;
	var basicdimn=document.getElementById(basicdimn).value;
	var tollower=document.getElementById(tollower).value;
	var tolupper=document.getElementById(tolupper).value;
if(baloonno==""){alert("Please Enter Baloon No");return 0;}	
if(isNaN(baloonno)){alert("Baloon No Is Invalid: "+baloonno);return 0;}
if(basicdimn==""){alert("Please Enter Basic Dimension");return 0;}
if(isNaN(basicdimn)){alert("Invalid Basic Dimension: "+basicdimn);return 0;}
if(isNaN(tolupper)){alert("Please enter correct Upper Tolerance: "+tolupper);return 0;}
if(isNaN(tollower)){alert("Please enter correct Lower Tolerance: "+tollower);return 0;}
var tdif=tolupper-tollower;
if(tdif<0){alert("Lower Tolerance is more then Upper Tolerance: "+tollower+"::"+tolupper);return 0;}

					}
	return 1;
	
}


function delrow()
{
    $.ajax({
      data: $("form#add_ip_dimn").serializeArray(),
      dataType: "html",
      type: "POST",
      url: "del_inprocess_dimn.php",
      success: function(html) {
			document.getElementById("footer").innerHTML=html;
							$('#ipdimns').empty();			
						      }
    });
}
