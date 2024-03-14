<?php
session_start();

if (!isset($_SESSION["Auth"])) {
    session_destroy();
    header("Location: http://localhost:8080/miproy_SP/login.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- D A T A   T A B L E S -->
    <script src="./public/js/jquery-3.7.0.min.js"></script>

    <!--E S T I L O S  P E R S O N A L I Z A D O S -->
    <link rel="stylesheet" href="./public/css/estilos.css">

    <!-- VERSION bootstrap-5.1.3-dist-->
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">

    <!-- I C O N O S (DESDE ARCHIVOS LOCALES) VERSION bootstrap-icons-1.11.2 -->
    <link rel="stylesheet" href="./public/img/micons/font/bootstrap-icons.css">

    <!-- D A T A   T A B L E S (DESDE ARCHIVOS LOCALES) VERSION dt-1.13.8 -->
    <link href="./public/css/datatables.min.css" rel="stylesheet">
    <script src="./public/js/dataTables.min.js"></script>

    <!-- B O T O N E S -->
    <link rel="stylesheet" src="./public/css/buttons.dataTables.min-2.4.2.css">
    <script src="./public/js/dataTables.buttons.min-2.4.2.js"> </script>

    <script src="./public/js/buttons.print.min-2.4.2.js "></script>
    <script src="./public/js/dataTables.select.min-1.7.0.js "></script>

    <title>Control de Stock e Inventario</title>

</head>

<body id="pagppal">

    <div class="myContainer">
        <div id="encabezado" style="margin-bottom:1.5%;">
            <div><img src="./public/img/micons/LGB.png" alt="Trulli" width="80" height="70"> </div>

            <div style="margin-left:1%;" >
                <span >
                    <h3>Control de Stock e Inventario</h3>
                    <div id="myMess" title="Texto flotante" 
                        style="width:100%;margin-left:20em;margin-right:-3em;border:none;">Navegación
                    </div>
                </span>
            </div>

            <div style="align-items: auto;">
                <!--a href="http://localhost:8080/miproy_SP/login.php"-->
                <button id="FinalizaSesion" title='' type='submit' style="width:19%;height:2.8em"><i class="bi bi-box-arrow-up-right btn-lg" style='color:red;margin-left:5px;'></i style="margin-left:5px;"><b>&nbspCERRAR SESION</b>
                </button>
                <!--/a-->
                <button id='pmantenimiento' title="Instrucciones de Mantenimiento" type="button" class='bi bi-question-circle btn-lg' data-bs-toggle="modal" aria-label="" data-bs-target="#ayuda-modal">
                </button>
            </div>
        </div>

        <div class="dropdown">
            <div class="nav nav-tabs" id="myTab" role="tablist" style="margin-left:14px;border-bottom:none;height:2.7em;">

                <button id="home-tab" class="nav-link active" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-pc-display-horizontal btn-lg " style='color:blue;margin-left:-8px'>
                    </i style="margin-left:-18px;">Asignar&nbspEquipos
                </button>

                <button id="profile-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="bi bi-person-workspace btn-lg" style='color:blue;margin-left:-8px'>
                    </i style="margin-left:-12px;">Equipos&nbspAsignados
                </button>

                <button id="reverso-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#reverso" type="button" role="tab" aria-controls="reverso" aria-selected="false"><i class="bi bi-recycle btn-lg" style='color:blue;margin-left:-8px'>
                    </i style="margin-left:-18px;">Desincorporados
                </button>

                <button id="menureport" class="btn btn-secondary dropdown-toggle " type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="bi bi-menu-button btn-lg" style="color:blue;margin-left:-8px">
                    </i style="margin-left:-12px;">Menú de Reportes
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenu2" style="border:none;">

                    <button id="mantenim-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#mantenim" type="button" role="tab" 
                    aria-controls="mantenim" aria-selected="false" style="height:2.6em;"><i class="bi bi-screwdriver btn-lg" style="color:blue;display:flex;margin-left:-12px">&nbsp&nbspMantenimiento</i>
                    </button>

                    <button id="reporte-tab" class="nav-link" data-bs-toggle="tab" data-bs-target="#reporte" type="button" role="tab" aria-controls="reporte" aria-selected="false" style="margin-top:8px;height:2.6em;"><i class="bi bi-clock-history btn-lg" style="color:blue;margin-left:-12px">&nbsp&nbspHistórico</i>
                    </button>

                </div>
            </div>
        </div>

        <div class="tab-content">
            <!--******** P A G I N A   1 ******* P R I N C I P A L ***********-->
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <!-- AVISOS -->
                <div id="aviso-usuario" class="alert alert-primary my-2" role="alert" style="width:90%;margin:0 auto;display:none">
                </div><br>

                <!--  ************* F O R M U L A R I O  1 ************ -->
                <form id="selecionarEquipoFrm">
                    <div id="form-div">
                        <div id="PrimerSelecEquipos">
                            <div>
                                <!--SELECTOR EQUIPOS-->
                                <div style="display:flex; justify-content:space-around;">

                                    <!--bi-database-fill-add -->
                                    <h4 style="margin-left:0.2rem;position:relative;"><b>Equipos</b></h4>
                                    <h1 id="cmas">+</h1>
                                    <!--  ************* I N S E R T A R   R E G I S T R O ************ -->
                                    <div>
                                        <button id="enviarcorreo" title='Envio de Correo' type='image' class='bi bi-envelope-arrow-up btn-lg' data-bs-toggle='modal' aria-label='' data-bs-target='#enviarcorreofrmModal'>
                                        </button>
                                        <button id="insertaregistro" title='Insertar - Modificar Registro de Equipo' type='image' class='bi bi-pc-display-horizontal btn-lg' data-bs-toggle='modal' aria-label='' data-bs-target='#insertaregistrosfrmModal'>
                                        </button>
                                    </div>
                                </div>

                                <!--  ************* S E L E C T O R   E Q U I P O S ************ -->

                                <?php $conn = new PDO("mysql:host=localhost;dbname=bdsisst", "root", ""); ?>
                                <select class="form-select" required id="seleccEquipo" name="seleccEquipo" style="width: 50%;">
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    $query = $conn->prepare("SELECT co_Art, art_Des FROM tstocksis WHERE estatus = 1 order by co_Art");
                                    $query->execute();
                                    $data = $query->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($data as $valores) :
                                        echo '<option value="' . $valores["co_Art"] . '">' . $valores["co_Art"] . ' - ' . $valores["art_Des"] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div class="camposComunes" style="margin-top:3.5%;">
                                <div>
                                    <h6><i>Código</i></h6>
                                    <input class="form-control" type="number" name="txtCodigo" readonly id="txtCodigo" placeholder="Nro Identificador del Equipo">
                                </div>

                                <div style="margin-left: 10px;">
                                    <h6><i>Descripción</i></h6>
                                    <input class="form-control" type="text" name="txtDescrip" readonly id="txtDescrip" placeholder="Descripcion del componente">
                                </div>
                            </div>

                            <div class="camposComunes">
                                <div>
                                    <h6><i>Modelo</i></h6>
                                    <input class="form-control" type="text" name="txtModelo" readonly id="txtModelo" placeholder="Identificador Referencial">
                                </div>

                                <div style="margin-left: 10px;">
                                    <h6><i>Serial</i></h6>
                                    <input class="form-control" type="text" name="txtSerial" readonly id="txtSerial" placeholder="Nro Serial de Fabrica">
                                </div>
                            </div>
                            <div class="camposComunes">
                                <div>
                                    <h6 class="milab1"><i>Fecha de Registro</i></h6>
                                    <input class="form-control" type="date" name="txtFechregistro" id="txtFechregistro" readonly placeholder="Fecha de registro del equipo">
                                </div>

                                <!--div style="margin-left: 10px;">
                                    <h6 class="milab1" ><i>Fecha de Asignacion</i></h6>
                                    <input class="form-control" type="date" name="txtFechasign" id="txtFechasign" 
                                    readonly placeholder="Fecha en que se asigno el equipo">
                                </div-->
                            </div>
                            <!--div class="camposComunes"-->
                            <div class="camposComunes" style="display:flex;">
                                <div style="margin-top:0.3rem;">
                                    <span style="display:flex;">
                                        <h6 id=motobserv style="margin-top:-4px;"><i>Motivo de la asignación</i></h6>
                                        <!--h1 id="cmas3" title="Click para habilitar / Desactivar la asignacion">+</h1-->
                                    </span>
                                    <input class="form-control" type="text" name="txtMotentrega" id="txtMotentrega" placeholder="Justifica la asignacion" style="margin-top:1.3em">
                                </div>

                                <!--div id="fechaManten" style="margin-top:0.8rem;">
                                    <h6 style="color: red;margin-left:20%">Fecha&nbspde&nbspMantenimiento</h6>
                                    <input class="form-control" type="date" name="txtFechmantenim" id="txtFechmantenim" placeholder="Fecha de Mantenimiento" readonly>
                                </div-->
                            </div>
                            <div id="observaciones-div" style="margin-top:14px;">
                                <span style="display:flex;">
                                    <h6 id=idobserv style="margin-top:-8px; "><i>Observaciones de la adquisición</i></h6>
                                    <!--h1 id="cmas2" title="Click para habilitar / Desactivar la observacion">+</h1-->
                                </span>
                                <textarea class="form-control" name="txtObserv" id="txtObserv" style="width:60.3em;resize:none;border-radius: 4px; margin-top:16px;" disabled>
                                </textarea>
                            </div>

                        </div>

                        <!--SELECTOR USUARIOS-->
                        <div id="SegundoSelecUsuarios">
                            <div>
                                <h4><b>Asignar Usuario</b></h4>
                                <select class="form-select" id="seleccUser" name="seleccUser" style="width: 100%;margin-top:10px;" required>
                                    <option value="">Seleccione una opción</option>
                                    <?php
                                    $query = $conn->prepare("SELECT muNamen, muDpto FROM tusergb order by muNamen");
                                    $query->execute();
                                    $data = $query->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($data as $valores) :
                                        echo '<option value="' . $valores["muNamen"] . '">' . $valores["muNamen"] . ' - ' . $valores["muDpto"] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>

                            <div>
                                <div style="Margin-top:34px">
                                    <h6><i>Nombre</i></h6>
                                    <input class="form-control" type="text" name="txtNombre" required readonly id="txtNombre" placeholder="Persona responsable">
                                </div>

                                <div style="Margin-top:15px">
                                    <h6><i>Cargo</i></h6>
                                    <input class="form-control" type="text" name="txtCargo" readonly id="txtCargo" placeholder="Gerarquia en la Empresa">
                                </div>

                                <div style="Margin-top:15px">
                                    <h6><i>Código de Departamento</i></h6>
                                    <input class="form-control" class="form-control" type="text" name="txtDpto" readonly id="txtDpto" placeholder="Nro referente del Departamento">
                                </div>

                                <div style="Margin-top:15px">
                                    <h6><i>Área de Ubicación</i></h6>
                                    <input class="form-control" type="text" name="txtAreaubic" readonly id="txtAreaubic" placeholder="Oficina Referencial">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--div style="display:flex;"-->
                    <button id="asignaEquip" title='' type='submit'><i class="bi bi-pc-display-horizontal btn-lg" style='color:blue;'>
                        </i style="margin-left:5px;"><b>&nbsp&nbspA S I G N A R</b>
                    </button>
                    <!--/div-->
                </form>

                <!-- V E N T A N A   M O D A L   M A N T E N I M I E N T O -->
                <div class="modal fade" id="ayuda-modal" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document" style="max-width:50%">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Instrucciones de Mantenimiento</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="accordion" id="accordionExample">
                                    <div class="window3">
                                        <h6 class="header" style="  border-radius: 5PX;">
                                            Instructivo para ejecutar el servicio </h6>

                                        <div class="listbox2" style="background-color: #f0f8ff;">
                                            <p>Aquí indicaciones planas.</p>
                                        </div>

                                        <div class="listbox2" style="background-color: #ccf8cc;">
                                            <p>Indicaciones Seguras.</p>
                                        </div>

                                        <div class="listbox2 mb-3" style="background-color: #eebcb9;">
                                            <p>Indicaciones de cuidado.</p>
                                        </div>
                                    </div>

                                    <!--div class="accordion-item">
                                                <h2 class="accordion-header" id="headingOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                        Accordion Item #1
                                                    </button>
                                                </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                         This is the first item's accordion body.
                                                    </div>
                                                </div>
                                              </div-->
                                    <div>
                                        <button type="footer" class="button button1" style="bottom:3px;
                                                 border-radius: 5px; width: 55px;" data-bs-dismiss="modal" aria-label="">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--********************
            <****** PAGINA 2 **** A S I G N A C I O N E S  ***-->

            <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!--img src="public/img/ref/Pag_2.png" alt=""-->
                <!--  ************* F O R M U L A R I O  2 ************ -->
                <form id="selecionarEquipoFrm2">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col">

                                <table id="tabla-id" class="table table-striped table-bordered  table-hover" style="width:115%;margin-left:-8%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Código</th>
                                            <th style="text-align: center;">Descripción</th>
                                            <th style="text-align: center;">Modelo</th>
                                            <th style="text-align: center;">Serial</th>
                                            <th style="text-align: center;">Área_Dpto.</th>
                                            <th style="text-align: center;">Usuario</th>
                                            <th style="text-align: center;">Fecha_Asignación</th>
                                            <th style="text-align: center;">Fecha_Registro</th>
                                            <th style="text-align: center;">"Desincorporar"</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                        $stmt = $conn->prepare("SELECT * FROM tstockasig order by fecha_Regw");
                                        $stmt->execute();
                                        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($array as $row) {
                                            echo "<tr id='dtabla'>";
                                            echo "<td>" . $row["co_Artw"] . "</td>";
                                            echo "<td>" . $row["art_Desw"] . "</td>";
                                            echo "<td>" . $row["modelow"] . "</td>";
                                            echo "<td>" . $row["serialpw"] . "</td>";
                                            echo "<td>" . $row["ubicacionw"] . "</td>";
                                            echo "<td>" . $row["campo1w"] . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fechasigw"])) . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fecha_Regw"])) . "</td>";
                                            echo "<td  style='display:flex;'>   
                                                 <button id='desincorpora' 
                                                    title='Desincorporar Equipo' type='button'  
                                                    class='bi bi-person-workspace ' data-bs-toggle='modal' aria-label=''
                                                    data-bs-target='#actualizaTablasmodal1'>
                                                 </button>

                                                 <!--button id='automatword' style='margin-left:1em;' 
                                                    title='Imprime Formato de Entrega del Equipo' type='button'  
                                                    class='bi  bi-file-word' data-bs-toggle='modal' aria-label=''
                                                    data-bs-target='#'>
                                                 </button-->

                                             </td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--*****************************
            <****** P A G I N A   3 *** D E S I N C O R P O R A D O S ****-->

            <div class="tab-pane" id="reverso" role="tabpanel" aria-labelledby="reverso-tab">
                <!--img src="public/img/ref/Pag_2.png" alt=""-->
                <!--  ************* F O R M U L A R I O  3 ************ -->
                <form id="selecionarEquipoFrm3">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col">
                                <table id="tablar-id" class="table table-striped table-bordered  table-hover" style="width:115%;margin-left:-8%;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Código</th>
                                            <th style="text-align: center;">Descripción</th>
                                            <th style="text-align: center;">Modelo</th>
                                            <th style="text-align: center;">Serial</th>
                                            <th style="text-align: center;">Área_Dpto.</th>
                                            <th style="text-align: center;">Usuario</th>
                                            <th style="text-align: center;">Fecha_Asignación</th>
                                            <th style="text-align: center;">Fecha_Registro</th>
                                            <th style="text-align: center;">"Reincorporar"</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        //$conn = new PDO("mysql:host=localhost;dbname=bdsisst", "root", "");
                                        $stmt = $conn->prepare("SELECT * FROM tshistorico 
                                                            WHERE estatush = 4 order by fecha_Regh");
                                        $stmt->execute();
                                        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($array as $row) {
                                            echo "<tr id='drtabla'>";
                                            echo "<td>" . $row["co_Arth"] . "</td>";
                                            echo "<td>" . $row["art_Desh"] . "</td>";
                                            echo "<td>" . $row["modeloh"] . "</td>";
                                            echo "<td>" . $row["serialph"] . "</td>";
                                            echo "<td>" . $row["ubicacionh"] . "</td>";
                                            echo "<td>" . $row["campo1h"] . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fechasigh"])) . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fecha_Regh"])) . "</td>";
                                            echo "<td>   
                                                <button id='procesareverso'  
                                                     title='Reincorporar Equipos' type='button' class='bi bi-recycle '
                                                    data-bs-toggle='modal' aria-label='' data-bs-target=''>
                                                </button>
                                             </td>";
                                            echo "</tr>";
                                        }
                                        ?>

                                        <!--div style="align-items: auto" ;>
                                        <button title="Actualizar estatus del Equipo" type="button" class="bi bi-tools" data-bs-toggle="modal" aria-label="" data-bs-target=""></button>
                                        <button title="Editar Registro actual" type="button" class="bi bi-journal-check" data-bs-toggle="modal" aria-label="" data-bs-target="#ayuda-modal"></button>
                                     </div-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!--***********************
            <****** PAGINA 4 *** H  I S T O R I C O ****-->

            <div class="tab-pane" id="reporte" role="tabpanel" aria-labelledby="reporte-tab">
                <!--img src="public/img/ref/Pag_2.png" alt=""-->
                <form id="selecionarEquipoFrm4">
                    <div class="container mt-4">
                        <div class="row" style="width:115%;margin-left:-1px">
                            <div class="col" style="margin-right:10%; margin-left: -7%;">
                                <table id="tablareportes-id" class="table table-striped table-bordered  table-hover ">

                                    <!--table id="tablareportes-id" class="table table-striped table-bordered  table-display" style="margin-left:4%"-->
                                    <!--style="font-size: 0.8em;"-->
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width:15%">Código</th>
                                            <th style="text-align: center; width:100%">Descripción</th>
                                            <th style="text-align: center; width:30%">Modelo</th>
                                            <th style="text-align: center; width:30%">Serial</th>
                                            <th style="text-align: center; width:50%">Área_Dpto.</th>
                                            <th style="text-align: center; width:40%">Usuario</th>
                                            <th style="text-align: center; width:10%">Fecha_Asignación</th>
                                            <th style="text-align: center; width:10%">Fecha_Registro</th> <br>
                                            <th style="text-align: center; width:2%">Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $conn = new PDO("mysql:host=localhost;dbname=bdsisst", "root", "");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $stmt = $conn->prepare("SELECT * FROM tshistorico order by fecha_Regh");
                                        $stmt->execute();
                                        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($array as $row) {
                                            echo "<tr id='dreptabla'>";
                                            echo "<td class='text-nowrap text-center'>" . $row["co_Arth"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["art_Desh"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["modeloh"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["serialph"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["ubicacionh"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["campo1h"] . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fechasigh"])) . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fecha_Regh"])) . "</td>";
                                            echo "<td class='text-nowrap text-center'>";
                                            $row["estatush"];
                                            switch ($row["estatush"]) {
                                                case 1:
                                                    echo "Disponible";
                                                    break;
                                                case 2:
                                                    echo "Asignado";
                                                    break;
                                                case 3:
                                                    echo "Reasignado";
                                                    break;
                                                case 4:
                                                    echo "Desincorporado";
                                                    break;
                                                case 5:
                                                    echo "Reversado";
                                                    break;
                                                default:
                                                    echo "Estatus no coincide con ninguno de los casos anteriores";
                                            }
                                            echo "</td>";
                                            //echo "<td class='text-nowrap'>" . $row["estatush"] . "</td>";
                                            echo "</tr>";
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--***********************
            <****** PAGINA 5 ** M A N T E N I M I E N T O*****-->

            <div class="tab-pane" id="mantenim" role="tabpanel" aria-labelledby="mantenim-tab">
                <!--img src="public/img/ref/Pag_2.png" alt=""-->
                <form id="selecionarEquipoFrm5">
                    <div class="container mt-4">
                        <div class="row" style="width:115%;margin-left:-1px">
                            <div class="col" style="margin-right:10%; margin-left: -7%;">
                                <table id="tablamantenim-id" class="table table-striped table-bordered  table-hover ">

                                    <!--table id="tablareportes-id" class="table table-striped table-bordered  table-display" style="margin-left:4%"-->
                                    <thead>
                                        <tr>
                                            <th style="text-align: center; width:15%">Código</th>
                                            <th style="text-align: center; width:60%">Descripción</th>
                                            <th style="text-align: center; width:30%">Modelo</th>
                                            <th style="text-align: center; width:30%">Serial</th>
                                            <th style="text-align: center; width:50%">Fecha_Registro</th>
                                            <th style="text-align: center; width:40%">Fecha_Mantenimiento</th>
                                            <th style="text-align: center; width:2%">Estatus</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $conn = new PDO("mysql:host=localhost;dbname=bdsisst", "root", "");
                                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $stmt = $conn->prepare("SELECT * FROM tstocksis order by fecha_Reg");
                                        $stmt->execute();
                                        $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($array as $row) {
                                            echo "<tr id='dreptablam'>";
                                            echo "<td class='text-nowrap text-center'>" . $row["co_Art"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["art_Des"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["modelo"] . "</td>";
                                            echo "<td class='text-nowrap'>" . $row["serialp"] . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fecha_Reg"])) . "</td>";
                                            echo "<td class='text-nowrap text-center'>" . date("d-m-Y", strtotime($row["fec_Mantenim"])) . "</td>";
                                            echo "<td class='text-nowrap text-center'>";
                                            $row["estatus"];
                                            switch ($row["estatus"]) {
                                                case 1:
                                                    echo "Disponible";
                                                    break;
                                                case 2:
                                                    echo "Asignado";
                                                    break;
                                                default:
                                                    echo "Falta Estatus";
                                            }
                                            echo "</td>";
                                            //echo "<td class='text-nowrap'>" . $row["estatush"] . "</td>";
                                            echo "</tr>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--VENTANA MODAL PACTUALIZA-->
    <?php include("actualizar-registro-modal.php"); ?>
    <?php include("reverso-registro-modal.php"); ?>
    <?php include("pinsert-registro.php"); ?>
    <?php include("pcorreo.php"); ?>

    <script src="datos.php"></script>
    <script src="./public/js/bootstrap.bundle.min.js"></script>
    <script src="./public/js/bootstrap.min.js"></script>
    <script type="module" src="./public/js/main.js"></script>

    <script type="text/javascript">
        setTimeout(function() {
            document.getElementById("aviso-usuario").style.display = "none";
        }, 2000)
    </script>


    <script>
        document.getElementById("home-tab").addEventListener("click", function (evt) {
           const myMessElement = document.getElementById('myMess');
            myMessElement.innerText = 'Asignar Equipos';
        });

        document.getElementById("profile-tab").addEventListener("click", function (evt) {
           const myMessElement = document.getElementById('myMess');
            myMessElement.innerText = 'Equipos Asignados';
        });

        document.getElementById("reverso-tab").addEventListener("click", function (evt) {
           const myMessElement = document.getElementById('myMess');
            myMessElement.innerText = 'Desincorporados';
        });

        document.getElementById("menureport").addEventListener("click", function (evt) {
           const myMessElement = document.getElementById('myMess');
            myMessElement.innerText = 'Menú de Reportes';
        });

        document.getElementById("mantenim-tab").addEventListener("click", function (evt) {
           const myMessElement = document.getElementById('myMess');
            myMessElement.innerText = 'Mantenimiento';
        });

        document.getElementById("reporte-tab").addEventListener("click", function (evt) {
           const myMessElement = document.getElementById('myMess');
            myMessElement.innerText = 'Histórico';
        });
</script>
</body>

</html>