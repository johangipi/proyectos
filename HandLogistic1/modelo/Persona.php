<?php
namespace App\Modelo;

class Persona {
    public static $user = null;
    private $nombre;
    private $apellido;
    private $email;
    private $contrasena;

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function credenciales() {
        $sql = "SELECT * FROM personas WHERE email='" . $this->getEmail() . "' AND contrasena=MD5('" . $this->getContrasena() . "')";
        
        return $sql;
    }

    public function actualizar() {
        $sql = "UPDATE personas SET nombre='" . $this->getNombre() . "', apellido='" . $this->getApellido() . "', contrasena=MD5('" . $this->getContrasena() . "') WHERE email='" . $this->getEmail() . "'";
        return $sql;
    }

    public static function perfil() {
        $sql = "SELECT nombre, apellido, email FROM personas WHERE email='" . self::$user . "'";
        return $sql;
    }

    public function eliminar() {
        $sql = "DELETE FROM personas WHERE email='" . self::$user . "'";
        self::$user = null;
        return $sql;
    }
}
?>
