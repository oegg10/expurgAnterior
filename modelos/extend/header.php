<?php

session_start();

include "../../conexion/conexion.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Urgencias</title>

    <link rel="icon" href="../../public/img/SSC.jpg">

    <?php require_once "scripts.php"; ?>

    <style>
        .error{
            border: solid 2px #ff0000;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><img src="../../public/img/SSC.jpg" alt="logos" width="25px" height="25px"> Urgencias</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php if($_SESSION['idrol'] == 1){ ?>
        <!-- MENU ADMIN -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../usuarios/index.php">Usuarios</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Reportes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../reportes/productividad.php">Productividad</a>
                        <a class="dropdown-item" href="../reportes/reporteRecepcion.php">Reporte por Recepcionista</a>
                        <a class="dropdown-item" href="../reportes/reporteConsultados.php">Consultas</a>
                        <a class="dropdown-item" href="../reportes/reporteNSP.php">Pacientes N.S.P.</a>
                        <a class="dropdown-item" href="../reportes/triageReporte.php">Triages</a>
                    </div>
                </li>
            </ul>
        <!-- FIN MENU ADMIN -->

        <?php }elseif ($_SESSION['idrol'] == 2){ ?>
            
        <!-- MENU MEDICO -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../consultas/index.php">Consultas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../consultas/consultadosXmedico.php">Consultados</a>
                </li>
            </ul>
        <!-- FIN MENU MEDICO -->

        <?php }elseif ($_SESSION['idrol'] == 3) { ?>

        <!-- MENU RECEPCIONISTA -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pacientes/index.php">Pacientes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../recepcion/index.php">Recepción</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../reportes/reporteConsultados.php">Consultados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../reportes/reporteNSP.php">No se presentó</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../recepcion/consultorio1.php">Cons1</a>
                </li>
            </ul>
            <!-- FIN MENU RECEPCIONISTA -->

        <?php }elseif ($_SESSION['idrol'] == 4){ ?>
        <!-- MENU EXTERNO -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Estádistica</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Reportes
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../reportes/repCalidad.php">Dpto. Calidad</a>
                        <a class="dropdown-item" href="#">Otros reportes</a>
                    </div>
                </li>
            </ul>
        <!-- FIN MENU EXTERNO -->

        <?php }elseif ($_SESSION['idrol'] == 5){ ?>
        <!-- MENU TRIAGE -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                        <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../triages/index.php">Triage</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../reportes/triageReporte.php">Reportes</a>
                </li>
            </ul>
        <!-- FIN MENU TRIAGE -->

        <?php }elseif ($_SESSION['idrol'] == 6){ ?>
        <!-- MENU ENFERMERIA -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../extend/inicio.php">Inicio <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../enfermeria/index.php">Pacientes</a>
                </li>
            </ul>
        <!-- FIN MENU ENFERMERIA -->

        <?php } ?>

            <!-- NOMBRE DEL USUARIO Y SALIDA -->
            <ul class="nav navbar-nav ml-auto">
                <li style="padding-right: 3rem; color: white;"><span class="fa fa-user"></span> <?php echo $_SESSION['nombre'] ?></li>
                <li style="padding-right: 3rem; color: white;"><?php echo $_SESSION['nivel'] ?></li>
                <li><a href="../extend/salir.php" class="btn btn-dark btn-sm"><span class="fa fa-sign-out"></span> Salir</a></li>
            </ul>

        </div>
    </nav>