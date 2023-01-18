

 window.onload = function () {
  Buscar();

   }
//Registro de Usuario
function Guardar() {
    
    var cc = $('#cedula').val();
    var nombre = $('#nombre').val();
    var apellido = $('#apellido').val();
    var correo = $('#correo').val();
    var telefono = $('#telefono').val();
    var id_tipo = $('#id_tipo').val();
    var pass = $('#pass').val();
    var action = 'AddUsuario';
                         
    if( (cc == '' || nombre == '' || apellido =='' ||  correo == ''|| 
        telefono == ''  || id_tipo ==''|| pass =='' ) ){
  
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
  
    }else{
  
  
  
        $.ajax({
          url: 'model/ajax_usuarios.php',
          type: 'POST',
          async: true,
          data: { action: action, cedula:cc, nombre:nombre, apellido:apellido,  correo:correo, telefono:telefono, tipo:id_tipo, contraseña:pass },
  
  
          success: function (response) {
          // console.log(response);
            if(response==''){
  
                  swal({
                    title: "Guardado",
                    text: "Registro Almacenado Exitosamente!",
                    icon: "success",
                    button: "ok",
                    })
  
                    .then((willDelete) => {
                    if (willDelete) {
                    
                       Buscar();   
                   
                  
  
                        
                    } 
                    });
  
            }else{
  
              swal({
                title: "Oops!",
                text: "Ha ocurrido un "+" " + response,
                icon: "warning",
                button: "ok",
                })
  
                .then((willDelete) => {
                if (willDelete) {
                  
                    
                } 
                });
  
            }
  
            
            },
            error: function (error) {
          }
        });
      }
  }
// fin 


//Registro de Usuario
function Modificar() {

  var id = $('#id_usuario').val();
  var cc = $('#ecedula').val();
  var nombre = $('#enombre').val();
  var apellido = $('#eapellido').val();
  var correo = $('#ecorreo').val();
  var telefono = $('#etelefono').val();
 
  var pass = $('#epass').val();
  var action = 'UpdateUsuario';
                     
  if( (cc == '' || nombre == '' || apellido =='' ||  correo == ''|| 
      telefono == ''  || pass =='' ) ){

    swal({
      title: "Oops!",
      text: "Llene todos los Campos Requeridos",
      icon: "warning",
      button: "ok",
      })

      .then((willDelete) => {
      if (willDelete) {
       $('#cedula').focus(); 
          
      } 
      });

  }else{



      $.ajax({
        url: 'model/ajax_usuarios.php',
        type: 'POST',
        async: true,
        data: { action: action,id:id, cedula:cc, nombre:nombre, apellido:apellido,  correo:correo, telefono:telefono, contraseña:pass },


        success: function (response) {
        // console.log(response);
          if(response==''){

                swal({
                  title: "Guardado",
                  text: "Registro Almacenado Exitosamente!",
                  icon: "success",
                  button: "ok",
                  })

                  .then((willDelete) => {
                  if (willDelete) {
                  
                      cancelar();    
                 
                

                      
                  } 
                  });

          }else{

            swal({
              title: "Oops!",
              text: "Ha ocurrido un "+" " + response,
              icon: "warning",
              button: "ok",
              })

              .then((willDelete) => {
              if (willDelete) {
                
                  
              } 
              });

          }

          
          },
          error: function (error) {
        }
      });
    }
}
// fin 

// validacion para editar
function validarEdit(url) {

  var id = $(this).attr('f');

  swal({
          title: "¿Realmente Deseas Editar el Registro?",
          text: "Se cargara la informacion del Registro Selecionado...",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
          if (willDelete) {


              var action = 'Get_usu';
            
              $.ajax({
                  url: 'model/ajax_usuarios.php',
                  type: 'POST',
                  async: true,
                  data: { action: action, id: id },

                  success: function(response) {
                     

                      if (response=='') {



                      } else {

                          $('.ui.modal')
                          .modal('show');

                          var data = $.parseJSON(response);
                          $('#id_usuario').val(data.id_usuario);
                          $('#ecedula').val(data.identificacion);
                          $('#enombre').val(data.nombre);
                          $('#eapellido').val(data.apellido);
                          $('#ecorreo').val(data.email);
                          
                         
                        
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
              formData.append("id", $(this).attr('f'));
              $.ajax({
                  data: formData,
                  url: 'model/ajax_usuarios.php',
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
                                  Buscar($().val());
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

function cancelar(){

    var url='?opcion=usuarioadmin';
    location.href=url;
    
}
//fin

function Cerrar(){

  $('.ui.modal')
  .modal('hide');

}

// buscar curso
function Buscar(){

  var action = 'Get_usuarios';
  $.ajax({
      url: 'model/ajax_usuarios.php',
      type: 'POST',
      async: true,
      data: { action: action },

      success: function(response) {

          if (response != '') {

            var info = $.parseJSON(response);
            $('#Tbl_Registro').html(info.detalle);

          } else {
           
            $('#Tbl_Registro').html('');
             

          }
      },
      error: function(error) {}
  });

}// fin