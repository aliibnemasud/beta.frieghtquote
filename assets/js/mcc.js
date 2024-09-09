$(document).ready(function(){

	$("#save_carrier").on("click",function(){
		$.ajax({
			url : "/beta.freightquote/index.php/quote_mcc/save_carrier",
			type : "POST",
			data : {
				carrier_name : $("#carrier_name").val(),
				carrier_phone : $("#company_phone").val(),
				carrier_city : $("#carrier_city").val(),
				carrier_state : $("#carrier_state").val(),
				carrier_country : $('#carrier_country').val(),
				carrier_zip_code : $("#carrier_zip_code").val(),
				contact_first : $("#contact_first").val(),
				contact_second : $("#contact_second").val(),
				contact_email : $("#contact_email").val(),
				contact_phone : $("#contact_phone").val()
			},
			dataType : "JSON",
			success : function(res)
			{
				document.location.reload();
			}
		})
	})

	$("#save_trader").on("click",function(){
		var flag = 0;
		if($("#carrier").val()=="")
		{
			$("#carrier").css("border","1px solid red");
			flag = 1;
		}

		if($("#rate").val()=="")
		{
			$("#rate").css("border","1px solid red");
			flag = 1;
		}

		if(flag == 1)
		{
			return;
		}
		
		$("#droba-loader").removeClass("loaded");
        $('#save_trader').prop('disabled', true);
		$.ajax({
			url : "/beta.freightquote/index.php/quote_mcc/update_mcc",
			type : "POST",
			data : {
				carrier : $("#carrier").val(),
				rate : $("#rate").val().replace(/,/g, ''),
				note : $("#note").val(),
				hidden_id : $("#hidden_id").val(),
			},
			dataType : "JSON",
			success : function(res)
			{
				// $("#success_modal").modal("show");
				$("#droba-loader").addClass("loaded");
				$(".main_div").css("display","none");
				$(".after_div")[0].innerHTML = "<h5>Your Freight Quote has been sent to the ITC Trader</h5>";
			}
		})
	})

	$("#update_mcc").on("click",function(){
		$.ajax({
			url : "/beta.freightquote/index.php/quote_mcc/update_mcc",
			type : "POST",
			data : {
				carrier : $("#carrier").val(),
				rate : $("#rate").val().replace(/,/g, ''),
				note : $("#note").val(),
				id : $("#hidden_id").val(),
			},
			dataType : "JSON",
			success : function(res)
			{
				document.location.reload();
			}
		})
	})
})
