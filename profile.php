            <?php
            session_start();
            include 'db.php'; // Conectar a la base de datos

            // Verificar si el usuario está logueado
            if (!isset($_SESSION['usuario'])) {
                header("Location: login.php"); // Redirigir a login si no está logueado
                exit();
            }

            // Obtener el usuario actual
            $usuario_actual = $_SESSION['usuario'];

            // Obtener los datos del usuario de la base de datos
            $sql = "SELECT * FROM Usuarios WHERE usuario='$usuario_actual'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Guardar los datos del usuario en una variable
                $usuario_info = $result->fetch_assoc();
            } else {
                echo "No se encontraron datos para este usuario.";
                exit();
            }

            $conn->close();
            ?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Perfil de Usuario | ArchiPlan Store</title>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                <style>
                    body {
                        background-color: #f8f9fa;
                    }
                    .navbar {
                        background-color: #007bff;
                    }
                    .navbar-brand,
                    .nav-link {
                        color: white !important;
                    }
                    .navbar-brand:hover,
                    .nav-link:hover {
                        color: #ffd700 !important;
                    }
                    .card {
                        border: none;
                        border-radius: 15px;
                        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                        transition: transform 0.2s, box-shadow 0.2s;
                    }
                    .card:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
                    }
                    .btn-custom {
                        background-color: #007bff;
                        color: white;
                        border-radius: 50px;
                        transition: background-color 0.3s, transform 0.2s;
                    }
                    .btn-custom:hover {
                        background-color: #0056b3;
                        transform: translateY(-2px);
                    }
                    .modify-btn {
                        background-color: #28a745;
                        color: white;
                        border-radius: 50px;
                        transition: background-color 0.3s, transform 0.2s;
                    }
                    .modify-btn:hover {
                        background-color: #218838;
                        transform: translateY(-2px);
                    }
                    h1 {
                        color: #343a40;
                    }
                    h5 {
                        color: #495057;
                    }
                    .icon {
                        margin-right: 8px;
                    }
                    footer {
                        margin-top: 20px;
                        padding: 10px 0;
                        background-color: #343a40;
                        color: white;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <a class="navbar-brand" href="#">ArchiPlan Store</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="carrito.php">Carrito</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="container mt-5">
                    <h1 class="text-center mb-4">Tu Información de Perfil</h1>
                    
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Nombre Completo:</h5>
                                    <p class="card-text"><?php echo htmlspecialchars($usuario_info['nombre']); ?></p>
                                </div>
                            </div>

                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Datos de tu Cuenta</h5>
                                    <p>Correo: <strong><?php echo htmlspecialchars($usuario_info['correo_electronico']); ?></strong> 
                                    <p>Número Telefónico: <strong><?php echo htmlspecialchars($usuario_info['numero_telefono']); ?></strong> 
                                    <p>Nombre de Usuario: <strong><?php echo htmlspecialchars($usuario_info['usuario']); ?></strong> 
                                </div>
                            </div>

                            <!-- <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="font-weight-bold">Seguridad</h5>
                                    <p>Tienes configurada la seguridad de tu cuenta:</p>
                                    <ul>
                                        <li>Métodos de Verificación:</li>
                                        <ul>
                                            <li>Teléfono: <strong><?php echo htmlspecialchars($usuario_info['numero_telefono']); ?></strong></li>
                                            <li>Correo Electrónico: <strong><?php echo htmlspecialchars($usuario_info['correo_electronico']); ?></strong></li>
                                        </ul>
                                    </ul>
                                </div>
                            </div>
                        --> </div>
                    </div>

                </div>

                <footer>
                    <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
                </footer>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            </body>
            </html>
