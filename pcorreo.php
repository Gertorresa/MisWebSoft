<!-- La ventana modal -->

<div class="modal fade" id="enviarcorreofrmModal" role="dialog">

  <div class="modal-dialog">

    <!-- Contenido de la ventana modal -->
    <div class="modal-content">

      <div class="modal-body" style="height:40em;border:none;">

        <form id="correo-formulario">
          <div id="correoheader">
            <div id="imagpng"><img src="./public/img/micons/LGB.png" alt="Trulli" width="78" height="60"> </div>
            <h1 id="head1bcorreo">Envío de Correo</h1>
          </div>

          <label id="labcorreo" for="destinatario">Destinatario:</label>
          <input type="email" id="destinatario" class="form-control" placeholder="correo@ejemplo.com" required>
          <br>
          <label id="labcorreo" for="asunto">Asunto:</label>
          <input type="text" id="asunto" class="form-control" placeholder="Asunto del correo" required>
          <br>
          <label id="labcorreo" for="mensaje">Mensaje:</label>
          <textarea id="mensaje" rows="4" class="form-control" placeholder="Escribe tu mensaje aquí" required></textarea>
          <br>
          <div style="display:flex">
               <button id="procesaCorreosModal" type="submit" >&nbsp&nbspPROCESAR&nbsp&nbsp</button>
               <button id="refrescarModal" type="button" class="btn btn-danger" style="margin-left:60%" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>


