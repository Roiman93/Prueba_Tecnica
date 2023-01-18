<?php
 require 'includes/funciones.php';
  incluirTemplate('header_admin',);
?> 
<body>

<?php include 'includes/templates//adm.php' ?>

  <div class="ui hidden divider"></div>
  <h3 class="ui center aligned header">Informe</h3>
    <div class="ui very relax container m-a-70-m-b-70 ">
        
   
        
        <!-- tabla de Registros -->        
        <table  class="ui very compact selectable celled small  table" >
            <thead class="ui sticky" >
                <tr class="ui sticky inverted table">
                    
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col"> identificación</h5> </th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Nombres Completo</h5> </th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Grado</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Grupo</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Nombre Curso</h5></th>
                    <th> <h5 class=" ui header" style="color:#ffff" scope="col">Credito</h5></th>
                    
                
                </tr>
                
            </thead>
                
            <tbody id="Tbl_Registro">
                <!-- Tabla ajax -->
            </tbody>
               
            
        </table>
        <!-- fin -->
        
                
        <!-- fin -->
        <div class="ui hidden divider"></div>

      
    </div>

    <h4 class="ui dividing header"></h4> 
     
</body>
<?php
    incluirTemplate('footer_admin');
?>

<script type="text/javascript" src="build/js/Funciones_Reportes.js" ></script>




 