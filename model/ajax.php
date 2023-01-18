<?php 

include '../model/conexion.php';

    // Login
    if ($_POST['action'] == 'Login'){ 
        
      if (!empty($_POST['usuario'])|| !empty($_POST['pass'])){
          
        $user = $_POST['usuario'];
			  $pass = $_POST['pass'];

          $sql="SELECT * FROM usuario where email LIKE '$user' and password LIKE '$pass'";
          $query = mysqli_query($conexion,$sql);

          $result = mysqli_num_rows($query);


          if($result > 0){

            while ($data = mysqli_fetch_assoc($query)) {
              session_start();
               $_SESSION['ih_id'] = $data['id_usuario'];
               $_SESSION['ih_email'] = $data['email'];
               $_SESSION['ih_nombre'] = $data['nombre'];
               $_SESSION['ih_tipo'] = $data['id_tipo'];

            }

            mysqli_close($conexion);
            exit;
         
          


          }else{

              $data=0;
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
              mysqli_close($conexion);
              exit;
          }
          
         
   
       }

       Print "Campos vacios";



      exit;
  
  
  
    }//fin

    // buscar estudiante  filtro por nombre y Id
    if ($_POST['action'] == 'Get_Studen'){ 
        
     // validar campos vacios
        if (!empty($_POST['buscar']) ){
          // variables
            $buscar = $_POST['buscar'];
            $filtro = $_POST['filtro'];


          if(!empty($_POST['filtro'])){

            if($filtro==1){
                 

              $sql=" SELECT est.s_id,CONCAT(est.first_name,' ',est.last_name) AS nombre_estudiante,
              est.lv_id,est.group,email,est.phone_number,est.geolocation,est.status FROM test_students est 
              WHERE s_id  like '%$buscar%'";
  
              $query = mysqli_query($conexion,$sql);
              $result = mysqli_num_rows($query);
                       
              $detalletabla = '';
              $arrayData  = array();
  
              if ($result > 0) {
                   
                       while ($data = mysqli_fetch_assoc($query)) {

                        if($data['status']==1){
                          $estado='<td class="positive" ><i class="icon checkmark"></i>Activo</td>';
                         }else{
                          $estado='<td class="negative" ><i class="icon close"></i>Desactivado</td>';
                         }
  
                       $detalletabla .= '<tr>
                                              <td class="tx">'.$data['s_id'].'</td>
                                              <td class="tx">'.$data['nombre_estudiante'].'</td>
                                              <td class="tx">'.$data['lv_id'].'</td>
                                              <td class="tx">'.$data['group'].'</td>
                                              <td class="tx">'.$data['email'].'</td>
                                              <td class="tx">'.$data['phone_number'].'</td>
                                              <td class="tx">'.$data['geolocation'].'</td>
                                              '.$estado.'
                                              <td>
                                                  <a style="cursor:pointer;" onclick=Ver_Cursos(f="'.$data['s_id'].'")>
                                                    <div class="ui small icon button">
                                                    <i class="thumbtack icon"></i>Cursos
                                                    </div>
                                                  </a> 
                                                  <a style="cursor:pointer;" onclick=Validar_Edita_Cliente(fac="'.$data['s_id'].'")>
                                                    <div class="ui small icon button">
                                                    <i class=" blue edit icon"></i>
                                                    </div>
                                                  </a>
                                                  <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['s_id'].'") >
                                                    <div class="ui small icon button">
                                                    <i class=" red trash icon"></i>
                                                    </div>
                                                  </a>
                                              </td>
                                             
                                          </tr>'; 
                          }
                                   $arrayData['detalle']= $detalletabla;
                                   echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                   mysqli_close($conexion);exit;
                                  
                                   
              }else{
                     echo "error";
                     mysqli_close($conexion);exit;
               }


            }else{

              $sql=" SELECT est.s_id,CONCAT(est.first_name,' ',est.last_name) AS nombre_estudiante,
              est.lv_id,est.group,email,est.phone_number,est.geolocation,est.status FROM test_students est
              WHERE CONCAT(est.first_name,' ',est.last_name)  like '%$buscar%'";
  
              $query = mysqli_query($conexion,$sql);
              $result = mysqli_num_rows($query);
                       
              $detalletabla = '';
              $arrayData  = array();
  
              if ($result > 0) {
                   
                       while ($data = mysqli_fetch_assoc($query)) {

                        if($data['status']==1){
                          $estado='<td class="positive" ><i class="icon checkmark"></i>Activo</td>';
                         }else{
                          $estado='<td class="negative" ><i class="icon close"></i>Desactivado</td>';
                         }
  
                       $detalletabla .= '<tr>
                                              <td class="tx">'.$data['s_id'].'</td>
                                              <td class="tx">'.$data['nombre_estudiante'].'</td>
                                              <td class="tx">'.$data['lv_id'].'</td>
                                              <td class="tx">'.$data['group'].'</td>
                                              <td class="tx">'.$data['email'].'</td>
                                              <td class="tx">'.$data['phone_number'].'</td>
                                              <td class="tx">'.$data['geolocation'].'</td>
                                              '.$estado.'
                                              <td>
                                                  <a style="cursor:pointer;" onclick=Ver_Cursos(f="'.$data['s_id'].'")>
                                                    <div class="ui small icon button">
                                                    <i class="thumbtack icon"></i>Cursos
                                                    </div>
                                                  </a> 
                                                  <a style="cursor:pointer;" onclick=Validar_Edita_Cliente(fac="'.$data['s_id'].'")>
                                                    <div class="ui small icon button">
                                                    <i class=" blue edit icon"></i>
                                                    </div>
                                                  </a>
                                                  <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['s_id'].'") >
                                                    <div class="ui small icon button">
                                                    <i class=" red trash icon"></i>
                                                    </div>
                                                  </a>
                                              </td>
                                          </tr>'; 
                          }
                                   $arrayData['detalle']= $detalletabla;
                                   echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                   mysqli_close($conexion);exit;
                                  
                                   
              }else{
                     echo "error";
                     mysqli_close($conexion);exit;
               }

            }


          }else{

            exit;

          }


        }else{

            $sql="SELECT est.s_id,CONCAT(est.first_name,' ',est.last_name) AS nombre_estudiante,
            est.lv_id,est.group,email,est.phone_number,est.geolocation,est.status FROM test_students est ";

            $query = mysqli_query($conexion,$sql);
            
            $result = mysqli_num_rows($query);
                     
            $detalletabla = '';
            $arrayData  = array();

            if ($result > 0) {
                 
                     while ($data = mysqli_fetch_assoc($query)) {

                       if($data['status']==1){
                        $estado='<td class="positive" style="cursor:pointer;" ><i class="icon checkmark"></i>Activo</td>';
                       }else{
                        $estado='<td class="negative" style="cursor:pointer;" ><i class="icon close"></i>Desactivado</td>';
                       }

                     $detalletabla .= '<tr>
                                          <td class="tx">'.$data['s_id'].'</td>
                                          <td class="tx">'.$data['nombre_estudiante'].'</td>
                                          <td class="tx">'.$data['lv_id'].'</td>
                                          <td class="tx">'.$data['group'].'</td>
                                          <td class="tx">'.$data['email'].'</td>
                                          <td class="tx">'.$data['phone_number'].'</td>
                                          <td class="tx">'.$data['geolocation'].'</td>
                                          '.$estado.'
                                          <td>
                                            <a style="cursor:pointer;" onclick=Ver_Cursos(f="'.$data['s_id'].'")>
                                              <div class="ui small icon button">
                                               <i class="thumbtack icon"></i>Cursos
                                              </div>
                                            </a> 
                                            <a style="cursor:pointer;" onclick=Validar_Edit_student(fac="'.$data['s_id'].'")>
                                              <div class="ui small icon button">
                                               <i class=" blue edit icon"></i>
                                              </div>
                                            </a>
                                            <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['s_id'].'") >
                                              <div class="ui small icon button">
                                               <i class=" red trash icon"></i>
                                              </div>
                                            </a>
                                         </td>
                                           
                                        </tr>'; 
                        }
                                 $arrayData['detalle']= $detalletabla;
                                 echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                 mysqli_close($conexion);exit;
                    
            }else{
                 echo "error";
                 mysqli_close($conexion);exit;
             }

        }

    }//fin

    // buscar estudiante por id
    if ($_POST['action'] == 'Get_st'){ 
        
        if (!empty($_POST['student'])){
            $id=$_POST['student'];

            $sql="SELECT * FROM test_students  WHERE s_id ='$id'";
            $query = mysqli_query($conexion,$sql);

            mysqli_close($conexion);
            $result = mysqli_num_rows($query);

            $data = '';
            
            if($result > 0){
            $data = mysqli_fetch_assoc($query);
          
            }else{
                $data= 0;
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }
        exit;
    
    
    
    }//fin

    // consulta todos los cursos atriculados X un estudiantem
    if ($_POST['action'] == 'Get_cursos'){ 
    
      if (!empty($_POST['student'])){

          $id=$_POST['student'];

          $sql="SELECT t.cxs_id,tc.c_id,tc.name,tc.credits from test_courses_x_student t  
          INNER JOIN test_students st on st.s_id=t.s_id
          INNER JOIN test_courses tc  on tc.c_id=t.c_id where st.s_id='$id'; ";
          
          $query = mysqli_query($conexion,$sql);
          $result = mysqli_num_rows($query);
                   
          $detalletabla = '';
          $arrayData  = array();

            if ($result > 0) {
               
                   while ($data = mysqli_fetch_assoc($query)) {

                 

                   $detalletabla .= '<tr>
                                          <td class="tx">'.$data['c_id'].'</td>
                                          <td class="tx">'.$data['name'].'</td>
                                          <td class="tx">'.$data['credits'].'</td>
                                         
                                          <td>
                                              <a style="cursor:pointer;" onclick=Ver_Cursos_(dir="'.$data['c_id'].'")>
                                                <div class="ui small icon button">
                                                <i class="thumbtack icon"></i>Cursos
                                                </div>
                                              </a> 
                                              <a style="cursor:pointer;" onclick=Validar_Edita_Cliente(fac="'.$data['c_id'].'")>
                                                <div class="ui small icon button">
                                                <i class=" blue edit icon"></i>
                                                </div>
                                              </a>
                                              <a style="cursor:pointer;"  onclick=ValidarRemove(fac="'.$data['cxs_id'].'") >
                                                <div class="ui small icon button">
                                                <i class=" red trash icon"></i>
                                                </div>
                                              </a>
                                          </td>
                                         
                                      </tr>'; 
                      }
                               $arrayData['detalle']= $detalletabla;
                               echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                               mysqli_close($conexion);exit;
         
            }else {
              print"error"; exit;
            }
      
          }
  
  
  }//fin

    // buscar un curso x id
    if ($_POST['action'] == 'Getcurso'){ 
        
        if (!empty($_POST['id'])){
            $id=$_POST['id'];

            $sql="SELECT tc.c_id,tc.name,tc.credits from test_courses tc  
            where c_id='$id'";
            $query = mysqli_query($conexion,$sql);

            mysqli_close($conexion);
            $result = mysqli_num_rows($query);

            $data = '';
            
            if($result > 0){
            $data = mysqli_fetch_assoc($query);
            //print_r($data);
            }else{
                $data= 0;
            }
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }
        exit;
    
    
    
    }//fin

    // consulta todos los cursos matriculados X un estudiante
    if ($_POST['action'] == 'Get_courses'){ 
    
        if (!empty($_POST['student'])){
  
            $id=$_POST['student'];
  
            $sql="SELECT t.cxs_id,tc.c_id,tc.name,tc.credits from test_courses_x_student t  
            INNER JOIN test_students st on st.s_id=t.s_id
            INNER JOIN test_courses tc  on tc.c_id=t.c_id where st.s_id='$id'; ";
            
            $query = mysqli_query($conexion,$sql);
            $result = mysqli_num_rows($query);
                     
            $detalletabla = '';
            $arrayData  = array();
  
              if ($result > 0) {
                 
                     while ($data = mysqli_fetch_assoc($query)) {
  
                   
  
                     $detalletabla .= '<tr>
                                            <td class="tx">'.$data['c_id'].'</td>
                                            <td class="tx">'.$data['name'].'</td>
                                            <td class="tx">'.$data['credits'].'</td>
                                           
                                            <td class="right aligned">                                              
                                                <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['cxs_id'].'") >
                                                  <div class="ui small icon button">
                                                  <i class=" red trash icon"></i>
                                                  </div>
                                                </a>
                                            </td>
                                           
                                        </tr>'; 
                        }
                                 $arrayData['detalle']= $detalletabla;
                                 echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                 mysqli_close($conexion);exit;
           
              }else {
                print"error"; exit;
              }
        
            }
    
    
    }//fin


      // consulta combo box cursos
    if ($_POST['action'] == 'Get_cbxcursos'){

      $detalleOption = '';
      $arrayData  = array();

      if(isset($_POST['id_menuSelected']))
      {
        $idPaginaSelected = $_POST['id_menuSelected'];
      }else {
        $idPaginaSelected ='';
      }
        
        $sql="SELECT * FROM test_courses";

          $query = mysqli_query($conexion,$sql);
          $result = mysqli_num_rows($query);

      if ($result > 0) {
        $sel='';
        while ($data = mysqli_fetch_assoc($query)) {
          
        
          if($idPaginaSelected  === $data['c_id'])
          { 
            $sel='selected';
          } else {
            $sel='';
          }
          
            $detalleOption .= '<option  '.$sel.'
                                value="'.$data['c_id'].'"> '.$data['c_id'].' 
                              </option>';             
                
        }
            $arrayData['Combobox'] = $detalleOption;
            echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
            mysqli_close($conexion); exit;
      
      }else{
        echo'No hay Registros';
        mysqli_close($conexion); exit;
      }


    }//fin

    // Guardar Curso x estudiante
    if ($_POST['action'] == 'GuardarC'){ 
        
        $s_id=$_POST['id_s'];
        $c_id=$_POST['id_c'];

        
        $sql="INSERT INTO test_courses_x_student(c_id, s_id) VALUES ($c_id,$s_id)";
  
        if( mysqli_query($conexion,$sql) ) {
            mysqli_close($conexion);
            exit;
        }else{
            echo "fallo en la consulta " . $sql . "-" . mysqli_error($conexion);
            mysqli_close($conexion);
            exit;
        }
        
    
    
    }//fin

    // eliminar Curso x estudiante
    if ($_POST['action'] == 'Deltcs'){ 
        
        $id_s=$_POST['id_s'];
        $id_cxs = $_POST['id_c'];
      
        $sql="DELETE FROM test_courses_x_student WHERE cxs_id='$id_cxs' and s_id='$id_s'";

        if( mysqli_query($conexion,$sql) ) {
            mysqli_close($conexion);
            exit;
        }else{
            echo "fallo en la consulta " . $sql . "-" . mysqli_error($conexion);
            mysqli_close($conexion);
            exit;
        }
        
    
    
    }//fin

    // buscar estudiante por nombre y Id buscar lupa
    if ($_POST['action'] == 'bs_lupa'){ 
        
          // validar campos vacios
             if (!empty($_POST['buscar']) ){
               // variables
                 $buscar = $_POST['buscar'];
                 $filtro = $_POST['filtro'];
     
     
               if(!empty($_POST['filtro'])){
     
                 if($filtro==1){
                      
     
                   $sql=" SELECT est.s_id,est.first_name,est.last_name,
                   est.lv_id,est.group,email,est.phone_number,est.geolocation,est.status FROM test_students est 
                   WHERE s_id  like '%$buscar%'";
       
                   $query = mysqli_query($conexion,$sql);
                   $result = mysqli_num_rows($query);
                            
                   $detalletabla = '';
                   $arrayData  = array();
       
                   if ($result > 0) {
                        
                            while ($data = mysqli_fetch_assoc($query)) {
     
                             if($data['status']==1){
                               $estado='<td class="positive" ><i class="icon checkmark"></i>Activo</td>';
                              }else{
                               $estado='<td class="negative" ><i class="icon close"></i>Desactivado</td>';
                              }
       
                            $detalletabla .= '<tr>
                                                  <td class="tx">'.$data['s_id'].'</td>
                                                  <td class="tx">'.$data['first_name'].'</td>
                                                  <td class="tx">'.$data['last_name'].'</td>
                                                  <td class="tx">'.$data['lv_id'].'</td>
                                                  <td class="tx">'.$data['group'].'</td>
                                                  
                                               </tr>'; 
                               }
                                        $arrayData['detalle']= $detalletabla;
                                        echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                        mysqli_close($conexion);exit;
                                       
                                        
                   }else{
                          echo "error";
                          mysqli_close($conexion);exit;
                    }
     
     
                 }else{
     
                   $sql=" SELECT est.s_id,est.first_name,est.last_name,
                   est.lv_id,est.group,email,est.phone_number,est.geolocation,est.status FROM test_students est
                   WHERE CONCAT(est.first_name,' ',est.last_name)  like '%$buscar%'";
       
                   $query = mysqli_query($conexion,$sql);
                   $result = mysqli_num_rows($query);
                            
                   $detalletabla = '';
                   $arrayData  = array();
       
                   if ($result > 0) {
                        
                            while ($data = mysqli_fetch_assoc($query)) {
     
                             if($data['status']==1){
                               $estado='<td class="positive" ><i class="icon checkmark"></i>Activo</td>';
                              }else{
                               $estado='<td class="negative" ><i class="icon close"></i>Desactivado</td>';
                              }
       
                            $detalletabla .= '<tr>
                                                  <td class="tx">'.$data['s_id'].'</td>
                                                  <td class="tx">'.$data['first_name'].'</td>
                                                  <td class="tx">'.$data['last_name'].'</td>
                                                  <td class="tx">'.$data['lv_id'].'</td>
                                                  <td class="tx">'.$data['group'].'</td>
                                              </tr>'; 
                               }
                                        $arrayData['detalle']= $detalletabla;
                                        echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                        mysqli_close($conexion);exit;
                                       
                                        
                   }else{
                          echo "error";
                          mysqli_close($conexion);exit;
                    }
     
                 }
     
     
               }else{
     
                 exit;
     
               }
     
     
             }else{
     
                 $sql="SELECT est.s_id,est.first_name,est.last_name,est.lv_id,est.group,email,est.phone_number,
                 est.geolocation,est.status FROM test_students est ";
     
                 $query = mysqli_query($conexion,$sql);
                 
                 $result = mysqli_num_rows($query);
                          
                 $detalletabla = '';
                 $arrayData  = array();
     
                 if ($result > 0) {
                      
                          while ($data = mysqli_fetch_assoc($query)) {
     
                            if($data['status']==1){
                             $estado='<td class="positive" style="cursor:pointer;" ><i class="icon checkmark"></i>Activo</td>';
                            }else{
                             $estado='<td class="negative" style="cursor:pointer;" ><i class="icon close"></i>Desactivado</td>';
                            }
     
                          $detalletabla .= '<tr>
                                               <td class="tx">'.$data['s_id'].'</td>
                                               <td class="tx">'.$data['first_name'].'</td>
                                               <td class="tx">'.$data['last_name'].'</td>
                                               <td class="tx">'.$data['lv_id'].'</td>
                                               <td class="tx">'.$data['group'].'</td>
                                             </tr>'; 
                             }
                                      $arrayData['detalle']= $detalletabla;
                                      echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                                      mysqli_close($conexion);exit;
                         
                 }else{
                      echo "error";
                      mysqli_close($conexion);exit;
                  }
     
             }
     
    }//fin


    if ($_POST['action'] == 'Get_rpx'){ 

        $sql="SELECT e.s_id,CONCAT(e.first_name, ' ',e.last_name) as nombre, e.lv_id, e.group,ts.name,ts.credits FROM test_students e 
        INNER JOIN test_courses_x_student cs on  cs.s_id=e.s_id 
        INNER JOIN test_courses ts on ts.c_id=cs.c_id 
        ORDER by E.s_id";

        $query = mysqli_query($conexion,$sql);
        $result = mysqli_num_rows($query);
                
        $detalletabla = '';
        $arrayData  = array();

        if ($result > 0) {
            
                while ($data = mysqli_fetch_assoc($query)) {

               

                $detalletabla .= '<tr>
                                        <td class="tx">'.$data['s_id'].'</td>
                                        <td class="tx">'.$data['nombre'].'</td>
                                        <td class="tx">'.$data['lv_id'].'</td>
                                        <td class="tx">'.$data['group'].'</td>
                                        <td class="tx">'.$data['name'].'</td>
                                        <td class="tx">'.$data['credits'].'</td>                                                                            
                                    </tr>'; 
                    }
                            $arrayData['detalle']= $detalletabla;
                            echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);
                            mysqli_close($conexion);exit;
                            
                            
        }else{
              echo "error";
              mysqli_close($conexion);exit;
        }


    }


    

    


        


