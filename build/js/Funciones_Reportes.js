

 window.onload = function () {
    Buscar();
   
    
     // show dropdown on hover
     }


//buscar Studen
function Buscar() {

    var action = 'Get_rpx';

    $.ajax({
        url: 'model/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action},
        success: function(response) {


            if (response != 'error') {

                var info = JSON.parse(response);

                $('#Tbl_Registro').html(info.detalle);
               

            } else {


                swal({
                    title: "Oops!",
                    text: "No se encontro Registro ",
                    icon: "warning",
                    button: "ok",
                })

                .then((willDelete) => {
                    if (willDelete) {
                      
                       
                  $('#Tbl_Registro').html('');
                    
                    }
                });
               
            }

        },
        error: function(error) {}
    });



}
//fin