$(document).ready(function(){
    var cname= document.getElementById('catname').innerHTML;
    load_data_search();
    load_data_filter();
   
    function load_data_filter(query_filter)
    {
     $.ajax({
      url:"fetch_search.php",
      method:"POST",
      data:{query_filter: query_filter,
           cname: cname,
    },
      success:function(data)
      {
        
       $('#result').html(data);
      }
     });
    }

    function load_data_search(query)
    {
     $.ajax({
      url:"fetch_search.php",
      method:"POST",
      data:{query: query,
           cname: cname,
    },
      success:function(data)
      {
        
       $('#result').html(data);
      }
     });
    }

    $('#text_search').keyup(function(){
     var search = $(this).val();
     if(search != '')
     {
      load_data_search(search);
     }
     else
     {
      load_data_search();
     }
    });
	$('#multi_search_filter').change(function(){
		$('#hidden_country').val($('#multi_search_filter').val());
		var query_filter = $('#hidden_country').val();
        // alert(query_filter);
		load_data_filter(query_filter);
	});
   });