<?php
    require_once("Conexion.php");

    abstract class DAO extends Conexion{

        abstract function queryListar($filtro);
        abstract function queryAgregar();
        abstract function queryEliminar();        
        abstract function queryModificar();
        abstract function queryBuscarPorId();        
        
        abstract function metodoListar($statement, $parametro);
        abstract function metodoAgregar($statement, $parametro);
        abstract function metodoEliminar($statement, $parametro);        
        abstract function metodoModificar($statement, $parametro);
        abstract function metodoBuscarPorId($statement, $parametro);  
        
        public function listar($filtro, $parametro) {
            $arrayDeObjetos = array();
            $pdo = $this->conectar();
            try {
                $resultSet = $pdo->prepare($this->queryListar($filtro));
                $arrayDeObjetos = $this->metodoListar($resultSet, $parametro);
                return $arrayDeObjetos;
            }catch (Exception $e) {
                echo($e);
            }finally{
                $this->desconectar();
            }
        }        

        public function agregar($parametro){
            $pdo = $this->conectar();
            try{
                $statement = $pdo->prepare($this->queryAgregar());
                $this->metodoAgregar($statement, $parametro);    
                return $pdo->lastInsertId();                 
            }catch(PDOException $e){
                echo($e);               
            }finally{
                $this->desconectar();
            }
        }
        
        public function eliminar($parametro) {
            $pdo = $this->conectar();
            try{
                $statement = $pdo->prepare($this->queryEliminar());
                $filasAfectadas = $this->metodoEliminar($statement, $parametro);
                return $filasAfectadas;
            }catch(Exception $e){
                echo($e);
            }finally{
                $this->desconectar();
            }
        }

        public function modificar($parametro){
            $pdo = $this->conectar();
            try{
                $statement = $pdo->prepare($this->queryModificar());
                $filasAfectadas = $this->metodoModificar($statement, $parametro);
                return $filasAfectadas;
            }catch(Exception $e){
                echo($e);               
            }finally{
                $this->desconectar();
            }
        }

        public function buscarPorId($parametro) {
            $arrayDeObjetos = array();
            $pdo = $this->conectar();
            try {
                $statement = $pdo->prepare($this->queryBuscarPorId());
                $arrayDeObjetos = $this->metodoBuscarPorId($statement, $parametro);
                return $arrayDeObjetos;
            } catch (Exception $e) {
                echo($e);
            }finally{
                $this->desconectar();
            }
        }
     
      
    }
