$(document).ready(function(){
    //alert("hi");
    $('#area').change(function(){
        loadcity();
    });

    $('#city').change(function(){
        loadcustomer();
    });

    $('#category').change(function(){
        loadcustomer();
    });

});