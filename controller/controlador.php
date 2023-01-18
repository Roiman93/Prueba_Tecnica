<?php
session_start();
require 'controller/Base.php';



class Controller extends Base{


	function Controlador(){
		
		
		if(isset($_GET['opcion'])){
			$opc = $_GET['opcion'];
			
			if(method_exists($this, $opc)){
				
				$this->$opc();
			}else{
				$this->error();
			}
		}else{	
			
			$this->login();
           
		}


	}


	function Inicio(){

		if(isset($_SESSION['ih_id'])){
		
				include 'views/Inicio.php';
		
		}else{
			$this->redireccionar('login');
		}
		
	}

	function Estudiantes(){

		if(isset($_SESSION['ih_id'])){
		
				include 'views/List_student.php';
		
		}else{
			$this->redireccionar('login');
		}
		
	}

	function Cursos(){

		if(isset($_SESSION['ih_id'])){
		
				include 'views/Cursos.php';
		
		}else{
			$this->redireccionar('login');
		}
		
	}

	
	function Asignacion(){

		if(isset($_SESSION['ih_id'])){
		
				include 'views/Asignacion.php';
		
		}else{
			$this->redireccionar('login');
		}
		
	}

	function Reporte(){

		if(isset($_SESSION['ih_id'])){
		
				include 'views/Reportes.php';
		
		}else{
			$this->redireccionar('login');
		}
		
	}

	function error(){
		print "pagina 404.html";
	}



 // administrador
 
	function usuarioadmin(){
			
		
		
		if(isset($_SESSION['ih_id'])){
			if($_SESSION['ih_tipo'] == 1){
				
				if(isset($_GET['edit'])){
					
				}
				include 'views/admusuarios.php';
			}else{
				$this->redireccionar('home');
			}
		}else{
			$this->redireccionar('login');
		}

	}

	function login(){
		if(isset($_SESSION['ih_id'])){
			$this->inicio();
		}else{
			include "views/acceso.php";
		}
	}

	function closini(){

		unset($_SESSION['ih_id']);
		unset($_SESSION['ih_email']);
		unset($_SESSION['ih_nombre']);
		unset($_SESSION['ih_tipo']);
		session_destroy();
		$this->redireccionar('login');
	}

	function close(){
		unset($_SESSION['ih_id']);
		unset($_SESSION['ih_email']);
		unset($_SESSION['ih_nombre']);
		unset($_SESSION['ih_tipo']);
		session_destroy();
		$this->redireccionar('login');
	}


}

?>