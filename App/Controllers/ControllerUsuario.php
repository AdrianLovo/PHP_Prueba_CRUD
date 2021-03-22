<?php
   
    require_once("../DAO/DAOUsuario.php");
    require_once("../Models/Usuario.php");
    	
    class ControllerUsuario{

        private $daoUsuario;
        private $datos;
        
        public function __construct(){
            $this->daoUsuario = new DAOUsuario();
            $this->datos = array();
        }

        public function Buscar(){      
            // $email = isset($_POST['parametro']) ? $_POST['parametro'] : null;
            // $usuario = new Usuario(null, null, $email, null, null, null, null);          
            // $find = $this->daoUsuario->buscarPorId($usuario);              
            // if($find){
            //     echo("ok");
            // }else{
            //     echo("error");
            // }
        }
       
        public function Login(){            
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;   
            $usuario = new Usuario(null, null, $email, $password, null, null, null);           
            $row = $this->daoUsuario->buscarPorId($usuario);
            
            if(password_verify($password, $row[0][3] )){	
                session_start();		
                $_SESSION['id'] = $row[0][0];
                $_SESSION['email'] = $row[0][2];
                echo("ok"); 
            }
        }

        public function Listar(){
            $datosTodos = array();    
            $filtro = isset($_POST['filtro']) ? $_POST['filtro'] : null;
            $parametro = isset($_POST['parametro']) ? $_POST['parametro'] : null;
            $datosTodos = $this->daoUsuario->listar($filtro, $parametro);
            echo json_encode($datosTodos);	          	
        }

        public function Eliminar(){
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $usuario = new Usuario($id, null, null, null, null, null, null);       
            echo($this->daoUsuario->eliminar($usuario));
        }

        public function Agregar(){       
            $fecha = date('Y-m-d H:i:s');
            $name = isset($_POST['name']) ? $_POST['name'] : null;
            $email = isset($_POST['email']) ? $_POST['email'] : null;
            $password = isset($_POST['password']) ? $_POST['password'] : null;
            $encriptado = password_hash($password, PASSWORD_DEFAULT);
            $nombre = isset($_FILES['imagen']['name']) ? $_FILES['imagen']['name'] : null;
            $nombreTemp = isset($_FILES['imagen']['tmp_name']) ? $_FILES['imagen']['tmp_name'] : null;
            $destino = $nombre != "" ? "../../public/img/".date('YmdHis').$nombre : "/Resources/img/default.png";
            
            $usuario = new Usuario(null, $name, $email, $encriptado, $fecha, null, $destino);
            $usuario->setId($this->daoUsuario->agregar($usuario));
            
            if($usuario->getId() > 0){
                $nombre != "" ? move_uploaded_file($nombreTemp, $destino) : null;
                array_push($this->datos, $usuario->toArray());
                echo json_encode($this->datos);
            }else{
                echo json_encode($this->datos);
            }
        }

        public function Modificar(){            
            $fecha = date('Y-m-d H:i:s');            
            $id= isset($_POST['idE']) ? $_POST['idE'] : null;
            $name= isset($_POST['nameE']) ? $_POST['nameE'] : null;
            $email = isset($_POST['emailE']) ? $_POST['emailE'] : null;
            $ImagenEOld = isset($_POST['ImagenEOld']) ? $_POST['ImagenEOld'] : null;
            $nombre = isset($_FILES['imagenE']['name']) ? $_FILES['imagenE']['name'] : null;
            $nombreTemp = isset($_FILES['imagenE']['tmp_name']) ? $_FILES['imagenE']['tmp_name'] : null;
            $destino = "../../public/img/".date('YmdHis').$nombre;
            $destino = $nombre != "" ? $destino : $ImagenEOld;           
           
            $usuario = new Usuario($id, $name, $email, null, null, $fecha, $destino); 
            $filas = $this->daoUsuario->modificar($usuario);    
            
            if($filas > 0){
                $nombre != "" ? move_uploaded_file($nombreTemp, $destino) : null;
                array_push($this->datos, $usuario->toArray());
                echo json_encode($this->datos); 
            }else{
                echo json_encode($this->datos);
            }
        }
    }

    
    //Parametros Post
    $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : null;
    
    //Instancia de clases a Utilizar
    $controllerUsuario = new ControllerUsuario();
    $controllerUsuario->$metodo();        //Metodo recibido 