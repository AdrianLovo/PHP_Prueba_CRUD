<?php
    
    class Controller{

        public function Salir(){    
            session_start();	
            session_destroy();
            echo("ok");
        }       
    }
    
    //Parametros Post
    $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : null;
    
    //Instancia de clases a Utilizar
    $controller = new Controller();
    $controller->$metodo();        //Metodo recibido 