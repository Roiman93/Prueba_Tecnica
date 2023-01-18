
    function Login() {

        var us = $('#usu').val();
        var ps = $('#pass').val();
       
        
    
        if ((us == "" || ps == "")) {
    
            swal({
                title: "Oops!",
                text: "Campos Vacios",
                icon: "warning",
                button: "ok",
            })
    
            .then((willDelete) => {
                if (willDelete) {
                   

    
                }
            });
    
        } else {
    
    
            var formData = new FormData();
            formData.append("action", 'Login');
            formData.append("usuario", $('#usu').val());
            formData.append("pass", md5($('#pass').val()));
           
    
    
            //console.log(formData);
            $.ajax({
                data: formData,
                url: 'model/ajax.php',
                type: "POST",
                contentType: false,
                processData: false,
                beforesend: function() {
    
                },
                success: function(response) {
    
    
                    if (!response.length) {
    
                        swal({
                            title: "Acceso",
                            text: "Acceso Concedido",
                            icon: "success",
                            button: "ok",
                        })
    
                        .then((willDelete) => {
                            if (willDelete) {
    
                                 location.href = "?opcion=inicio";


                            }
                        });
    
                    } else {
    
                        swal({
                            title: "Oops!",
                            text: "Ha ocurrido un error " + " " + "Usuaro o contraseña Equivocados",
                            icon: "warning",
                            button: "ok",
                        })
    
                        .then((willDelete) => {
                            if (willDelete) {
                               
    
                            }
                        });
    
    
    
                    }
                },
                error: function(error) {}
            });
        }
    
    } //fin


    