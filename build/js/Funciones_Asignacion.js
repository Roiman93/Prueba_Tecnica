 window.onload = function () {
  
    $('#numero').focus();
     }

// validar enter buscar
var txt_cod = document.getElementById("numero");
txt_cod.onkeyup = function(e) {
        if (e.keyCode == 13) {
            Buscar();
        }
    }
    //fin


// cargar combo box paginas
function CargarCursos() {

    var action = 'Get_cbxcursos';
    var id_mSelected = $('#id_curso').val();



    $.ajax({
        url: 'model/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_menuSelected: id_mSelected },
        success: function(response) {



            if (response != '') {

                var info = JSON.parse(response);

                $('#Select_Curso').html(info.Combobox);


            } else {

                swal({
                    title: "Oops!",
                    text: "No se Encontro Registro" + " ",
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


// cargar informacion segun select
$("#Select_Curso").on("change", function() {
    if ($("#start_date").val() == "") {        

    }else {
        buscar_c($('#Select_Curso').val());
    } 
})
//fin

// buscar curso
function buscar_c(id){

    var action = 'Getcurso';
    $.ajax({
        url: 'model/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id: id },

        success: function(response) {

            if (response != '') {

                var data = $.parseJSON(response);
                $('#txt_nombre').val(data.name);
                $('#txt_credito').val(data.credits);
                document.getElementById("btn_guardar").style.display = '';
                $('#btn_guardar').focus();

            } else {
               
                $('#txt_nombre').val('');
                $('#txt_credito').val('');

            }
        },
        error: function(error) {}
    });

}// fin


// buscar estudiante por id
function buscar_estudiante() {

    var cc = $('#numero').val();
    var action = 'Get_st';

    if ((cc == '' || cc == 0)) {

        swal({
            title: "Oops!",
            text: "Digite un Nuemero de Documento valido",
            icon: "warning",
            button: "ok",
        })

        .then((willDelete) => {
            if (willDelete) {

                $('#numero').focus();

            }
        });

    } else {

        $.ajax({
            url: 'model/ajax.php',
            type: 'POST',
            async: true,
            data: { action: action, student: cc },

            success: function(response) {

                if (response == 0) {

                    swal({
                            title: "Estudiante No Registrado",
                            text: "Desea Registrar el Nuevo Estudainte",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {

                                //mostrar modal;
                                $('.ui.modal.Crear')
                                    .modal('show');

                                $('#txt_nuemero').val(cc);
                                movimientos($('#numero').val());

                            } else {
                                swal("!No se Realizo Ninguna Accion!");
                             
                            }
                        });


                } else {
                    var data = $.parseJSON(response);             
                 
                    $('#p_nombre').val(data.first_name);
                    $('#s_nombre').val(data.last_name);
                    $('#grado').val(data.lv_id);
                    $('#grupo').val(data.group);
                  
                    movimientos(cc);
                    CargarCursos();
                    $('#numero').prop("disabled", true);
                    $('#Select_Curso').prop("disabled", false);
                    $('#Select_Curso').focus();


                }
            },
            error: function(error) {}
        });
    }
}
// fin 

//buscar Studen con filtro
function buscar() {

    var buscar = $('#txt_buscar').val();
    var filtro = $('#filtro').val();

    var action = 'bs_lupa';

    $.ajax({
        url: 'model/Ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, buscar: buscar, filtro: filtro },
        success: function(response) {


            if (response != 'error') {

                var info = JSON.parse(response);

                $('#Tbl_RegistroM').html(info.detalle);
               

            } else {
                $('#Tbl_RegistroM').html('');
            }

        },
        error: function(error) {}
    });



}
//fin

// Cursos asignados
function movimientos(cc) {

    var action = 'Get_courses';
    $.ajax({
        url: 'model/ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, student: cc },

        success: function(response) {

            if (response != '') {

                var data = $.parseJSON(response);
                $('#detalle_cursos').html(data.detalle);

            } else {
               
                $('#detalle_cursos').html('');

            }
        },
        error: function(error) {}
    });

}

// Guardar Registros
function Guardar(){

    var id_s = $('#numero').val();
    var id_c = $('#Select_Curso').val();

    if ((id_s == "" || id_c == "")) {

        swal({
            title: "Oops!",
            text: "Campos Vacios verifique",
            icon: "warning",
            button: "ok",
        })

        .then((willDelete) => {
            if (willDelete) {
                // borrar();

            }
        });

    } else {


        var formData = new FormData();
        formData.append("action", 'GuardarC');
        formData.append("id_s", id_s);
        formData.append("id_c", id_c);

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
                        title: "Guardado",
                        text: "Registro Almacenado Exitosamente!",
                        icon: "success",
                        button: "ok",
                    })

                    .then((willDelete) => {
                        if (willDelete) {

                            $('#txt_nombre').val('');
                            $('#txt_credito').val('');
                            document.getElementById("btn_guardar").style.display = 'none';
                            movimientos(id_s);
                            $('#Select_Curso').focus();

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
    }

} //fin

// Guardar Registros
function eliminar(id_tcs){

    var id_s = $('#numero').val();


    if ((id_tcs == "" || id_s == "")) {

        swal({
            title: "Oops!",
            text: "Campos Vacios verifique",
            icon: "warning",
            button: "ok",
        })

        .then((willDelete) => {
            if (willDelete) {
                // borrar();

            }
        });

    } else {


        var formData = new FormData();
        formData.append("action", 'Deltcs');
        formData.append("id_s", id_s);
        formData.append("id_c", id_tcs);

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
                        title: "Eliminado",
                        text: "Registro Eliminado Exitosamente!",
                        icon: "success",
                        button: "ok",
                    })

                    .then((willDelete) => {
                        if (willDelete) {

                            $('#txt_nombre').val('');
                            $('#txt_credito').val('');
                            document.getElementById("btn_guardar").style.display = 'none';
                            movimientos(id_s);
                         

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
    }

} //fin

function limpiar_form(){
    $("#Select_Curso").val('');

    $('#numero').val('');
    $('#p_nombre').val('');
    $('#s_nombre').val('');
    $('#grado').val('');
    $('#grupo').val('');
    $('#txt_nombre').val('');
    $('#txt_credito').val('');
    $('#detalle_cursos').html('');
    document.getElementById("btn_guardar").style.display = 'none';
    $('#numero').prop("disabled", false);
    $('#Select_Curso').prop("disabled", true);
    $('#numero').focus();

}

function limpiar_modal(){

    $('#txt_buscar').val('');
    $('#Tbl_RegistroM').html('');


}


// validaciones

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
                var id_tcs = $(this).attr('f');
   
                eliminar(id_tcs);


            } else {
                swal("!No se Realizo Ningun Cambio!");
            }
        });


}
//fin

//validar buscar curso por codigo
var elem = document.getElementById("numero");
elem.onkeyup = function(e) {
        if (e.keyCode == 13) {

            buscar_estudiante($('#numero').val())

        }
    }
//fin

//validar buscar estudiante con filtro
var elem = document.getElementById("txt_buscar");
elem.onkeyup = function(e) {
        if (e.keyCode == 13) {

            buscar();

        }
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
    

// buscar lupa 
$('#btn_lupa').click(function(e) {

    $('.long.modal.tabla')
        .modal({
            centered: false
        })
        .modal('show');

}); //fin


// leer contenido de la tabla 
function selecionar() {
    var resume_table = document.getElementById("tbl");


    for (var i = 1, row; row = resume_table.rows[i]; i++) {


        

        for (var j = 0, col; col = row.cells[j]; j++) {

            console.log(`columna: ${col.innerText}`);
            console.log(j);

            

        }
    }
}

window.onload = function() {

    // creamos los eventos para cada elemento con la clase "tbl"

    let elementos = document.getElementsByClassName("tbl");

    for (let i = 0; i < elementos.length; i++) {
        // cada vez que se haga clic sobre cualquier de los elementos,

        // ejecutamos la función obtenerValores()

        elementos[i].addEventListener("click", obtenerValores);
    }

} //fin

// funcion que se ejecuta cada vez que se hace clic
function obtenerValores(e) {
const array = [];
var x = 0;
// vamos al elemento padre (<tr>) y buscamos todos los elementos <td>

// que contenga el elemento padre

var elementosTD = e.srcElement.parentElement.getElementsByTagName("td");



// recorremos cada uno de los elementos del array de elementos <td>
for (let i = 0; i < 5; i++) {
    switch (x) {

        case x = 0:
            array[x] = { s_id: elementosTD[i].innerHTML };
            x = x + 1;
            //console.log(' id x = 0');
            break;

        case x = 1:
            array[x] = { first_name: elementosTD[i].innerHTML };
            x = x + 1;
            //console.log(' primero x = 1');
            break;


        case x = 2:
            array[x] = { last_name: elementosTD[i].innerHTML };
            x = x + 1;
            //console.log(' digito x = 3');
            break;

        case x = 3:
            array[x] = { lv_id: elementosTD[i].innerHTML };
            x = x + 1;
            //console.log(' segundo x = 4');
            break;

        case x = 4:
            array[x] = { group: elementosTD[i].innerHTML };
            x = x + 1;
            //console.log(' r x=5');
            break;

        default:
           
    }

}


// cerramos el modal y mostramos los datos 
$('.ui.modal')
.modal('hide');

$('#numero').val(array[0]['s_id']);
$('#p_nombre').val(array[1]['first_name']);
$('#s_nombre').val(array[2]['last_name']);
$('#grado').val(array[3]['lv_id']);
$('#grupo').val(array[4]['group']);
movimientos(array[0]['s_id']);
CargarCursos();
$('#numero').prop("disabled", true);
$('#Select_Curso').prop("disabled", false);
$('#Select_Curso').focus();


} //fin
