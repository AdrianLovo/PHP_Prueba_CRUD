<?php

    require_once("DAO.php");
    require_once("../Models/Usuario.php");
        
    class DAOUsuario extends DAO{

        public function __construct(){
            $this->datos = array();
        }

        public function queryBuscarPorId(){
            $query = "SELECT * FROM php_crud.users WHERE email=? LIMIT 1";
            return $query;
        }

        public function metodoBuscarPorId($statement, $parametro){
            $statement->execute([$parametro->getEmail()]);
            $resultSet = $statement->fetchAll();
            return $resultSet;
        }   

        public function queryListar($filtro){
            switch ($filtro) {
                case '':
                    return "SELECT * FROM php_crud.users ORDER BY id ASC";
            }            
            return "";
        }

        public function metodoListar($statement, $parametro){
            if($parametro != ''){
                $statement->execute([$parametro]);
            }else{
                $statement->execute();
            }

            $resultSet = $statement->fetchAll();            
            if(!empty($resultSet)){
                foreach($resultSet as $fila){
                    $tmp = new Usuario($fila[0], $fila[1], $fila[2], $fila[3], $fila[4], $fila[5], $fila[6]);
                    array_push($this->datos, $tmp->toArray());
                }    
            }
            return $this->datos;
        }   
               
        public function queryEliminar(){
            $query = "DELETE FROM php_crud.users WHERE id = ?";
            return $query;
        }

        public function metodoEliminar($statement, $parametro){
            $statement->execute([$parametro->getId()]);
            $filasAfectadas = $statement->rowCount();          
            return $filasAfectadas;
        }

        public function queryAgregar(){
            $query = "INSERT INTO php_crud.users (name, email, password, created_at, imagen) VALUES(?, ?, ?, ?, ?)";            
            return $query;
        }

        public function metodoAgregar($statement, $parametro){
            $datos = $parametro->toArray();
            $statement->execute([$datos['name'], $datos['email'], $datos['password'], $datos['created_at'], $datos['imagen']]);            
        }

        public function queryModificar(){
            $query = "UPDATE php_crud.users SET name=?, email=?, imagen=?, updated_at=?  WHERE id=?";
            return $query;
        }

        public function metodoModificar($statement, $parametro){
            $filasAfectadas = 0;
            $datos = $parametro->toArray();  
            if($statement->execute([$datos['name'],$datos['email'], $datos['imagen'], $datos['updated_at'], $datos['id']])){
                $filasAfectadas = $statement->rowCount(); 
            }
            return $filasAfectadas;
        }

    }

