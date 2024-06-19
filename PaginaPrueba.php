<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Asignaciones de cita </title>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .circular-checkbox {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      width: 15px;
      height: 15px;
      margin-right: 10px;
      border-radius: 100%;
      border: 1px solid #000;
    }

    .circular-checkbox:checked {
      background-color: #1036b4af;
    }

    .row {
      display: flex;
      align-items: left;
    }

    .row .column {
      flex: 1;

    }

    .center-elements {
      display: flex;
      justify-content: center;


    }

    .column label {
      display: block;
      padding: 5px;
      margin: 10px;
      width: 100%;
      box-sizing: border-box;
    }

    .column input {
      display: block;
      padding: 5px;
      margin: 10px;
      box-sizing: border-box;
    }

    .column label {
      text-align: left;
    }


    input[type="submit"] {
      background-color: rgb(65, 172, 3);
      color: white;
      padding: 12px 50px;
      border: none;
      cursor: pointer;
      border-radius: 10px;
      font-family: Arial, sans-serif;
      font-weight: bold;
      font-size: 16px;
      transition: transform 0.3s;
    }

    .input:hover {
      transform: scale(0.9);
    }

    .cuadro {
      border: 2px solid #516ad888;
      background-color: #4d48482c;
    }

    .texto-justificado {
      text-align: justify;
    }

    .centrar-imagen {
      display: flex;
      justify-content: center;
      align-items: center;

    }

    .a-blanco {
      color: white;
      text-decoration: none;
    }

    .textoPeque {
      font-size: 14px;
    }

    .textoMed {
      font-size: 20px;
    }

    header {
      display: flex;
      background-color: rgb(2, 36, 100);
      padding: 1%;

    }

    .underline-on-hover:hover {
      text-decoration: underline;
      text-decoration-color: rgb(134, 238, 74);
      text-decoration-thickness: 3px;
      text-decoration-skip-ink: none;
    }

    footer {
      background-color: rgb(2, 36, 100);
      padding: 30px;
      color: white;
      text-align: center;
    }

    nav {
      display: flex;
      justify-content: center;
    }

    ul {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    li {
      display: inline-block;
      margin: 0 15px;
    }

    a {
      color: #fff;
      text-decoration: none;
      margin-right: 15px
    }

    @media screen and (max-width: 600px) {
      nav {
        flex-direction: column;
        align-items: center;
      }

      li {
        display: block;
        margin: 10px 0;
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', (event) => {
      // Función para formatear la fecha y hora en el formato requerido por datetime-local
      function getCurrentDateTime() {
        const ahora = new Date();
        const año = ahora.getFullYear();
        const mes = String(ahora.getMonth() + 1).padStart(2, '0');
        const dia = String(ahora.getDate()).padStart(2, '0');
        const hora = String(ahora.getHours()).padStart(2, '0');
        const minuto = String(ahora.getMinutes()).padStart(2, '0');
        return `${año}-${mes}-${dia}T${hora}:${minuto}`;
      }

      // Establecer el valor mínimo del input con la fecha y hora actual
      const fechaInput = document.getElementById('fecha');
      fechaInput.min = getCurrentDateTime();

      fechaInput.addEventListener('keypress', (e) => {
        e.preventDefault();
      });

      fechaInput.addEventListener('keydown', (e) => {
        e.preventDefault();
      });

      // NEGAR LA EDICION DEL NOMBRE DE USUARIO
      const userName = document.getElementById('cliente');
      userName.addEventListener('keypress', (e) => {
        e.preventDefault();
      });

      userName.addEventListener('keydown', (e) => {
        e.preventDefault();
      });

    });
  </script>

  <script>

    document.addEventListener("DOMContentLoaded", function () {

      var checkbox1 = document.getElementById("car");
      var checkbox2 = document.getElementById("descar");

      checkbox1.addEventListener("change", function () {

        if (checkbox1.checked) {
          checkbox2.checked = false;
        }
      });

      checkbox2.addEventListener("change", function () {

        if (checkbox2.checked) {
          checkbox1.checked = false;
        }
      });

    });

  </script>

<script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error')) {
                const errorMessage = urlParams.get('error');
                alert("Error: " + decodeURIComponent(errorMessage));
                window.location.href = 'PaginaPrueba.php';
            }
        };
</script>

  <script>
    window.addEventListener('DOMContentLoaded', function () {
      var urlParams = new URLSearchParams(window.location.search);
      var SuccessMsg = urlParams.get('success');

      if (SuccessMsg) {
        alert('Cita creada exitosamente'); // Muestra el mensaje de error en una alerta

        // Recarga la página después de mostrar el mensaje de error
        window.location.href = 'PaginaPrueba.php';
      }
    });
  </script>

  <script>
    function verificarCheckboxes() {
      var checkbox1 = document.getElementById('car');
      var checkbox2 = document.getElementById('descar');

      if (!checkbox1.checked && !checkbox2.checked) {
        alert('CUIDADO: Debes seleccionar al menos uno de los checkboxes.');
        return false; // Evita el envío del formulario
      }
    }
  </script>


  </script>

