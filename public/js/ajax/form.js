function loadcity(callback)
{
    var id = $("#area").val();
    $("#loading-img").fadeIn("slow");

    $.ajax({
        type:"POST",
        dataType: "json",
        url: "/async/loadcity",
        async:true,
        data: {
            sel_area: id
        },
        cache: false,

        success: function(result){
            $("#loading-img").css("display", "none");

            var options = $("#city");
            options.empty();
            $.each(result, function() {
                options.append($("<option/>").val(this.id).text(this.name));                
            });

            if(callback && typeof(callback) === "function")
            {
                callback();
            }
        }
    });    
}

function loadcustomer()
{
    var cat_id = $("#category").val();
    var id = $("#city").val();

    $("#loading-img").fadeIn("slow");
    $.ajax({
        type:"POST",
        dataType: "json",
        url: "/async/loadcustomer",
        async:true,
        data: {
            sel_cat: cat_id,
            sel_city: id
        },
        cache: false,

        success: function(result){
            $("#loading-img").css("display", "none");

            var options = $("#customer");
            options.empty();
            $.each(result, function() {
                options.append($("<option/>").val(this.id).text(this.name));
            });
        }
    });
}