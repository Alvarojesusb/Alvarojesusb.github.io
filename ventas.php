<?php
session_start();
ob_start();
include 'conexion.php';

if (!isset($_SESSION['username'])){
	header("Location: login.php");
	exit();
	}

if ($_SERVER["REQUEST_METHOD"]== "POST"){
	$action = $_POST['action'];
	
	if ($action == 'agregar') {
		$producto = $_POST['producto'];
		$marca = $_POST['marca'];
		$talla = $_POST['talla'];
		$cantidad =  $_POST['cantidad'];
		$precio = $_POST['precio'];
		
		$stmt = $conn->prepare("INSERT INTO ventas (producto, marca, talla, cantidad, precio) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssid", $producto, $marca, $talla,$cantidad, $precio);
		
		if($stmt->execute()){
			echo "<script> window.location.href='ventas.php';</script>";
			exit();
			}else{
				echo "Error al agregar la venta:" . $conn->error;
			}
			
			$stmt->close();
		} elseif ($action == 'modificar'){
			$id = $_POST ['id'];
			$producto = $_POST ['producto'];
			$marca = $_POST['marca'];
			$talla = $_POST['talla'];
			$cantidad = $_POST ['cantidad'];
			$precio = $_POST ['precio'];
			
			$stmt = $conn->prepare("UPDATE ventas SET producto=?,marca=?, talla=?, cantidad=?, precio=? WHERE id=?");
			$stmt->bind_param("sssidi", $producto, $marca, $talla, $cantidad, $precio, $id);
			
			if ($stmt->execute()) {
				echo "<script>window.location.href='ventas.php';</script>";
				exit();
			}else{
				echo "Error al modificar la venta: " . $conn->error;
				}
				$stmt->close();
			}elseif($action == 'eliminar') {
				$id = $_POST['id'];
				
				$stmt = $conn->prepare("DELETE FROM ventas WHERE id=?");
				$stmt->bind_param("i", $id);
				
				if ($stmt->execute()){
					echo"<script>window.location.href='ventas.php';</script>";
					exit();
				}else{
					echo "Error al eliminar la venta: " . $conn->error;
					}
					$stmt->close();
			}
			}
			
$result = $conn-> query("SELECT * FROM ventas");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Sistema de Ventas</title>
</head>
<body style="background-color:#CCFFFF">
<h1><center> Tienda de deportes Alvasport</center></h1>
<h2><center> Bienvenido</center> <center> <?php echo htmlspecialchars($_SESSION['username']);?></center></h2>
<h2><center> a la mejor tienda de deportes </center> </h2>
<h3><center> Hoy es un buen dia para hacer Deporte</center></h3>
<br><center>
<form method="POST" action="ventas.php">
<input type="hidden" name="action" value="agregar">
Producto: <input type="text" name="producto" required>
marca: <input type="text" name="marca" required>
talla: <input type="text" name="talla" required>
Cantidad: <input type="number" name="cantidad" required>
Precio <input type="number" step="0.01" name="precio" required>
<button type="submit">Agregar Venta</button>
</form></center>
<br>
<br>
<br>
<br>

<center><table border="1">
<tr>
<th>ID</th>
<th>Producto</th>
<th>Marca</th>
<th>Talla</th>
<th>Cantidad</th>
<th>Precio</th>
<th>Fecha</th>
<th>Acciones</th>
</tr></center>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<form method="POST" action="ventas.php">
<td><?php echo htmlspecialchars($row['id']); ?></td>
<td><input type="text" name="producto" value="<?php
echo htmlspecialchars($row['producto']);?>" required></td>
<td><input type="text" name="marca" value="<?php
echo htmlspecialchars($row['marca']);?>" required></td>
<td><input type="text" name="talla" value="<?php
echo htmlspecialchars($row['talla']);?>" required></td>
<td><input type="number" name="cantidad" value="<?php
echo htmlspecialchars($row['cantidad']);?>" required></td>
<td><input type="number" step="0.01" name="precio" value="<?php
echo htmlspecialchars($row['precio']);?>" required></td>

<td><?php echo htmlspecialchars($row['fecha']);?></td>

<td><input type="hidden" name="id" value="<?php
echo htmlspecialchars($row['id']);?>">
<button type="submit" name="action" value="modificar">Modificar</button>
<button type="submit" name="action" value="eliminar">Eliminar</button>
</td>
</form>
</tr>
<?php endwhile; ?>
</table>
<a href="logout.php">Cerrar sesión</a>

</body>
</html>