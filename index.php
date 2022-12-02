<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./favicon.ico">
  <title>BBVA</title>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" integrity="sha384-wESLQ85D6gbsF459vf1CiZ2+rr+CsxRY0RpiF1tLlQpDnAgg6rwdsUF1+Ics2bni" crossorigin="anonymous">

</head>

<body class="bg_login_color">
  <div class="bg_login">
    <div id="app"></div>
    <div class="wrapper fadeInDown">
      <div id="formContent">
        <img class="logo-form" src="./img/logo-blue.svg">
        <!-- Tabs Titles -->
        <p class="info-title">Log in</p>
    
        <!-- Login Form -->
        <div class="container-form">
          <form>
            <label>Correo electrónico</label>
            <input type="text" id="login" class="fadeIn second" name="login" placeholder="example@exmaple.com">
            <label>Clave</label>
            <input type="password" id="password" class="fadeIn third" name="login" placeholder="*****">
            <a class="link-pass" href="#">Olvide Contraseña</a><br>
            <br>
            <!--<div class="terms">
              <p>El CIM (Centro Interactivo de Marketing), es una plataforma digital e informática creada, desarrollada y puesta en funcionamiento por su propietaria Gráficas Corona JE, S.A. de C.V., misma que cuenta con los respectivos derechos de autor y que fue implementada única y exclusivamente para recabar datos relacionados con el aviso recibo emitido por la Comisión Federal Electricidad por lo que cualquier usuario por el solo hecho de ingresar a este sistema se compromete y obliga expresamente a mantener en la más estricta confidencialidad respecto de todos los documentos, formularios y en general a toda la información a la que tenga acceso o se le proporcione para los fines del CIM, por lo que se compromete a no divulgar dicha información a ningún tercero, salvo orden o mandato judicial o que así se tenga que hacer en cumplimiento a las instrucciones que previamente y por escrito lo indique las bases de uso del CIM. Para efectos del presente aviso se considerará confidencial, toda aquella información que sea proporcionada a través de CIM ya sea que el usuario la haya adquirido accidentalmente o de forma directa a través del CIM cuyo acceso pueda ser pero no se limita a informes, medios escritos o digitales, en red, medios de almacenamiento informáticos o que se encuentren o consten en cualquier otra forma de almacenaje conforme a la tecnología existente o pendiente de existir. En ese contexto el usuario se deberá abstener de utilizar la información del CIM para otros fines que no sean los expresamente previstos por el señalado sistema informático y por ende tampoco podrá usarla para beneficio propio o el de terceros, respetando en todo momento los derechos de autor que le corresponden a Gráficas Corona JE, S.A. de C.V. como propietario del CIM, así como el hecho de que la información que éste sistema contiene está a resguardo por la señalada persona moral, por lo que el usuario se compromete además a no emitir publicidad, boletines informativos ni conceder entrevistas en relación con la información catalogada como confidencial.</p>
            </div>-->
            <div class="">
              <input type="radio" name="terms">
              <label class="radio">ACEPTO EL AVISO DE CONFIDENCIALIDAD</label> 
            </div>
            <div class="text-center">
            <input type="button" id="ref" class="center-button fadeIn fourth" value="Iniciar sesión">
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
  <!--<footer class="text-center footer-in">
    <img src="./img/cim/by.png">
    <img src="./img/cim/ideeo.png">
  </footer>-->

  <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    var app2 = new Vue({
      el: '#app',
      data: {
        result: null,
        message: 'You loaded this page on ' + new Date().toLocaleString()
      },
      created() {

        const URL = "https://backopspace.ideeo.mx/board/general_detail/";

        const header = { 
          "Content-Type": "application/json",
          'Accept': 'application/json'
        }
        const params = {
          "event": 'OpenSpace', 
          "month":'09'
        };
        const a = axios({ 
          method: 'post', 
          url: URL,
          headers: {'Content-Type': 'application/json', 'Accept': 'application/json'},
          data: params,
          })
          .then((result) => {
            console.log(result.data);
          //this.result = result.data;
          //console.log(result);
        })
      }
    })
  </script>

  <script>
    $(document).ready(function() {

      /*$.ajax({
        contentType: 'application/json',
        data: JSON.stringify({ "event": "OpenSpace",  "month": "09" }),
        dataType: 'json',
        success: function(data){
            console.log("device control succeeded");
        },
        error: function(){
          console.log("Device control failed");
        },
        processData: false,
        type: 'GET',
        url: 'https://backopspace.ideeo.mx/board/general_detail/'
      });*/

      $( "#ref" ).click(function() {
        window.location.href = "views/dashboard.php";
      });
    });
  </script>
</body>
</html>