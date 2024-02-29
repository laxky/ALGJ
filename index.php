<?php

session_start();
if (!isset($_SESSION['ID'])) {
    echo '
 <script>
        alert("Por favor inicie sesión e intente nuevamente");
        window.location = "PHP/login.php";
    </script>
    ';
    session_destroy();
    die();
}

include "conexion/db.php";
$consulta = $conexion->prepare("SELECT empresas.NIT, 
empresas.Nombre,
empresas.ID_Licencia,
empresas.Correo,
licencia.Serial,
tp_licencia.Tipo AS Tipo_Licencia,
estado.Estado
FROM empresas
INNER JOIN licencia ON empresas.ID_Licencia = licencia.ID
INNER JOIN tp_licencia ON licencia.TP_licencia = tp_licencia.ID
INNER JOIN estado ON licencia.ID_Estado = estado.ID;

");
$consulta->execute();
$consulta_ = $consulta->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu desarrollador</title>

    <link rel="stylesheet" href="nav/css/estilos.css">

    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<style>
    /* Estilos adicionales para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border: 1px solid #4f89e0;
    }

    th {
        background-color: #1783db;
    }

    tbody tr:nth-child(even) {
        background-color: #a7bcdb;
    }

    tbody tr:hover {
        background-color: #4f85d6;
    }
</style>

<body id="body">

    <header>
        <div class="icon__menu">
            <i class="fas fa-bars" id="btn_open"></i>

        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <i class="fab fa-youtube"></i>
            <h4>developer </h4>
        </div>

        <div class="options__menu">

            <a href="#" class="selected">
                <div class="option">
                    <i class="fas fa-home" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <a href="PHP/Register_empresa.php">
                <div class="option">
                    <i class="far fa-file" title="Crear empresa"></i>
                    <h4>crear empresa</h4>
                </div>
            </a>

            <a href="PHP/serial.php">
                <div class="option">
                    <i class="fas fa-solid fa-arrows-to-eye" title="seriales "></i>
                    <h4>Gestionar seriales</h4>
                </div>
            </a>

            <a href="PHP/login.php">
                <div class="option">
                    <i class="far fa-regular fa-user" title="Login"></i>
                    <h4>Login</h4>
                </div>
            </a>

            <a href="#">
                <div class="option">
                    <i class="far fa-id-badge" title="Contacto"></i>
                    <h4>Contacto</h4>
                </div>
            </a>

            <a href="#">
                <div class="option">
                    <i class="far fa-address-card" title="Nosotros"></i>
                    <h4>Nosotros</h4>
                </div>
            </a>
            <a href="PHP/cerrar.php">
                <div class="option">
                    <i class="far fa-solid fa-share-from-square" title="Nosotros"></i>
                    <h4>Cerrar session</h4>
                </div>
            </a>
        </div>

    </div>

    <main>
        <div class="table-responsive">
            <table class="table table-primary table-bordered">
                <thead>
                    <tr>
                        <th scope="col">NIT</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">ID licencia </th>
                        <th scope="col">Correo</th>
                        <th scope="col">Seriales</th>
                        <th scope="col">Estado Licencia</th>
                        <th scope="col">Tipo licenia </th>
                        <th scope="col">Ajustes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consulta_ as $info) { ?>
                        <tr>
                            <td scope="row"><?php echo $info['NIT']; ?></td>
                            <td><?php echo $info['Nombre']; ?></td>
                            <td><?php echo $info['ID_Licencia']; ?></td>
                            <td><?php echo $info['Correo']; ?></td>
                            <td><?php echo $info['Serial']; ?></td>
                            <td><?php echo $info['Estado']; ?></td>
                            <td><?php echo $info['Tipo_Licencia']; ?></td>
                            <td>
                                <a name="" id="" class="btn btn-secondary" href="#" role="button">editar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>


    <script src="nav/js/script.js">

    </script>
</body>
</body>

</html>