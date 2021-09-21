<?php
require_once 'conexion.php';
$db_conexionP = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionP->real_query("SELECT p.id_producto as id, p.producto, p.precio_costo, p.precio_venta, p.descripcion, p.existencia, m.marca FROM productos AS p INNER JOIN marcas AS m ON p.id_marca = m.id_marca");
$resultadoE = $db_conexionP->use_result();
$db_conexionM = mysqli_connect($db_host, $db_user, $db_pass, $db_nombre, $port);
$db_conexionM->real_query("SELECT id_marca as id, marca as marca FROM db_lab2_desarrollo.marcas;");
$resultadoP = $db_conexionM->use_result();
?>
<!doctype html>
<html lang="en">

<head>
	<title>CRUD PHP PRODUCTOS</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<div class="row" style="margin-top: 1em;">
		<div class="col-md-10" style="margin-left: 100px;">
			<div style="padding:10px; background-color: #001940; color:white;">
				<h3 class="text-center">Nuevo producto</h3>
			</div>
			<div style="padding:10px; background-color: white; width: 100%;">
				<form class="d-flex" action="nuevo.php" method="POST">
					<div class="col">
						<div class="row">
							<div class="col-md-6">
								<label for="lbl_producto" class="form-label"><b>producto</b></label>
								<input type="text" name="txt_producto" id="txt_producto" class="form-control" placeholder="nombre del producto" required>
							</div>
							<div class="col-md-6">
								<label for="lbl_marca" class="form-label"><b>Marca</b></label>
								<select class="form-select" name="drop_marca" id="drop_marca" required>
									<option value=0>Selecione una marca</option>
									<?php
									while ($filaMarca = $resultadoP->fetch_assoc()) {
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
								<input type="number"  step="0.01" name="txt_precio_costo" id="txt_precio_costo" class="form-control" placeholder="0.00" required>
							</div>
							<div class="col-md-6">
								<label for="lbl_precio_venta" class="form-label"><b>precio_venta</b></label>
								<input type="number"  step="0.01" name="txt_precio_venta" id="txt_precio_venta" class="form-control" placeholder="0.00" required>
							</div>
						</div>
						<div class="row" style="margin-top: 1em;">
							<div class="col-md-4">
								<label for="lbl_existencia" class="form-label"><b>existencia</b></label>
								<input type="number" name="txt_existencia" id="txt_existencia" class="form-control" required>
							</div>
							<div class="col-md-8">
								<label for="lbl_descripcion" class="form-label"><b>descripcion</b></label>
								<input type="text" name="txt_descripcion" id="txt_descripcion" class="form-control" placeholder="producto de marca, peso." required>

							</div>
						</div>
						<center>
							<div class="mb-3" style="margin-top: 1em;">
								<button class="btn btn-primary" name="btn_agregar" id="btn_agregar"><img src="img/add.png" style="width: 25px; height:25px; color:white;"></img> Agregar</button>
							</div>
						</center>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 1em;">
		<div class="col-md-10" style="margin-left: 100px;">
			<div style="padding:10px; background-color: #001940; color:white;">
				<h3 class="text-center">Listado de Productos</h3>
			</div>
			<div style="padding:10px; background-color: white; width: 100%;">
				<table class="table table-striped table-inverse table-responsive">
					<thead class="thead-inverse">
						<tr>
							<th class="text-center">Producto</th>
							<th class="text-center">Precio costo</th>
							<th class="text-center">precio venta</th>
							<th class="text-center">Descripcion</th>
							<th class="text-center">Existencia</th>
							<th class="text-center">Marca</th>
							<th class="text-center">Acciones</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($filaProducto = $resultadoE->fetch_assoc()) {
							echo "<tr data-id=" . $filaProducto['id'] . ">";
							echo "<td class='text-center' >" . $filaProducto['producto'] . "</td>";
							echo "<td class='text-center' >Q" . $filaProducto['precio_costo'] . "</td>";
							echo "<td class='text-center' >Q" . $filaProducto['precio_venta'] . "</td>";
							echo "<td class='text-center' >" . $filaProducto['descripcion'] . "</td>";
							echo "<td class='text-center' >" . $filaProducto['existencia'] . "</td>";
							echo "<td class='text-center' >" . $filaProducto['marca'] . "</td>";
							echo "<td class='text-center' ><a href='editar.php?id=" . $filaProducto['id'] . "' class='btn btn-success'> <img src='img/edit.png' style='width: 25px; height:25px; color:white;'></img></a>";
							echo "<a href='eliminar.php?id=" . $filaProducto['id'] . "' class='btn btn-danger' style='margin-left: 10px;'>  <img src='img/delete.png' style='width: 25px; height:25px; color:white;'></img></a></td>";
							echo "</tr>";
						}
						$db_conexionP->close();
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>