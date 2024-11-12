            <?php

                session_start();

                $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';

                date_default_timezone_set('America/Cancun');

                $conn = new mysqli("localhost", "root", "", "planos");

                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                $compra_exitosa = false; 
                $error_msg = ""; 

                if (isset($_GET['id_plano'])) {
                    $id_plano = intval($_GET['id_plano']);

                    $sql = "SELECT * FROM Planos_Residenciales WHERE id_planos = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_plano);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $plano = $result->fetch_assoc();
                    if (!$plano) {
                        die("Plano no encontrado.");
                    }
                } 
                
                elseif (isset($_GET['id_condominio'])) {
                    $id_condominio = intval($_GET['id_condominio']);

                    $sql = "SELECT * FROM condominios_horizontales WHERE id_condominio = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_condominio);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $condominio = $result->fetch_assoc();
                    if (!$condominio) {
                        die("Condominio no encontrado.");
                    }
                } 
                
                elseif (isset($_GET['id_departamento'])) {
                    $id_departamento = intval($_GET['id_departamento']);

                    $sql = "SELECT * FROM Departamentos WHERE id_departamento = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_departamento);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $departamento = $result->fetch_assoc();
                    if (!$departamento) {
                        die("Departamento no encontrado.");
                    }
                } else {
                    die("ID de plano, condominio o departamento no proporcionado.");
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $metodo_pago = $_POST['metodo_pago'];
                    $email_usuario = $_POST['email_usuario']; 
                    $fecha_hora = date("Y-m-d H:i:s"); 

                    if ($metodo_pago === 'Seleccionar') {
                        $error_msg = 'Por favor seleccione la forma de pago.';
                    } elseif (!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
                        $error_msg = 'Por favor ingrese un correo electrónico válido.';
                    }

                    if (isset($plano)) {
                        $nombre_item = $plano['nombre'];
                        $precio = floatval($plano['precio']);
                        $tipo_item = 'plano';
                    } elseif (isset($departamento)) {
                        $nombre_item = $departamento['tipo_departamento'];
                        $precio = floatval($departamento['precio']);
                        $tipo_item = 'departamento';
                    } elseif (isset($condominio)) {
                        $nombre_item = $condominio['nombre_condominio'];
                        $precio = floatval($condominio['precio']);
                        $tipo_item = 'condominio';
                    } else {
                        $error_msg = "No se ha seleccionado ningún item.";
                    }

                    if (isset($nombre_item)) {
                        $tipo_tarjeta = isset($_POST['tipo_tarjeta']) ? $_POST['tipo_tarjeta'] : null;
                        $interest = isset($_POST['interest']) ? $_POST['interest'] : 'sin-intereses';
                        $meses = isset($_POST['meses']) ? $_POST['meses'] : null;
                    
                        $sql = "INSERT INTO Historial_Compras (tipo_item, nombre_item, precio, metodo_pago, fecha_hora, email_usuario, id_usuario, tipo_tarjeta, interest, meses) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt = $conn->prepare($sql);
                    
                        $id_usuario = isset($id_usuario) ? $id_usuario : null;
                    
                        $stmt->bind_param("ssdsssissi", $tipo_item, $nombre_item, $precio, $metodo_pago, $fecha_hora, $email_usuario, $id_usuario, $tipo_tarjeta, $interest, $meses);
                    
                        if ($stmt->execute()) {
                            $compra_exitosa = true; 
                        } else {
                            $error_msg = "Error al procesar la compra: " . $conn->error;
                        }
                    }                                                                        
                }

            ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Formulario de Compra</title>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

            <style>

                body {
                    background-color: #f4f6f9;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                .form-container {
                    margin: 40px auto;
                    padding: 40px;
                    border-radius: 15px;
                    box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
                    background-color: #ffffff;
                    max-width: 600px;
                }
                
                h1 {
                    color: #343a40;
                    font-weight: bold;
                    margin-bottom: 25px;
                }

                .btn-custom {
                    background-color: #28a745;
                    color: #fff;
                    font-size: 18px;
                    padding: 10px 20px;
                    border-radius: 50px;
                    transition: background-color 0.3s ease;
                }

                .btn-custom:hover {
                    background-color: #218838;
                }

                .success {
                    background-color: #d4edda;
                    color: #155724;
                    padding: 15px;
                    border: 1px solid #c3e6cb;
                    border-radius: 10px;
                    margin-top: 20px;
                    font-weight: bold;
                    text-align: center;
                }
                
                .error {
                    background-color: #f8d7da;
                    color: #721c24;
                    padding: 15px;
                    border: 1px solid #f5c6cb;
                    border-radius: 10px;
                    margin-top: 20px;
                    font-weight: bold;
                    text-align: center;
                }

                .form-text {
                    font-size: 0.9em;
                    color: #6c757d;
                }

                .payment-details {
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 20px;
                    background-color: #f8f9fa;
                    margin-top: 30px;
                }

                .form-group label {
                    font-weight: bold;
                }

                .form-group i {
                    color: #007bff;
                    margin-right: 8px;
                }

                .input-group-text {
                    background-color: #e9ecef;
                    border-radius: 0.25rem;
                }

                body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            margin: 40px auto;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 30px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            max-width: 600px;
        }
        h1 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 25px;
        }
        .btn-custom {
            background-color: #28a745;
            color: #fff;
            font-size: 18px;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .success, .error {
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
        }
        .success { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
        .form-text { font-size: 0.9em; color: #6c757d; }
        .payment-details { padding: 20px; background-color: #f8f9fa; margin-top: 30px; }
        .navbar-brand img { width: 30px; height: 30px; }
        footer { background-color: #f8f9fa; padding: 15px 0; }
        .social-icons a { margin: 0 10px; font-size: 20px; color: #007bff; }
        .social-icons a:hover { color: #0056b3; }

        .payment-options {
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 8px;
                margin-top: 20px;
                background-color: #f9f9f9;
                max-height: 500px; /* Altura máxima de la sección */
                overflow-y: auto; /* Añade barra de desplazamiento si es necesario */
                resize: horizontal; /* Permite el redimensionamiento vertical */
            }
            .payment-options h2, .payment-options h3, .payment-options h4 {
                margin-bottom: 15px;
            }
            .payment-options p {
                margin-bottom: 5px;
            }

            .question-icon {
                font-size: 20px;  /* Tamaño del icono */
                color: #007bff;   /* Color azul para el ícono */
                margin-left: 5px; /* Espacio entre el texto y el ícono */
                cursor: pointer; /* Puntero de mano al pasar el mouse */
                transition: transform 0.2s; /* Transición suave para el efecto */
            }

            .question-icon:hover {
                transform: scale(1.2); /* Efecto de ampliación al pasar el mouse */
            }

                        /* Estilo para el título de la sección */
            .form-title {
                font-size: 1.5rem;
                color: #333;
                font-weight: bold;
                text-transform: uppercase;
            }

            /* Contenedor de información de transferencia */
            .transferencia-info {
                background-color: #f8f9fa; /* Fondo suave */
                border-radius: 8px; /* Bordes redondeados */
                padding: 15px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Sombra ligera */
                margin-top: 10px;
            }

            /* Estilo para cada detalle */
            .transferencia-info p {
                font-size: 1rem;
                line-height: 1.6;
                color: #555;
                margin-bottom: 8px;
            }

            /* Resaltar los valores de los detalles */
            .transferencia-detail {
                font-weight: 600;
                color: #007bff; /* Color azul para resaltar */
            }

            /* Estilo del enlace del correo */
            .transferencia-email {
                color: #007bff;
                text-decoration: none;
                font-weight: 500;
            }

            .transferencia-email:hover {
                text-decoration: underline;
            }

    body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #f8f9fa !important;
        }
        .navbar-brand img {
            width: 30px;
            height: 30px;
            margin-right: 8px;
        }
        .navbar-brand:hover, .navbar-nav .nav-link:hover {
            color: #ffc107 !important;
        }
        .form-container {
            margin: 50px auto;
            padding: 40px;
            border-radius: 15px;
            background-color: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            max-width: 600px;
            animation: fadeInUp 0.7s ease-out;
        }
        h1 {
            color: #495057;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
            padding: 10px 25px;
            border-radius: 50px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .input-group-text {
            background-color: #e9ecef;
            border-radius: 0.25rem;
        }
        .question-icon {
            font-size: 20px;
            color: #007bff;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .question-icon:hover {
            transform: scale(1.2);
            color: #0056b3;
        }
        .alert {
            display: none;
            margin-top: 20px;
            font-weight: bold;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        footer {
            background-color: #343a40;
            color: #f8f9fa;
            padding: 15px 0;
            text-align: center;
        }
        .social-icons a {
            margin: 0 10px;
            font-size: 24px;
            color: #ffc107;
            transition: color 0.3s ease;
        }
        .social-icons a:hover {
            color: #fff;
        }
            </style>

        </head>

        <body>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand">
                <img src="https://u-static.fotor.com/images/text-to-image/result/PRO-886967f1cd4f48f79be8d0b4a41e867e.jpg" alt="Logo">
                ArchiPlan Store
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">🏡 Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">📞 Contáctanos</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">📋 Acerca de Nosotros</a></li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item profile-link">
                        <a class="nav-link" href="profile.php">👤<?php echo htmlspecialchars($usuario); ?></a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">🚪 Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </nav>

                <div class="container form-container animate__animated animate__fadeIn animate__delay-0.5s">
                <h1 class="text-center mb-4 text-gradient">Formulario de Pago</h1>

                <?php if ($error_msg): ?>
                    <div class="alert alert-danger text-center"><?php echo $error_msg; ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="form-group mb-3">
                        <label for="tipo_plano"><i class="fas fa-file-alt"></i> Nombre</label>
                        <input type="text" class="form-control" id="tipo_plano" 
                            value="<?php echo isset($plano) ? $plano['nombre'] : (isset($condominio) ? $condominio['nombre_condominio'] : $departamento['tipo_departamento']); ?>" 
                            disabled>
                        <small class="form-text">Es un:
                            <strong>
                                <?php
                                if (isset($plano)) {
                                    echo "Renders";
                                } elseif (isset($condominio)) {
                                    echo "Condominio";
                                } else {
                                    echo "Departamento";
                                }
                                ?>
                            </strong>
                        </small>
                    </div>

                    <div class="form-group mb-3">
                        <label for="precio_plano"><i class="fas fa-dollar-sign"></i> Precio</label>
                        <input type="text" class="form-control" id="precio_plano" 
                            value="$<?php echo isset($plano) ? number_format($plano['precio'], 2) : (isset($condominio) ? number_format($condominio['precio'], 2) : number_format($departamento['precio'], 2)); ?>" 
                            disabled>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email_usuario"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                        <input type="email" class="form-control" id="email_usuario" name="email_usuario" placeholder="Ingresa tu correo electrónico" required>
                    </div>

            <div class="form-group mb-3">
                <label for="metodo_pago"><i class="fas fa-credit-card"></i> Método de Pago</label>
                <select class="form-control" id="metodo_pago" name="metodo_pago" required onchange="mostrarFormularioPago()">
                    <option value="">Seleccione una forma de pago</option>
                    <option value="Pago con Tarjeta">Pago con Tarjeta</option>
                    <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                </select>
            </div>

            <div id="form-tarjeta" class="mt-3" style="display: none;">
                
            <div class="form-group mb-3">
            <label for="tipo_tarjeta"><span class="fas fa-question-circle question-icon"></span> ¿Qué tipo de tarjeta es?</label>
                <select class="form-control" id="tipo_tarjeta" name="tipo_tarjeta" onchange="mostrarFormularioTarjeta()">
                    <option value="">Seleccione una opción</option>
                    <option value="Debito">Débito</option>
                    <option value="Credito">Crédito</option>
                </select>
            </div>
                            <div id="detalle-tarjeta" style="display: none;">
                            <div class="form-group mb-3">
                    <h3 class="text-center mb-4 text-gradient">Datos de la Tarjeta de Débito/Crédito</h3>
                    
                    <label for="numero_tarjeta"><i class="fas fa-credit-card"></i> Número de Tarjeta</label>
                    <input type="text" class="form-control" id="numero_tarjeta" placeholder="Ingresa tu número de tarjeta" required oninput="detectarBanco()">
                    
                    <label for="tipo-tarjeta"><i class="fas fa-id-card"></i>¿Que Tarjeta es?</label>
                    <input type="text" class="form-control" id="tipo-tarjeta" placeholder="Detectado automáticamente" readonly>
                    
                    <label for="banco-tarjeta"><i class="fas fa-university"></i>¿Que Banco es?</label>
                    <input type="text" class="form-control" id="banco-tarjeta" placeholder="Detectado automáticamente" readonly>
                </div>

                <div class="form-group mb-3">
                    <label for="nombre_titular"><i class="fas fa-user"></i> Nombre del Titular</label>
                    <input type="text" class="form-control" id="nombre_titular" placeholder="Ingresa tu nombre" required>
                </div>
                <div class="form-group mb-3">
                    <label for="fecha_expiracion"><i class="fas fa-calendar-alt"></i> Fecha de Vencimiento</label>
                    <input type="month" class="form-control" id="fecha_expiracion" required>
                </div>
                <div class="form-group mb-3">
                    <label for="codigo_seguridad"><i class="fas fa-lock"></i> CVC</label>
                    <input type="password" class="form-control" id="codigo_seguridad" required>
                </div>

                <div id="form-pagar-a-meses" style="display: none;">
                    <h3 class="text-center mb-4 text-gradient">Pagar a Meses</h3>

                    <div class="form-group">
                        <label for="banco-tarjeta-meses">¿Qué Banco es?</label>
                        <input type="text" id="banco-tarjeta-meses" name="banco_tarjeta_meses" class="form-control" readonly placeholder="Detectado automáticamente">
                    </div>
                </div>

                <div class="form-group">
                    <label for="interest">¿Con o Sin Intereses?</label>
                    <select id="interest" name="interest" class="form-control custom-select" required>
                        <option value="" disabled selected>Seleccione una opción</option>
                        <option value="sin-intereses">Con Intereses</option>
                        <option value="con-intereses">Sin Intereses</option>
                    </select>
                </div>

                                <div class="form-group">
                    <label for="installments">¿A cuantos Meses?</label>
                    <select id="installments" name="meses" class="form-control custom-select" required>
                        <option value="" disabled selected>Seleccione el mes correspondiente</option>
                        <option value="3">3 meses</option>
                        <option value="6">6 meses</option>
                        <option value="12">12 meses</option>
                        <option value="18">18 meses</option>
                        <option value="24">24 meses</option>
                    </select>
                </div>

            </div>

            </div>

                </div>
            </div>
                        <div id="form-transferencia" style="display: none; margin-top: 10px;">
                <h4 class="form-title mb-3">Datos para Transferir</h4>
                
                <div class="transferencia-info">
                    <p><strong>CLABE Interbancaria:</strong> <span class="transferencia-detail">646690146402415222</span></p>
                    <p><strong>Banco:</strong> <span class="transferencia-detail">STP</span></p>
                    <p><strong>Beneficiario:</strong> <span class="transferencia-detail">Ediel Martin Solis Lozano</span></p>
                    
                    <p class="mt-2">Envíar el comprobante de pago al correo de: 
                        <a href="mailto:edielmartinsolislozano@gmail.com" class="transferencia-email">edielmartinsolislozano@gmail.com</a>
                    </p>
                </div>
            </div>

        </div>

            <button id="boton-comprar" type="submit" class="btn btn-custom btn-block mt-4">Comprar</button>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

            <style>

                /* Estilos de tarjeta */
                .improved-section {
                    border-radius: 12px;
                    background-color: #ffffff;
                    max-width: 500px;
                    width: 100%;
                    border: none;
                    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                }

                /* Estilo de título con gradiente */
                .text-gradient {
                    background: linear-gradient(45deg, #4A90E2, #7B4397);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    font-weight: 600;
                }

                /* Fondo del botón con gradiente y animación */
                .btn-gradient {
                    background: linear-gradient(45deg, #4A90E2, #7B4397);
                    color: #fff;
                    border: none;
                    border-radius: 8px;
                    font-weight: 600;
                    transition: background 0.3s ease;
                }

                .btn-gradient:hover {
                    background: linear-gradient(45deg, #7B4397, #4A90E2);
                    box-shadow: 0 4px 12px rgba(74, 144, 226, 0.4);
                }

                /* Animación de entrada */
                @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
                
            </style>
                    
                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow-lg animate__animated animate__fadeIn">
                            <div class="card-body">
                            <h2 class="text-center text-gradient mb-4">Opciones de Pago a Meses</h2>
                                        <p class="text-center text-muted">Explora las opciones de pago a meses con y sin intereses disponibles para diferentes bancos.</p>

                                        <?php
                                        $precio = isset($plano) ? $plano['precio'] : (isset($condominio) ? $condominio['precio'] : $departamento['precio']);

                                        function calcularCuotas($precio, $meses, $interes = 0) {
                                            $monto = $precio / $meses;
                                            if ($interes > 0) {
                                                $monto = $monto * (1 + ($interes / 100));
                                            }
                                            return number_format($monto, 2);
                                        }
                                        ?>

                                <div class="mt-4">
                                    <h3 class="text-center text-info">SIN INTERESES</h3>
                                    <div class="row mt-3">
                                        <!-- BBVA -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/bbva.png" alt="BBVA" width="50"></h4>
                                                    <p>BBVA BANCOMER</p>
                                                    <p>3 meses: $<?php echo calcularCuotas($precio, 3); ?>/mes</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Santander -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/santander.jpg" alt="Santander" width="50"></h4>
                                                    <p>SANTANDER</p>
                                                    <p>3 meses: $<?php echo calcularCuotas($precio, 3); ?>/mes</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Scotiabank -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/scotiabank.jpg" alt="Scotiabank" width="50"></h4>
                                                    <p>SCOTIABANK</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- INVEX -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/invex.png" alt="INVEX" width="50"></h4>
                                                    <p>INVEX</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18); ?>/mes</p>
                                                    <p>24 meses: $<?php echo calcularCuotas($precio, 24); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Banorte -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/banorte.png" alt="Banorte" width="50"></h4>
                                                    <p>BANORTE</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                                <!-- Citibanamex -->
                                            <div class="col-md-6 col-lg-3">
                                                <div class="card border-0 shadow-sm mb-4">
                                                    <div class="card-body text-center">
                                                        <h4><img src="/imagenes/bancos/citibanamex.jpg" alt="Citibanamex" width="50"></h4>
                                                        <p>CITIBANAMEX</p>
                                                        <p>3 meses: $<?php echo calcularCuotas($precio, 3); ?>/mes</p>
                                                        <p>6 meses: $<?php echo calcularCuotas($precio, 6); ?>/mes</p>
                                                        <p>12 meses: $<?php echo calcularCuotas($precio, 12); ?>/mes</p>
                                                        <p>18 meses: $<?php echo calcularCuotas($precio, 18); ?>/mes</p>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <h3 class="text-center text-danger">CON INTERESES</h3>
                                    <div class="row mt-3">
                                        <!-- BBVA -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/bbva.png" alt="BBVA" width="50"></h4>
                                                    <p>BBVA BANCOMER</p>
                                                    <p>3 meses: $<?php echo calcularCuotas($precio, 3, 15); ?>/mes</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6, 19.3); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12, 36); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18, 36.8); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Santander -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/santander.jpg" alt="Santander" width="50"></h4>
                                                    <p>SANTANDER</p>
                                                    <p>3 meses: $<?php echo calcularCuotas($precio, 3, 17.3); ?>/mes</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6, 22.3); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12, 37); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Scotiabank -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/scotiabank.jpg" alt="Scotiabank" width="50"></h4>
                                                    <p>SCOTIABANK</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6, 23); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12, 40); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- INVEX -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/invex.png" alt="INVEX" width="50"></h4>
                                                    <p>INVEX</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12, 33.7); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18, 37.5); ?>/mes</p>
                                                    <p>24 meses: $<?php echo calcularCuotas($precio, 24, 50); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Banorte -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/banorte.png" alt="Banorte" width="50"></h4>
                                                    <p>BANORTE</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6, 20); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12, 30); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18, 40); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Citibanamex -->
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card border-0 shadow-sm mb-4">
                                                <div class="card-body text-center">
                                                    <h4><img src="/imagenes/bancos/citibanamex.jpg" alt="Citibanamex" width="50"></h4>
                                                    <p>CITIBANAMEX</p>
                                                    <p>3 meses: $<?php echo calcularCuotas($precio, 3, 14); ?>/mes</p>
                                                    <p>6 meses: $<?php echo calcularCuotas($precio, 6, 18); ?>/mes</p>
                                                    <p>12 meses: $<?php echo calcularCuotas($precio, 12, 25); ?>/mes</p>
                                                    <p>18 meses: $<?php echo calcularCuotas($precio, 18, 35); ?>/mes</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
                </div>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

            <style>
                .text-gradient {
                    background: linear-gradient(45deg, #4A90E2, #7B4397);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                }
                .card {
                    border-radius: 12px;
                }
                .card:hover {
                    transform: translateY(-5px);
                    transition: transform 0.3s ease;
                }
            </style>

        </div>

                            </div>


                            <footer>
            <p>&copy; 2024 ArchiPlan Store. Todos los derechos reservados.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

            <script>

                function mostrarFormularioPago() {
                        var metodoPago = document.getElementById('metodo_pago').value;
                        var formTarjeta = document.getElementById('form-tarjeta');
                        var formTransferencia = document.getElementById('form-transferencia');
                        var botonComprar = document.getElementById('boton-comprar');
                        var detalleTarjeta = document.getElementById('detalle-tarjeta');
                        var formPagarMeses = document.getElementById('form-pagar-a-meses');

                        formTarjeta.style.display = 'none';
                        formTransferencia.style.display = 'none';
                        botonComprar.style.display = 'block';
                        detalleTarjeta.style.display = 'none';
                        formPagarMeses.style.display = 'none';

                        if (metodoPago === 'Pago con Tarjeta') {
                            formTarjeta.style.display = 'block';  
                        } else if (metodoPago === 'Transferencia Bancaria') {
                            formTransferencia.style.display = 'block';  
                            botonComprar.style.display = 'none'; 
                        }
                    }

                    function mostrarFormularioTarjeta() {
                        var tipoTarjeta = document.getElementById('tipo_tarjeta').value;
                        var detalleTarjeta = document.getElementById('detalle-tarjeta');
                        var formPagarMeses = document.getElementById('form-pagar-a-meses');

                        if (tipoTarjeta === 'Debito' || tipoTarjeta === 'Credito') {
                            detalleTarjeta.style.display = 'block';
                            formPagarMeses.style.display = 'block'; 
                        } else {
                            detalleTarjeta.style.display = 'none';
                            formPagarMeses.style.display = 'none'; 
                        }
                    }

                    function detectarBanco() {
                        var numeroTarjeta = document.getElementById('numero_tarjeta').value;
                        var tipoTarjetaElemento = document.getElementById('tipo-tarjeta');
                        var bancoElemento = document.getElementById('banco-tarjeta');
                        var bancoElementoMeses = document.getElementById('banco-tarjeta-meses'); 
                        
                        tipoTarjetaElemento.value = ''; 
                        bancoElemento.value = ''; 
                        if (bancoElementoMeses) {
                            bancoElementoMeses.value = ''; 
                        }

                        if (numeroTarjeta.startsWith('4')) {
                            tipoTarjetaElemento.value = 'Visa';
                        } else if (numeroTarjeta.startsWith('5')) {
                            tipoTarjetaElemento.value = 'MasterCard';
                        } else {
                            tipoTarjetaElemento.value = 'Tarjeta desconocida';
                        }

                        var bancoDetectado = 'Banco Desconocido';
                        if (numeroTarjeta.startsWith('41') || numeroTarjeta.startsWith('51')) {
                            bancoDetectado = 'BBVA';
                        } else if (numeroTarjeta.startsWith('42') || numeroTarjeta.startsWith('52')) {
                            bancoDetectado = 'Santander';
                        } else if (numeroTarjeta.startsWith('43') || numeroTarjeta.startsWith('53')) {
                            bancoDetectado = 'Scotiabank';
                        } else if (numeroTarjeta.startsWith('44') || numeroTarjeta.startsWith('54')) {
                            bancoDetectado = 'INVEX';
                        } else if (numeroTarjeta.startsWith('45') || numeroTarjeta.startsWith('55')) {
                            bancoDetectado = 'Banorte';
                        }

                        bancoElemento.value = bancoDetectado;
                        if (bancoElementoMeses) {
                            bancoElementoMeses.value = bancoDetectado;
                        }
                    }

                    document.getElementById('numero_tarjeta').addEventListener('input', detectarBanco);

                    const precio = parseFloat(document.getElementById('precio').value);

            </script>

        </body>
    
        </html>
