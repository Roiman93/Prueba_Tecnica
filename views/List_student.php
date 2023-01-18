<?php
 require 'includes/funciones.php';
  incluirTemplate('header_admin',);
?> 
<body>

<?php include 'includes/templates//adm.php' ?>

  <div class="ui hidden divider"></div>
  <h3 class="ui center aligned header">Estudiantes</h3>
    <div class="ui very relax container m-a-70-m-b-70 ">
   
         <div class="ui  segmen">
         <div class="ui stackable  form">
            <div class="two fields">
                <div class="field">
                    <label>Buscar</label>
                    <div class="ui icon input">
                    <input type="text"  id="txt_buscar" placeholder="Buscar...">
                    <i class="inverted circular search link icon" type="submit" onclick="Buscar();" id="btn_buscar_fact" ></i>
                    </div>
                </div>

                <div class="two wide field">
                    <label>Filtro</label>
                    <select class="ui fluid search dropdown" id="filtro">
                        <option value="1">Id</option>
                        <option value="2">Nombre</option>
                    </select>
                </div>
            </div>
            </div>  
           
          <button class=" right attached blue ui button" onclick="Crear()">Nuevo Registro</button>
        </div>
        
        <!-- tabla de Registros -->        
        <table  class="ui very compact selectable celled small  table" >
            <thead class="ui sticky" >
                <tr class="ui sticky inverted table">
                    
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col"> Id</h5> </th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Nombres Completo</h5> </th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Grado</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Grupo</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Email</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Telefono</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Geolocalizaciòn</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Estado</h5></th>
                    <th class="textright"> <h5 class=" ui header" style="color:#ffff" scope="col">Acciones</h5></th>
                
                </tr>
                
            </thead>
                
            <tbody id="Tbl_Registro">
                <!-- Tabla ajax -->
            </tbody>
               
            
        </table>
        <!-- fin -->
        
                
        <!-- fin -->
        <div class="ui hidden divider"></div>

        <!-- modal crear -->
        <div class="ui modal crear" id="frm_crear">
            <div class="ui secondary segment">  
                <div class="ui form">
                    <h4 class="ui dividing header">Datos del Estudiante</h4> 
                    <input type="hidden" id="id_st">
                        <div class="equal width  fields">
                     
                            <div class="field" id="grupo__cp_nombre">
                                <label>Primer Nombre</label>
                               
                                <input placeholder="Primer Nombre" name="cp_nombre" id="cp_nombre" type="text" > 
                                
                                <p class="formulario__input-error">El Nombre no puede contener caracteres especiales</p>
                            </div>

                            <div class="field" id="grupo__cp_apellido">
                                <label>Primer Apelldio</label>
                                <input placeholder="Segundo Nombre" name="cp_apellido" id="cp_apellido" type="text" >
                                <p class="formulario__input-error">El Nombre no puede contener caracteres especiales</p>
                            </div>

                            <div class=" two field" id="grupo__cp_grado">
                                <label>Grado</label>
                                <input  name="cp_grado" id="cp_grado" type="text"  onkeypress="return valideKey(event);" >
                                <p class="formulario__input-error">El grado solo puede contener un numero entero</p>
                            </div>

                            <div class=" three field" id="grupo__cp_grupo">
                                <label>Grupo</label>
                                <input name="cp_grupo" id="cp_grupo" type="text" >
                                <p class="formulario__input-error">El grupo solo puede contener una letra de la A-Z</p>
                            </div>

                        </div>

                        <div class="equal width  fields">
                            <div class="field" id="grupo__cp_email">
                                <label>Email</label>
                                <input placeholder="@ejemplo.com" name="cp_email" id="cp_email" type="email" >
                                <p class="formulario__input-error">Ingrese un correo valido</p>
                            </div>

                            <div class="field" id="grupo__cp_telefono">
                                <label>Telefono</label>
                                <input placeholder="3105607860" name="cp_telefono" id="cp_telefono" type="text" onkeypress="return valideKey(event);">
                                <p class="formulario__input-error">El campo telefono no puede contener letras solo numeros</p>
                            </div>

                            <div class="field" id="grupo__cp_Glocation">
                                <label>Geolocalizacion</label>
                                <input name="cp_Glocation"  id="cp_Glocation" type="text" >
                                <p class="formulario__input-error">Ingrese los datos correctamente</p>
                            </div>
                        </div>

                        <div class="ui green approve button" onclick="Ejecutar_G()">Guardar</div>
                        <button class="ui cancel button" onclick="Cerrar(1)">Cancel</button>

                </div>
            </div> 
        </div>
         <!-- fin -->

        <!-- modal editar -->
        <div class="ui modal edit" id="frm_edit">
            <div class="ui secondary segment">  
                <div class="ui form">
                    <h4 class="ui dividing header">Datos del Estudiante</h4> 
                    <input type="hidden" id="id_st">
                        <div class="equal width  fields">
                     
                            <div class="field" id="grupo__p_nombre">
                                <label>Primer Nombre</label>
                               
                                <input placeholder="Primer Nombre" name="p_nombre" id="p_nombre" type="text" > 
                                
                                <p class="formulario__input-error">El Nombre no puede contener caracteres especiales</p>
                            </div>

                            <div class="field" id="grupo__p_apellido">
                                <label>Primer Apellido</label>
                                <input name="p_apellido" id="p_apellido" type="text" >
                                <p class="formulario__input-error">El Nombre no puede contener caracteres especiales</p>
                            </div>

                            <div class=" two field" id="grupo__grado">
                                <label>Grado</label>
                                <input  name="grado" id="grado" type="number" max="1" min="0" onkeypress="return valideKey(event);" >
                                <p class="formulario__input-error">El grado solo puede contener un numero entero</p>
                            </div>

                            <div class=" three field" id="grupo__grupo">
                                <label>Grupo</label>
                                <input name="grupo" id="grupo" max="1" type="text" >
                                <p class="formulario__input-error">El grupo solo puede contener una letra de la A-Z</p>
                            </div>

                        </div>

                        <div class="equal width  fields">
                            <div class="field" id="grupo__email">
                                <label>Email</label>
                                <input placeholder="@ejemplo.com" name="email" id="email" type="email" >
                                <p class="formulario__input-error">Ingrese un correo valido</p>
                            </div>

                            <div class="field" id="grupo__telefono">
                                <label>Telefono</label>
                                <input placeholder="3105607860" name="telefono" id="telefono" type="text" onkeypress="return valideKey(event);">
                                <p class="formulario__input-error">El campo telefono no puede contener letras solo numeros</p>
                            </div>

                            <div class="field" id="grupo__Glocation">
                                <label>Geolocalizacion</label>
                                <input name="Glocation"  id="Glocation" type="text" >
                                <p class="formulario__input-error">Ingrese los datos correctamente</p>
                            </div>
                        </div>
                        
                        <button class="ui green approve button" onclick="Ejecutar_M()" id="btn_mod_student">Actualizar</button>
                        <button class="ui cancel button" onclick="Cerrar(0)">Cancel</button>
                      
                        

                </div>
            </div> 
        </div>
        <!-- fin -->
      
    </div>

    <h4 class="ui dividing header"></h4> 
     
</body>
<?php
    incluirTemplate('footer_admin');
?>

<script type="text/javascript" src="build/js/Funciones_List_Student.js" ></script>




 