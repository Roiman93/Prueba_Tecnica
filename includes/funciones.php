<?php

require 'app.php';

function incluirTemplate( string $nombre, bool $inicio = false){
   
   //echo TEMPLATES_URL.'/'.$nombre.'.php';
   include TEMPLATES_URL.'/'.$nombre.'.php';
}


 function logo()
{
   //echo LOGO.'/'.$nombre.'.svg';

   $logo='build/img/logo.svg';
   if (file_exists($logo)){
       echo 'build/img/logo.svg';
   }else{
    echo' ../../build/img/logo.svg';
   }


}


function BuscarImg($nombre)
{
   $ruta='build/img/';
   if (file_exists($ruta.$nombre)){
       echo 'build/img/'.$nombre;
   }else{
    echo' ../../build/img/'.$nombre;
   }


}

function BuscarCss($nombre)
{
   $ruta='build/css/';
   if (file_exists($ruta.$nombre)){
       echo 'build/css/'.$nombre;
   }else{
      echo' ../../build/css/'.$nombre;
   }

}

function BuscarJs($nombre)
{
   $ruta='build/js/';
   if (file_exists($ruta.$nombre)){
       echo 'build/js/'.$nombre;
   }else{
       echo' ../../build/js/'.$nombre;
   }

}






