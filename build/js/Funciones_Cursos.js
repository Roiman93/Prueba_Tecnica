

 window.onload = function () {
    Buscar();
    $('#txt_buscar').focus();
    
     // show dropdown on hover
     }

// validar enter buscar
var txt_cod = document.getElementById("txt_buscar");
txt_cod.onkeyup = function(e) {
        if (e.keyCode == 13) {
            Buscar();
        }
    }
    //fin

function Cancelar() {

    var url = '?opcion=inicio';
    location.href = url;

}
	
let items = [
    "p_nombre",
    "p_apellido",
    "grado",
    "grupo",
    "email",
    "telefono",
    "Glocation"];


let items_c = [
        "cp_nombre",
        "cp_apellido",
        "cp_grado",
        "cp_grupo",
        "cp_email",
        "cp_telefono",
        "cp_Glocation"];

let campos = {
    p_nombre: false,
    p_apellido: false,
    grado: false,
    grupo:false,
    email: false,
    telefono: false,
    Glocation: false,
    cp_nombre: false,
    cp_apellido: false,
    cp_grado: false,
    cp_grupo:false,
    cp_email: false,
    cp_telefono: false,
    cp_Glocation: false


}

function validar_errores_Crear(arary){
    
     arary.forEach(function(dx) {
        validarFormulario_Crear(dx);
    });

    if(campos.cp_nombre && campos.cp_apellido && campos.cp_grado && campos.cp_grupo && campos.cp_email && campos.cp_telefono && campos.cp_Glocation)
    {
        return true
    }else{
        return false
    }
}

function validar_errores(arary){

        arary.forEach(function(dt) {
            validarFormulario(dt);
        });

        if(campos.p_nombre && campos.p_apellido && campos.grado && campos.grupo && campos.email && campos.telefono && campos.Glocation)
        {
            return true
        }else{
            return false
        }

    

}

function validarFormulario_Crear(x){

    var exp_nombre=/^[a-zA-ZÀ-ÿ\s]{1,40}$/; // Letras
    var exp_grado=/^[0-9\_\-]{1,1}$/;
    var exp_grupo=/^[a-zA-Z\_\-]{1,2}$/;
	var exp_correo=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
	var exp_telefono=/^[0-9\_\-]{7,10}$/; // 7 a 10 numeros
    var exp_ubicacion=/^(\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)?)\s?[,]\s?)+(\-?([1]?[0-7]?[0-9](\.\d+)?|180((.[0]+)?)))$/; // latitu y longitud

     
	switch (x) {
		case "cp_nombre":
			validarCampo(exp_nombre,x,$('#cp_nombre').val());
		break;
		case "cp_apellido":
			validarCampo(exp_nombre, x, $('#cp_apellido').val());
		break;
        case "cp_grado":
            
			validarCampo(exp_grado, x, $('#cp_grado').val());
       
		break;
        case "cp_grupo":
			validarCampo(exp_grupo, x, $('#cp_grupo').val());
            
		break;
        case "cp_email":
			validarCampo(exp_correo, x, $('#cp_email').val());
		break;
        case "cp_telefono":
			validarCampo(exp_telefono,x, $('#cp_telefono').val());
		break;	
		
		case "cp_Glocation":
			validarCampo(exp_ubicacion,x, $('#cp_Glocation').val());
		break;
	}

}



