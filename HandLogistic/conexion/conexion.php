<?php
class Conexion {
    private $conexion;
    private $stm;

    public function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=localhost;dbname=ejercicio', 'root', '');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
        }
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
        return $this->conexion->prepare($sql);
    }

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

    public function cerrar() {
        $this->stm = null;
        $this->conexion = null;
    }
}
?>
