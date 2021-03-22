<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="/Resources/bootstrap-4.5.3/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css"> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script> -->
    
    <!--Librerias Sweet-->
    <link rel="stylesheet" href="/Resources/sweet/sweetalert2.min.css">
    <link rel="shortcut icon" href="/Resources/img/favicon.ico">  

</head>
<body>

  <!--Menu Principal-->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <a id="user" class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navb">
        	<ul class="navbar-nav mr-auto">                
            	<li>
                	<a class="nav-link" href="views/registro.php">
                    	Registrarse
                	</a>                   
            	</li>
				
            </ul>
        </div>  
    </nav>

    
    <!--Contendor Principal-->
    <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
              <div class="card-body">
                <h5 class="card-title text-center">Iniciar Sesion</h5>


                	<div class="form-signin">
                    <div class="form-label-group">
                      <label for="inputEmail">Correo Electronico</label>
                      <input id="inputEmail" type="email" class="form-control data" placeholder="Email address" required autofocus>
                    </div>
              
                    <div class="form-label-group mb-3">
                      <label for="inputPassword">Contraseña</label>
                      <input id="inputPassword" type="password" class="form-control data" placeholder="Password" required>
                    </div>
                    <button id="btnLogin" class="btn btn-lg btn-primary btn-block" type="button">Ingresar</button>                        
                  </div>

              </div>
            </div>
          </div>
        </div>
    </div>


    <!--Librerias Jquery > Bootstrap | SweetAlert-->
    <script src="/Resources/bootstrap-4.5.3/jquery-3.3.1.min.js"></script>
    <script src="/Resources/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="/Resources/sweet/sweetalert2.min.js"></script>   

    <!--Controlador JS -->
    <script type="module" src="/js/index.js"></script>

</body>
</html>