</head>

<body style="background-color: #f0f0f0;">

  <?php
  if (!isset($_COOKIE['user']) || $_COOKIE['user'] !== 'authenticated') {
      header("Location: login.html");
      exit();
  }
  $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
  ?>

  <header>
    <nav>
      <ul>
        <li>

          <b><a href="PaginaPrueba.php"><span class="underline-on-hover">Asignación de citas</span></a></b>
          <b><a href="PaginaCierre.html"><span class="underline-on-hover">Cierre de citas</span></a></b>
          <b><a href="PaginaCancelacion.html"><span class="underline-on-hover">Cancelación de citas</span></a></b>
          <b><a><span class="underline-on-hover">Anulación de citas</span></a></b>
          <b><a href="logout.php"><span class="underline-on-hover">Cerrar sesión</span></a></b>

        </li>
      </ul>
    </nav>
  </header>


  <div class="center-elements">

    <h1>SOLICITUD DE CITA A CARROTANQUE</h1>
  </div>
  <br>


  <div class="center-elements">
    <form action="ServidorPagina.php" method="POST" onsubmit="return verificarCheckboxes()">


      <div class="row">
        <div class="column">
          <label for="placa">Cliente:</label>
        </div>
        <div class="column">
          <input type="text" class="cuadro" id="cliente" name="cliente" value="<?php echo htmlspecialchars($username);?>"></textarea><br><br>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="car">Operación de cargue:</label>
        </div>
        <div class="column">
          <input type="checkbox" id="car" name="car" class="circular-checkbox">
        </div>

      </div>

      <div class="row">
        <div class="column">
          <label for="descar">Operación de descargue:</label>
        </div>
        <div class="column">
          <input type="checkbox" id="descar" name="descar" class="circular-checkbox"><br><br>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="fecha">Fecha y hora de ingreso: </label>
        </div>
        <div class="column">
          <input type="datetime-local" id="fecha" class="cuadro" name="fecha" required><br><br>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="cedula">Cedula de conductor:</label>
        </div>
        <div class="column">
          <input type="number" class="cuadro" id="cedula" name="cedula" required><br><br>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="placa">Ingrese placa de vehiculo: </label>
        </div>
        <div class="column">
          <input type="text" class="cuadro" id="placa" name="placa" minlength="6" maxlength="6"
            required></textarea><br><br>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="numero">No Autorización manifiesto: </label>
        </div>
        <div class="column">
          <input type="number" class="cuadro" id="numero" name="numero" min="70000000" required><br><br>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="nit">Nit empresa transportadora: </label>
        </div>
        <div class="column">
          <input type="number" placeholder="Con digito de verifcación" class="cuadro" id="nit" name="nit" maxlength="10"
            required><br><br>
        </div>
      </div>


      <div class="center-elements">
        <div class="row">
          <input type="submit" class='input' value="Enviar">
        </div>
      </div>

      <br><br>

      <div id="error-message">
        <?php
            if (isset($_GET['error'])) {
              $errorMessage = $_GET['error'];
              
            }
            ?>
      </div>

    </form>

  </div>

  <footer>

    <div class="row">
      <div class="column">
        <br>
        <div class="centrar-imagen">

          <img src="imagenes/Logo-color-blanco.png" alt="Descripción de la imagen" width="230">

        </div>
      </div>

      <div class="column">
        <br>
        <div class="textoMed"><b>Nosotros</b></div>
        <div class="texto-justificado">
          <p class='textoPeque'>SOCIEDAD PORTUARIA DEL DIQUE S.A. es un terminal de servicio
            público en la bahía de Cartagena ubicado al interior de la Zona Franca más importante de la ciudad.
          </p>
        </div>
      </div>

      <div class="column">

        <div class="centrar-imagen">

          <br><br><br>
          <div class="textoMed"><b>Navegación</b></div>

        </div>

      </div>

      <div class="column">

        <br>
        <div class="textoMed"><b> Contáctanos</b></div><br>


        <div class="textoPeque">
          <div class="row"><img src="imagenes/casa.png" alt="icono" width="17">Zona industrial de Mamonal , KM 13<br>
          </div>
          <div class="row"><img src="imagenes/telefono.png" alt="icono" width="17"> Teléfono: (575) 651 7110 <br></div>
          <div class="row">
            <img src="imagenes/whatsapp.png" alt="icono" width="17"><a href="https://wa.me/+573013669069"
              class="a-blanco"> Celular: 301 366 9069</a><br>
          </div>
          <div class="row">
            <img src="imagenes/email.png" alt="icono" width="4%"> <a href="mailto:control@spdique.com"
              class="a-blanco">control@spdique.com</a>
          </div>
        </div>
      </div>

    </div>
  </footer>



</body>

</html>