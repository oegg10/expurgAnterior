<?php

ob_start();

include "../extend/header.php";

if (!isset($_SESSION['idusuario'])) {
    header("Location:../../index.php");
} else {

    if ($_SESSION['idrol'] != 2) {
        header("Location:../../index.php");
    }

    $id = $_GET['id'];
    $idr = $_GET['idr'];

    $sql = "SELECT c.idconsulta, c.idrecepcion, c.fechaingreso, c.fc, c.fr, c.ta, c.temperatura, c.glucosa, c.talla, c.peso, c.pabdominal, c.imc, c.notaingresourg, c.tipourgencia, c.atnprehosp, c.trastrans, c.nombreunidad, c.tiempotraslado, c.motivoatencion, c.tipocama, c.ministeriopublico, c.mujeredadfertil, c.afecprincipal, c.comorbilidad1, c.comorbilidad2, c.comorbilidad3, c.interconsulta1, c.interconsulta2, c.interconsulta3, c.procedim1, c.procedim2, c.procedim3, c.procedim4, c.procedim5, c.medicamento1, c.medicamento2, c.medicamento3, c.fechaalta, c.altapor, c.otraunidad, c.condicion, c.idusuario, r.idrecepcion,p.idpaciente,p.nombre AS np, p.curp, p.fechanac, r.edad,p.sexo,r.mtvoconsulta, u.nombre AS nm, u.curp AS cm, u.cedula, u.turno FROM pacientes p INNER JOIN recepciones r ON p.idpaciente = r.idpaciente INNER JOIN consultas c ON c.idrecepcion = r.idrecepcion INNER JOIN usuarios u ON c.idusuario = u.idusuario WHERE idconsulta = '$id' AND r.idrecepcion = '$idr'";
    $resultado = $con->query($sql);
    $fila = $resultado->fetch_assoc();

    //========================================================================================================
    $fechaing = date('d-m-Y H:i:s', strtotime($fila['fechaingreso']));
    $fnac = date('d/m/Y', strtotime($fila['fechanac']));
?>

    <div class="container-fluid">
        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-4">
                <img src="../../public/img/logoSSA_NM.png" alt="logo SSC" width="200px">
            </div>

            <div class="form-group col-lg-8 col-md-8 col-sm-8">
                <h3>HOSPITAL GENERAL DE SALTILLO</h3>
            </div>
        </div>


        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                    <tbody>
                        <tr style="height: 36px;">
                            <td style="width: 50%; text-align: center; height: 36px;"><strong>Nombre</strong></td>
                            <td style="width: 20%; text-align: center; height: 36px;"><strong>CURP</strong></td>
                            <td style="width: 16%; text-align: center; height: 36px;"><strong>Fecha nac.</strong></td>
                            <td style="width: 7%; text-align: center; height: 36px;"><strong>Edad</strong></td>
                            <td style="width: 7%; text-align: center; height: 36px;"><strong>Sexo</strong></td>
                        </tr>
                        <!--DATOS-->
                        <tr style="height: 18px;">
                            <td style="width: 50%; height: 18px; font-size: 20px;"><?php echo $fila['np']; ?></td>
                            <td style="width: 20%; height: 18px; font-size: 20px;"><?php echo $fila['curp']; ?></td>
                            <td style="width: 16%; height: 18px; text-align: center; font-size: 20px;"><?php echo $fnac; ?></td>
                            <td style="width: 7%; height: 18px; text-align: center; font-size: 20px;"><?php echo $fila['edad']; ?></td>
                            <td style="width: 7%; height: 18px; text-align: center; font-size: 20px;">
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
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                    <tbody>
                        <tr style="height: 36px;">
                            <td style="width: 20%; text-align: center; height: 36px;"><strong>Fecha y hora de ingreso</strong></td>
                            <td style="width: 5%; text-align: center; height: 36px;"><strong>FC</strong></td>
                            <td style="width: 5%; text-align: center; height: 36px;"><strong>FR</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>TA</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>TEMPERATURA</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>GLUCOSA</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>TALLA</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>PESO</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>P. ABDOMINAL</strong></td>
                            <td style="width: 10%; text-align: center; height: 36px;"><strong>IMC</strong></td>
                        </tr>
                        <!--DATOS-->
                        <tr style="height: 18px;">
                            <td style="width: 20%; height: 18px; text-align: center; font-size: 20px;"><?php echo $fechaing; ?></td>
                            <td style="width: 5%; height: 18px; font-size: 20px;"><?php echo $fila['fc']; ?></td>
                            <td style="width: 5%; height: 18px; font-size: 20px;"><?php echo $fila['fr']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['ta']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['temperatura']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['glucosa']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['talla']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['peso']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['pabdominal']; ?></td>
                            <td style="width: 10%; height: 18px; font-size: 20px;"><?php echo $fila['imc']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-12">

                <h3>NOTA MEDICA DE INGRESO A URGENCIAS</h3>
                <p style="font-size: 20px;">
                    <?php echo $fila['notaingresourg']; ?>
                </p>

            </div>

            <!-- CONSULTA DE URGENCIAS -->

            <div class="col-sm-12">

                <h3>DIAGNOSTICOS</h3>
                <p style="font-size: 20px;">
                    <?php echo $fila['afecprincipal']; ?>- <?php echo $fila['comorbilidad1']; ?>- <?php echo $fila['comorbilidad2']; ?>- <?php echo $fila['comorbilidad3']; ?>
                </p>

            </div>

            <div class="col-sm-12">

                <h3>PROCEDIMIENTOS</h3>
                <p style="font-size: 20px;">
                    <?php echo $fila['procedim1']; ?>- <?php echo $fila['procedim2']; ?>- <?php echo $fila['procedim3']; ?>- <?php echo $fila['procedim4']; ?>- <?php echo $fila['procedim5']; ?>
                </p>
            </div>

            <div class="col-sm-12">

                <h3>MEDICAMENTOS</h3>
                <p style="font-size: 20px;">
                    <?php echo $fila['medicamento1']; ?>- <?php echo $fila['medicamento2']; ?>- <?php echo $fila['medicamento3']; ?>
                </p>

            </div>

            <!-- DATOS DEL MEDICO -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" style="border-collapse: collapse; width: 100%; height: 36px; margin-bottom: 0px;" border="1">
                    <tbody>
                        <tr style="height: 36px;">
                            <td style="width: 30%; text-align: center; height: 36px;"><strong>NOMBRE DEL MEDICO</strong></td>
                            <td style="width: 30%; text-align: center; height: 36px;"><strong>CURP</strong></td>
                            <td style="width: 20%; text-align: center; height: 36px;"><strong>CEDULA</strong></td>
                            <td style="width: 20%; text-align: center; height: 36px;"><strong>TURNO</strong></td>
                        </tr>
                        <!--DATOS-->
                        <tr style="height: 18px;">
                            <td style="width: 30%; height: 18px; font-size: 17px;"><?php echo $fila['nm']; ?></td>
                            <td style="width: 30%; height: 18px; font-size: 17px;"><?php echo $fila['cm']; ?></td>
                            <td style="width: 20%; height: 18px; font-size: 17px;"><?php echo $fila['cedula']; ?></td>
                            <td style="width: 20%; height: 18px; font-size: 17px;"><?php echo $fila['turno']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                <a href="index.php" type="button" class="btn btn-success"><i class='fa fa-reply' title='Regresar'> Regresar</i></a>
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