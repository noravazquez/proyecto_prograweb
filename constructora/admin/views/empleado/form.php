<h1>
  <?php echo ($action == 'edit') ? 'Modificar ' : 'Nuevo ' ?>Empleado
</h1>
<form class="container-fluid" method="POST" action="empleado.php?action=<?php echo $action; ?>" enctype="multipart/form-data">
  <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="data[nombre]" class="form-control" placeholder="Nombre" required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Primer apellido</label>
    <input type="text" name="data[primer_apellido]" class="form-control" placeholder="Primer apellido" required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Segundo apellido</label>
    <input type="text" name="data[segundo_apellido]" class="form-control" placeholder="Segundo apellido" required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">Fecha de nacimiento</label>
    <input type="date" name="data[fecha_nacimiento]" class="form-control" placeholder="Fecha de nacimiento" required minlength="3" maxlength="200" />
  </div>
  <div class="mb-3">
    <label class="form-label">RFC</label>
    <input type="text" name="data[rfc]" id="rfc" class="form-control" placeholder="RFC" required minlength="12" maxlength="13" />
    <div id="rfc-error" class="error-message"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">CURP</label>
    <input type="text" name="data[curp]" id="curp" class="form-control" placeholder="CURP" required minlength="18" maxlength="18" />
    <div id="curp-error" class="error-message"></div>
  </div>
  <div class="mb-3">
    <label class="form-label">Departamento</label>
    <select name="data[id_departamento]" class="form-control" required>
      <?php
        foreach ($datadepartamentos as $key => $depto): 
          $selected = " ";
          if ($depto['id_departamento']==$data[0]['id_departamento']):
            $selected = " selected";
          endif;?>
      <option value="<?php echo $depto['id_departamento']; ?>" <?php echo $selected; ?>><?php echo $depto['departamento']; ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="row">
	<h1>Selecciona un dispositivo</h1>
	<div>
		<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
		<button id="boton">Tomar foto</button>
		<p id="estado"></p>
	</div>
	<br>
	<video muted="muted" id="video"></video>
	<canvas id="canvas" style="display: none;"></canvas>
   </div>

  <div class="mb-3">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" />
  </div>

</form>
<script>
    const rfcInput = document.getElementById('rfc');
    rfcInput.addEventListener('blur', validateRFC);

    function validateRFC() {
        const rfc = rfcInput.value.trim().toUpperCase();
        const pattern = /^[A-Z]{4}\d{6}[A-Z0-9]{3}$/;
        const errorDiv = document.getElementById('rfc-error');
        if (rfc && !pattern.test(rfc)) {
            errorDiv.innerText = 'RFC inválido';
            rfcInput.classList.add('is-invalid');
        } else {
            errorDiv.innerText = '';
            rfcInput.classList.remove('is-invalid');
        }
    }

    const curpInput = document.getElementById('curp');
    curpInput.addEventListener('blur', validateCURP);

    function validateCURP() {
        const curp = curpInput.value.trim().toUpperCase();
        const pattern = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z0-9]{2}$/;
        const errorDiv = document.getElementById('curp-error');
        if (curp && !pattern.test(curp)) {
            errorDiv.innerText = 'CURP inválida';
            curpInput.classList.add('is-invalid');
        } else {
            errorDiv.innerText = '';
            curpInput.classList.remove('is-invalid');
        }
    }

    const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $estado = document.querySelector("#estado"),
    $boton = document.querySelector("#boton"),
    $listaDeDispositivos = document.querySelector("#listaDeDispositivos");

const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
        $listaDeDispositivos.remove(x);
};
const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

// La función que es llamada después de que ya se dieron los permisos
// Lo que hace es llenar el select con los dispositivos obtenidos
const llenarSelectConDispositivosDisponibles = () => {

    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = [];
            dispositivos.forEach(dispositivo => {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            if (dispositivosDeVideo.length > 0) {
                // Llenar el select
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
}

(function() {
    // Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
        return;
    }
    //Aquí guardaremos el stream globalmente
    let stream;


    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });



    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
                video: {
                    // Justo aquí indicamos cuál dispositivo usar
                    deviceId: idDeDispositivo,
                }
            },
            (streamObtenido) => {
                // Aquí ya tenemos permisos, ahora sí llenamos el select,
                // pues si no, no nos daría el nombre de los dispositivos
                llenarSelectConDispositivosDisponibles();

                // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                $listaDeDispositivos.onchange = () => {
                    // Detener el stream
                    if (stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                    }
                    // Mostrar el nuevo stream con el dispositivo seleccionado
                    mostrarStream($listaDeDispositivos.value);
                }

                // Simple asignación
                stream = streamObtenido;

                // Mandamos el stream de la cámara al elemento de vídeo
                $video.srcObject = stream;
                $video.play();

                //Escuchar el click del botón para tomar la foto
                //Escuchar el click del botón para tomar la foto
                $boton.addEventListener("click", function() {

                    //Pausar reproducción
                    $video.pause();

                    //Obtener contexto del canvas y dibujar sobre él
                    let contexto = $canvas.getContext("2d");
                    $canvas.width = $video.videoWidth;
                    $canvas.height = $video.videoHeight;
                    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

                    let foto = $canvas.toDataURL(); //Esta es la foto, en base 64

                    $estado.innerHTML = "Enviando foto. Por favor, espera...";
                    fetch("../../../../proyecto_prograweb/constructora/admin/views/empleado/guardar_foto.php", {
                            method: "POST",
                            body: encodeURIComponent(foto),
                            headers: {
                                "Content-type": "image/jpg",
                            }
                        })
                        .then(resultado => {
                            // A los datos los decodificamos como texto plano
                            return resultado.text()
                        })
                        .then(nombreDeLaFoto => {
                            // nombreDeLaFoto trae el nombre de la imagen que le dio PHP
                            console.log("La foto fue enviada correctamente");
                            $estado.innerHTML = `Foto guardada con éxito. Puedes verla <a target='_blank' href='./${nombreDeLaFoto}'> aquí</a>`;
                        })

                    //Reanudar reproducción
                    $video.play();
                });
            }, (error) => {
                console.log("Permiso denegado o error: ", error);
                $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
            });
    }
})();
</script>