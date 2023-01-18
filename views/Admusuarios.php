
<?php
 require 'includes/funciones.php';
  incluirTemplate('header_admin',);
?> 
<body>

<?php include 'includes/templates//adm.php' ?>  
<div class="ui hidden divider"></div>



<div class="ui very relax container m-a-70-m-b-70 ">
  <!-- Formulario usuarios -->

  <div class="ui secondary segment">  
    
    <div class="ui form">
        <h4 class="ui dividing header">Registro Usuario</h4> 
    
        <div class="equal width  fields">
      
          <div class="eight wide field">
            <label>Cedula</label>
            <input  type="text" id="cedula" placeholder="Identificaciòn"  onkeypress="return valideKey(event);">
            
          </div>
          
          <div  class="field">
          <label>Nombre</label>
            <input type="text"  id="nombre" placeholder="Nombres">
            
          </div>

          <div  class="field">
            <label>Apellidos</label>
            <input type="text" name="apellido" id="apellido" placeholder="Apellidos" >
          </div>

          <div class="field">
            <label>Correo</label>
            <input type="text" id="correo"  name="correo"  placeholder="Correo Electronico" type="text" >
          </div>

          <div class="eight wide field">
            <label>Telefono</label>
            <input type="text" id="telefono" name="telefono" placeholder="Telefono" type="text" onkeypress="return valideKey(event);">
          </div>
    
          <div class="field">
            <label>Contraseña</label>
            <input type="text" id="pass" name="pass" placeholder="Digite una Contraseña" type="text" onkeypress="return valideKey(event);">
          </div>
        
        </div>
        <input class="ui green button" onclick="Guardar();" type="submit"  value="Guardar">
        <input onclick="cancelar();" class="ui  button" type="submit" id="btn_cancelar" value="Cancelar" >

    </div> 

  </div>

  <!-- fin -->

  <!-- Tabla de Registros -->
  <table class="ui striped table">
    <thead>
      <tr class="ui inverted table">
        <th>Identificacion</th>
        <th>Correo</th>
        <th>Nombre Completo</th>
        <th>Acciones</th>
        
      </tr>
    </thead>
    <tbody id="Tbl_Registro">
        
    </tbody>
  </table>
        
  <!-- fin -->
  <div class="ui divider"></div>

    <!-- modal Edit -->
    <div class="ui modal " >
        <div class="ui secondary segment">  
          <div class="ui form">
              <h4 class="ui dividing header">Registro Usuario</h4> 
              <input type="hidden" name="id_usuario" id="id_usuario" value="">
            
                <div class="equal width  fields">
              
                  <div class="eight wide field">
                    <label>Cedula</label>
                    <input  type="text" id="ecedula" placeholder="Identificaciòn" value=""  onkeypress="return valideKey(event);">
                    
                  </div>
                  
                  <div  class="field">
                  <label>Nombre</label>
                    <input type="text"  id="enombre" placeholder="Nombres" value="">
                    
                  </div>

                  <div  class="field">
                    <label>Apellidos</label>
                    <input type="text" name="eapellido" id="eapellido" placeholder="Apellidos" value="" >
                  </div>

                  <div class="field">
                    <label>Correo</label>
                    <input type="text" id="ecorreo"  name="correo"  placeholder="Correo Electronico" type="text" value="" >
                  </div>

                
              
                  <div class="field">
                    <label>Contraseña</label>
                    <input type="text" id="epass" name="pass" placeholder="Telefono" type="text" >
                  </div>
                
                </div>

                <button class="ui green approve button" onclick="Modificar()" id="btn_mod_student">Actualizar</button>
                <button class="ui cancel button" onclick="Cerrar()">Cancel</button>

        </div> 
      </div>
    </div>
        <!-- fin -->

        
    

</div>
</body>
<?php
    incluirTemplate('footer_admin');
?>

<script type="text/javascript" src="build/js/Funciones_Usuario.js" ></script>


