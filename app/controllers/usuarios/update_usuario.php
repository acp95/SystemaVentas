<?php
echo $id_usuario_get = $_GET['id'];
$sql_usuarios = "SELECT us.id_usuario AS id_usuario, us.nombres AS nombres, us.email AS email, rol.rol AS rol
                 FROM tb_usuarios AS us
                 INNER JOIN tb_roles AS rol ON us.id_rol = rol.id_rol
                 WHERE id_usuario = ' $id_usuario_get '";
$query_usuarios=$pdo->prepare($sql_usuarios);
$query_usuarios->execute();
$usuarios_datos= $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios_datos as $usuarios_dato){
    $nombres = $usuarios_dato['nombres'];
    $email = $usuarios_dato['email'];
    $rol = $usuarios_dato['rol'];
}
?>