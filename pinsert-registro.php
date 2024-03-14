<div class="modal fade" id="insertaregistrosfrmModal" role="dialog">
  <div class="modal-dialog">

    <!-- Contenido de la ventana modal -->
    <div class="modal-content" style="width:144%;right: 12%">

      <!-- AVISOS -->
      <div id="aviso-usuario" class="alert alert-primary my-2" role="alert" style="width:90%;margin:0 auto;display:none">
      </div>

      <div class="modal-header">
        <div><img src="./public/img/micons/LGB.png" alt="Trulli" width="55" height="50"> </div>
        <h4 class="modal-title" style="margin-right:57%;">Registro de Equipos</h4>
      </div>

      <div class="modal-body">

        <div class="container mt-3">
          <ul class="nav nav-tabs" id="myTabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tab1">Insertar Registro</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tab2">Editar Registro</a>
            </li>
          </ul>

          <div class="tab-content">
            <div class="tab-pane fade show active" id="tab1">
              <form id="frmModalinsert" style="width: 100%;">

                <div class="camposComunes" style="margin-left:6px;margin-top:2em;">
                  <div>
                    <h6><i>Código</i></h6>
                    <input class="form-control" type="number" name="modCodigo" id="modCodigo" required>
                  </div>

                  <div style="margin-left: 10px;">
                    <h6><i>Descripción</i></h6>
                    <input class="form-control" type="text" name="modDescrip" id="modDescrip" style="width: 28.6em;" required>
                  </div>
                </div>

                <div class="camposComunes" style="margin-top:12px;margin-left:6px;">
                  <div>
                    <h6><i>Modelo</i></h6>
                    <input class="form-control" type="text" name="modModelo" id="modModelo" required style="width:13em;">
                  </div>

                  <div style="margin-left: 10px;">
                    <h6><i>Serial</i></h6>
                    <input class="form-control" type="text" name="modSerialp" id="modSerialp" required>
                  </div style="margin-left: 10px; width:40%">
                  <div id="fechaManten">
                    <h6><i>Fecha de Mantenimiento</i></h6>
                    <input class="form-control" type="date" name="modFechmantenim" id="modFechmantenim" placeholder="" style="width: 15.7em;">
                  </div>
                  <!--div style="margin-left: 10px; width:30%">
                  <h6><i>Fecha_Registro</i></h6>
                  <input class="form-control" type="date" name="modfec_reg" id="modfec_reg" style="width: 117%;" required>
                  </div-->
                </div>
                <br>
                <div class="camposComunes">

                  <br>

                  <div id="observaciones-div">
                    <h6><i>Observaciones</i></h6>
                    <textarea class="form-control" name="modObserv" id="modObserv" style="resize:none;border-radius: 4px;margin-left:4px;"></textarea>
                  </div>

                </div>
                <br><br>
                <div style="display:flex">
                  <button id="procesaCamposinsModal" type="submit" style="border-radius:4px;margin-left:2%;color:blue;background-color:graywhite;">&nbsp&nbspPROCESAR&nbsp&nbsp</button>
                  <button id="refrescarModal" type="button" class="btn btn-danger" style="margin-left:72%" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </form>
            </div>

            <!--  ************* P E S T A Ñ A   N R O   2    ************ -->
            <div class="tab-pane fade" id="tab2">

            <!--  ************* S E L E C T O R   E Q U I P O S ************ -->
              <?php $conn = new PDO("mysql:host=localhost;dbname=bdsisst", "root", ""); ?> <br>
              <select class="form-select" required id="seleccEquipoMod" name="seleccEquipoMod" style="width: 70%;">
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

              <form id="frmModaEdit" style="width: 100%;">

                <div class="camposComunes" style="margin-left:6px;margin-top:2em;">
                  <div>
                    <h6><i>Código</i></h6>
                    <input class="form-control" type="number" name="txtmCodigo" placeholder="" id="txtmCodigo" >
                  </div>

                  <div style="margin-left: 10px;">
                    <h6><i>Descripción</i></h6>
                    <input class="form-control" type="text" name="txtmDescrip" id="txtmDescrip" placeholder="" style="width: 28.6em;" >
                  </div>
                </div>

                <div class="camposComunes" style="margin-top:12px;margin-left:6px;">
                  <div>
                    <h6><i>Modelo</i></h6>
                    <input class="form-control" type="text" name="txtmModelo" id="txtmModelo" placeholder="" style="width:13em;">
                  </div>

                  <div style="margin-left: 10px;">
                    <h6><i>Serial</i></h6>
                    <input class="form-control" type="text" name="txtmSerial" placeholder="" id="txtmSerial" >
                  </div style="margin-left: 10px; width:40%">
                  <div id="fechaManten">
                    <h6><i>Fecha de Mantenimiento</i></h6>
                    <input class="form-control" type="date" name="txtmFechmantenim" id="txtmFechmantenim" placeholder="" style="width: 15.7em;">
                  </div>
  
                </div>
                <br>
                <div class="camposComunes">

                  <br>

                  <div id="observaciones-div">
                    <h6><i>Observaciones</i></h6>
                    <textarea class="form-control" name="txtmObserv"  id="txtmObserv"  style="resize:none;border-radius: 4px;margin-left:4px;">
                  </textarea>
                  </div>

                </div>
                <br><br>
                <div style="display:flex">
                  <button id="procesaCamposModifModal" type="submit" style="border-radius:4px;margin-left:2%;color:blue;background-color:graywhite;">&nbsp&nbspPROCESAR&nbsp&nbsp</button>
                  <button id="refrescarModal" type="button" class="btn btn-danger" style="margin-left:72%" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </form>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>