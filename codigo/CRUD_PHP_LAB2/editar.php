<?php
include("conexion.php");
$db_conexionPEditar = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);
$idEdit = utf8_decode($_GET["id"]);
$db_conexionPEditar->real_query("SELECT e.id_producto as id, e.producto, e.precio_costo, e.precio_venta, e.descripcion, e.existencia, p.marca FROM db_lab2_desarrollo.productos AS e INNER JOIN db_lab2_desarrollo.marcas AS p ON e.id_marca = p.id_marca WHERE id_producto = $idEdit;");
$resultadoPEdit = $db_conexionPEditar->use_result();
$filaProductoEdit = $resultadoPEdit->fetch_assoc();
$db_conexionM = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre);
$db_conexionM->real_query("SELECT id_marca as id, marca as marca FROM marcas;");
$resultadoM = $db_conexionM->use_result();
$idMarcaP = $resultadoM->fetch_assoc();
?>
<!doctype html>
<html lang="en">

<head>
	<title>Pagina PHP</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<div class="row" style="margin-top: 1em;">
		<div class="col-md-10" style="margin-left: 100px;">
			<div style="padding:10px; background-color: #001940; color:white;">
				<h3 class="text-center">Editar Producto : <?php echo $filaProductoEdit['precio_costo']; ?> <?php echo $filaProductoEdit['precio_venta']; ?> </h3>
			</div>
			<div style="padding:10px; background-color: white; width: 100%;">
				<div class="container">
					<form class="d-flex" action="" method="POST" autocomplete="off">
						<div class="col">
							<input name="id" id="id" value="<?php echo $filaProductoEdit['id']; ?>" hidden>
							<div class="row">
								<div class="col-md-6">
									<label for="lbl_producto" class="form-label"><b>producto</b></label>
									<input type="text" name="txt_producto" id="txt_producto" class="form-control" value="<?php echo $filaProductoEdit['producto']; ?>">
								</div>
								<div class="col-md-6">
									<label for="lbl_marca" class="form-label"><b>marca</b></label>
									<select class="form-select" name="drop_marca" id="drop_marca" required>
										<option value="<?php echo $idMarcaP['id']; ?>"><?php echo $idMarcaP['marca']; ?></option>
										<?php
										while ($filaMarca = $resultadoM->fetch_assoc()) {
											echo "<option value=" . $filaMarca['id'] . ">" . $filaMarca['marca'] . "</option>";
										}
										$db_conexionM->close();
										?>
									</select>
								</div>
							</div>
							<div class="row" style="margin-top: 1em;">
								<div class="col-md-6">
									<label for="lbl_precio_costo" class="form-label"><b>precio_costo</b></label>
									<input type="number" step="0.01" name="txt_precio_costo" id="txt_precio_costo" class="form-control" value="<?php echo $filaProductoEdit['precio_costo']; ?>">
								</div>
								<div class="col-md-6">
									<label for="lbl_precio_venta" class="form-label"><b>precio_venta</b></label>
									<input type="number" step="0.01" name="txt_precio_venta" id="txt_precio_venta" class="form-control" value="<?php echo $filaProductoEdit['precio_venta']; ?>">
								</div>
							</div>
							<div class="row" style="margin-top: 1em;">
								<div class="col-md-4">
									<label for="lbl_existencia" class="form-label"><b>existencia</b></label>
									<input type="number" name="txt_existencia" id="txt_existencia" class="form-control" value="<?php echo $filaProductoEdit['existencia']; ?>">
								</div>
								<div class="col-md-8">
									<label for="lbl_descripcion" class="form-label"><b>descripcion</b></label>
									<input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" value="<?php echo $filaProductoEdit['descripcion']; ?>">
								</div>
							</div>
							<?php $db_conexionPEditar->close(); ?>
							<div class="text-center">
								<a href="index.php" class="btn btn-primary"> <img src="img/return.png" style='width: 25px; height:25px; color:white;'></img> Regresar</a> &nbsp;&nbsp;
								<button name="btn_editar" id="btn_editar" class="btn btn-success"><img src="img/save.png" style='width: 25px; height:25px; color:white;'></img> Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (isset($_POST["btn_editar"])) {
		include 'actualizar.php';
	}
	?>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>