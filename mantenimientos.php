<?php
include 'connection_mantenimientos.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libro de cotizaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .button-bar {
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: flex-end; /* Botones alineados a la derecha */
            background-color: #003366;
            padding: 10px;
            box-sizing: border-box;
        }
        .button-bar a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #004080;
            border-radius: 5px;
            margin-left: 10px; /* Espacio entre los botones */
        }
        .button-bar a:hover {
            background-color: #002244;
        }
        .header {
            width: 90%;
            max-width: 1000px;
            display: flex;
            align-items: center;
            margin-top: 20px; /* Espacio encima del header */
        }
        .header img {
            height: 109px; /* Ajusta el tamaño del logo según sea necesario */
            margin-right: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 40px;
            color: black; /* Azul marino */
        }
        .container {
            width: 90%;
            max-width: 1000px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #003366; /* Azul marino */
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #003366; /* Azul marino */
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        tr:nth-child(even) td {
            background-color: #e6e6e6;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container h2 {
            margin-top: 0;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-container input, .form-container textarea, .form-container select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .form-container input[type="submit"] {
            background-color: #003366; /* Azul marino */
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            padding: 12px;
        }
        .form-container input[type="submit"]:hover {
            background-color: #002244; /* Azul marino oscuro */
        }
    </style>
</head>
<body>
    <div class="button-bar">
        <a href="index.php">Proyectos</a>
        <a href="mantenimientos.php">Mantenimientos</a>
        <a href="termografia.php">Termografías</a>
        <a href="estudios.php">Estudios</a>
        <a href="capacitacion.php">Capacitaciones</a>
    </div>

    <div class="header">
        <img src="https://www.plusindustrial.mx/images/logo.png" alt="Logo">
        <h1>Cotizaciones de Mantenimientos</h1>
    </div>

    <div class="container">
        <!-- Tabla de datos -->
        <table>
            <thead>
                <tr>
                    <th>Tipo de cotización</th>
                    <th>Año / Mes</th>
                    <th>Consecutivo</th>
                    <th>Cliente</th>
                    <th>Descripción</th>
                    <th>Elaboró</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>M-</td>"; // Columna estática
                        echo "<td>" . htmlspecialchars($row["fecha"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["consecutivo"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["cliente"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["descripcion"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["elaboro"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay datos</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Formulario para agregar nuevos datos -->
        <div class="form-container">
            <h2>Agregar Nuevo Registro</h2>
            <form method="POST" action="">
                <input type="hidden" id="fecha" name="fecha" value="<?php echo $formattedDate; ?>">
                <input type="hidden" id="consecutivo" name="consecutivo" value="<?php echo $nextConsecutivo; ?>">
                
                <label for="cliente">Cliente:</label>
                <input type="text" id="cliente" name="cliente" required>
                
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                
                <label for="elaboro">Elaboró:</label>
                <select id="elaboro" name="elaboro" required>
                    <?php
                    foreach ($names as $name) {
                        echo "<option value=\"" . htmlspecialchars($name) . "\">" . htmlspecialchars($name) . "</option>";
                    }
                    ?>
                </select>
                
                <input type="submit" value="Agregar Registro">
            </form>
        </div>
    </div>
</body>
</html>
