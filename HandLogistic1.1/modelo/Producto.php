<?php


class Producto {
    private $nombre;
    private $item;
    private $categoria;
    private $ubicacion;
    private $cantidad;
    private $idUsuario;
    
    public function __construct($nombre, $item, $categoria, $ubicacion, $cantidad, $idUsuario) {
        $this->nombre = $nombre;
        $this->item = $item;
        $this->categoria = $categoria;
        $this->ubicacion = $ubicacion;
        $this->cantidad = $cantidad;
        $this->idUsuario = $idUsuario;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getItem() {
        return $this->item;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getUbicacion() {
        return $this->ubicacion;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function registrarProducto() {
        $query = "INSERT INTO producto (nombre, item, categoria, ubicacion, cantidad, idUsuario) VALUES ('$this->nombre', '$this->item', '$this->categoria', '$this->ubicacion', '$this->cantidad', '$this->idUsuario')";
        return $query;
    }
    
}
?>

