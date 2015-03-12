function placeOrder()
{
	$('#submit_button').click(function(e){
	orderStr = {};
	orderStr["customer_phone_no"] = $("#customer_phone_no").val();
	orderStr["address"] = $("#address").val();
	orderStr["type"] = $("#dine_in")[0].checked ? "DINE_IN" : "HOME_DELIVERY";
	orderStr["item_ids"] = [];
	orderStr["costs"] = [];
	orderStr["quantities"] = [];
	$("#menu").children('tr').each(function() {
		 orderStr["item_ids"].push($(this).children('td').eq(0).html());
		 orderStr["costs"].push($(this).children('td').eq(2).html());
		 orderStr["quantities"].push($($(this).children('td').eq(4).children()).val());
	});

//	var orderJsonString = JSON.stringify(orderStr);
	console.log(orderStr);
		$.ajax({
		url:'./place_order.php',
		type:"POST",
		data: orderStr, 
		success: function(x,y) {alert(x);},
		});
		e.preventDefault();
	});
}

$(document).ready(function () {
	$("input[name=type]:radio").change(function () {
        $("#address_div").toggle();
    });
    placeOrder();
});