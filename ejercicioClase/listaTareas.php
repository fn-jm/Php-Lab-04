<?php
include 'claseTarea.php';

$archivo = 'almacenTareas.json';
$tareas = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["eliminar"])) {
    $idEliminar = $_GET["eliminar"];
    $tareas = array_filter($tareas, fn($t) => $t["id"] != $idEliminar);
    file_put_contents($archivo, json_encode(array_values($tareas)));
    header("Location: listaTareas.php");
    exit();
}

$masImportante = null;
$masUrgente = null;

foreach ($tareas as $tarea) {
    if ($masImportante == null || $tarea["importancia"] > $masImportante["importancia"]) {
        $masImportante = $tarea;
    }

    if ($masUrgente == null || $tarea["fechaRealizacion"] < $masUrgente["fechaRealizacion"]) {
        $masUrgente = $tarea;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>CRUD de Tareas</title>
</head>

<body>
    <h2>Lista de Tareas</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Descripcion</th>
            <th>Importancia</th>
            <th>Mes</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($tareas as $tarea): ?>
            <tr>
                <td><?= $tarea["id"] ?></td>
                <td><?= $tarea["descripcion"] ?></td>
                <td><?= $tarea["importancia"] ?></td>
                <td><?= $tarea["mesRealizacion"] ?></td>
                <td><?= $tarea["fechaRealizacion"] ?></td>
                <td>
                    <a href="editarTarea.php?id=<?= $tarea["id"] ?>">Editar</a>
                    <a href="?eliminar=<?= $tarea["id"] ?>" onclick="return confirm('Eliminar esta tarea?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php if ($masImportante != null): ?>
        <h3>Resultados</h3>
        La tarea mas importante: <?= $masImportante["descripcion"] ?>,
        importancia - <?= $masImportante["importancia"] ?>,
        mes de realizacion - <?= $masImportante["mesRealizacion"] ?>,
        fecha de realizacion - <?= $masImportante["fechaRealizacion"] ?>
        <br>
        La tarea mas urgente: <?= $masUrgente["descripcion"] ?>,
        importancia - <?= $masUrgente["importancia"] ?>,
        mes de realizacion - <?= $masUrgente["mesRealizacion"] ?>,
        fecha de realizacion - <?= $masUrgente["fechaRealizacion"] ?>
        <br>
    <?php endif; ?>

    <h2>Agregar Tarea</h2>
    <form action="insertarTarea.php" method="POST">
        <label>Ingresar descripcion de tarea:</label>
        <input type="text" name="descripcion" required>
        <br>
        <label>Ingresar importancia de tarea (del 1 al 5):</label>
        <input type="number" name="importancia" min="1" max="5" required>
        <br>
        <label>Ingresar mes de realizacion:</label>
        <input type="text" name="mesRealizacion" value="Septiembre" required>
        <br>
        <label>Ingresar fecha de realizacion:</label>
        <input type="number" name="fechaRealizacion" min="1" max="31" required>
        <br>
        <button type="submit">Agregar</button>
    </form>

    <?php
    echo "<br>";
    echo "Fabian Jimenez";
    ?>
</body>

</html>
