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
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/organigrama.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <!-- fontawesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <style>
    .navbar-brand{
      width: 150px!important;
      margin: 0!important;
    }
    .upload-button input[type=file] {
      height: 30px!important;
      margin-top: 50px!important;
    }
  </style>
</head>
<body>
  <!-- Begin page content -->
    <div id="app">
        <div class="container-fluid">
            <div class="detail-gral with-chat" id="arbol">
                <div class="row">
                    <div class="col-md-12 text-center upload-button">
                        <br> <hr>
                        <br><label for="exampleInputEmail1" class="dark-valor">ÁRBOL DE DECISIONES</label><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center upload-button">
                        <br>
                        <p style="text-align: left;">Nota: Los cambios en el árbol se guardan por cada bloque modificado.</p>
                        <br>
                        <div id='organigrama'></div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <script src="js/bootstrap.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
  <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="js/components/app.js"></script>
  <script src="js/organigrama_chat_edit.js"></script>
  <script>
    const URL = "https://backoffice.ideeo.mx/chatbot/";
    
    $(document).ready(function() {     

      const valores = window.location.search;
      const urlParams = new URLSearchParams(valores);
      const nodo = urlParams.get('nodo');

      if( nodo=="" || nodo==null ){
          console.log("Nodo no identificado");
      }else{
        var settings = {
          "url": URL + "flujo/" + nodo,
          "method": "GET",
          "timeout": 0,
          "processData": false,
          "mimeType": "multipart/form-data",
          "contentType": false,
          "headers": {
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        };
        $.ajax(settings).done(function (response) {
          var resp = JSON.parse(response);
          console.log(resp);
          actualizarArbol(resp);
        }).fail(function(d){
          alert("Intenta de nuevo");
        });
      }

    });

    

    function actualizarArbol(datos){
      $("#organigrama").empty();
      // Carga de datos para el organigrama
      organigrama.data = datos;
      // creación del organigrama, se le manda el id del contenedor
      organigrama.create('organigrama');

      var userSelection = document.getElementsByClassName('nodo');
      for(var i = 0; i < userSelection.length; i++) {
        (function(index) {
          userSelection[index].addEventListener("click", function() {
            id_padre = userSelection[index].id;
            $("#padre").val(id_padre);
            $("#padre2").val(id_padre);
            localStorage.setItem('padre',id_padre);
            $("#label-"+id_padre).text("Bloque en edición");
            $("#padre").css("color","red");
            pintarTabla(id_padre);
            setTimeout(function(){
              $("#padre").css("color","#000");
              $("#label-"+id_padre).text("");
            }, 6000);
          })
        })(i);
      }
      return true;
    }
   
    
  </script>
</body>

</html>