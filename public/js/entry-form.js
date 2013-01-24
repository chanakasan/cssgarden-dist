$(document).ready(function(){
    function call_loadcustomer()
    {
        var city_id = $("#city option:selected").val();
        var cat_id = $("#category option:selected").val();

        if(city_id > 0 && cat_id > 0)
        {
            loadcustomer();
        }
    }

//    var area_id = $("#area option:selected").val();
//    if(area_id >0)
//    {
//        loadcity();
//        if(city_id > 0 && cat_id > 0)
//        {
//            loadcustomer();
//        }
//    }
    
    // on change
    $("#area").change(function(){
        loadcity(function(){
            call_loadcustomer();
        });        
    });

    $("#city").change(function(){
        var cat_id = $("#category option:selected").val();
        if(cat_id > 0)
        {
            loadcustomer();
        }
    });

    $("#category").change(function(){
        var area_id = $("#area option:selected").val();
        var city_id = $("#city option:selected").val();
        if(area_id >0 && city_id > 0)
        {
            loadcustomer();
        }
    });

    
});