<?php
include 'claseUsuario.php';

$archivo = 'almacenUsuarios.json';
$usuarios = file_exists($archivo) ? json_decode(file_get_contents($archivo), true) : [];
$usuarioEncontrado = null;

if (isset($_GET["id"])) {
    foreach ($usuarios as $u) {
        if ($u["id"] == $_GET["id"]) {
            $usuarioEncontrado = $u;
            break;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];

    foreach ($usuarios as &$u) {
        if ($u["id"] == $id) {
            $u["nombre"] = $nombre;
            $u["email"] = $email;
            break;
        }
    }

    file_put_contents($archivo, json_encode($usuarios));
    header("Location: listaUsuarios.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>

<body>
    <h2>Editar Usuario</h2>
    <?php if ($usuarioEncontrado): ?>
        <form action="editarUsuario.php" method="POST">
            <input type="hidden" name="id" value="<?= $usuarioEncontrado["id"] ?>">
            <input type="text" name="nombre" value="<?= $usuarioEncontrado["nombre"] ?>" required>
            <input type="email" name="email" value="<?= $usuarioEncontrado["email"] ?>" required>
            <button type="submit">Actualizar</button>
        </form>
    <?php else: ?>
        <p>Usuario no encontrado.</p>
    <?php endif; ?>
    <a href="listaUsuarios.php">Volver</a>
</body>

</html>