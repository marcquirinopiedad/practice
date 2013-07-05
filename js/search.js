 $(document).ready(function(){
 
	var l = window.location;

		var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + "/";
		$('.search_button').click(function(e){
			e.preventDefault();
			var search = $('.search').val();
			var type = $('.selection').val();
			//alert(search);
			//alert(type);
			$.ajax({
			type: "POST",
			url	:	base_url + "index.php/exam/search",	
			data: {
				search: search,
				type: type
				
			},
			success	: function(data) {
				//alert(data);
				$('.pagination').empty();
				$('.search_result').empty().append(data);
				
				
			}
			
			});
		
		});
		
 
 });