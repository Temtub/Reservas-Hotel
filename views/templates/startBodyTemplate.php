
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Hoteles Rodrigo</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="views/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>

    <body>

        <div class="container">

            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar__title navbar-brand" href="<?php
                                    echo $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=selectAllHotelesAndHabitaciones';
                                    ?>"><span class="firstTitle">Stay</span>Sphere</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" 
                                   href="<?php
                                    echo $_SERVER['PHP_SELF'] . '?controller=HotelesHabitaciones&action=selectAllHotelesAndHabitaciones';
                                   ?>" >Ver hoteles y habitaciones</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" 
                                   href="<?php
                                    echo $_SERVER['PHP_SELF'] . '?controller=ReservasHabitacionesHoteles&action=viewAllReservas';
                                   ?>" >Ver reservas</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" 
                                   href="<?php
                                    echo $_SERVER['PHP_SELF'] . '?controller=Usuarios&action=closeSession';
                                   ?>" >Cerrar sesión</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div>Ultima conexión: <?php echo getLastLoginTime();?></div>
                </div>
            </nav>

