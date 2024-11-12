            <?php
            session_start();
            include 'db.php'; // Conectar a la base de datos

            $action = $_POST['action'] ?? ''; // Saber si es login o registro

            if ($action == 'login') {
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];

                // Comprobar si el usuario existe y la contraseña coincide (sin password_hash)
                $sql = "SELECT * FROM Usuarios WHERE usuario='$usuario' AND password='$password'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // El login es exitoso
                    $_SESSION['usuario'] = $usuario;
                    header("Location: index.php");
                    exit();
                } else {
                    // Error en el login
                    $error = "Usuario o contraseña incorrectos, por favor inténtelo de nuevo.";
                }

            } elseif ($action == 'register') {
                $nombre = $_POST['nombre'];
                $usuario = $_POST['usuario'];
                $password = $_POST['password'];
                $telefono = $_POST['telefono'];
                $correo = $_POST['correo'];

                // Insertar el nuevo usuario
                $sql = "INSERT INTO Usuarios (nombre, usuario, password, numero_telefono, correo_electronico) 
                        VALUES ('$nombre', '$usuario', '$password', '$telefono', '$correo')";

                if ($conn->query($sql) === TRUE) {
                    // Registro exitoso, redirigir al login
                    $_SESSION['usuario'] = $usuario;
                    header("Location: index.php");
                    exit();
                } else {
                    $error = "Error al registrar: " . $conn->error;
                }
            }

            $conn->close();
            ?>

            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login/Registro - ArchiPlan Store</title>
                <!-- Bootstrap 5 CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    body {
                        background: linear-gradient(120deg, #a1c4fd, #c2e9fb);
                        min-height: 100vh;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-family: 'Montserrat', sans-serif;
                        margin: 0;
                    }

                    .card {
                        padding: 40px;
                        border-radius: 15px;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                    }

                    .form-group label {
                        font-weight: 500;
                    }

                    .btn-primary {
                        background-color: #00aaff;
                        border: none;
                        transition: background-color 0.3s ease;
                    }

                    .btn-primary:hover {
                        background-color: #007acc;
                    }

                    .alert {
                        margin-bottom: 20px;
                    }

                    .back-link {
                        color: #00aaff;
                        text-decoration: none;
                        transition: color 0.3s;
                    }

                    .back-link:hover {
                        color: #007acc;
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="card w-50 mx-auto">
                        <h2 class="text-center mb-4"><?php echo ($action == 'register') ? 'Registrarse' : 'Iniciar Sesión'; ?></h2>
                        
                        <!-- Mostrar mensaje de error si existe -->
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger text-center">
                                <?php echo $error; ?>
                            </div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <input type="hidden" name="action" value="<?php echo htmlspecialchars($action); ?>">
                            
                            <?php if ($action == 'register'): ?>
                                <!-- Campos adicionales para el registro -->
                                <div class="form-group mb-3">
                                    <label for="nombre">Nombre Completo</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="telefono">Número de Teléfono</label>
                                    <input type="tel" class="form-control" name="telefono" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="correo">Correo Electrónico</label>
                                    <input type="email" class="form-control" name="correo" required>
                                </div>
                            <?php endif; ?>

                            <div class="form-group mb-3">
                                <label for="usuario">Usuario</label>
                                <input type="text" class="form-control" name="usuario" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <?php echo ($action == 'register') ? 'Registrar Cuenta' : 'Iniciar Sesión'; ?>
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <?php if ($action == 'register'): ?>
                                <a href="login.php" class="back-link">¿Ya tienes una cuenta? Inicia Sesión</a>
                            <?php else: ?>
                                <a href="registro.php" class="back-link">¿No tienes una cuenta? Regístrate aquí</a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="inicio.php" class="back-link">⬅️ Regresar</a>
                        </div>
                    </div>
                </div>
                
                <!-- Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            </body>
            </html>
