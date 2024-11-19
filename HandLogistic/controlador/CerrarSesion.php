<?php
require_once 'Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    Persona::$user = null;
    header('Location: index.php');
    exit();
}
?>
