var emplyoee_id;

$(document).ready(function(){
	$("#view_upload").on("click",function(){
		$("#file_upload").click();
	});
	$("#file_upload").on("change",function(){
		$("#view_upload")[0].innerHTML = "<i class = 'fas fa-check'></i> Upload Success!"
	})
	$(".employee_card").on("click",function(){
		emplyoee_id = $(this).data("id");
		$("#hidden_edit_id").val(emplyoee_id);
		var html = $(this)[0].innerHTML;
		$(".show_employee")[0].innerHTML = html;
		$("#edit_modal").modal("show");
		$("#edit_f_name").val($("#employee_card"+emplyoee_id+" .edit_name").data("first"));
		$("#edit_l_name").val($("#employee_card"+emplyoee_id+" .edit_name").data("last"));
		$("#edit_pos").val($("#employee_card"+emplyoee_id+" .edit_position").data("val"));
		$("#edit_email_add").val($("#employee_card"+emplyoee_id+" .edit_email").data("val"));
		$("#edit_direct_phone").val($("#employee_card"+emplyoee_id+" .edit_direct_phone").data("val"));
		$("#edit_cell_phone").val($("#employee_card"+emplyoee_id+" .edit_cell_phone").data("val"));
		$("#edit_extension").val($("#employee_card"+emplyoee_id+" .edit_extension").data("val"));
		$("#edit_workstation").val($("#employee_card"+emplyoee_id+" .edit_workstation").data("val"));
	})

	$("#edit_view_upload").on("click",function(){
		$("#edit_file_upload").click();
	});

	$("#delete_user").on("click",function(){
		$.ajax({
			url : "staff/delete_user",
			type : "POST",
			data : {
				id : $("#hidden_edit_id").val()
			},
			success : function(res)
			{
				location.reload();
			}
		})
	})
})