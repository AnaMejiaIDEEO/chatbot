<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="./favicon.ico">
  <title>BBVA</title>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script> -->
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
          <form id="data" method="post">
            <label>Correo electrónico</label>
            <input type="text" id="email" class="fadeIn second" placeholder="example@example.com" required>
            <label>Contraseña</label>
            <input type="password" id="password" class="fadeIn third" placeholder="*****" required>
            <!-- <a class="link-pass" href="#">Olvide Contraseña</a><br> -->
            <br>
            <!--<div class="terms">
              <p>El CIM (Centro Interactivo de Marketing), es una plataforma digital e informática creada, desarrollada y puesta en funcionamiento por su propietaria Gráficas Corona JE, S.A. de C.V., misma que cuenta con los respectivos derechos de autor y que fue implementada única y exclusivamente para recabar datos relacionados con el aviso recibo emitido por la Comisión Federal Electricidad por lo que cualquier usuario por el solo hecho de ingresar a este sistema se compromete y obliga expresamente a mantener en la más estricta confidencialidad respecto de todos los documentos, formularios y en general a toda la información a la que tenga acceso o se le proporcione para los fines del CIM, por lo que se compromete a no divulgar dicha información a ningún tercero, salvo orden o mandato judicial o que así se tenga que hacer en cumplimiento a las instrucciones que previamente y por escrito lo indique las bases de uso del CIM. Para efectos del presente aviso se considerará confidencial, toda aquella información que sea proporcionada a través de CIM ya sea que el usuario la haya adquirido accidentalmente o de forma directa a través del CIM cuyo acceso pueda ser pero no se limita a informes, medios escritos o digitales, en red, medios de almacenamiento informáticos o que se encuentren o consten en cualquier otra forma de almacenaje conforme a la tecnología existente o pendiente de existir. En ese contexto el usuario se deberá abstener de utilizar la información del CIM para otros fines que no sean los expresamente previstos por el señalado sistema informático y por ende tampoco podrá usarla para beneficio propio o el de terceros, respetando en todo momento los derechos de autor que le corresponden a Gráficas Corona JE, S.A. de C.V. como propietario del CIM, así como el hecho de que la información que éste sistema contiene está a resguardo por la señalada persona moral, por lo que el usuario se compromete además a no emitir publicidad, boletines informativos ni conceder entrevistas en relación con la información catalogada como confidencial.</p>
            </div>-->
            <!-- <div class="">
              <input type="radio" name="terms">
              <label class="radio">ACEPTO EL AVISO DE CONFIDENCIALIDAD</label> 
            </div> -->
             &nbsp; <label class="msg-confirm" id="msg-response"></label> <br>
            <div class="text-center">
            <input type="submit" class="center-button fadeIn fourth" value="Iniciar sesión">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    $(document).ready(function() {

      $("form#data").submit(function(e) {
        e.preventDefault();
        var settings = {
          "url": "https://backoffice.ideeo.mx/chatbot/login",
          "method": "POST",
          "timeout": 0,
          "processData": false,
          "contentType": false,
          "data": JSON.stringify({
            "usr": $("#email").val(),
            "pwd": $("#password").val(),
          }),
          "headers": {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        };
        $.ajax(settings).done(function (response) {
          console.log(response);
          if( response.auth == 1 ){
            localStorage.setItem('user',$("#email").val());
            localStorage.setItem('token',response.token);
            window.location.href = "directorio.php";
          }else{
            $("#msg-response").text(response.msg);
            setTimeout(function(){
              $("#msg-response").text("");
              $("#email").val('');
              $("#password").val('');
            }, 4000);
          }
        }).fail(function(d){
          console.log(d);
          $("#msg-response").text(" Inténtalo de nuevo");
          setTimeout(function(){
            $("#msg-response").text("");
              $("#email").val('');
              $("#password").val('');
          }, 4000);
        });
      });
    });
  </script>
</body>
</html>