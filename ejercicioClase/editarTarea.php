<?php
include 'claseTarea.php';

$archivo = 'almacenTareas.json';
$tareas = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
$tareaEncontrada = null;

if (isset($_GET["id"])) {
    foreach ($tareas as $t) {
        if ($t["id"] == $_GET["id"]) {
            $tareaEncontrada = $t;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $descripcion = htmlspecialchars($_POST["descripcion"] ?? "");
    $importancia = (int) ($_POST["importancia"] ?? 1);
    $mesRealizacion = htmlspecialchars($_POST["mesRealizacion"] ?? "");
    $fechaRealizacion = (int) ($_POST["fechaRealizacion"] ?? 1);

    foreach ($tareas as &$t) {
        if ($t["id"] == $id) {
            $t["descripcion"] = $descripcion;
            $t["importancia"] = $importancia;
            $t["mesRealizacion"] = $mesRealizacion;
            $t["fechaRealizacion"] = $fechaRealizacion;
            break;
        }
    }

    unset($t);

    file_put_contents($archivo, json_encode($tareas));
    header("Location: listaTareas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Tarea</title>
</head>

<body>
    <h2>Editar Tarea</h2>
    <?php if ($tareaEncontrada): ?>
        <form action="editarTarea.php" method="POST">
            <input type="hidden" name="id" value="<?= $tareaEncontrada["id"] ?>">

            <label>Descripcion:</label>
            <input type="text" name="descripcion" value="<?= $tareaEncontrada["descripcion"] ?>" required>
            <br>
            <label>Importancia (del 1 al 5):</label>
            <input type="number" name="importancia" min="1" max="5" value="<?= $tareaEncontrada["importancia"] ?>" required>
            <br>
            <label>Mes de realizacion:</label>
            <input type="text" name="mesRealizacion" value="<?= $tareaEncontrada["mesRealizacion"] ?>" required>
            <br>
            <label>Fecha de realizacion:</label>
            <input type="number" name="fechaRealizacion" min="1" max="31" value="<?= $tareaEncontrada["fechaRealizacion"] ?>" required>
            <br>
            <button type="submit">Actualizar</button>
        </form>
    <?php else: ?>
        <p>Tarea no encontrada.</p>
    <?php endif; ?>

    <a href="listaTareas.php">Volver</a>

    <?php
    echo "<br>";
    echo "Fabian Jimenez";
    ?>
</body>

</html>
