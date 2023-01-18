<?php
 require 'includes/funciones.php';
  incluirTemplate('header_admin',);
?> 
<body>

  <div><?php include 'includes/templates//adm.php' ?></div>
 
 
  <div class="ui very relax container m-a-70-m-b-80 ">
  <div class="ui hidden divider"></div>
 
  <h3 class="ui center aligned header">Matriculas</h3>

    <div class="ui secondary segment">

        <div class="ui form">
          <h4 class="ui dividing header">Datos del estudiante</h4> 
          
            <div class="equal width  fields">
           
              <div class="seven wide field">
                <label>Nuemero Id</label>
                <div class="ui mini icon input">
                   <input type="text" name="numero" id="numero"  onkeypress="return valideKey(event);" >
                    <div class="ui small icon button" data-content="Buscar" id="btn_lupa">
                        <i class="inverted tiny circular search link icon" type="submit"></i>
                    </div>
                </div>
              </div>

              <div class="field">
                <label>Primer Nombre</label>
                <input disabled  id="p_nombre" type="text" required > 
              </div>

              <div class="field">
                <label>Primer Apellido</label>
                <input disabled  id="s_nombre" type="text" required > 
              </div>

              <div class="four wide field">
               <label>Grado</label>
               <input disabled id="grado" type="text" >
              </div>

              <div class="seven wide field">
               <label>Grupo</label>
               <input disabled  id="grupo" type="text" >
              </div>
            </div>
            
        </div>

       <!-- fin -->

       <div class="ui hidden divider"></div>

       <!-- tabla de selecion de cursos -->
       <selection >
        <h4 class="ui dividing header">Cursos</h4> 
        <input type="hidden" id="id_curso">
        <input type="hidden" id="id_mov">
        <table class="ui very compact  small  table" id="tbl_venta">
            <thead>
            <tr class="ui inverted table" >
                <th width="150px"><h5 class=" ui header" style="color:#ffff" scope="col">Codigo</h5</th>
                <th width="550px"><h5 class="ui header" style="color:#ffff" scope="col">Nombre</h5></th>
                <th width="150px" class="left aligned"><h5 class="ui header" style="color:#ffff" scope="col">Creditos</h5></th>
                <th class="right aligned"><h5 class=" ui header" style="color:#ffff" scope="col">Accion</h5></th>
            </tr>
         
                <tr>
                    <td>   
                        <select disabled name="Select" id="Select_Curso" class="ui fluid search dropdown" name="">
                            <option value="" disabled selected>--Codigo--</option>
                        </select>
                    </td> 
                <td>
                    <div class="ui fluid icon input">
                        <input disabled type="text" name="txt_nombre" id="txt_nombre" >
                        
                    </div>
                </td>

                <td>
                    <div class="ui fluid icon input">
                        <input disabled type="text" name="txt_credito" id="txt_credito">
                    </div>
                </td>
             

                <td class="right aligned"> 
                    <button class="ui mini blue icon button" id="btn_guardar" names="btn_guardar" onclick="Guardar()" style="display:none;">
                        <i class="plus square icon"></i>
                    </button>

                    <button class="ui mini  icon button" id="btn_modificar" names="btn_modificar" onclick="Modificar()" style="display:none;">
                        <i class="plus green icon"></i>
                    </button>

                    <button class="ui mini  icon button" id="btn_cancelar" names="btn_cancelar" onclick="Limpiar_Formulario()" style="display:none;">
                        <i class="window red close icon"></i>
                    </button>
                        <!-- <a  id="btn_g" names="btn_guardar" onclick="Guardar()" style="cursor:pointer" class="ui mini blue button" ><i class="plus square icon"  ></i></a> -->
                        <!-- <a  id="btn_modificar" onclick="Modificar()" style="display:none; cursor:pointer" class="link_add" ><i class="plus green icon"></i>Modificar</a>
                        <a id="btn_cancelar" onclick="Limpiar_Formulario()" style="display:none; cursor:pointer"class="link_add" ><i class="window red close icon"></i>Cancelar</a>          -->
                </td>

                </tr>
                <!-- fin -->

            </thead>

            <!-- Tabla resumen factura -->
            <tfoot id="detalle_totales">
                <!-- Tabla ajax -->
            </tfoot>
        </table>
       </selection>
       <!-- fin -->

       <div class="ui secondary segment">
        <h4>Cursos Matriculados</h4>
        <!-- tabla de movimientos -->
        <selection>
            <table class="ui very compact  small  table" id="tbl_venta">
                <thead>
                    <tr class="ui inverted table">
                        <th width="150px"><h5 class=" ui header" style="color:#ffff" scope="col">Codigo</h5</th>
                        <th width="550px"><h5 class="ui header" style="color:#ffff" scope="col">Nombre</h5></th>
                        <th width="150px"><h5 class="ui header" style="color:#ffff" scope="col">Creditos</h5></th>
                        <th class="right aligned"><h5 class=" ui header" style="color:#ffff" scope="col">Accion</h5></th>
                    </tr>
                </thead>    

                <tbody id="detalle_cursos">
                    <!-- Tabla ajax -->
                </tbody>
            </table>
            <!-- fin -->
        </selection>
       </div>
        

        <!-- modal  buscar lupa -->
        <div style="width: auto; height:auto;" class="ui long modal tabla">
            <!-- tabla de Registros -->
            <div class="ui secondary segment">
                <div class="ui stackable  form">
                    <div class="fields">
                        <div class="field">
                            <label>Buscar</label>
                            <input type="text"  id="txt_buscar" placeholder="Buscar ...">
                            
                        </div>
                        <div class="field">
                            <label>Filtro</label>
                            <select class="ui fluid search dropdown" id="filtro">
                                <option value="1">Id</option>
                                <option value="2">Nombre</option>
                            </select>
                        </div>

                    
                    </div>
                </div>
            </div>
            <table id='tbl' class="ui selectable collapsing celled  table tbl">
                <thead>
                    <tr id="row" class="ui inverted table">
                        <th>Id</th>
                        <th>Primer nombre</th>
                        <th>Primer Apellido</th>
                        <th>Grado</th>
                        <th>Grupo</th>
                    </tr>
                </thead>
                    <tbody id="Tbl_RegistroM">
                    <!-- Tabla ajax -->
                    </tbody>
            </table>
            <div class="actions">
                <div class="ui cancel button" onclick="limpiar_modal()">Cancelar</div>                       
            </div>
        </div>
        <!-- fin -->

   
        <div class="ui green compact segment">
          <div class="ui small basic icon buttons">          
            <a style="cursor:pointer" href="?opcion=inicio"  class="ui red button"><i class="angle double left icon"></i> Atras</a>
            <a style="cursor:pointer" onclick="limpiar_form()"  class="ui red button">Limpiar <i class="red trash icon"></i></a>
          </div>
        </div>
 

    </div>

  </div>
</body>

 

<?php
    incluirTemplate('footer_admin');
?>
 
  <script type="text/javascript" src="build/js/Funciones_Asignacion.js"></script>