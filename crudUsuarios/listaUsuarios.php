<?php
include 'claseUsuario.php';
$archivo = 'almacenUsuarios.json';
$usuarios = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["eliminar"])) {
    $idEliminar = $_GET["eliminar"];
    $usuarios = array_filter($usuarios, fn($u) => $u["id"] != $idEliminar);
    file_put_contents($archivo, json_encode(array_values($usuarios)));
    header("Location: listaUsuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuarios</title>
</head>

<body>
    <h2>Lista de Usuarios</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= $usuario["id"] ?></td>
                <td><?= $usuario["nombre"] ?></td>
                <td><?= $usuario["email"] ?></td>
                <td>
                    <a href="editarUsuario.php?id=<?= $usuario["id"] ?>">Editar</a>
                    <a href="?eliminar=<?= $usuario["id"] ?>" onclick="return confirm('¿Eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Agregar Usuario</h2>
    <form action="insertarUsuario.php" method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Agregar</button>
    </form>
</body>

</html>