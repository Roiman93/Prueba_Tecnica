<?php 

include '../model/conexion.php';

// Registro de usuarios
if($_POST['action'] == 'AddUsuario'){

  //print_r($_POST);

    $cedula = $_POST['cedula'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$correo = $_POST['correo'];
	$telefono = $_POST['telefono'];
	$pass = $_POST['contraseña'];
	$passDB = md5($pass);

    $sql = "INSERT INTO usuario (nombre,apellido, identificacion, email, id_tipo, password) 
    VALUES ('$nombre','$apellido','$cedula','$correo','1','$passDB')";
	
	if( mysqli_query($conexion,$sql) ) {
		mysqli_close($conexion);
		//sendEmail($nombre, $correo, $pass);
		exit;
	}else{
		echo "fallo en la consulta " . $sql . "-" . mysqli_error($conexion);
		mysqli_close($conexion);
		exit;
	}

}
//fim


// Modificar Usuario
if($_POST['action'] == 'UpdateUsuario'){

	
    $id= $_POST['id'];
    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $pass = $_POST['contraseña'];
    $passDB = md5($pass);


    if(empty($pass)){

      $sql =  "UPDATE usuario SET  nombre='$nombre', apellido = '$apellido', email = '$correo',identificacion='$cedula'
       WHERE id_usuario = '$id'";
      if( mysqli_query($conexion,$sql) ) {
          mysqli_close($conexion);
          //sendEmail($nombre, $correo, $pass);
          exit;
      }else{
          echo "fallo en la consulta " . $sql . "-" . mysqli_error($conexion);
          mysqli_close($conexion);
          exit;
      }


  }else {
      $passDB = md5($pass);

      $sql1 =  "UPDATE usuario SET  nombre='$nombre', apellido = '$apellido', email = '$correo',identificacion='$cedula',password ='$passDB' WHERE id_usuario = $id";

      
      if( mysqli_query($conexion,$sql1) ) {
          mysqli_close($conexion);
          //sendEmail($nombre, $correo, $pass);
          exit;
      }else{
          echo "fallo en la consulta " . $sql1. "-" . mysqli_error($conexion);
          mysqli_close($conexion);
          exit;
      }

  }
   
    
    


}
//fim

// Eliminar
if($_POST['action'] == 'Eliminar'){

	$id= $_POST['id'];
	$sql=" DELETE FROM usuario  WHERE id_usuario='$id'";
   
    if (mysqli_query($conexion,$sql)) {
         
        mysqli_close($conexion);
        exit;

    } else {

        mysqli_close($conexion);
        echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        exit;

    }

	


}
// fin

// buscar Usuarios
if ($_POST['action'] == 'Get_usuarios'){ 

            $sql="SELECT * FROM usuario";

            $query = mysqli_query($conexion,$sql);
            $result = mysqli_num_rows($query);
                    
            $detalletabla = '';
            $arrayData  = array();

            if ($result > 0) {
                
                    while ($data = mysqli_fetch_assoc($query)) {
    
                    $detalletabla .= '<tr>
                                            <td class="tx">'.$data['identificacion'].'</td>
                                            <td class="tx">'.$data['email'].'</td>
                                            <td class="tx">'.$data['nombre'].' '.$data['apellido'].'</td>

                                            <td>
                                            
                                            <a style="cursor:pointer;" onclick=validarEdit(f="'.$data['id_usuario'].'")>
                                                <div class="ui small icon button">
                                                <i class=" blue edit icon"></i>
                                                </div>
                                            </a>
                                                                                       
                                            <a style="cursor:pointer;"  onclick=ValidarRemove(f="'.$data['id_usuario'].'") >
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

        

}//fin

// buscar x id
if ($_POST['action'] == 'Get_usu'){ 
    
    if (!empty($_POST['id'])){

        $id=$_POST['id'];

        $sql="SELECT * FROM usuario where id_usuario='$id'";
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

