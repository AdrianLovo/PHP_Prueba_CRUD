<?php

    class Usuario{

        private $id;
        private $name;
        private $email;
        private $password;
        private $created_at;
        private $updated_at;
        private $imagen;
        
        public function __construct($id, $name, $email, $password, $created_at, $updated_at, $imagen){
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->password = $password;
            $this->created_at =$created_at;
            $this->updated_at = $updated_at;
            $this->imagen = $imagen;
        }

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }
    
        public function getName(){
            return $this->name;
        }
    
        public function setName($name){
            $this->name = $name;
        }
    
        public function getEmail(){
            return $this->email;
        }
    
        public function setEmail($email){
            $this->email = $email;
        }
    
        public function getPassword(){
            return $this->password;
        }
    
        public function setPassword($password){
            $this->password = $password;
        }
    
        public function getCreated_at(){
            return $this->created_at;
        }
    
        public function setCreated_at($created_at){
            $this->created_at = $created_at;
        }
    
        public function getUpdated_at(){
            return $this->updated_at;
        }
    
        public function setUpdated_at($updated_at){
            $this->updated_at = $updated_at;
        }

        public function getImagen(){
            return $this->imagen;
        }
    
        public function setImagen($imagen){
            $this->imagen = $imagen;
        }
    

        //Metodo para obtener los datos de los atributos en un array
        public function toArray(){
            $datos = array(
                'id' => $this->id, 
                'name' => $this->name, 
                'email' => $this->email, 
                'password' => $this->password, 
                'created_at' => $this->created_at, 
                'updated_at' => $this->updated_at, 
                'imagen' => $this->imagen
            );
            return $datos;
        }
       

    }

