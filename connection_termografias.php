<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "libro";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los datos
$sql = "SELECT fecha, consecutivo, cliente, descripcion, elaboro FROM termografias";
$result = $conn->query($sql);

// Obtener fecha actual para el campo "Año / Mes"
$currentDate = new DateTime();
$formattedDate = $currentDate->format('y') . $currentDate->format('m');

// Obtener el siguiente consecutivo
$sql_consecutivo = "SELECT MAX(consecutivo) AS max_consecutivo FROM termografias";
$result_consecutivo = $conn->query($sql_consecutivo);
$row_consecutivo = $result_consecutivo->fetch_assoc();
$nextConsecutivo = $row_consecutivo['max_consecutivo'] ? $row_consecutivo['max_consecutivo'] + 1 : 1;

// Nombres pre-cargados
$names = ["", "Ing. Martín", "Amairani", "Raúl", "Daniel"];

// Procesar el formulario si se envía
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $formattedDate; // Año / Mes generado automáticamente
    $consecutivo = $nextConsecutivo; // Consecutivo generado automáticamente
    $cliente = $_POST['cliente'];
    $descripcion = $_POST['descripcion'];
    $elaboro = $_POST['elaboro'];

    $sql_insert = "INSERT INTO termografias (tipo, fecha, consecutivo, cliente, descripcion, elaboro) VALUES ('T-', ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sssss", $fecha, $consecutivo, $cliente, $descripcion, $elaboro);

    if ($stmt->execute()) {
        // Actualizar los resultados después de la inserción
        $result = $conn->query($sql);
    } else {
        echo "<p>Error al agregar el registro: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

$conn->close();
?>
