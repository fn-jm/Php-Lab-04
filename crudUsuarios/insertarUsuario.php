<?php
include 'claseUsuario.php';
$archivo = 'almacenUsuarios.json';
$usuarios = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];

    $id = count($usuarios) > 0 ? end($usuarios)["id"] + 1 : 1;
    $nuevoUsuario = new Usuario($id, $nombre, $email);

    $usuarios[] = $nuevoUsuario->toArray();
    file_put_contents($archivo, json_encode($usuarios));

    header("Location: listaUsuarios.php");
    exit();
}
