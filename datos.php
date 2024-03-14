<?php
session_start();

$conn = new PDO("mysql:host=localhost;dbname=bdsisst", "root", "");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$action = '';
if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'seleccionarEquipo':

            // SELECCIONAR DATOS DEL EQUIPO (CONSULTA)        
            $co_Art = $_GET['codigo'];
            $stmt = $conn->query("SELECT * FROM tstocksis WHERE co_Art = '$co_Art' and estatus != 2 order by co_Art");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo json_encode($row);
            break;

        case 'seleccionarUsuario':
            // SELECCIONAR DATOS DEL USUARIO           
            $muNamen = $_GET['muNamen'];
            $stmt = $conn->prepare("SELECT * FROM tusergb WHERE muNamen = '$muNamen' ");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            echo json_encode($row);
            break;

        case    'registroInsertm':
            try {
                // INSERTAR REGISTROS EQUIPOS 
                $co_Art = $_GET['codigo'];
                $stmt_up = $conn->prepare("SELECT * FROM tstocksis WHERE  co_Art = '$co_Art' ");
                $stmt_up->execute();

                if ($stmt_up->rowCount() > 0) {
                    echo 'registro ya existe';
                    return ['stmt' => false];
                }

                // DATOS DEL EQUIPO
                $txtCodigo       = $_POST["modCodigo"];
                $txtDescrip      = ucfirst($_POST["modDescrip"]);
                $txtModelo       = $_POST["modModelo"];
                $txtSerial       = $_POST["modSerialp"];
                $txtFechReg      =  date("Y-m-d");   //$_POST["modfec_reg"];
                $estatus         = 1;
                $txtFechasig     = date("//");
                $txtCampo2       = date("Y-m-d");
                $txtObserv       = ucfirst($_POST["modObserv"]);
                $txtFechmantenim = $_POST["modFechmantenim"];

                $stmt = $conn->prepare("INSERT INTO tstocksis (co_Art, art_Des, modelo, serialp, fecha_Reg,  
                                                              estatus, fechasig, campo2, campo4, fec_Mantenim )  
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");

                $stmt->bindParam(1, $txtCodigo);
                $stmt->bindParam(2, $txtDescrip);
                $stmt->bindParam(3, $txtModelo);
                $stmt->bindParam(4, $txtSerial);
                $stmt->bindParam(5, $txtFechReg);
                $stmt->bindParam(6, $estatus);
                $stmt->bindParam(7, $txtFechasig);
                $stmt->bindParam(8, $txtCampo2);
                $stmt->bindParam(9, $txtObserv);
                $stmt->bindParam(10, $txtFechmantenim);
                $stmt->execute();

                echo json_encode(['stmt' => 'Datos insertados correctamente']);
            } catch (PDOException $e) {
                echo json_encode(['stmt' => 'Error al insertar los datos: ' . $e->getMessage()]);
            }
            break;

            /* ****************   A S I G N A C I O N  D E    E Q U I P O  ********** */
        case 'asignacionEquipoSeleccionado':

            try {
                // CAMBIAR STATUS PARA EVITAR VOLVER A REALIZAR LA ASIGNACION
                $co_Art = $_GET['codigo'];
                $stmt_up = $conn->prepare("UPDATE tstocksis SET estatus = 2 WHERE  co_Art = '$co_Art' ");
                $stmt_up->execute();

                // DATOS DEL EQUIPO
                $txtCodigo       = $_POST["txtCodigo"];
                $txtDescrip      = ucfirst($_POST["txtDescrip"]);
                $txtModelo       = $_POST["txtModelo"];
                $txtSerial       = $_POST["txtSerial"];
                $txtMotentrega   = ucfirst($_POST["txtMotentrega"]);
                $txtFechReg      = $_POST["txtFechregistro"];
                $txtObserv       = ucfirst($_POST["txtObserv"]);
                $estatusw        = 2;
                $txtFechasig     = date("Y-m-d");
                $txtCampo2       =  date("07/10/2024");
                $txtFechmantenim = $_POST["txtFechmantenim"];

                // DATOS DEL USUARIO
                $txtNombre   = ucfirst($_POST["txtNombre"]);
                $txtCargo    = ucfirst($_POST["txtCargo"]);
                $txtDpto     = ucfirst($_POST["txtDpto"]);
                $txtAreaubic = ucfirst($_POST["txtAreaubic"]);

                // REGISTRA EL EQUIPO ASIGNADO

                $stmt = $conn->prepare("INSERT INTO tstockasig (co_Artw, art_Desw, modelow, serialpw,  campo3w, fecha_Regw, campo4w, 
                                                estatusw, campo1w, i_Art_desw, uni_Empw, ubicacionw, fechasigw, campo2w, fec_Mantenimw ) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bindParam(1, $txtCodigo);
                $stmt->bindParam(2, $txtDescrip);
                $stmt->bindParam(3, $txtModelo);
                $stmt->bindParam(4, $txtSerial);
                $stmt->bindParam(5, $txtMotentrega);
                $stmt->bindParam(6, $txtFechReg);
                $stmt->bindParam(7, $txtObserv);
                $stmt->bindParam(8, $estatusw);
                $stmt->bindParam(9, $txtNombre);
                $stmt->bindParam(10, $txtCargo);
                $stmt->bindParam(11, $txtDpto);
                $stmt->bindParam(12, $txtAreaubic);
                $stmt->bindParam(13, $txtFechasig);
                $stmt->bindParam(14, $txtCampo2);
                $stmt->bindParam(15, $txtFechmantenim);
                $stmt->execute();

                echo json_encode(['stmt' => 'Datos insertados correctamente']);
            } catch (PDOException $e) {
                echo json_encode(['stmt' => 'Error al insertar los datos: ' . $e->getMessage()]);
            }
            break;

            /* ****************  R E A S I G N A R   E Q U I P O  ********** */
        case 'registroAhistorico':
            try {
                // CAMBIANDO ESTATUS AL MAESTRO PARA VOLVER A UTILIZAR EL EQUIPO
                $co_Artw = $_GET['codigo'];
                $stmt = $conn->prepare("SELECT * FROM tstockasig  WHERE  co_Artw = '$co_Artw' ");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // DATOS DEL EQUIPO
                $co_Artw       = $row['co_Artw'];
                $art_Desw      = ucfirst($row['art_Desw']);
                $modelow       = $row['modelow'];
                $serialpw      = $row['serialpw'];
                $campo3w       = ucfirst($row['campo3w']);
                $fecha_Regw    = $row['fecha_Regw'];
                $campo4w       = ucfirst($row['campo4w']);
                $estatusw      = 3;
                $fechasigw    = $row['fechasigw'];
                $campo2w       = $row['campo2w'];
                $fec_Mantenimw = $row['fec_Mantenimw'];

                // DATOS DEL USUARIO
                $campo1w    = ucfirst($row['campo1w']);
                $i_Art_desw = ucfirst($row['i_Art_desw']);
                $uni_Empw   = ucfirst($row['uni_Empw']);
                $ubicacionw = ucfirst($row['ubicacionw']);

                // HISTORICO DE EQUIPOS ASIGNADOS
                $stmt = $conn->prepare("INSERT INTO tshistorico (co_Arth, art_Desh, modeloh, serialph, campo3h, fecha_Regh, campo4h, 
                                                    estatush, campo1h, i_Art_desh, uni_Emph, ubicacionh, fechasigh, campo2h, fec_Mantenimh ) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bindParam(1, $co_Artw);
                $stmt->bindParam(2, $art_Desw);
                $stmt->bindParam(3, $modelow);
                $stmt->bindParam(4, $serialpw);
                $stmt->bindParam(5, $campo3w);
                $stmt->bindParam(6, $fecha_Regw);
                $stmt->bindParam(7, $campo4w);
                $stmt->bindParam(8, $estatusw);
                $stmt->bindParam(9, $campo1w);
                $stmt->bindParam(10, $i_Art_desw);
                $stmt->bindParam(11, $uni_Empw);
                $stmt->bindParam(12, $ubicacionw);
                $stmt->bindParam(13, $fechasigw);
                $stmt->bindParam(14, $campo2w);
                $stmt->bindParam(15, $fec_Mantenimw);
                $stmt->execute();

                $modNombre = $_POST['modNombre'];
                $stmt = $conn->prepare("SELECT * FROM tusergb WHERE muNamen = '$modNombre' ");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $txtNamen   = ucfirst($row['muNamen']);
                $txtCargo   = ucfirst($row['muCargo']);
                $txtDpto    = ucfirst($row['muDpto']);
                $txtCompany = ucfirst($row['muCompany']);

                echo json_encode($row);

                $stmt = $conn->prepare("UPDATE tstockasig SET campo1w = '$txtNamen', i_Art_desw = '$txtCargo', 
                                              uni_Empw =  '$txtDpto', ubicacionw = '$txtCompany' WHERE  co_Artw = '$co_Artw' ");
                $stmt->execute();

                //echo json_encode(['stmt' => 'Datos insertados y actualizados correctamente']);
            } catch (PDOException $e) {
                echo json_encode(['stmt' => 'Error al insertar los datos: ' . $e->getMessage()]);
            }

            break;

            /* *********** D E S I N C O R P O R A C I O N *********** */
        case 'registroaDesincorporar':
            try {
                // CAMBIAR STATUS PARA DESINCORPORAR
                $co_Artw = $_GET['codigo'];
                $stmt = $conn->prepare("SELECT * FROM tstockasig  WHERE  co_Artw = '$co_Artw' ");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                // DATOS DEL EQUIPO
                $co_Artw       = $row['co_Artw'];
                $art_Desw      = ucfirst($row['art_Desw']);
                $modelow       = $row['modelow'];
                $serialpw      = $row['serialpw'];
                $campo3w       = ucfirst($row['campo3w']);
                $fecha_Regw    = $row['fecha_Regw'];
                $campo4w       = ucfirst($row['campo4w']);
                $estatusw     = 4;
                $fec_Precvw    = $row['fechasigw'];
                $campo2w       = $row['campo2w'];
                $fec_Mantenimw = $row['fec_Mantenimw'];

                // DATOS DEL USUARIO
                $campo1w    = ucfirst($row['campo1w']);
                $i_Art_desw = ucfirst($row['i_Art_desw']);
                $uni_Empw   = ucfirst($row['uni_Empw']);
                $ubicacionw = ucfirst($row['ubicacionw']);

                // HISTORICO DE EQUIPOS ASIGNADOS
                $stmt = $conn->prepare("INSERT INTO tshistorico (co_Arth, art_Desh, modeloh, serialph, campo3h, fecha_Regh, campo4h, 
                                                    estatush, campo1h, i_Art_desh, uni_Emph, ubicacionh, fechasigh, campo2h, fec_Mantenimh ) 
                                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                $stmt->bindParam(1, $co_Artw);
                $stmt->bindParam(2, $art_Desw);
                $stmt->bindParam(3, $modelow);
                $stmt->bindParam(4, $serialpw);
                $stmt->bindParam(5, $campo3w);
                $stmt->bindParam(6, $fecha_Regw);
                $stmt->bindParam(7, $campo4w);
                $stmt->bindParam(8, $estatusw);
                $stmt->bindParam(9, $campo1w);
                $stmt->bindParam(10, $i_Art_desw);
                $stmt->bindParam(11, $uni_Empw);
                $stmt->bindParam(12, $ubicacionw);
                $stmt->bindParam(13, $fechasigw);
                $stmt->bindParam(14, $campo2w);
                $stmt->bindParam(15, $fec_Mantenimw);
                $stmt->execute();

                // ELIMINANDOLO DEL ARCHIVO DE TRABAJO TSTOCKASIG
                $stmt = $conn->query("DELETE FROM tstockasig WHERE co_Artw = '$co_Artw' ");
                $stmt->execute();

                $stmt = $conn->prepare("UPDATE tstocksis SET estatus = 4 WHERE  co_Art = '$co_Artw' ");
                $stmt->execute();

                echo json_encode(['stmt' => 'Datos actualizados correctamente']);
            } catch (PDOException $e) {
                echo json_encode(['stmt' => 'Error al insertar los datos: ' . $e->getMessage()]);
            }
            break;

        case 'registroReversom':
            $co_Art = $_GET['codigo'];
            $stmt_1 = $conn->prepare("UPDATE tstocksis SET estatus = 1 WHERE  co_Art = '$co_Art' ");
            $stmt_2 = $conn->prepare("UPDATE tshistorico SET estatush = 5 WHERE  co_Arth = '$co_Art' ");

            try {
                $stmt_1->execute();
                $stmt_2->execute();

                echo json_encode(['stmt_2' => 'Datos actualizados correctamente']);
            } catch (PDOException $e) {
                echo json_encode(['stmt_2' => 'Error al insertar los datos: ' . $e->getMessage()]);
            }

            /* //echo "Datos Reversados correctamente";
            } catch (PDOException $e) {
                echo "Error al Reversar este Equipo: " . $e->getMessage();
            }*/
            break;

        case 'registroEditm':
            // M O D I F I C A R  R E G I S T R O S   D E L  E Q U I P O
            try {
                $co_Art = $_GET['codigo'];

                $stmt = $conn->prepare("UPDATE tstocksis 
                                        SET co_Art = ?, art_Des = ?, modelo = ?, serialp = ?, campo4 = ?, fec_Mantenim = ? 
                                         WHERE co_Art = ?");

                $co_Art        = $_POST["txtmCodigo"];
                $art_Des       = $_POST["txtmDescrip"];
                $modelo        = $_POST["txtmModelo"];
                $serial        = $_POST["txtmSerial"];
                $campo4        = $_POST["txtmObserv"];
                $fec_Mantenim  = $_POST["txtmFechmantenim"];
                $co_Art2       = $co_Art;

                $stmt->bindParam(1, $co_Art);
                $stmt->bindParam(2, $art_Des);
                $stmt->bindParam(3, $modelo);
                $stmt->bindParam(4, $serial);
                $stmt->bindParam(5, $campo4);
                $stmt->bindParam(6, $fec_Mantenim);
                $stmt->bindParam(7, $co_Art2);
            
               // Ejecuta la consulta
               $stmt->execute();
               //$row = $stmt->fetch(PDO::FETCH_ASSOC);

                echo json_encode(['stmt' => 'Datos Modificados correctamente']);
            } catch (PDOException $e) {
                echo json_encode(['stmt' => 'Error al Modificar los datos: ' . $e->getMessage()]);
            }

            break;


        case 'borrarRegistro_enprueba':
            // SELECCIONAR BORRAR DATOS DEL EQUIPO (CONSULTA)
            $co_Artw = $_GET['codigo'];
            $stmt = $conn->query("DELETE FROM tstockasig WHERE co_Artw = codigo ");
            $stmt->execute([$co_Artw]);

            try {
                $stmt->execute();
                echo "Datos Eliminados correctamente";
            } catch (PDOException $e) {
                echo "Error al Eliminar los datos: " . $e->getMessage();
            }
            break;

        case 'consultausuariopassw':

            if (isset($_POST['username']) && isset($_POST['password'])) {

                if ($_POST["username"] == 'Gtorres' && $_POST["password"] == 's0p0rt3') {
                    $_SESSION["Auth"] = true;
                    echo json_encode(['Datos Consultados Correctamente']);
                } else {
                    echo json_encode(['error' => 'Usuario o contraseña incorrectos']);
                }
            } else {
                echo json_encode(['error' => 'Datos incompletos en la solicitud']);
            }
            break;

        default:
            echo " ERROR EN EL VALOR DE LA VARIABLE USADA EN EL `GET`!";
            break;
    }
}

$_SESSION['mensaje'] = "Datos cargados correctamente";
$_SESSION['mostrar-mensaje'] = true;
header("Refresh:0; url=index.php");
