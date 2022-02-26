$(document).ready(function(){
    $(".search-dropdown").click(function(){
        $(".search-dropdown-list ul").toggleClass("active");
    });

    // select search-dropdown list category
    $(".search-dropdown-list ul li").click(function(){
        var icon_text = $(this).html();
        $(".default-option").html(icon_text);
        var default_name = $(this).attr('name');
        // alert($(this).val());
        $('#name_cat').attr('value', default_name);
        
    });

    // hide search-dropdown when clicking outside searchbar or search-dropdown list
    $(document).on("click",function(event){
        if(!$(event.target).closest(".search-dropdown").length){
            $(".search-dropdown-list ul").removeClass("active");
        }
    });
});
