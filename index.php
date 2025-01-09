<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_ventas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die ("conexion fallida: " . $conn->connect_error);
}
	?>
</body>
</html>