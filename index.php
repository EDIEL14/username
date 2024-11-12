                <?php
                session_start();

                // Verificar si el usuario está autenticado
                if (isset($_SESSION['usuario'])) {
                    // Si está autenticado, establecer el nombre del usuario
                    $usuario = $_SESSION['usuario'];
                } else {
                    // Redirigir a la página de inicio de sesión o mostrar un mensaje de error
                    header('Location: inicio.php');
                    exit();
                }
                ?>

                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Pagina Principal</title>

                    <!-- Bootstrap CSS -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                    <!-- Custom Google Fonts -->
                    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
                    <!-- Bootstrap Icons -->
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                    <style>
                        body {
                            font-family: 'Poppins', sans-serif;
                            background-color: #f7f8fa;
                            color: #333;
                            overflow-x: hidden;
                        }

                        header {
                            background: linear-gradient(45deg, #006266, #0d7377);
                            color: white;
                            position: sticky;
                            top: 0;
                            z-index: 1000;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                            animation: slideInDown 1s ease-in-out;
                        }

                        header h1 {
                            font-weight: 600;
                            font-size: 1.8rem;
                        }

                        .navbar-brand {
                            font-weight: bold;
                            font-size: 1.5rem;
                            color: white;
                            text-transform: uppercase;
                            display: flex;
                            align-items: center;
                            transition: color 0.3s ease;
                        }

                        .navbar-brand img {
                            height: 40px;
                            margin-right: 10px;
                            border-radius: 50%;
                            border: 2px solid white;
                        }

                        .navbar-dark .navbar-nav .nav-link {
                            font-size: 1.1rem;
                            font-weight: 500;
                            color: rgba(255, 255, 255, 0.85);
                            transition: color 0.3s ease;
                            margin-left: 20px;
                        }

                        .navbar-dark .navbar-nav .nav-link:hover {
                            color: #ffda79;
                            transform: translateY(-2px);
                            transition: all 0.3s;
                        }

                        /* Hero */
                        .hero-content {
                            background-image: url('https://source.unsplash.com/1600x900/?architecture,blueprint');
                            background-size: cover;
                            background-position: center;
                            height: 600px;
                            display: flex;
                            justify-content: center;
                            align-items: center;
                            color: white;
                            text-align: center;
                            position: relative;
                            animation: fadeIn 2s ease;
                        }

                        .hero-content h2 {
                            font-size: 4rem;
                            font-weight: bold;
                            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
                        }

                        .hero-content p {
                            font-size: 1.5rem;
                            margin-bottom: 30px;
                            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.4);
                        }

                        .cta-button {
                            background-color: #ff6b6b;
                            color: white;
                            padding: 12px 30px;
                            border-radius: 30px;
                            font-size: 1.2rem;
                            font-weight: bold;
                            text-transform: uppercase;
                            transition: all 0.4s ease;
                            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
                        }

                        .cta-button:hover {
                            background-color: #006266;
                            transform: scale(1.1);
                            transition: all 0.3s ease-in-out;
                        }

                        /* Animaciones */
                        @keyframes fadeIn {
                            from { opacity: 0; }
                            to { opacity: 1; }
                        }

                        @keyframes slideInDown {
                            from { transform: translateY(-100px); }
                            to { transform: translateY(0); }
                        }

                        /* Footer */
                        footer {
                            background-color: #333;
                            color: white;
                            padding: 40px 0;
                            text-align: center;
                            animation: fadeInUp 1.5s ease;
                        }

                        footer .social-icons a {
                            color: white;
                            margin: 0 15px;
                            font-size: 1.5rem;
                            transition: color 0.3s ease, transform 0.3s;
                        }

                        footer .social-icons a:hover {
                            color: #ffda79;
                            transform: scale(1.2);
                        }

                        /* Hero content */
                    .hero-content {
                        background-image: url('https://source.unsplash.com/1600x900/?architecture,blueprint');
                        background-size: cover;
                        background-position: center;
                        height: 600px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        color: white;
                        text-align: center;
                        position: relative;
                        overflow: hidden;
                        box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.4);
                        animation: fadeIn 2s ease;
                    }

                    .hero-content::before {
                        content: '';
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background: linear-gradient(45deg, rgba(0, 98, 102, 0.9), rgba(13, 115, 119, 0.9));
                        z-index: 1;
                    }

                    .container {
                        position: relative;
                        z-index: 2;
                    }

                    /* Title */
                    .hero-title {
                        font-size: 4.5rem;
                        font-weight: bold;
                        margin-bottom: 10px;
                        color: #e7c023;
                        text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.7);
                        animation: fadeInDown 1.2s ease-in-out;
                    }

                    /* Description */
                    .hero-description {
                        font-size: 1.6rem;
                        margin-bottom: 40px;
                        max-width: 800px;
                        margin: 0 auto;
                        color: #e9ecef;
                        line-height: 1.8;
                        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
                    }

                    /* Call-to-action button */
                    .cta-button {
                        background-color: #ff6b6b;
                        color: white;
                        padding: 15px 40px;
                        border-radius: 30px;
                        font-size: 1.3rem;
                        font-weight: bold;
                        text-transform: uppercase;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
                        transition: all 0.4s ease;
                        display: inline-block;
                        animation: pulse 2s infinite;
                    }

                    .cta-button:hover {
                        background-color: #ff927a;
                        transform: scale(1.08) translateY(-3px);
                        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.6);
                    }

                    /* Keyframe animations */
                    @keyframes fadeIn {
                        from { opacity: 0; }
                        to { opacity: 1; }
                    }

                    @keyframes pulse {
                        0%, 100% { transform: scale(1); }
                        50% { transform: scale(1.05); }
                    }

                    .cta-button {
                        background-color: #ff6b6b;
                        color: white;
                        padding: 15px 40px;
                        border: 2px solid transparent;
                        border-radius: 30px;
                        font-size: 1.3rem;
                        font-weight: bold;
                        text-transform: uppercase;
                        text-decoration: none;
                        position: relative;
                        transition: all 0.4s ease;
                        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
                        overflow: hidden;
                        z-index: 1;
                    }

                    .cta-button::before {
                        content: "";
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 300%;
                        height: 300%;
                        background: linear-gradient(120deg, #ff6b6b, #ffda79, #006266, #ff6b6b);
                        z-index: -1;
                        transition: all 0.4s ease;
                        opacity: 0;
                        border-radius: 30px;
                        filter: blur(8px);
                    }

                    .cta-button:hover::before {
                        opacity: 1;
                        transform: scale(0.5);
                    }

                    .cta-button:hover {
                        background-color: #006266;
                        color: #ffda79;
                        transform: scale(1.05);
                        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.4);
                    }

                    .cta-button:active {
                        transform: scale(0.98);
                    }

                    </style>

                </head>
                <body>

                <header>
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <div class="container">
                            <a class="navbar-brand">
                                <img src="https://u-static.fotor.com/images/text-to-image/result/PRO-886967f1cd4f48f79be8d0b4a41e867e.jpg" alt="Logo">
                                ArchiPlan Store
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">🏡 Inicio</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">📞 Contáctanos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="about.php">📋 Acerca de nosotros</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">🚪 Cerrar Sesión</a>
                                    </li>
                                    <li class="nav-item profile-link">
                                        <a class="nav-link" href="profile.php">👤 <?php echo htmlspecialchars($usuario); ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </header>

                            <main>
                <div class="hero-content animate__animated animate__fadeInUp">
                    <div class="container text-center">
                        <h2 class="hero-title animate__animated animate__fadeInDown">Proyectos Profesionales y Elegantes</h2>
                        <p class="hero-description animate__animated animate__fadeInUp animate__delay-1s"> Explora en nuestra tienda y descubre una exclusiva selección de renders, departamentos y condominios. Diseños de alta calidad ideales para satisfacer todas tus necesidades arquitectónicas. </p>
                        <a href="renders.php" class="cta-button">Explorar</a>
                    </div>
                </div>
            </main>

                <style>
                    .hero-content {
                        background-image: url('https://source.unsplash.com/1600x900/?architecture,design');
                        background-size: cover;
                        background-position: center;
                        height: 600px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
                        position: relative;
                        padding: 20px;
                        border-radius: 10px;
                    }

                    .hero-title {
                        font-size: 3.5rem;
                        font-weight: 800;
                        margin-bottom: 20px;
                        animation: fadeInUpTitle 1.5s ease;
                        line-height: 1.2;
                    }

                    .hero-description {
                        font-size: 1.4rem;
                        max-width: 800px;
                        margin: 0 auto 30px;
                        line-height: 1.8;
                        padding: 0 10px;
                        animation: fadeInUpDescription 1.5s ease;
                    }

                    .cta-button {
                        background-color: #ff6b6b;
                        color: white;
                        padding: 15px 40px;
                        border-radius: 50px;
                        font-size: 1.2rem;
                        font-weight: bold;
                        text-transform: uppercase;
                        transition: background-color 0.4s, transform 0.4s;
                        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.4);
                    }

                    .cta-button:hover {
                        background-color: #006266;
                        transform: scale(1.08);
                        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.4);
                    }

                    /* Custom Animations */
                    @keyframes fadeInUpTitle {
                        from { transform: translateY(20px); opacity: 0; }
                        to { transform: translateY(0); opacity: 1; }
                    }

                    @keyframes fadeInUpDescription {
                        from { transform: translateY(30px); opacity: 0; }
                        to { transform: translateY(0); opacity: 1; }
                    }
                </style>

                <footer>
                    <div class="container">
                        <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
                    </div>

                    <div class="social-icons">
                        <p>Nuestras Redes Sociales:</p>
                        <a href="https://www.facebook.com/" target="_blank" class="bi bi-facebook"></a>
                        <a href="https://www.twitter.com/" target="_blank" class="bi bi-twitter"></a>
                        <a href="https://www.instagram.com/" target="_blank" class="bi bi-instagram"></a>
                    </div>
                </footer>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                </body>
                </html>
