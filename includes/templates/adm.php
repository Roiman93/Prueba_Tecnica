<div class="ui borderless inverted main menu">
    <div class="ui text container">
      <div class="header item">
        <img class="logo"  onclick="inicio()"  src="build/img/icon.png">
       Software
      </div>
      <a href="?opcion=Estudiantes" class="item">Estudiantes</a>
      <a href="?opcion=Reporte" class="item">Informe</a>
      <a href="#" class="ui right floated dropdown item" tabindex="0">
        Asignaciones <i class="dropdown icon"></i>
        <div class="menu transition hidden" tabindex="-1">
          <div class="item" onclick="location.href='?opcion=Cursos'">Cursos</div>
          <div class="item" onclick=" location.href='?opcion=Asignacion'">Matriculas</div>
     
        </div>
      </a>
      <a class="item"  href="?opcion=usuarioadmin" ><i class="user icon"></i>Usuarios</a>

      <button  class="ui right item">
        <?php print "<i class='user white icon'></i> ".$_SESSION['ih_nombre']."&nbsp;&nbsp;&nbsp;&nbsp;"; ?>
        <a href="?opcion=closini" class="mini ui red button" >Salir </a>
      </button> 
    </div>
</div>




