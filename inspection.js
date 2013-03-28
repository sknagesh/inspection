$(document).ready(function() {
    //populate drawing list based on customer
    $("#Customer_ID").click(function() {
var Customer_ID=$(this).val();
$.ajax({
		data: {"Customer_ID":Customer_ID},
		dataType: "xml",
		type: "POST",
		url: "get_drawing_list.php",
		success: function(html) {
		PopulateList(html,"Drawing_NO");
      							}
		});
    });
    //populate operation list based on drawing no
    $("#Drawing_NO").click(function() {
var Drawing_NO=$(this).val();
$.ajax({
		data: {"Drawing_NO":Drawing_NO},
		dataType: "xml",
		type: "POST",
		url: "get_operation_list.php",
		success: function(html) {
		PopulateList(html,"Operation_NO");
      							}
		});
	});


    //show inprocess dimensions based on operation no
    $("#Operation_NO").click(function() {
var Operation_ID=$(this).val();
$.ajax({
		data: {"Operation_ID":Operation_ID},
		dataType: "html",
		type: "POST",
		url: "update_ip_dimns_ajax.php",
		success: function(html) {
		document.getElementById("ipdimns").innerHTML=html;
      							}
		});
	});


$("#add_ip_dimn").validationEngine('attach', {promptPosition : "centerRight"}); //attach form to validation engine

 });


function checktol(field, rules, i, options){
var tollower=field.val();
var index=field.i;
var tolupper="tolupper["+index+"]";
alert(tolupper+tollower);



    }




$("form#add_ip_dimn").live("submit",function(event) {
event.preventDefault();
var $this = $(this);

$.ajax({
  					data: $this.serializeArray(),
   					dataType: "html",
   					type: $this.attr("method"),
   					url: $this.attr("action"),
   					success: function(html) {
				document.getElementById("footer").innerHTML=html;
      							}
		});
	});

function addrow()
{
	var noofrows=$('#inprocesstble tr').size();
	alert("no of rows="+noofrows);

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




















function PopulateList(countryNode,listname) {
	var countryList = document.getElementById(listname);
	for ( var count = countryList.options.length - 1; count > -1; count--) {
		countryList.options[count] = null;
	}

	var countryNodes = countryNode.getElementsByTagName('drawing');
	var idValue;
	var textValue;
	var optionItem;
	for ( var count = 0; count < countryNodes.length; count++) {
		textValue = GetInnerText(countryNodes[count]);
		idValue = countryNodes[count].getAttribute("id");
		optionItem = new Option(textValue, idValue, false, false);
		countryList.options[countryList.length] = optionItem;
	}
}

function GetInnerText(node) {
	return (node.textContent || node.innerText || node.text);
}
