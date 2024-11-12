<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - ArchiPlan Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos generales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            color: #444;
        }

        /* Estilo para el encabezado */
        header {
            background: linear-gradient(135deg, #2c3e50, #34495e);
            color: #fff;
            padding: 60px 0;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        header h1 {
            font-size: 3.5rem;
            font-weight: bold;
            margin: 0;
            animation: fadeIn 1s;
        }

        /* Estilo para la información de contacto */
        .contact-info {
            display: flex;
            justify-content: space-evenly;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .contact-info a {
            display: flex;
            align-items: center;
            background-color: #3498db;
            color: #fff;
            padding: 15px 30px;
            border-radius: 50px;
            margin: 20px;
            font-size: 1.1rem;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .contact-info a:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .contact-info img {
            width: 30px;
            height: 30px;
            margin-right: 15px;
        }

        .section-title {
            text-align: center;
            font-size: 2.2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 40px;
            animation: slideInUp 1s;
        }

        .hours, .location {
            font-size: 1.2rem;
            color: #2c3e50;
            text-align: center;
            margin: 20px 0;
        }

        .location span {
            color: #16a085;
        }

        /* Estilo para el pie de página */
        footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 20px 0;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Encabezado -->
    <header>
        <h1>Contacto</h1>
    </header>

    <!-- Contenido principal -->
    <main class="container my-5">
        <section>
            <h2 class="section-title">Ponte en Contacto con Nosotros</h2>

            <!-- Información de contacto -->
            <div class="contact-info">
                <a href="mailto:edielmartinsolislozano@gmail.com">
                    <img src="https://img.icons8.com/ios-glyphs/30/ffffff/new-post.png" alt="Email">
                    Correo Electrónico
                </a>
            </div>

            <!-- Horario -->
            <div class="hours">
                <p>Horario de Atención:</p>
                <p>Lunes a Viernes de 8:00 AM a 4:00 PM</p>
            </div>

            <!-- Ubicación -->
            <div class="location">
                <p>ArchiPlan Store</p>
                <p><span>Cancún, Quintana Roo, MX</span></p>
            </div>
        </section>
    </main>

    <!-- Pie de página -->
    <footer>
        <p>© 2024 ArchiPlan Store - Todos los derechos reservados</p>
    </footer>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
