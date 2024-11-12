                <?php
                session_start(); // Asegúrate de iniciar la sesión

                
            // Verifica si la variable de sesión 'usuario' está definida
            $usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : 'Invitado';
            $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

                
                // Conexión a la base de datos
                $conn = new mysqli("localhost", "root", "", "planos");

                // Verifica la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta para obtener los planos residenciales
                $sql_planos = "SELECT * FROM Planos_Residenciales";
                $result_planos = $conn->query($sql_planos);

                // Consulta para obtener los departamentos
                $sql_departamentos = "SELECT * FROM Departamentos";
                $result_departamentos = $conn->query($sql_departamentos);

                // Consulta para obtener los condominios
                $sql_condominios = "SELECT * FROM condominios_horizontales";
                $result_condominios = $conn->query($sql_condominios);
                ?>

                <!DOCTYPE html>
                <html lang="es">
                <head>                   
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
                    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

                    <title>ArchiPlan Store</title>

                    <style>
                        
                        .card {
                            transition: transform 0.3s, box-shadow 0.3s;
                        }

                        .card:hover {
                            transform: scale(1.05);
                            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
                        }

                        .details {
                            display: none;
                        }

                        .social-icons {
                            margin-top: 20px;
                            font-size: 1.5rem;
                        }

                        .social-icons a {
                            color: #333;
                            margin: 0 10px;
                            transition: color 0.3s;
                        }

                        .social-icons a:hover {
                            color: #28a745;
                        }

                            /* Estilo para el contenedor del carrusel */
                        .carousel-item {
                            position: relative;
                            height: 700px;
                            color: white;
                        }

                        .carousel-item img {
                            object-fit: cover;
                            width: 100%;
                            height: 100%;
                            filter: brightness(70%);
                        }

                        .carousel-caption {
                            position: absolute;
                            top: 56%; /* Centra verticalmente, puedes ajustar el porcentaje */
                            left: 50%; /* Centra horizontalmente */
                            transform: translate(-50%, -50%); /* Ajusta el centro */
                            text-align: center;
                            white-space: nowrap; /* Evita que el texto se divida en líneas */
                            max-width: 100%; /* Permite que el texto ocupe todo el ancho */
                        }

                        .carousel-caption h1 {
                            font-size: 3.4rem; /* Ajusta el tamaño según lo necesario */
                            font-weight: bold;
                            text-shadow: 3px 4px 10px rgba(0, 0, 0, 0.7);
                            margin: 0;
                            white-space: nowrap;
                        }

                        .carousel-caption {
                            left: 45%; /* Mueve el texto más a la derecha */
                            transform: translate(-60%, -50%); /* Ajusta la transformación para mantener el texto alineado */
                        }

                        .carousel-caption {
                            left: 47%; /* Mueve el texto más a la izquierda */
                            transform: translate(-40%, -50%); /* Ajusta la transformación */
                        }

                        /* Botones */
                        .carousel-control-prev,
                            .carousel-control-next {
                                position: absolute;
                                top: 43%; /* Centra los botones verticalmente */
                                transform: translateY(-50%);
                                width: auto; /* Ajusta el ancho para que sea más estrecho */
                                padding: 3px; /* Ajusta el espaciado si es necesario */
                            }

                            .carousel-control-prev {
                                left: 0; /* Pega el botón a la izquierda */
                            }

                            .carousel-control-next {
                                right: 0; /* Pega el botón a la derecha */
                            }

                                /* Efecto hover en los links de la barra de navegación */
    .nav-link {
        position: relative;
        color: #ccc;
        transition: color 0.3s ease;
    }

    .nav-link:hover {
        color: #fff;
    }

    /* Animación de subrayado en los links */
    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        background-color: #28a745;
        left: 0;
        bottom: -5px;
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    /* Perfil con espaciado y color en hover */
    .profile-link {
        font-weight: 500;
    }

    /* Estilo para la tarjeta con efecto de zoom */
    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        border-radius: 8px;
        overflow: hidden;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    /* Estilo para los iconos sociales */
    .social-icons a {
        color: #ddd;
        font-size: 1.5rem;
        margin: 0 10px;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #28a745;
    }

    /* Estilo del carrusel */
    .carousel-item {
        position: relative;
        height: 700px;
        color: white;
        text-align: center;
    }

    .carousel-item img {
        object-fit: cover;
        width: 100%;
        height: 100%;
        filter: brightness(75%);
        transition: filter 0.5s ease;
    }

    .carousel-item:hover img {
        filter: brightness(85%);
    }

    /* Centrar y estilizar el texto del carrusel */
    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        white-space: nowrap;
    }

    .carousel-caption h1 {
        font-size: 3.4rem;
        font-weight: bold;
        text-shadow: 3px 4px 10px rgba(0, 0, 0, 0.7);
        white-space: nowrap;
    }

    /* Estilo y posición de los botones del carrusel */
    .carousel-control-prev, .carousel-control-next {
        top: 50%;
        width: auto;
        padding: 10px;
    }

                    </style>

                    <script>

                        function toggleDetails(id) {
                            const details = document.getElementById(id);
                            details.style.display = details.style.display === "none" ? "block" : "none";
                        }

                        function comprar(id, tipo) {
                    if (tipo === 'plano') {
                        window.location.href = "prestar.php?id_plano=" + id; // Para planos
                    } else if (tipo === 'departamento') {
                        window.location.href = "prestar.php?id_departamento=" + id; // Para departamentos
                    } else if (tipo === 'condominio') {
                        window.location.href = "prestar.php?id_condominio=" + id; // Para condominios
                    } else {
                        console.error("Tipo no válido"); // Manejo de errores en caso de que el tipo no sea válido
                    }
                }

                </script>

                </head>

                <body>
            
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand d-flex align-items-center">
                        <img src="https://u-static.fotor.com/images/text-to-image/result/PRO-886967f1cd4f48f79be8d0b4a41e867e.jpg" alt="Logo" style="width: 35px; height: 35px; margin-right: 10px;">
                        <span class="fw-bold">ArchiPlan Store</span>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="index.php">🏡 Inicio</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.php">📞 Contáctanos</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">📋 Acerca de Nosotros</a></li>
                        </ul>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center profile-link" href="profile.php">
                                    👤 <span class="ms-1"><?php echo htmlspecialchars($usuario); ?></span>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">🚪 Cerrar Sesión</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

                    <div id="planosCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/imagenes/PRINCIPAL 1.jpg" class="d-block w-100" alt="Plano Principal 1">
                            <div class="carousel-caption">
                                <h1>DISEÑOS PARA TU CASA</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/imagenes/PRINCIPAL 2.1.jpeg" class="d-block w-100" alt="Plano Principal 2.1">
                            <div class="carousel-caption">
                            <h1>DISEÑOS PARA TU CASA</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="" class="d-block w-100" alt="Plano Principal 2">
                            <div class="carousel-caption">
                            <h1>DISEÑOS PARA TU CASA</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="" class="d-block w-100" alt="Plano Principal 3">
                            <div class="carousel-caption">
                            <h1>DISEÑOS PARA TU CASA</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/imagenes/PRINCIPAL 4.jpeg" class="d-block w-100" alt="Plano Principal 4">
                            <div class="carousel-caption">
                            <h1>DISEÑOS PARA TU CASA</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/imagenes/PRINCIPAL 5.jpeg" class="d-block w-100" alt="Plano Principal 5">
                            <div class="carousel-caption">
                            <h1>DISEÑOS PARA TU CASA</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                    <img src="/imagenes/PRINCIPAL 6.jpg" class="d-block w-100" alt="Plano Principal 6">
                    <div class="carousel-caption">
                    <h1>DISEÑOS PARA TU CASA</h1>
                    </div>
                </div>

                </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#planosCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#planosCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>

            </div>

                    <header class="text-center my-5">
                        <h1 class="mb-4">RENDERS RESIDENCIALES 🏠</h1>
                        <h2 class="mb-4">Nuestros Mejores Renders Residenciales</h2>
                        <p class="lead">Diseños arquitectónicos modernos y funcionales, realizados por expertos en el área.</p>
                    </header>

                    <div class="container my-5">
                        <div class="row">
                            <?php if ($result_planos->num_rows > 0): ?>
                                <?php while ($row = $result_planos->fetch_assoc()): ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card plano p-3">
                                            <h3 class="card-title"><?php echo htmlspecialchars($row['nombre']); ?></h3>
                                            <p class="price">Precio: $<?php echo number_format($row['precio'], 2); ?></p>
                                            <button class="btn btn-primary" onclick="toggleDetails('details-plan-<?php echo $row['id_planos']; ?>')">Ver detalles</button>
                                            <div id="details-plan-<?php echo $row['id_planos']; ?>" class="details mt-3" style="display: none;">
                                                <p><strong>Descripción:</strong> <?php echo htmlspecialchars($row['descripcion']); ?></p>
                                                <p><strong>Habitaciones:</strong> <?php echo htmlspecialchars($row['habitaciones']); ?></p>
                                                <p><strong>Niveles:</strong> <?php echo htmlspecialchars($row['niveles']); ?></p>
                                                <p><strong>Tamaño:</strong> <?php echo htmlspecialchars($row['tamano']); ?></p>
                                                <p><strong>Vehículos permitidos:</strong> <?php echo htmlspecialchars($row['vehiculos']); ?></p>
                                            </div>
                                            <a href="#" class="cta-button btn btn-success" onclick="comprar('<?php echo $row['id_planos']; ?>', 'plano')">Comprar</a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-center">No hay planos disponibles en este momento.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Sección de Departamentos -->
                        <header class="text-center my-5">
                            <h1 class="mb-4">🏢 Departamentos</h1>
                            <h2 class="mb-4">Nuestros Mejores Departamentos</h2>
                            <p class="lead">Departamentos modernos y cómodos, ideales para vivir.</p>
                        </header>

                        <div class="row">
                            <?php if ($result_departamentos->num_rows > 0): ?>
                                <?php while ($row = $result_departamentos->fetch_assoc()): ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card departamento p-3">
                                            <h3 class="card-title"><?php echo htmlspecialchars($row['tipo_departamento']); ?></h3>
                                            <p class="price">Precio: $<?php echo number_format($row['precio'], 2); ?></p>
                                            <button class="btn btn-primary" onclick="toggleDetails('details-dep-<?php echo $row['id_departamento']; ?>')">Ver detalles</button>
                                            <div id="details-dep-<?php echo $row['id_departamento']; ?>" class="details mt-3" style="display: none;">
                                                <p><strong>Torres:</strong> <?php echo htmlspecialchars($row['torres']); ?></p>
                                                <p><strong>Niveles:</strong> <?php echo htmlspecialchars($row['niveles']); ?></p>
                                                <p><strong>Habitaciones:</strong> <?php echo htmlspecialchars($row['habitaciones']); ?></p>
                                            </div>
                                            <a href="#" class="cta-button btn btn-success" onclick="comprar('<?php echo $row['id_departamento']; ?>', 'departamento')">Comprar</a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-center">No hay departamentos disponibles en este momento.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Sección de Condominios -->
                        <header class="text-center my-5">
                            <h1 class="mb-4">🏡 Condominios</h1>
                            <h2 class="mb-4">Nuestros Mejores Condominios</h2>
                            <p class="lead">Condominios ideales para disfrutar de la vida.</p>
                        </header>

                        <div class="row">
                            <?php if ($result_condominios->num_rows > 0): ?>
                                <?php while ($row = $result_condominios->fetch_assoc()): ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card condominio p-3">
                                            <h3 class="card-title"><?php echo htmlspecialchars($row['nombre_condominio']); ?></h3>
                                            <p class="price">Precio: $<?php echo number_format($row['precio'], 2); ?></p>
                                            <button class="btn btn-primary" onclick="toggleDetails('details-cond-<?php echo $row['id_condominio']; ?>')">Ver detalles</button>
                                            <div id="details-cond-<?php echo $row['id_condominio']; ?>" class="details mt-3" style="display: none;">
                                                <p><strong>Total de Unidades:</strong> <?php echo htmlspecialchars($row['total_unidades']); ?></p>
                                                <p><strong>Estilo de las Viviendas:</strong> <?php echo htmlspecialchars($row['estilo_viviendas']); ?></p>
                                                <p><strong>Superficie terreno:</strong> <?php echo htmlspecialchars($row['superficie_promedio']); ?></p>
                                                <p><strong>Tamaño del terreno:</strong> <?php echo htmlspecialchars($row['tamano_terreno']); ?></p>
                                                <p><strong>Las zonas mas comunes:</strong> <?php echo htmlspecialchars($row['zonas_comunes']); ?></p>
                                                <p><strong>Servicios que contiene:</strong> <?php echo htmlspecialchars($row['servicios']); ?></p>
                                            </div>
                                            <a href="#" class="cta-button btn btn-success" onclick="comprar('<?php echo $row['id_condominio']; ?>', 'condominio')">Comprar</a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <p class="text-center">No hay condominios disponibles en este momento.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <footer class="text-center py-4">
                        <p>© 2024 ArchiPlan Store. Todos los derechos reservados.</p>
                        <div class="social-icons">
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                        </div>
                    </footer>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
                </body>
                </html>

                <?php
                // Cierra la conexión
                $conn->close();
                ?>
