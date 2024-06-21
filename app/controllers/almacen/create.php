<?php
include('../../config.php');

$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fechaHora = date('Y-m-d H:i:s');

$filename = '';
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $nombreDelArchivo = date("Y-m-d_H-i-s");
    $filename = $nombreDelArchivo . "__" . basename($_FILES['image']['name']);
    $locacion = "../../../almacen/img_productos/" . $filename;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $locacion)) {
        session_start();
        $_SESSION['mensaje'] = "Error: no se pudo mover el archivo de imagen";
        $_SESSION['icono'] = "error";
        header('Location: '.$URL.'/almacen/create.php');
        exit;
    }
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo cargar el archivo de imagen";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/almacen/create.php');
    exit;
}

$sentencia = $pdo->prepare("INSERT INTO tb_almacen
    (codigo, nombre, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, imagen, id_usuario, id_categoria, fyh_creacion) 
    VALUES (:codigo, :nombre, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :imagen, :id_usuario, :id_categoria, :fyh_creacion)");

$sentencia->bindParam(':codigo', $codigo);
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);  // Asegúrate de que precio_compra esté definido correctamente
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':imagen', $filename);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':id_categoria', $id_categoria);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

if ($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se registró el producto de manera correcta";
    $_SESSION['icono'] = "success";
    header('Location:'.$URL.'/almacen/');
}else{
    session_start();
    $_SESSION['mensaje'] = "Error: no se pudo registrar el Producto";
    $_SESSION['icono'] = "error";
    header('Location: '.$URL.'/almacen/create.php');
}
?>
