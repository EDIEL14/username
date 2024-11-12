            <?php
            session_start(); 

            if (isset($_SESSION['usuario'])) {
                $usuario = htmlspecialchars($_SESSION['usuario']); 
            } 
            ?>

            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Catálogo de Planos</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
                <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                <style>
                    body {
                        font-family: 'Montserrat', sans-serif;
                        background-color: #f4f4f9;
                        color: #333;
                        margin: 0;
                        transition: background-color 0.3s;
                        display: flex;
                        flex-direction: column;
                        min-height: 100vh; /* Asegura que el body ocupe al menos toda la altura de la ventana */
                    }

                    /* Estilo del navbar */
                    .navbar {
                        background-color: #343a40;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    }

                    .navbar-brand img {
                        width: 50px;
                        height: auto;
                    }

                    .navbar-nav .nav-link {
                        color: #fff !important;
                        font-size: 1.1rem;
                        transition: color 0.3s, transform 0.3s;
                    }

                    .navbar-nav .nav-link:hover {
                        color: #28a745 !important;
                        transform: scale(1.1);
                    }

                    .profile-link a {
                        font-weight: bold;
                        color: #ff6b6b !important;
                    }

                    /* Estilo para el header */
                    header {
                        background: linear-gradient(135deg, #28a745, #218838);
                        color: #ffffff;
                        padding: 80px 0;
                        text-align: center;
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                    }

                    header h1 {
                        font-size: 3.5rem;
                        font-weight: 700;
                        letter-spacing: 1.5px;
                        animation: slideIn 1s forwards;
                    }

                    /* Contenedor principal */
                    .container {
                        margin-top: center;
                    }

                    /* Estilo de las categorías de planos */
                    .planos-categorias {
                        background-color: #e5e5e5;
                        border-radius: 10px;
                        padding: 30px;
                        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
                        text-align: center;
                        animation: fadeIn 1.5s ease-in-out;
                        transition: transform 0.3s;
                        margin-top: 140px;
                    }

                    .planos-categorias:hover {
                        transform: translateY(-1px);
                        background-color: #ffffff;
                    }

                    .planos-categorias h2 {
                        color: #000000;
                        font-weight: 700;
                        margin-bottom: 10px;
                        font-size: 2.5rem;
                    }

                    .planos-categorias p {
                        font-size: 1.2rem;
                        color: #f73333;
                        margin-bottom: 20px;
                    }

                    /* Botón principal con animaciones */
                    .cta-button {
                        background: linear-gradient(135deg, #ff6b6b, #ff4757, #ff6b6b);
                        color: #fff;
                        padding: 15px 40px;
                        border: none;
                        border-radius: 50px;
                        font-size: 1.3rem;
                        font-weight: 700;
                        letter-spacing: 1px;
                        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
                        transition: all 0.3s ease;
                        text-decoration: none;
                        display: inline-block;
                        background-size: 200%;
                        animation: gradientMove 3s infinite;
                        position: relative;
                        overflow: hidden;
                    }

                    @keyframes gradientMove {
                        0% {
                            background-position: 0%;
                        }
                        100% {
                            background-position: 100%;
                        }
                    }

                    /* Efecto de onda brillante en hover */
                    .cta-button:hover::before {
                        content: "";
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        width: 300%;
                        height: 300%;
                        background: radial-gradient(circle, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0) 60%);
                        transform: translate(-50%, -50%) scale(0);
                        transition: transform 0.5s ease-in-out;
                        border-radius: 50%;
                        opacity: 0.7;
                    }

                    .cta-button:hover::before {
                        transform: translate(-50%, -50%) scale(1);
                    }

                    /* Efecto de brillo */
                    .cta-button::after {
                        content: "";
                        position: absolute;
                        top: -4px;
                        left: -4px;
                        right: -4px;
                        bottom: -4px;
                        background: linear-gradient(135deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0));
                        border-radius: 50px;
                        transition: all 0.5s ease;
                        opacity: 0;
                    }

                    .cta-button:hover::after {
                        opacity: 1;
                        filter: blur(3px);
                    }

                    /* Movimiento de botón en hover */
                    .cta-button:hover {
                        transform: scale(1.1) rotate(1deg);
                        box-shadow: 0 8px 25px rgba(255, 107, 107, 0.9), 0 0 40px rgba(255, 218, 121, 0.6);
                    }

                    /* Animación de fade-in */
                    @keyframes fadeIn {
                        0% {
                            opacity: 0;
                            transform: translateY(20px);
                        }
                        100% {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    @keyframes slideIn {
                        0% {
                            opacity: 0;
                            transform: translateX(-50%);
                        }
                        100% {
                            opacity: 1;
                            transform: translateX(0);
                        }
                    }

                    /* Estilo para el footer */
                    footer {
                        background-color: #343a40;
                        color: #ffffff;
                        padding: 20px 0;
                        text-align: center;
                        margin-top: auto; /* Hace que el footer se mueva al final */
                        font-size: 0.9rem;
                    }

                    footer p {
                        margin: 0;
                    }

                    /* Estilo de iconos sociales */
                    .social-icons {
                        margin-top: 20px;
                    }

                    .social-icons a {
                        color: #ffffff;
                        font-size: 1.5rem;
                        margin: 0 10px;
                        transition: color 0.3s;
                    }

                    .social-icons a:hover {
                        color: #28a745;
                    }

                    /* Responsividad */
                    @media (max-width: 768px) {
                        header h1 {
                            font-size: 2.8rem;
                        }

                        .planos-categorias h2 {
                            font-size: 2rem;
                        }

                        .cta-button {
                            padding: 12px 30px;
                            font-size: 1.1rem;
                        }
                    }

                    @media (max-width: 480px) {
                        header h1 {
                            font-size: 2.5rem;
                        }

                        .planos-categorias h2 {
                            font-size: 1.5rem;
                        }

                        .cta-button {
                            padding: 10px 20px;
                            font-size: 1rem;
                        }
                    }
                </style>
            </head>

            <body>

                <!-- Navbar -->
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
                                                <a class="nav-link" href="about.php">📋 Acerca de Nosotros</a>
                                            </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">🚪 Cerrar Sesión</a>
                        </li>
                                <li class="nav-item profile-link">
                                    <a class="nav-link" href="profile.php">
                                    👤<?php echo htmlspecialchars($usuario); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <!-- Contenido principal -->
                <div class="container">
                    <div class="planos-categorias">
                        <h1>¿Que haras en esta seccion?</h1>
                        <p>Bueno en esta sección encontrarás los mejores Renders, los mejores Departamentos y los mejores Condominios profesionales y atracvtivos que estan disponibles en nuestra tienda:</p>
                        <a class="cta-button" href="planos.php">Entrar</a>
                    </div>
                </div>

                <!-- Footer -->
                <footer>
                    <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
                    <div class="social-icons">
                    <p>Nuestras Redes Sociales:</p>
                        <a href="https://www.facebook.com/" target="_blank" class="bi bi-facebook"></a>
                        <a href="https://www.twitter.com/" target="_blank" class="bi bi-twitter"></a>
                        <a href="https://www.instagram.com/" target="_blank" class="bi bi-instagram"></a>
                    </div>
                </footer>

                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
            </body>

            </html>
    