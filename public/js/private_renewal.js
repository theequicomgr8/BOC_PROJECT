$(document).ready(function(){

	var email=$("#email0").val();
	// if(email.lenght!='')
	// {
	// 	$("#tab_1").click(function(){
	// 		var data = new FormData($("#private_media")[0]);
	// 		$.ajax({
	// 			url : '/privateownerRenewal',
	// 			type:'POST',
	// 			data: data,
	// 			cache: false,
	// 			contentType: false,
	// 			processData: false,
	// 			success:function(data)
	// 			{
	// 				console.log(data);
	// 			}
	// 		});

	// 	});
	// }

	// $("#tab_2,#tab_3,#tab_4").click(function(){
	// 	var data = new FormData($("#private_media")[0]);
	// 	$.ajax({
	// 		url : '/privateRenewall',
	// 		type:'POST',
	// 		data:data,
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,
	// 		success:function(data)
	// 		{
	// 			$("#getID").attr('value',1);
	// 		}
	// 	});
	// });

	$("#tab_3,#tab_4").click(function(){
		$("#getID").attr('value',1);
	});

	$("#prev_2,#prev_3,#prev_4").click(function(){
		$("#getID").attr('value',1);
	});

	




	//for delete

	$(".delete").on("click",function(){
		var get_id=$(this).attr('data-id');
		var line_no=$("#"+get_id).val();

		var get_odMediaID=$(this).attr('data-od');
		var od_media_id=$("#"+get_odMediaID).val();
		$.ajax({
			url: 'MediaWorkDone_delete',
			type:'GET',
			data:{line_no: line_no,od_media_id: od_media_id},
			success:function(data)
			{
				console.log(data);
			}
		});
		
	});

	//sole media addres delete
	$(".del").on("click",function(){
		var get_id=$(this).attr('data-sid');
		var line_no=$("#"+get_id).val();

		var hideTab=$(this).attr('data-mid');

		var get_odMediaID=$(this).attr('data-sod');
		var od_media_id=$("#"+get_odMediaID).val();
		$.ajax({
			url: 'soleaddress_delete',
			type:'GET',
			data:{line_no: line_no,od_media_id: od_media_id},
			success:function(data)
			{
				$("#"+hideTab).hide();
				console.log(data);
			}
		});
		
	});




	

});