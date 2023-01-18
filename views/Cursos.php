<?php
 require 'includes/funciones.php';
  incluirTemplate('header_admin',);
?> 
<body>

<?php include 'includes/templates//adm.php' ?>

  <div class="ui hidden divider"></div>

    <div class="ui very relax container m-a-70-m-b-70 ">
    <h3 class="ui center aligned header">Cursos</h3>

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
                    
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col"> Codigo</h5> </th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Nombre</h5> </th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Creadito</h5></th>
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
       
                        <div class="equal width  fields">
                     
                            <div class="field" id="grupo__c_nombre">
                                <label>Nombre</label>
                               
                                <input  name="cp_nombre" id="c_nombre" type="text" > 
                                
                                <p class="formulario__input-error">El Nombre no puede contener caracteres especiales </p>
                            </div>

                            <div class="field" id="grupo__c_credito">
                                <label>Creditos</label>
                                <input name="c_credito" id="c_credito" type="text" >
                                <p class="formulario__input-error">Solo debe contener numeros</p>
                            </div>
                </div>
                <div class="ui green approve mini button" onclick="Ejecutar_G()">Guardar</div>
                <button class="ui cancel mini button" onclick="Cerrar(1)">Cancel</button>
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
                     
                            <div class="field" id="grupo__nombre">
                                <label>Nombre</label>
                               
                                <input placeholder="Primer Nombre" name="nombre" id="nombre" type="text" > 
                                
                                <p class="formulario__input-error">El Nombre no puede contener caracteres especiales</p>
                            </div>

                            <div class="field" id="grupo__credito">
                                <label>Creditos</label>
                                <input name="credito" id="credito" type="text" >
                                <p class="formulario__input-error">Solo debe contener numeros</p>
                            </div>

                        </div>

                        <button class="ui green approve mini button" onclick="Ejecutar_M()" id="btn_mod_student">Actualizar</button>
                        <button class="ui cancel mini button" onclick="Cerrar(0)">Cancel</button>
                      
                </div>
            </div> 
        </div>
        <!-- fin -->
      
    </div>
     
</body>
<?php
    incluirTemplate('footer_admin');
?>

<script type="text/javascript" src="build/js/Funciones.js" ></script>




 