        <?php

        // Iniciar sesión
        session_start();

        // Verificar si el usuario ya está logueado, redirigir si es así
        if (isset($_SESSION['usuario'])) {
            header('Location: login.php'); // Redirigir a la página de inicio o perfil
            exit();
        }

        include 'db.php'; 

        // Manejar el registro
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nombre = $_POST['nombre'];
            $usuario = $_POST['usuario'];
            $password = $_POST['password']; // No encriptar la contraseña
            $numero_telefono = $_POST['numero_telefono'];
            $correo_electronico = $_POST['correo_electronico'];

            // Insertar el nuevo usuario en la base de datos
            $sql = "INSERT INTO Usuarios (nombre, usuario, password, numero_telefono, correo_electronico) 
                    VALUES (?, ?, ?, ?, ?)";
            
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("sssss", $nombre, $usuario, $password, $numero_telefono, $correo_electronico);

                if ($stmt->execute()) {
                    // Registro exitoso, iniciar sesión automáticamente
                    $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión
                    header('Location: login.php'); // Redirigir a la página principal
                    exit();
                } else {
                    echo "Error: " . $stmt->error; // Mostrar error
                }
            } else {
                echo "Error: " . $conn->error; // Mostrar error
            }
            $stmt->close();
        }

        $conn->close();

        ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - ArchiPlan Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos generales */
        body {
            background: linear-gradient(to right, #71b7e6, #9b59b6);
            font-family: 'Roboto', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        /* Contenedor del formulario */
        .card {
            border-radius: 15px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            max-width: 500px;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            animation: fadeIn 1s ease;
        }

        /* Animación de entrada */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Encabezado de la tarjeta */
        .card-header {
            background-color: #9b59b6;
            color: #fff;
            text-align: center;
            font-weight: bold;
            font-size: 1.4rem;
            padding: 1.5rem;
        }

        /* Estilos de los campos */
        .input-group-text {
            background-color: #f0f0f0;
            border: none;
            border-radius: 15px 0 0 15px;
            font-size: 1.2rem;
            color: #6c757d;
        }

        .form-control {
            border: none;
            border-radius: 0 15px 15px 0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .form-control:focus {
            box-shadow: 0 0 8px rgba(155, 89, 182, 0.5);
            outline: none;
        }

        /* Botón de enviar */
        .btn-primary {
            background-color: #9b59b6;
            border: none;
            font-weight: bold;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.2s;
            font-size: 1.2rem;
            padding: 12px;
        }

        .btn-primary:hover {
            background-color: #7d3a9b;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Mensajes de validación */
        .password-strength {
            font-size: 0.9rem;
            font-weight: bold;
            margin-top: 5px;
        }

        /* Colores de la fuerza de la contraseña */
        .strength-weak { color: red; }
        .strength-medium { color: orange; }
        .strength-strong { color: #34af23; }
        .strength-very-strong { color: green; }
        .error-message {
            color: red;
            font-size: 0.9rem;
            margin-top: 5px;
        }

        /* Footer del formulario */
        .footer {
            margin-top: 15px;
            text-align: center;
            color: #6c757d;
        }

        .footer a {
            color: #9b59b6;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: #5a356b;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            Crear una Nueva Cuenta en ArchiPlan Store
        </div>
        <div class="card-body p-4">
            <form action="" method="POST">
                <!-- Nombre Completo -->
                <div class="form-group">
                    <label for="nombre">Nombre Completo:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" name="nombre" placeholder="Escribe tu nombre completo" required>
                    </div>
                </div>
                <!-- Usuario -->
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                        </div>
                        <input type="text" class="form-control" name="usuario" placeholder="Escribe tu nuevo usuario" required>
                    </div>
                </div>
                <!-- Contraseña -->
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Escribe tu nueva contraseña" required>
                    </div>
                    <div id="password-strength" class="password-strength">La contraseña es:</div>
                </div>
                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <label for="confirm-password">Confirmar Nueva Contraseña:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" class="form-control" id="confirm-password" placeholder="Confirma tu contraseña" required>
                    </div>
                    <div id="password-error" class="error-message" style="display: none;">La contraseña no es igual que la anterior.</div>
                </div>
                <!-- Número de Teléfono -->
                <div class="form-group">
                    <label for="numero_telefono">Número de Teléfono:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" name="numero_telefono" placeholder="Escribe tu número de teléfono">
                    </div>
                </div>
                <!-- Correo Electrónico -->
                <div class="form-group">
                    <label for="correo_electronico">Correo Electrónico:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="email" class="form-control" name="correo_electronico" placeholder="Escribe tu correo electrónico" required>
                    </div>
                </div>
                <!-- Botón de enviar -->
                <button type="submit" class="btn btn-primary btn-block mt-3">Crear Cuenta</button>
            </form>
            <!-- Footer del formulario -->
            <div class="footer mt-3">
                <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirm-password');
        const passwordStrength = document.getElementById('password-strength');
        const passwordError = document.getElementById('password-error');

        passwordInput.addEventListener('input', () => {
            const passwordValue = passwordInput.value;
            if (passwordValue.length < 7) {
                passwordStrength.textContent = 'La contraseña es: NO segura';
                passwordStrength.className = 'password-strength strength-weak';
            } else if (passwordValue.length < 10) {
                passwordStrength.textContent = 'La contraseña es: Media Segura';
                passwordStrength.className = 'password-strength strength-medium';
            } else if (passwordValue.length < 15) {
                passwordStrength.textContent = 'La contraseña es: Segura';
                passwordStrength.className = 'password-strength strength-strong';
            } else {
                passwordStrength.textContent = 'La contraseña es: Muy Segura';
                passwordStrength.className = 'password-strength strength-very-strong';
            }
        });

        confirmPasswordInput.addEventListener('input', () => {
            if (confirmPasswordInput.value !== passwordInput.value) {
                passwordError.style.display = 'block';
            } else {
                passwordError.style.display = 'none';
            }
        });
    </script>
</body>
</html>
