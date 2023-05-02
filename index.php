<?php
    // Incluir archivo de conexión a la base de datos
    require 'conexion.php';

    // Verificar si se recibió un formulario para agregar un usuario
    if (isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['cedula']) && isset($_POST['telefono'])) {
        // Recuperar datos del formulario
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $cedula = $_POST['cedula'];
        $telefono = $_POST['telefono'];

        // Preparar consulta SQL para insertar un usuario en la tabla "usuarios"
        $sql = "INSERT INTO usuarios (nombre, edad, cedula, telefono) VALUES ('$nombre', '$edad', '$cedula', '$telefono')";

        // Ejecutar consulta SQL
        if ($mysqli->query($sql)) {
            echo "<div class='alert alert-success' role='alert'>Usuario agregado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al agregar usuario: " . $mysqli->error . "</div>";
        }
    }

    // Verificar si se recibió un formulario para eliminar un usuario
    if (isset($_POST['eliminar'])) {
        $id = $_POST['id'];

        // Preparar consulta SQL para eliminar un usuario en la tabla "usuarios"
        $sql = "DELETE FROM usuarios WHERE id = '$id'";

        // Ejecutar consulta SQL
        if ($mysqli->query($sql)) {
            echo "<div class='alert alert-success' role='alert'>Usuario eliminado correctamente.</div>";
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error al eliminar usuario: " . $mysqli->error . "</div>";
        }
    }

    // Consulta SQL para obtener todos los usuarios de la tabla "usuarios"
    $sql = "SELECT * FROM usuarios";
    $resultado = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/svg+xml" href="/src/favicon.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DevOps en Github por Andrea Salcedo y Edwin Sanabria</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
      }
      header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 20px;
      }
      h1 {
        margin: 0;
        font-size: 36px;
      }
      p {
        font-size: 20px;
        line-height: 1.5;
        margin-bottom: 30px;
      }

      .caja-formulario {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    max-width: 500px;
    margin: 0 auto;
    box-shadow: 0px 0px 5px #ccc;
  }
  
  /* Estilos para las etiquetas */
  label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }
  
  /* Estilos para los campos de entrada */
  input[type="text"],
  input[type="number"] {
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #ccc;
    width: 100%;
  }
  
  /* Estilos para el botón */
  input[type="submit"] {
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }
  
  input[type="submit"]:hover {
    background-color: #0056b3;
  }



    </style>
  </head>
  <body>
    <header>
      <h1>DevOps en Github por Andrea Salcedo y Edwin Sanabria</h1>
    </header>
    <div class="container">
      <p>DevOps es una metodología que tiene como objetivo integrar el proceso de desarrollo de software con las operaciones del sistema. Esta extensión de DevOps se enfoca específicamente en la automatización del despliegue de aplicaciones y en la gestión de la infraestructura necesaria para ejecutarlas de manera eficiente.</p>
      <p>Es es una prueba satisfactoria de DevOps, Gracias por su tiempo!</p>
    </div>
    <div class="caja-formulario">
    <form method="post">
  <div>
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required style="display: inline-block;">
  </div>
  <div>
    <label for="edad">Edad:</label>
    <input type="number" id="edad" name="edad" required style="display: inline-block;">
  </div>
  <div>
    <label for="cedula">Cédula:</label>
    <input type="text" id="cedula" name="cedula" required style="display: inline-block;">
  </div>
  <div>
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" required style="display: inline-block;">
  </div>
  <div>
    <center><input type="submit" name="agregar" value="Agregar"></center>
  </div>
</form>
</div>
<?php
if (isset($_POST['agregar'])) {
  $nombre = $_POST['nombre'];
  $edad = $_POST['edad'];
  $cedula = $_POST['cedula'];
  $telefono = $_POST['telefono'];

  $sql = "INSERT INTO usuarios (nombre, edad, cedula, telefono) VALUES ('$nombre', $edad, '$cedula', '$telefono')";

  if ($resultado) {
    echo "Registro agregado exitosamente.";
  } else {
    echo "Error al agregar registro: " . $mysqli->error;
  }
}
?>

    <div class="table-responsive">
									<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>id</th>
												<th>nombre</th>
												<th>edad</th>
												<th>cedula</th>
                                                <th>telefono</th>
											</tr>
										</thead>
										<tbody>
											<?php while($row = $resultado->fetch_assoc()) { ?>
												
												<tr>
													<td><?php echo $row['id']; ?></td>
													<td><?php echo $row['nombre']; ?></td>
													<td><?php echo $row['edad']; ?></td>
													<td><?php echo $row['cedula']; ?></td>
                                                    <td><?php echo $row['telefono']; ?></td>

                                                    <td>
                                                    <form method="post">
                                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                        <input type="submit" name="eliminar" value="Eliminar">
                                                    </form>
                                                    </td>
 
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>

    <div id="root"></div>
    <script type="module" src="/src/main.jsx"></script>
  </body>
</html>