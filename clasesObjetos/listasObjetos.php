<?php
include('claseUsuario3.php');
$usuarios = array();
$usuario = new Usuario3("Fabian Jimenez", "fabian.jimenez@example.com");
$usuarios[] = $usuario;
$usuario = new Usuario3("Hugo Flores", "hugo.flores@example.com");
$usuarios[] = $usuario;


foreach ($usuarios as $usuario) {
    echo $usuario->getNombre() . "<br>";
    echo $usuario->getEmail() . "<br>";
}
