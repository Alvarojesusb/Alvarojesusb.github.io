<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Asegúrate de que la contraseña esté cifrada
echo "Contraseña cifrada: " . $password;
var_dump($_POST['username']); // Muestra el nombre de usuario que se está enviando
var_dump($_POST['password']); // Muestra la contraseña que se está enviando
    // Consulta preparada
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // "ss" indica que ambos parámetros son cadenas
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: ventas.php");
        exit();
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }

    $stmt->close();
}
?>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<center><form method="POST" action="login.php">
    <label><h2>Usuario:</h2></label>
    <input type="text" name="username" required>
    <br>
    <label><h2>Contraseña:</h2></label>
    <input type="password" name="password" required>
    <br>
    <br />

    <button type="submit"><h4>Ingresar</h4></button>
</form></center>
