<?php 

include '../model/conexion.php';

    // Guardar student
    if ($_POST['action'] == 'Guardar'){ 
        
        $nombre=$_POST['nombre'];
        $credito=$_POST['credito'];
                

        $sql="INSERT INTO `test_courses`( `name`, `credits`)
         VALUES ('$nombre','$credito')";

  
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
        $nombre=$_POST['nombre'];
        $credito=$_POST['credito'];
        
    
        // se insertan los datos
        $sql ="UPDATE test_courses SET `name`='$nombre',`credits`='$credito' WHERE c_id=' $id_st'";
       
                                            
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
    
        $sql ="DELETE FROM test_courses WHERE  c_id=$id_st ";
                                            
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
    if ($_POST['action'] == 'Get_cursos'){ 
        
            // validar campos vacios
               if (!empty($_POST['buscar']) ){
                 // variables
                   $buscar = $_POST['buscar'];
                   $filtro = $_POST['filtro'];
       
       
                 if(!empty($_POST['filtro'])){
       
                   if($filtro==1){
                        
       
                     $sql=" SELECT * FROM test_courses 
                     WHERE c_id  like '%$buscar%'";
         
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
                                                         <a style="cursor:pointer;" onclick=Validar_Edita(fac="'.$data['c_id'].'")>
                                                           <div class="ui small icon button">
                                                           <i class=" blue edit icon"></i>
                                                           </div>
                                                         </a>
                                                         <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['c_id'].'") >
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
       
                     $sql=" SELECT * FROM test_courses t
                     WHERE t.name like '%$buscar%'";
         
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
                                                         <a style="cursor:pointer;" onclick=Validar_Edita(fac="'.$data['c_id'].'")>
                                                           <div class="ui small icon button">
                                                           <i class=" blue edit icon"></i>
                                                           </div>
                                                         </a>
                                                         <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['c_id'].'") >
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
       
                   $sql="SELECT * FROM test_courses ";
       
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
                                                   <a style="cursor:pointer;" onclick=Validar_Edita(fac="'.$data['c_id'].'")>
                                                     <div class="ui small icon button">
                                                      <i class=" blue edit icon"></i>
                                                     </div>
                                                   </a>
                                                   <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['c_id'].'") >
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

    // buscar x id
    if ($_POST['action'] == 'Get_curso'){ 
        
        if (!empty($_POST['id'])){

            $id=$_POST['id'];

            $sql="SELECT * FROM test_courses where c_id='$id'";
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

    