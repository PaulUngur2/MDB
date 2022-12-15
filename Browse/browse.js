$(document).ready(function () {

    $("#liveSearch").keyup(function () {
        var input = $(this).val();


        if (input != ""){

            $.ajax({
                url:"browse-data.php",
                method:"POST",
                data:{input,input},

                success: function (data){
                    $("#searchResult").html(data);
                    $("#searchResult").css("display","block");
                }
            });
        } else {
            $("#searchResult").css("display","none");
        }
    });
});