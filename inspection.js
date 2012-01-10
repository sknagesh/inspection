$(document).ready(function() {
    $("#Customer_ID").change(function() {
var Customer_ID=$(this).val();


				$.ajax({
      					data: Customer_ID,
      					dataType: "html",
      					type: "POST",
      					url: get_drawing_list.php,
      					success: function(html) {
						
						
						
						
      							}
    							});


	})




    $("#Operation_NO").click(function() {
	var formName = elem.form.name;
	alert(formname);
	})

    
 });

