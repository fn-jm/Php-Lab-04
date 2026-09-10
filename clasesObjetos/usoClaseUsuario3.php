<?php
include('claseUsuario3.php');
$usuario3 = new Usuario3("Fabian Jimenez", "fabian.jimenez@example.com");
echo $usuario3->getNombre() . "<br>";
$usuario3->setNombre("Hugo Flores");
echo $usuario3->getNombre() . "<br>";
