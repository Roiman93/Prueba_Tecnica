
window.onload = function () {
Buscar();
$('#txt_buscar').focus();
}

// validar enter buscar
var txt_cod = document.getElementById("txt_buscar");
txt_cod.onkeyup = function(e) {
        if (e.keyCode == 13) {
            Buscar();
        }
    }
    //fin

let items = [
    "nombre",
    "credito"];


let items_c = [
        "c_nombre",
        "c_credito"
       ];

let campos = {
nombre: false,
credito: false,
c_nombre: false,
c_credito:false
}


function validar_errores_Crear(arary){
    
    arary.forEach(function(dx) {
       validarFormulario_Crear(dx);
   });

   if(campos.c_nombre && campos.c_credito)
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

       if(campos.nombre && campos.credito)
       {
           return true
       }else{
           return false
       }

   

}

function validarFormulario_Crear(x){

   var exp_nombre=/^[a-zA-ZÀ-ÿ\s]{1,40}$/; // Letras
   var exp_telefono=/^[0-9\_\-]{1,100}$/; // 7 a 10 numeros
   
   switch (x) {
       case "c_nombre":
           validarCampo(exp_nombre,x,$('#c_nombre').val());
       break;

       case "c_credito":
           validarCampo(exp_telefono,x, $('#c_credito').val());
       break;	
       
     
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



function validarFormulario(x){
   
   var exp_nombre=/^[a-zA-ZÀ-ÿ\s]{1,40}$/; // Letras
   var exp_telefono=/^[0-9\_\-]{1,10}$/; // 7 a 10 numeros
  
    switch (x) {
        case "nombre":
            validarCampo(exp_nombre,x,$('#nombre').val());
        break;
 
        case "credito":
            validarCampo(exp_telefono,x, $('#credito').val());
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
function Validar_Edita(url) {

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
                    url: 'model/ajax_cursos.php',
                    type: 'POST',
                    async: true,
                    data: { action: action, id: id },

                    success: function(response) {
                       

                        if (response ==  '') {



                        } else {

                            $('.ui.modal.edit')
                            .modal('show');

                            var data = $.parseJSON(response);
                            $('#id_st').val(data.c_id);
                            $('#nombre').val(data.name);
                            $('#credito').val(data.credits);
                           
                          
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
                    url: 'model/ajax_cursos.php',
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

// Abrir modal
function Crear() {

    $('.ui.modal.crear')
    .modal('show');


}
//fin

// Guardar Registros
function Guardar(){

    var nombre = $('#c_nombre').val();
    var credito= $('#c_credito').val();
    
  
        var formData = new FormData();
        formData.append("action", 'Guardar');
        formData.append("nombre", nombre);
        formData.append("credito", credito);
       
        $.ajax({
            data: formData,
            url: 'model/ajax_cursos.php',
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
    var nombre1 = $('#nombre').val();
    var cdt= $('#credito').val();
    
 
         var formData = new FormData();
         formData.append("action", 'Modificar');
         formData.append("st", id);
         formData.append("nombre", nombre1);
         formData.append("credito", cdt);
         
 
 
         $.ajax({
             data: formData,
             url: 'model/ajax_cursos.php',
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





// Limpiar formularios
function LimpiarModal(frm){

    if(frm ==1){

        $('#c_nombre').val('');
        $('#c_credito').val('');
    

    }else{

        $('#nombre').val('');
        $('#credito').val('');

       

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