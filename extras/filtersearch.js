$(document).ready(function(){
    var cname= document.getElementById('catname').innerHTML;
    load_data();
   
    function load_data(query, query_filter='')
    {
     $.ajax({
      url:"fetch_search.php",
      method:"POST",
      data:{query:query,
        query_filter: query_filter,
           cname: cname,
    },
      success:function(data)
      {
        
       $('#result').html(data);
      }
     });
    }
    $('#search_text').keyup(function(){
     var search = $(this).val();
     if(search != '')
     {
      load_data(search);
     }
     else
     {
      load_data();
     }
    });
	$('#multi_search_filter').change(function(){
		$('#hidden_country').val($('#multi_search_filter').val());
		var query_filter = $('#hidden_country').val();
        alert(query_filter);
		load_data(search, query_filter);
	});
   });