function validarFormulario(x){
    
    var exp_nombre=/^[a-zA-ZÀ-ÿ\s]{1,40}$/; // Letras
    var exp_grado=/^[0-9\_\-]{1,1}$/;
    var exp_grupo=/^[a-zA-Z\_\-]{1,2}$/;
	var exp_correo=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
	var exp_telefono=/^[0-9\_\-]{7,10}$/; // 7 a 10 numeros
    var exp_ubicacion=/^(\-?([0-8]?[0-9](\.\d+)?|90(.[0]+)?)\s?[,]\s?)+(\-?([1]?[0-7]?[0-9](\.\d+)?|180((.[0]+)?)))$/; // latitu y longitud

     
	switch (x) {
		case "p_nombre":
			validarCampo(exp_nombre,x,$('#p_nombre').val());
		break;
		case "p_apellido":
			validarCampo(exp_nombre, x, $('#p_apellido').val());
		break;
        case "grado":
            
			validarCampo(exp_grado, x, $('#grado').val());
       
		break;
        case "grupo":
			validarCampo(exp_grupo, x, $('#grupo').val());
            
		break;
        case "email":
			validarCampo(exp_correo, x, $('#email').val());
		break;
        case "telefono":
			validarCampo(exp_telefono,x, $('#telefono').val());
		break;	
		
		case "Glocation":
			validarCampo(exp_ubicacion,x, $('#Glocation').val());
		break;
	}

}

const validarCampo = (expresion, input, campo) => {
 
	if(expresion.test(campo)){
        console.log('grupo__',input);
		document.getElementById(`grupo__${input}`).classList.remove('error');
		document.querySelector(`#grupo__${input} .formulario__input-error`).classList.remove('formulario__input-error-activo');
		campos[input] = true;

	} else {
        console.log('incorrecto','grupo__',input);
		document.getElementById(`grupo__${input}`).classList.add('error');
        document.querySelector(`#grupo__${input} .formulario__input-error`).classList.add('formulario__input-error-activo');
		campos[input] = false;
	}

	

}

function valideKey(evt) {

    // code is the decimal ASCII representation of the pressed key.
    var code = (evt.which) ? evt.which : evt.keyCode;

    if (code == 8) { // backspace.
        return true;
    } else if (code >= 48 && code <= 57) { // is a number.
        return true;
    } else { // other keys.

        return false;
    }


}

