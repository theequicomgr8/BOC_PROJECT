$(document).ready(function(){
	// $("#officer_name_person").blur(function(){
	// 	var value=$(this).val();
	// 	$.ajax({
	// 		url : '/fetchOfficerDetail',
	// 		type: 'GET',
	// 		data: {name : value},
	// 		success:function(data)
	// 		{
	// 			console.log(data);
	// 			// $("#officer_name_person").val(data['officer_name_person']);
	// 			$("#person_designation").val(data['person_designation']);
	// 			$("#contact_no").val(data['contact_no']);
	// 			$("#email").val(data['email']);
	// 		}
	// 	});
	// });




	// $( function() {
	//     var availableTags = [
	//       "Mobile Phone Repair",
	//       "Sport Fields & Halls Contracting",
	//       "Audio Records Trading",
	//       "Sunglasses Trading",
	//       "Spectacles & Contact Lenses Trading",
	//       "Beauty & Personal Care Equipment Trading",
	//       "Parties & Entertainments Services",
	//       "Art Production Services",
	//       "ColdFusion",
	//       "Erlang",
	//       "Fortran",
	//       "Groovy",
	//       "Haskell",
	//       "Java",
	//       "JavaScript",
	//       "Lisp",
	//       "Perl",
	//       "PHP",
	//       "Python",
	//       "Ruby",
	//       "Scala",
	//       "Scheme"
	//     ];
	//     $( "#officer_name_person" ).autocomplete({
	//       source: availableTags
	//     });
	//   } );


	$("#officer_name_person").keyup(function(){
		var value=$(this).val();
		$.ajax({
			url : '/fetchOfficerDetail',
			type: 'GET',
			data: {name : value},
			success:function(data)
			{
				var getdata=JSON.parse(data);
				// console.log(data);
				fetchData(getdata);
				
			}
		});
	});


	function fetchData(data)
	{
		var ary=[];
		var temp=[];
		for(var i=0;i < data.length;++i)
		{	
			temp.push(data[i]['officer_name_person'] + ' ~ '+data[i]['email']);
			ary.push(data[i]['officer_name_person']);		
		}

		// console.log(temp);
		var availableTags=temp;	 
	    $( "#officer_name_person" ).autocomplete({
	      source: availableTags
	    });

	   
	}

	$(document).on("click",'.ui-menu-item-wrapper',function(){
		var value=$("#officer_name_person").val();
		var last=value.indexOf("~")+2;
		var email=value.substring(last);
		// console.log(email);
		$.ajax({
			url : '/showOfficerDetail',
			type: 'GET',
			data: {email : email},
			success:function(data)
			{
				console.log(data);
				$("#officer_name_person").val(data['officer_name_person'])
				$("#person_designation").val(data['person_designation'])
				$("#contact_no").val(data['contact_no'])
				$("#email").val(data['email'])
				
			}
		});
	});



//get year
// window.onload = function () {
//     var year = document.getElementById("year");
//     var currentYear = (new Date()).getFullYear();
//     for (var i = currentYear; i >= 1990; i--) {
//         var option = document.createElement("OPTION");
//         option.innerHTML = i;
//         option.value = i;
//         year.appendChild(option);
//     }
// };







});







