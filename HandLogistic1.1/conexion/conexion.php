<?php
class conexion {
    private $conexion;
    private $stm;

    public function __construct() {
        
        $this->conexion = new mysqli('mysql:host=localhost;dbname=ejercicio', 'root', '');

    }

    public function insertarActualizarEliminar($sql) {
        try {
            $this->stm = $this->conexion->prepare($sql);
            $this->stm->execute();
            return 1;
        } catch (PDOException $ex) {
            error_log($ex->getMessage());
            return 0;
        }
    }

    public function prepare($sql) {
        try { $this->stm = $this->conexion->prepare($sql); return $this->stm; 
        } 
        catch (PDOException $ex) { error_log($ex->getMessage()); return null;
     } }

    public function consultar($sql) {
        try {
            $this->stm = $this->conexion->prepare($sql);
            $this->stm->execute();
            return $this->stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            error_log($ex->getMessage());
            return null;
        }
    }

    public function errorInfo() {
        return $this->stm ? $this->stm->errorInfo() : $this->conexion->errorInfo(); 
    }

    public function cerrar() {
        $this->stm = null;
        $this->conexion = null;
    }
}
?>

