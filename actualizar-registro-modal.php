    <!-- La ventana modal -->

    <div class="modal fade" id="actualizaTablasmodal1" role="dialog">
        <div class="modal-dialog">

            <!-- Contenido de la ventana modal -->
            <div class="modal-content" style="width:144%;right: 12%">

                <!-- AVISOS -->
                <div id="aviso-usuario" class="alert alert-primary my-2" role="alert" style="width:90%;margin:0 auto;display:none">
                </div>

                <div class="modal-header">
                    <div><img src="./public/img/micons/LGB.png" alt="Trulli" width="40" height="35"> </div>
                    <h4 class="modal-title" style="margin-right:60%;">Cambio de Estatus</h4>
                </div>
                <div class="modal-body">
                    <form id="frmModalEstatus" style="width: 100%;">

                        <div class="camposComunes" style="margin-left:6px;">
                            <div>
                                <h6><i>Código</i></h6>
                                <input class="form-control" type="number" name="modCodigo" readonly id="modCodigo">
                            </div>

                            <div style="margin-left: 10px;">
                                <h6><i>Descripción</i></h6>
                                <input class="form-control" type="text" name="modDescrip" readonly id="modDescrip" style="width: 220%;">
                            </div>
                        </div>

                        <div class="camposComunes" style="margin-top:12px;margin-left:6px;">
                            <div>
                                <h6><i>Modelo</i></h6>
                                <input class="form-control" type="text" name="modModelo" readonly id="modModelo">
                            </div>

                            <div style="margin-left: 10px;">
                                <h6><i>Serial</i></h6>
                                <input class="form-control" type="text" name="modSerialp" readonly id="modSerialp">
                            </div>

                            <div style="margin-left: 10px;">
                                <h6><i>Area de Ubicación</i></h6>
                                <input class="form-control" type="text" name="modAreaubic" readonly id="modAreaubic" style="width: 115%;">
                            </div>
                        </div>

                        <div class="camposComunes">
                            <!--SELECTOR USUARIOS-->
                            <div id="selectorUsuarios" style="margin-left:16%;">
                                <!-- GUARDANDO VALORES PARA USARLOS EN EL _POST -->

                                <input type="hidden" id="modNombre" name="modNombre">
                                <input type="hidden" id="modNombreSelector" name="modNombreSelector">
                                <br>
                                <h5><b><i>Asignar Usuario</i></b></h5>
                                <select class="form-select" required id="seleccUserModal" name="seleccUserModal" style="border-radius: 5px;border:solid #d8cdcd 1px;width: 100%;margin-left:2%;">
                                    <option value="">Seleccione Usuario para reasignar el equipo</option-->
                                        <?php
                                        $query = $conn->prepare("SELECT * FROM tusergb  order by muNamen");
                                        $query->execute();
                                        $data = $query->fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($data as $valores) :
                                            echo '<option value="' . $valores["muNamen"] . '">' . $valores["muNamen"] . ' - ' . $valores["muDpto"] . '</option>';
                                        endforeach;
                                        ?>
                                </select>
                                <div style="width:105%;height:40%;margin-top:3%;
                                            padding:2%;display:flex;justify-content:left;">

                                    <div style="margin-right:6px;">
                                        <h6><i>Cargo</i></h6>
                                        <input class="form-control" type="text" name="mtxCargo" readonly id="mtxCargo" placeholder="Cargo">
                                    </div>

                                    <div style="margin-left: 3px;">
                                        <h6><i>Código de Departamento</i></h6>
                                        <input class="form-control" type="text" name="mtxDpto" readonly id="mtxDpto" placeholder="Codigo de Departamento">
                                    </div>
                                </div>

                                <h5><b><i>Cambiar Estatus</i></b></h5>
                                <select class="form-select" required id="seleccModalEstatus" name="seleccModalEstatus" style="margin-left:2%;width: 100%;border-radius: 5px;border:solid #d8cdcd 1px">
                                    <option value="">Elegir una opción para desincorporar-Revesar</option>
                                    <option value="1">Reasignar este Equipo</option>
                                    <option value="2">Desincorporar Asignados</option>
                                </select>
                            </div>
                        </div>
                        <br><br>
                        
                        <script> sessionStorage.setItem("Auth", true);</script>

                        <div style="display:flex">
                            <button id="procesaCamposModal" type="submit">
                                &nbsp&nbspPROCESAR&nbsp&nbsp</button>
                            <button id="refrescarModal" type="button" class="btn btn-danger" style="margin-left:72%" 
                            data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
