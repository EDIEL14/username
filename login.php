            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Login - ArchiPlan Store</title>
                <!-- Bootstrap 5 CSS -->
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                <!-- Font Awesome -->
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                <!-- Google Fonts -->
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
                <style>
                    body {
                        background: linear-gradient(120deg, #a1c4fd, #c2e9fb);
                        height: 100vh;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        font-family: 'Montserrat', sans-serif;
                        margin: 0;
                    }

                    .login-card {
                        background: #ffffff;
                        padding: 50px;
                        border-radius: 15px;
                        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
                        animation: slideIn 1s ease forwards;
                        opacity: 0;
                    }

                    .login-card h2 {
                        color: #333;
                        font-weight: 600;
                        font-size: 2rem;
                        margin-bottom: 20px;
                        text-align: center;
                    }

                    .form-control {
                        border-radius: 10px;
                        padding: 15px;
                        font-size: 1rem;
                        transition: all 0.3s ease;
                        border: 2px solid #e9ecef;
                    }

                    .form-control:focus {
                        border-color: #00aaff;
                        box-shadow: 0 0 10px rgba(0, 170, 255, 0.4);
                    }

                    .btn-login {
                        background-color: #00aaff;
                        color: white;
                        border-radius: 10px;
                        padding: 15px;
                        font-size: 1.2rem;
                        font-weight: 600;
                        width: 100%;
                        margin-top: 20px;
                        transition: all 0.3s ease;
                    }

                    .btn-login:hover {
                        background-color: #007acc;
                        transform: translateY(-3px);
                        box-shadow: 0 5px 15px rgba(0, 170, 255, 0.2);
                    }

                    .input-group-text {
                        background-color: #f0f0f0;
                        border: none;
                        color: #00aaff;
                    }

                    .footer {
                        text-align: center;
                        margin-top: 30px;
                    }

                    .footer a {
                        color: #00aaff;
                        text-decoration: none;
                        transition: color 0.3s ease;
                    }

                    .footer a:hover {
                        color: #007acc;
                    }

                    .background {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        z-index: -1;
                        overflow: hidden;
                    }

                    .background::before {
                        content: '';
                        position: absolute;
                        width: 200%;
                        height: 200%;
                        top: -50%;
                        left: -50%;
                        background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0));
                        animation: rotate 6s linear infinite;
                        z-index: -1;
                    }

                    @keyframes slideIn {
                        from {
                            opacity: 0;
                            transform: translateY(30px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    @keyframes rotate {
                        from {
                            transform: rotate(0deg);
                        }
                        to {
                            transform: rotate(360deg);
                        }
                    }

                    @media (max-width: 768px) {
                        .login-card {
                            padding: 30px;
                        }

                        .login-card h2 {
                            font-size: 1.8rem;
                        }

                        .form-control {
                            padding: 12px;
                        }

                        .btn-login {
                            font-size: 1rem;
                            padding: 10px;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="background"></div>

                <div class="login-card">
                    <h2><i class="fas fa-user-lock"></i> Iniciar Sesión</h2>
                    <form action="procesar_login.php" method="POST">
                        <input type="hidden" name="action" value="login">
                        <div class="form-group">
                            <label for="usuario">Usuario:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" name="usuario" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Contraseña:</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-login mt-4">Iniciar Sesión</button>
                    </form>
                    
                    <?php if (isset($_GET['mensaje'])): ?>
                    <div class="alert alert-success mt-3" role="alert">
                        <?php echo htmlspecialchars($_GET['mensaje']); ?>
                    </div>
                <?php endif; ?>
                
                    <div class="footer mt-4">
                        <p>¿No tienes una cuenta? <a href="registro.php">Crear Cuenta aquí</a></p>
                        <p>¿Quieres regresar atrás? <a href="inicio.php">Regresa aquí</a></p>
                    </div>
                </div>

                <!-- Bootstrap JS and dependencies -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
            </body>
            </html>
