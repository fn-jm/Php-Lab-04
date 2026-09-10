<?php

include('claseUsuario.php');
$usuario1 = new Usuario();
$usuario1->nombre = "Fabian Jimenez";
$usuario1->email = "fabian.jimenez@example.com";

echo $usuario1->mostrarInfo();