//buscar cursos con filtro
function Buscar() {

    var buscar = $('#txt_buscar').val();
    var filtro = $('#filtro').val();

    var action = 'Get_cursos';

    $.ajax({
        url: 'model/ajax_cursos.php',
        type: 'POST',
        async: true,
        data: { action: action, buscar: buscar, filtro: filtro },
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

// validacion para editar
function Validar_Edit(){

    var id = $(this).attr('fac');

    swal({
            title: "¿Realmente Deseas Editar el Registro?",
            text: "Se cargara la informacion del Registro Selecionado...",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {


                var action = 'Get_curso';
                

                $.ajax({
                    url: 'model/Ajax.php',
                    type: 'POST',
                    async: true,
                    data: { action: action, id:id },

                    success: function(response) {
                       

                        if (response ==  '') {



                        } else {

                            $('.ui.modal.edit')
                            .modal('show');

                            var data = $.parseJSON(response);
                            $('#id_st').val(data.s_id);
                            $('#p_nombre').val(data.first_name);
                            $('#p_apellido').val(data.last_name);
                            $('#grado').val(data.lv_id);
                            $('#grupo').val(data.group);
                            $('#email').val(data.email);
                            $('#telefono').val(data.phone_number);
                            $('#Glocation').val(data.geolocation)
                          
                        }
                    },
                    error: function(error) {}
                });




            } else {
                swal("!No se realizo ninguna Acción!");
            }
        });



}
//fin

// validacion estado activo
function Validar_StatusD(url) {

    var id = $(this).attr('f');

    swal({
            title: "¿Realmente Deseas Cambiar el Estado?",
            text: "Se Desactivara el Registro",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                var action = 'Get_Status';             

                $.ajax({
                    url: 'model/ajax_students.php',
                    type: 'POST',
                    async: true,
                    data: { action: action, st: id,cp:'0' },

                    success: function(response) {
                       

                        if (response ==  '') {
                         
                            swal({
                                title: "Actualizado",
                                text: "Registro Almacenado Exitosamente!",
                                icon: "success",
                                button: "ok",
                            })
        
                            .then((willDelete) => {
                                if (willDelete) {
        
                                    Buscar($('#txt_buscar').val());
                                    
                                   
        
                                }
                            });


                        } else {


                            swal({
                                title: "Oops!",
                                text: "Ha ocurrido un error " + " " + response,
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




            } else {
                swal("!No se realizo ninguna Acción!");
            }
        });



}
//fin

// validacion estado activo
function Validar_StatusA(url) {

    var id = $(this).attr('f');

    swal({
            title: "¿Realmente Deseas Cambiar el Estado?",
            text: "Se Activara el Registro",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var action = 'Get_Status';
                $.ajax({
                    url: 'model/ajax_students.php',
                    type: 'POST',
                    async: true,
                    data: { action: action, st: id,cp:'1' },

                    success: function(response) {
                       

                        if (response ==  '') {

                            swal({
                                title: "Actualizado",
                                text: "Registro Almacenado Exitosamente!",
                                icon: "success",
                                button: "ok",
                            })
        
                            .then((willDelete) => {
                                if (willDelete) {
        
                                    Buscar($('#txt_buscar').val());
                                    
                                   
        
                                }
                            });

                        } else {

                         
                            swal({
                                title: "Oops!",
                                text: "Ha ocurrido un error " + " " + response,
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




            } else {
                swal("!No se realizo ninguna Acción!");
            }
        });



}
//fin

// Abrir modal
function Crear() {

    $('.ui.modal.crear')
    .modal('show');


}
//fin

// Guardar Registros
function Guardar(){

    var nombre1 = $('#cp_nombre').val();
    var apellido1= $('#cp_apellido').val();
    var grado= $('#cp_grado').val();
    var grupo= $('#cp_grupo').val();
    var email=  $('#cp_email').val();
    var telefono =$('#cp_telefono').val();
    var ubicacion= $('#cp_Glocation').val()
  
        var formData = new FormData();
        formData.append("action", 'Guardar');
        formData.append("p_nombre", nombre1);
        formData.append("p_apellido", apellido1);
        formData.append("grado", grado);
        formData.append("grupo", grupo);
        formData.append("email", email);
        formData.append("telefono", telefono);
        formData.append("ubicacion", ubicacion);

        $.ajax({
            data: formData,
            url: 'model/ajax_students.php',
            type: "POST",
            contentType: false,
            processData: false,
            beforesend: function() {},
            success: function(response) {


                if (!response.length) {

                    swal({
                        title: "Guardado",
                        text: "Registro Almacenado Exitosamente!",
                        icon: "success",
                        button: "ok",
                    })

                    .then((willDelete) => {
                        if (willDelete) {

                            LimpiarModal(1);
                            Cerrar(1);
                            Buscar($('#txt_buscar').val());
                            
                           

                        }
                    });

                } else {

                    swal({
                        title: "Oops!",
                        text: "Ha ocurrido un error " + " " + response,
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
    

} //fin


// modificar 
function Modificar() {
    
   var id = $('#id_st').val();
   var nombre1 = $('#p_nombre').val();
   var apellido1= $('#p_apellido').val();
   var grado= $('#grado').val();
   var grupo= $('#grupo').val();
   var email=  $('#email').val();
   var telefono =$('#telefono').val();
   var ubicacion= $('#Glocation').val()

        var formData = new FormData();
        formData.append("action", 'Modificar');
        formData.append("st", id);
        formData.append("p_nombre", nombre1);
        formData.append("p_apellido", apellido1);
        formData.append("grado", grado);
        formData.append("grupo", grupo);
        formData.append("email", email);
        formData.append("telefono", telefono);
        formData.append("ubicacion", ubicacion);


        $.ajax({
            data: formData,
            url: 'model/ajax_students.php',
            type: "POST",
            contentType: false,
            processData: false,
            beforesend: function() {},
            success: function(response) {
       
                if (response == '') {

                    swal({
                        title: "Actualizado",
                        text: "Registro Almacenado Exitosamente!",
                        icon: "success",
                        button: "ok",
                    })

                    .then((willDelete) => {
                        if (willDelete) {
                             
                            LimpiarModal(0);
                            Cerrar(0);
                            Buscar($('#txt_buscar').val());



                        }
                    });

                } else {

                    swal({
                        title: "Oops!",
                        text: "Ha ocurrido un " + " " + response,
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
// fin



// validaciones  para eliminar 
function ValidarRemove(url) {

    swal({
            title: "¿Seguro que deseas Eliminar el Registro?",
            text: "No podrás deshacer este paso...",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                
                var formData = new FormData();
                formData.append("action", 'Eliminar');
                formData.append("st", $(this).attr('f'));
                $.ajax({
                    data: formData,
                    url: 'model/ajax_students.php',
                    type: "POST",
                    contentType: false,
                    processData: false,
                    beforesend: function() {},

                    success: function(response) {
                        if (response == '') {

                            swal({
                                title: "Registro Eliminado",
                                text: "!Exitoso!",
                                icon: "success",
                                button: "ok",
                            })

                            .then((willDelete) => {
                                if (willDelete) {
                                    Buscar($('#txt_buscar').val());
                                }
                            });

                        } else {

                            swal({
                                title: "Oops!",
                                text: "Ha ocurrido un Error: " + " " + response,
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



            } else {
                swal("!No se Realizo Ningun Cambio!");
            }
        });


}
//fin

function Ejecutar_G(){

    if(validar_errores_Crear(items_c)){
           Guardar();
    }else{

       swal({
           title: "Oops!",
           text: "Llene todos los Campos Requeridos",
           icon: "warning",
           button: "ok",
       })
   
       .then((willDelete) => {
           if (willDelete) {
   
   
           }
       });
   
   
    }

}

function Ejecutar_M(){
            
        if(validar_errores(items)){

            Modificar();

         }else{

            swal({
                title: "Oops!",
                text: "Llene todos los Campos Requeridos",
                icon: "warning",
                button: "ok",
            })
        
            .then((willDelete) => {
                if (willDelete) {
        
        
                }
            });
        
        }

}

// ver cursos por estudiante
function Ver_Cursos(url) {

    var id = $(this).attr("f");

    swal({
            title: "¿Realmente Deseas ver Los Cursos de este estudiante?",
            text: "Se cargara la informacion del Registro Selecionado...",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {


                var action = 'Get_cursos';
            

                $.ajax({
                    url: 'model/Ajax.php',
                    type: 'POST',
                    async: true,
                    data: { action: action, student: id },

                    success: function(response) {
                       

                        if (response ==  '') {



                        } else {

                            $('.ui.modal.cursos')
                            .modal('show');

                            var info = JSON.parse(response);
                             $('#Tbl_curso').html(info.detalle);
               

                        }
                    },
                    error: function(error) {}
                });




            } else {
                swal("!No se realizo ninguna Acción!");
            }
        });



}
//fin

// Limpiar formularios
function LimpiarModal(frm){

    if(frm ==1){

        $('#p_nombrec').val('');
        $('#p_apellidoc').val('');
        $('#gradoc').val('');
        $('#grupoc').val('');
        $('#emailc').val('');
        $('#telefonoc').val('');
        $('#Glocationc').val('')

    }else{

        $('#id_st').val('');
        $('#p_nombre').val('');
        $('#p_apellido').val('');
        $('#grado').val('');
        $('#grupo').val('');
        $('#email').val('');
        $('#telefono').val('');
        $('#Glocation').val('') 

    }

}

// Cerrar Modal
function Cerrar(frm){

    if(frm ==1){

         // cerramos el modal y mostramos los datos 
         $('.ui.modal.crear')
         .modal('hide');

    }else{

        // cerramos el modal y mostramos los datos 
        $('.ui.modal.edit')
        .modal('hide');
    }

}




