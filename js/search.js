$(document).ready(function(){
    var cname= document.getElementById('catname').innerHTML;
    load_data();
   
    function load_data(query)
    {
     $.ajax({
      url:"fetch_search.php",
      method:"POST",
      data:{query:query,
           cname: cname,
    },
      success:function(data)
      {
        //alert(data);
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
   });