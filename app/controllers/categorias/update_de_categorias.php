<?php
include('../../config.php');

$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria=$_GET['id_categoria'];
$sentencia = $pdo->prepare("UPDATE tb_categorias
    SET nombre_categoria =:nombre_categoria,
        fyh_actulizacion=:fyh_actulizacion
    WHERE id_categoria=:id_categoria");
$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_actulizacion', $fechaHora);
$sentencia->bindParam(':id_categoria', $id_categoria);
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se Actualizo el rol correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php

}else{
    session_start();
    $_SESSION['mensaje'] = "No se pudo actualizar en la  base de datos ";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php

}
?>