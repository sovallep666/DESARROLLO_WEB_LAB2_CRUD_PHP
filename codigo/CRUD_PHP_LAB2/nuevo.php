<?php
include("conexion.php");
$db_conexionEInsert = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);
$txt_producto = utf8_decode($_POST["txt_producto"]);
$txt_precio_costo = utf8_decode($_POST["txt_precio_costo"]);
$txt_precio_venta = utf8_decode($_POST["txt_precio_venta"]);
$txt_descripcion = utf8_decode($_POST["txt_descripcion"]);
$txt_existencia = utf8_decode($_POST["txt_existencia"]);
$drop_marca = utf8_decode($_POST["drop_marca"]);
$sqlInsert =  "INSERT INTO productos(producto,precio_costo,precio_venta,descripcion,existencia,id_marca) 
	VALUES ('" . $txt_producto . "','" . $txt_precio_costo . "','" . $txt_precio_venta . "','" . $txt_descripcion . "','" . $txt_existencia . "','"  . $drop_marca . "')";
if ($db_conexionEInsert->query($sqlInsert) == true) {
	$db_conexionEInsert->close();
	header("Location: index.php");
} else {
	echo "ERROR EN EL REGISTRO: " . $sqlInsert . "<br>" . $db_conexionEInsert->close();
}
