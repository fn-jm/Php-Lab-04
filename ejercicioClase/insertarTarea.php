<?php
include 'claseTarea.php';

$archivo = 'almacenTareas.json';
$tareas = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descripcion = htmlspecialchars($_POST["descripcion"] ?? "");
    $importancia = (int) ($_POST["importancia"] ?? 1);
    $mesRealizacion = htmlspecialchars($_POST["mesRealizacion"] ?? "");
    $fechaRealizacion = (int) ($_POST["fechaRealizacion"] ?? 1);

    $id = count($tareas) > 0 ? end($tareas)["id"] + 1 : 1;

    $nuevaTarea = Tarea::nuevaTarea($id, $descripcion, $importancia, $mesRealizacion, $fechaRealizacion);

    $tareas[] = $nuevaTarea->toArray();
    file_put_contents($archivo, json_encode($tareas));

    header("Location: listaTareas.php");
    exit();
}
