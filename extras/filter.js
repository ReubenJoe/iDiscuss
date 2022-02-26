$(document).ready(function(){

	load_data();
	var catname= document.getElementById('catname').innerHTML;
	function load_data(query_filter='')
	{
		
		$.ajax({
			url:"fetch_search.php",
			method:"POST",
			data:{query_filter:query_filter,
				catname: catname,
			},
			success:function(data)
			{
				$('#result').html(data);
			}
		})
	}

	$('#multi_search_filter').change(function(){
		$('#hidden_country').val($('#multi_search_filter').val());
		var query_filter = $('#hidden_country').val();
		load_data(query_filter);
	});
	
});