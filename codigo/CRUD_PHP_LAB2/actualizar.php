<?php
include("conexion.php");
$db_conexionEEditar = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);
$idEdit = utf8_decode($_POST["id"]);
$txt_producto = utf8_decode($_POST['txt_producto']);
$txt_precio_costo = utf8_decode($_POST["txt_precio_costo"]);
$txt_precio_venta = utf8_decode($_POST["txt_precio_venta"]);
$txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
$txt_existencia = utf8_decode($_POST["txt_existencia"]);
$drop_marca = utf8_decode($_POST["drop_marca"]);
$sqlUpdate = "UPDATE productos SET producto='" . $txt_producto . "', precio_costo='" . $txt_precio_costo . "', precio_venta='" . $txt_precio_venta . "', descripcion='" . $txt_descripcion . "', 
	existencia='" . $txt_existencia . "', id_marca=$drop_marca WHERE id_producto = $idEdit;";
echo "<br><br><br><br>";
if ($db_conexionEEditar->query($sqlUpdate) == true) {
	echo 'REGISTRO MODIFICADO';
} else {
	echo 'ERROR AL MODIFICAR REGISTRO';
}
echo "<br>SQL-->:  " . $sqlUpdate . "<br>";
$db_conexionEEditar->close();
header("Location: index.php");
