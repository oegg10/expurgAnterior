<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location:../../index.php");
    }

    $idc = $_GET['idc'];
    //$idrecepcion = $_GET['idr'];

    //Agregar encabezado
    $sql = "SELECT c.idconsulta, r.idrecepcion, r.edad, r.fechahorarecep, r.mtvoconsulta, p.idpaciente, p.expediente, p.nombre AS np, p.curp, p.fechanac, p.entidadnac, p.sexo, p.afiliacion, p.numafiliacion, p.domicilio, p.colonia, p.cp, p.municipio, p.localidad, p.entidaddom, p.telefono, u.nombre AS nu, u.turno, r.embarazo, r.semgesta, r.numgesta, r.medico, r.sala FROM recepciones r INNER JOIN pacientes p ON r.idpaciente = p.idpaciente INNER JOIN usuarios u ON r.idusuario = u.idusuario INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion WHERE c.idconsulta = '$idc'";

    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //Agregar cuerpo
    $cuerpo = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, c.tipourgencia, c.atnprehosp, c.trastrans, c.nombreunidad, c.tiempotraslado, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.condicion, c.idusuario, u.nombre AS nm, u.curp, u.cedula, u.turno FROM consultas c INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE c.idconsulta = '$idc'";

    $result = $con->query($cuerpo);
    $consulta = $result->fetch_assoc();

    //========================================================================================================

    $fnac = date('d/m/Y', strtotime($fila['fechanac']));

