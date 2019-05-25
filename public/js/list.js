$( document ).ready(function() {
    
    $(".btn-delete").click(function(){
        const id =$(this).attr("contact");
        var _token = $('input[name="_token"]').val();

        $.ajax({
            url: '/contacts/delete/'+id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            method:'DELETE',
            dataType: "json",
            success:function (data) {
                if(data.cod == "success"){
                    alert("eliminado");
                    location.reload();
                }
            },error: function (xhr, ajaxOptions, thrownError) {
                //alert(xhr.status);
                //alert(thrownError);
            }
        });
    })

});