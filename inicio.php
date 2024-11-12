<?php
session_start();
include 'db.php'; // Conectar a la base de datos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - ArchiPlan Store</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f5f5, #e0e0e0);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            position: relative;
        }

        .overlay {
            background-color: white;
            padding: 60px;
            border-radius: 20px;
            text-align: center;
            color: #333;
            max-width: 900px;
            width: 300%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .overlay:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
        }

        .welcome-section h1 {
            font-size: 2.7rem;
            font-weight: 600;
            margin-bottom: 20px;
            letter-spacing: 0.5px;
            color: #111;
            animation: fadeInText 1.5s ease-in-out;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .welcome-section p {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #555;
            animation: fadeInText 2s ease-in-out;
        }

        .additional-text {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #777;
            animation: fadeInText 2.5s ease-in-out;
        }

        @keyframes fadeInText {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container-options {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-option {
            width: 220px;
            padding: 15px;
            font-size: 1.2rem;
            font-weight: 500;
            border-radius: 50px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-option i {
            margin-right: 10px;
            font-size: 1.5rem;
        }

        .btn-login {
            background-color: #333;
            color: white;
            border: 2px solid #333;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-login:hover {
            background-color: transparent;
            color: #333;
            border-color: #333;
        }

        .btn-register {
            background-color: #daa520;
            color: white;
            border: 2px solid #daa520;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-register:hover {
            background-color: transparent;
            color: #daa520;
            border-color: #daa520;
        }

        .footer {
            color: #000000;
            font-size: 0.9rem;
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
        }

        /* Efecto de Fade-in */
        .overlay {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Tarjetas de presentación animadas */
        .card-plan {
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-plan:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .overlay {
                padding: 40px;
            }

            .welcome-section h1 {
                font-size: 2.2rem;
            }

            .btn-option {
                width: 100%;
                font-size: 1rem;
            }

            .container-options {
                flex-direction: column;
            }
        }

        .btn-guest {
            background-color: #6c757d;
            color: white;
            border: 2px solid #6c757d;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-guest:hover {
            background-color: transparent;
            color: #6c757d;
            border-color: #6c757d;
        }
    </style>

</head>
<body>

    <div class="overlay">
        <div class="welcome-section">
            <h1>Bienvenido/a a ArchiPlan Store</h1>
            <p>Explora y elige el mejor diseño arquitectónico para tu proyecto.</p>
            <p class="additional-text">¿Qué quieres hacer hoy?</p>
        </div>

        <div class="container-options">
            <a href="login.php" class="btn btn-login btn-option">
                <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
            </a>
            <a href="registro.php" class="btn btn-register btn-option">
                <i class="fas fa-user-plus"></i> Crear Cuenta
            </a>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
