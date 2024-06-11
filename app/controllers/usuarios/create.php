<?php
include('../../config.php');

$nombres = $_POST['nombres'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$fechaHora = date('Y-m-d H:i:s'); // Asignar la fecha y hora actual

if ($password_user == $password_repeat) {
    // Verificar si el rol existe en la tabla tb_roles
    $checkRole = $pdo->prepare("SELECT COUNT(*) FROM tb_roles WHERE id_rol = :id_rol");
    $checkRole->bindParam(':id_rol', $rol);
    $checkRole->execute();
    $roleExists = $checkRole->fetchColumn();

    if ($roleExists) {
        $password_user_hashed = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia = $pdo->prepare("INSERT INTO tb_usuarios 
                                    (nombres, email, id_rol, password_user, fyh_creacion) 
                                    VALUES (:nombres, :email, :id_rol, :password_user, :fyh_creacion)");

        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $rol);
        $sentencia->bindParam(':password_user', $password_user_hashed);
        $sentencia->bindParam(':fyh_creacion', $fechaHora);

        try {
            $sentencia->execute();
            session_start();
            $_SESSION['mensaje'] = "Se registró el usuario correctamente";
            header('Location: ' . $URL . '/usuarios/');
        } catch (PDOException $e) {
            session_start();
            $_SESSION['mensaje'] = "Error al registrar el usuario: " . $e->getMessage();
            header('Location: ' . $URL . '/usuarios/create.php');
        }
    } else {
        session_start();
        $_SESSION['mensaje'] = "El rol seleccionado no existe.";
        header('Location: ' . $URL . '/usuarios/create.php');
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Las contraseñas no son iguales";
    header('Location: ' . $URL . '/usuarios/create.php');
}
?>
