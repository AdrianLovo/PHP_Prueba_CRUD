<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <!--Bootstrap-->
    <link rel="stylesheet" href="/Resources/bootstrap-4.5.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Resources/css/style.min.css">
    
    <!--Librerias Sweet-->
    <link rel="stylesheet" href="/Resources/sweet/sweetalert2.min.css">
    <link rel="shortcut icon" href="/Resources/img/favicon.ico">  

</head>
<body>

  <!--Menu Principal-->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
        <a id="user" class="navbar-brand" href="../index.php">Home</a>
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
    <div class="container col-xl-10 col-lg-10 col-sm-12 col-10">

    <div class="card mt-3">
        <form method="post" action="" id="frmUsuario" autocomplete="off">  
            <input type="text" name="metodo" value="Agregar" style="display:none">                     
            <div class="form-row pt-4">
                <div class="form-group col-md-5 offset-md-1">
                    <label for="nombre">Nombre</label>
                    <input type="name" class="form-control" id="name" name="name" placeholder="Nombre" require>   
                    <span id="nombreWarning"></span>                     
                </div>
                <div class="form-group col-md-5">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="*****" require>
                    <span id="passwordWarning"></span>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5 offset-md-1">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com" require>
                    <span id="emailWarning"></span>
                </div>
                <div class="form-group col-md-5">
                    <label for="img">Imagen</label>
                    <input type="file" name="imagen" id="img" accept=".jpg,.png,jpeg" class="form-control">  
                    <span id="imagenWarning"></span>                                              
                </div>
            </div>

            <div class="text-center">
                <img src="/Resources/img/default.png" alt="Vista Previa" id="imgPrevia">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6 offset-md-1">
                    <button class="btn btn-lg btn-primary mt-1" id="registrar">Registrarse</button>                        
                </div>
            </div>
        </form>
    </div>

    

    </div>


    <!--Librerias Jquery > Bootstrap | SweetAlert-->
    <script src="/Resources/bootstrap-4.5.3/jquery-3.3.1.min.js"></script>
    <script src="/Resources/bootstrap-4.5.3/js/bootstrap.min.js"></script>
    <script src="/Resources/sweet/sweetalert2.min.js"></script>   

    <!--Controlador JS -->
    <script type="module" src="/js/registro.js"></script>

</body>
</html>