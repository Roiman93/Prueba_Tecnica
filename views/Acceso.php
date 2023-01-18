<!DOCTYPE html>
<html>
  <head> 
        <meta charset="UTF-8"> 
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Software">

        <!-- framework semantic -->
        <link rel="preload" href="build/css/Semantic/semantic.min.css" as="style">
        <link rel="stylesheet" href="build/css/Semantic/semantic.min.css">
        
       <!-- Jquery -->
        <script rel="preload" src="build/js/jquery-3.6.0.min.js"></script>
        <script rel="preload" src="build/css/Semantic/semantic.min.js"></script>
        <!-- fin -->

        <!-- hoja se estilos -->
        <link  rel="stylesheet" href="build/css/style.css">

        <title>Login</title> 

  </head>      
<body>
    
  <div class="ui hidden divider"></div>  

  <div class="ui middle aligned center aligned grid">
      <div class="column">
        <h2 class="ui green image header">
          <img src="build/img/secure.png" class="image">
          <div class="content">
            Ingrese a su cuenta
          </div>
        </h2> 
        <div class="ui segment">
          <form class="ui form" name="form" >
            <label>Usuario</label>
            <input type="text" id="usu" name="usuario" placeholder="Usuario" required="required">
            <label>Password</label>
            <input placeholder="Password" id="pass" type="password" required="required" name="pass"><br>
            
          </form>
          <button class="ui  fluid  large green  button"  onclick="Login()" > Acceso </button>
        
          <div class="ui error message">

          </div>
      </div> 
        <div><h6>Develop by ING.Royman Rodriguez</h6></div> 
      </div> 
  </div> 

</body>

   <script type="text/javascript" src="build/js/funcion_Login.js"></script>
   <script type="text/javascript" src="build/js/md5.min.js"></script>
   <script type="text/javascript" src="build/js/Sweetalert.min.js"></script>

</html>