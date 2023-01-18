<!DOCTYPE html>
<!DOCTYPE html>
<html>
   <head>
        
        <meta charset="UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Gestor de contenido">

        <!-- framework semantic -->
        <link rel="preload" href="build/css/Semantic/semantic.min.css" as="style">
        <link rel="stylesheet" href="build/css/Semantic/semantic.min.css">
        
       <!-- Jquery -->
        <script rel="preload" src="build/js/jquery-3.6.0.min.js"></script>
        <script rel="preload" src="build/css/Semantic/semantic.min.js"></script>
        <!-- fin -->

        <!-- hoja se estilos -->
        <link rel="stylesheet" href="<?php BuscarCss('style.css');?>">
 
        
       
        <script rel="preload" src="build/css/Semantic/components/transition.js"></script>
        <script rel="preload" src="build/css/Semantic/components/dropdown.js"></script>
        <script rel="preload" src="build/css/Semantic/components/visibility.js"></script>
        
        <title>
        Admin
        </title>

        <script>
  $(document)
    .ready(function() {
      // show dropdown on hover
      $('.main.menu  .ui.dropdown').dropdown({
        on: 'hover'
      });
    });
  </script>
           
   </head>