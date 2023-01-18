<?php 

include '../model/conexion.php';

    // Guardar student
    if ($_POST['action'] == 'Guardar'){ 
        
        $p_nombre=$_POST['p_nombre'];
        $p_apellido=$_POST['p_apellido'];
        $grado=$_POST['grado'];
        $grupo=$_POST['grupo'];
        $email=$_POST['email'];
        $telefono=$_POST['telefono'];
        $ubicacion=$_POST['ubicacion'];
        

        $sql="INSERT INTO test_students( `first_name`, `last_name`, `lv_id`, `group`, `email`, `phone_number`, `geolocation`, `status`)
         VALUES ('$p_nombre','$p_apellido','$grado','$grupo','$email','$telefono','$ubicacion','1')";

  
        if( mysqli_query($conexion,$sql) ) {
            mysqli_close($conexion);
            exit;
        }else{
            echo "fallo en la consulta " . $sql . "-" . mysqli_error($conexion);
            mysqli_close($conexion);
            exit;
        }
        
    
    
    }//fin
    
    // Modificar student
    if($_POST['action']=='Modificar'){
        
        $id_st=$_POST['st'];
        $p_nombre=$_POST['p_nombre'];
        $p_apellido=$_POST['p_apellido'];
        $grado=$_POST['grado'];
        $grupo=$_POST['grupo'];
        $email=$_POST['email'];
        $telefono=$_POST['telefono'];
        $ubicacion=$_POST['ubicacion'];
    
        // se insertan los datos
        $sql =" UPDATE `test_students` SET `first_name`='$p_nombre',`last_name`='$p_apellido',`lv_id`='$grado',`group`='$grupo',
        `email`='$email',`phone_number`='$telefono',`geolocation`='$ubicacion',`status`='1' WHERE s_id='$id_st'";
       
                                            
        if (mysqli_query($conexion,$sql)) {
            mysqli_close($conexion);
            exit;
    
        } else {
    
            mysqli_close($conexion);
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            exit;
    
        }
    
    
    
    
    
    
    
    
    
    }//fin


      // Modificar estado
      if($_POST['action']=='Get_Status'){
        
        $id_st=$_POST['st'];
        $cp=$_POST['cp'];
       
    
        // se insertan los datos
        $sql =" UPDATE `test_students` SET `status`='$cp' WHERE s_id='$id_st'";
       
                                     
        if (mysqli_query($conexion,$sql)) {
            mysqli_close($conexion);
            exit;
    
        } else {
    
            mysqli_close($conexion);
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            exit;
    
        }

    
    }//fin

    // Eliminar student
    if($_POST['action']=='Eliminar'){
    
        $id_st = $_POST['st'];
    
        
        $sql ="DELETE FROM test_students WHERE  s_id=$id_st ";
                                            
        if (mysqli_query($conexion,$sql)) {
         
            mysqli_close($conexion);
            exit;
    
        } else {
    
            mysqli_close($conexion);
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
            exit;
    
        }
    
    
    
    
    
    
    
    
    
    }//fin


    // buscar estudiante  filtro por nombre y Id
    if ($_POST['action'] == 'Get_Studen'){ 
      
      // variables
       isset($_POST['buscar']) ? $buscar = $_POST['buscar'] : $buscar='' ;
       isset($_POST['filtro']) ? $filtro = $_POST['filtro'] : $filtro='';
              
      // validar campos vacios
               if (!empty($buscar)){
                 
                   if($filtro==1){
                    // buscar por id
                        
       
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
                                    $estado='<td class="positive" style="cursor:pointer;" onclick=Validar_StatusD(f="'.$data['s_id'].'")><i class="icon checkmark"></i>Activo</td>';
                                   }else{
                                    $estado='<td class="negative" style="cursor:pointer;" onclick=Validar_StatusA(f="'.$data['s_id'].'")><i class="icon close"></i>Desactivado</td>';
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
       
       
                   }else{

                    // buscar por nombre
       
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
                                    $estado='<td class="positive" style="cursor:pointer;" onclick=Validar_StatusD(f="'.$data['s_id'].'")><i class="icon checkmark"></i>Activo</td>';
                                   }else{
                                    $estado='<td class="negative" style="cursor:pointer;" onclick=Validar_StatusA(f="'.$data['s_id'].'")><i class="icon close"></i>Desactivado</td>';
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
                                    $estado='<td class="positive" style="cursor:pointer;" onclick=Validar_StatusD(f="'.$data['s_id'].'")><i class="icon checkmark"></i>Activo</td>';
                                   }else{
                                    $estado='<td class="negative" style="cursor:pointer;" onclick=Validar_StatusA(f="'.$data['s_id'].'")><i class="icon close"></i>Desactivado</td>';
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


    




