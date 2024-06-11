<?php
include ('../../config.php');
echo $nombre_categoria = $_GET['nombre_categoria'];
$sentencia = $pdo->prepare("INSERT INTO tb_categorias
    (nombre_categoria, fyh_creacion) 
    VALUES (:nombre_categoria,:fyh_creacion)");

$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_creacion', $fechaHora);
if ($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se registró la categoria de la manera correctamente";
    $_SESSION['icono'] = "success";
   // header('Location: ' . $URL . '/categorias/');
    echo "<script>location.href = '{$URL}/categorias';</script>";
}else{
    session_start();
    $_SESSION['mensaje'] = "Error no se pudo registrar en la base de datos";
    $_SESSION['icono'] = "error";
    echo "<script>location.href = '{$URL}/categorias';</script>";
   // header('Location: ' . $URL . '/categorias');
}
?>