?>

    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <!--<div class="card text-left">-->
                <!--<div class="card-header">-->
                <div class="row">
                    <div class="col-sm-9">
                        <img src="../../public/img/urgencias.JPG" alt="logo SSC" width="500px">
                    </div>

                    <div class="col-sm-3">
                        <span style="font-size: 10px">Recepción: <small><?php echo $fila['nu']; ?></small></span>
                        <p><span style="font-size: 10px">Turno: <small><?php echo $fila['turno']; ?></small></span></p>
                    </div>

                    <input type="hidden" name="idpaciente" value="<?php echo $idpaciente; ?>">

                    <div class="table-responsive">

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 39%; text-align: center; height: 36px;"><strong> Nombre</strong></td>
                                    <td style="width: 20%; text-align: center; height: 36px;"><strong>CURP</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Fecha Nac.</strong></td>
                                    <td style="width: 21%; text-align: center; height: 36px;"><strong>Entidad Nacimiento</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Edad</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Sexo</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 18px;">
                                    <td style="width: 39%; height: 18px;"><?php echo $fila['np']; ?></td>
                                    <td style="width: 20%; height: 18px;"><?php echo $fila['curp']; ?></td>
                                    <td style="width: 10%; height: 18px;"><?php echo $fnac; ?></td>
                                    <td style="width: 21%; height: 18px;"><?php echo $fila['entidadnac']; ?></td>
                                    <td style="width: 5%; height: 18px;"><?php echo $fila['edad']; ?></td>
                                    <td style="width: 5%; height: 18px;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR F o M SEGUN EL GENERO o SEXO
                                        if ($fila['sexo'] == 'Femenino') {
                                            echo "F";
                                        } elseif ($fila['sexo'] == 'Masculino') {
                                            echo "M";
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Afiliaci&oacute;n</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>No. Afil.</strong></td>
                                    <td style="width: 40%; text-align: center; height: 36px;"><strong>Calle</strong></td>
                                    <td style="width: 35%; text-align: center; height: 36px;"><strong>Colonia</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>C.P.</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 10%; height: 36px;"><?php echo $fila['afiliacion']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $fila['numafiliacion']; ?></td>
                                    <td style="width: 40%; height: 36px;"><?php echo $fila['domicilio']; ?></td>
                                    <td style="width: 35%; height: 36px;"><?php echo $fila['colonia']; ?></td>
                                    <td style="width: 5%; height: 36px;"><?php echo $fila['cp']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 21%; text-align: center; height: 36px;"><strong>Entidad Domicilio</strong></td>
                                    <td style="width: 19%; text-align: center; height: 36px;"><strong>Municipio</strong></td>
                                    <td style="width: 29%; text-align: center; height: 36px;"><strong>Localidad</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Tel&eacute;fono</strong></td>
                                    <td style="width: 16%; text-align: center; height: 36px;"><strong>Hora recepci&oacute;n</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Embarazo</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 21%; height: 36px;"><?php echo $fila['entidaddom']; ?></td>
                                    <td style="width: 19%; height: 36px;"><?php echo $fila['municipio']; ?></td>
                                    <td style="width: 29%; height: 36px;"><?php echo $fila['localidad']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $fila['telefono']; ?></td>
                                    <td style="width: 16%; height: 36px;"><strong><?php echo  date("d-m-Y H:i", strtotime($fila['fechahorarecep'])); ?></strong></td>
                                    <td style="width: 5%; height: 36px;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR SI ESTA EMBARAZADA SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino') {
                                            echo $fila['embarazo'];
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>SDG</strong></td>
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Gesta</strong></td>
                                    <td style="width: 15%; text-align: center; height: 36px;"><strong>M&eacute;dico</strong></td>
                                    <td style="width: 50%; text-align: center; height: 36px;"><strong>Motivo Consulta</strong></td>
                                    <td style="width: 25%; text-align: center; height: 36px;"><strong>Sala</strong></td>
                                </tr>
                                <!--DATOS-->
                                <tr style="height: 36px;">
                                    <td style="width: 5%; height: 36px;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR LAS SDG SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino' && $fila['embarazo'] == 'SI') {
                                            echo $fila['semgesta'];
                                        } else {
                                            echo "";
                                        } ?></td>
                                    <td style="width: 5%; height: 36px;">
                                        <?php
                                        //CONDICION PARA IMPRIMIR EL NUMERO DE GESTA SI ES FEMENINO
                                        if ($fila['sexo'] == 'Femenino' && $fila['embarazo'] == 'SI') {
                                            echo $fila['numgesta'];
                                        } else {
                                            echo "";
                                        }
                                        ?></td>
                                    <td style="width: 15%; height: 36px;"><?php echo $fila['medico']; ?></td>
                                    <td style="width: 50%; height: 36px;"><?php echo $fila['mtvoconsulta']; ?></td>
                                    <td style="width: 25%; height: 36px;"><?php echo $fila['sala']; ?></td>

                                </tr>
                            </tbody>
                        </table>
                        <p style="text-align: center; font-size: 15px">=== DATOS DE LA CONSULTA ===</p>

                        <!-- DATOS DE LA CONSULTA -->
                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Att'n prehospitalaria</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Fecha y hora de ingreso</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Tipo de urgencia</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Tiempo traslado</strong></td>
                                    <td style="width: 60%; text-align: center; height: 36px;"><strong>Nombre unidad</strong></td>
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr style="height: 36px;">
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['atnprehosp']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['fechaingreso']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['tipourgencia']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['tiempotraslado']; ?></td>
                                    <td style="width: 60%; height: 36px;"><?php echo $consulta['nombreunidad']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 5%; text-align: center; height: 36px;"><strong>Tras. transitorio</strong></td>
                                    <td style="width: 30%; text-align: center; height: 36px;"><strong>Motivo att'n</strong></td>
                                    <td style="width: 15%; text-align: center; height: 36px;"><strong>Tipo de cama</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Fecha y hora de alta</strong></td>
                                    <td style="width: 20%; text-align: center; height: 36px;"><strong>Alta por:</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Ministerio pub.</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Mujer edad fertil</strong></td>
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr style="height: 36px;">
                                    <td style="width: 5%; height: 36px;"><?php echo $consulta['trastrans']; ?></td>
                                    <td style="width: 30%; height: 36px;"><?php echo $consulta['motivoatencion']; ?></td>
                                    <td style="width: 15%; height: 36px;"><?php echo $consulta['tipocama']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['fechaalta']; ?></td>
                                    <td style="width: 20%; height: 36px;"><?php echo $consulta['altapor']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['ministeriopublico']; ?></td>
                                    <td style="width: 10%; height: 36px;"><?php echo $consulta['mujeredadfertil']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align: center; font-size: 15px">=== AFECCIONES TRATADAS ===</p>

                        <!-- Afección principal -->
                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; text-align: center; height: 36px;"><strong>Afecciones</strong></td>
                                    <td style="width: 10%; text-align: center; height: 36px;"><strong>Clave CIE-10</strong></td>
                                </tr>
                                <!--DATOS DE LA CONSULTA-->
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo "PRINCIPAL: ". $consulta['afecprincipal']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['comorbilidad1']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['comorbilidad2']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['comorbilidad3']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align: center; font-size: 15px">=== INTERCONSULTA ===</p>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 34%; height: 36px;"><?php echo $consulta['interconsulta1']; ?></td>
                                    <td style="width: 33%; height: 36px;"><?php echo $consulta['interconsulta2']; ?></td>
                                    <td style="width: 33%; height: 36px;"><?php echo $consulta['interconsulta3']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align: center; font-size: 15px">=== PROCEDIMIENTOS ===</p>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['procedim1']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['procedim2']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['procedim3']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['procedim4']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 90%; height: 36px;"><?php echo $consulta['procedim5']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align: center; font-size: 15px">=== MEDICAMENTOS ===</p>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 34%; height: 36px;"><?php echo $consulta['medicamento1']; ?></td>
                                    <td style="width: 33%; height: 36px;"><?php echo $consulta['medicamento2']; ?></td>
                                    <td style="width: 33%; height: 36px;"><?php echo $consulta['medicamento3']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                        <p style="text-align: center; font-size: 15px">=== MEDICO RESPONSABLE ===</p>

                        <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                            <tbody>
                                <tr style="height: 36px;">
                                    <td style="width: 40%; height: 36px;"><?php echo "Nombre: " . $consulta['nm']; ?></td>
                                    <td style="width: 20%; height: 36px;"><?php echo "CURP: " . $consulta['curp']; ?></td>
                                    <td style="width: 15%; height: 36px;"><?php echo "Cédula: " . $consulta['cedula']; ?></td>
                                    <td style="width: 15%; height: 36px;"><?php echo "Turno: " . $consulta['turno']; ?></td>
                                    <td style="width: 10%; height: 36px;"></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>

    </body>

    </html>

<?php
}

$con->close();

ob_end_flush();
?>