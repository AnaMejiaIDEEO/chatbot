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
    </style>
    
    <link rel="stylesheet" href="../assets/static/css/app.css">

  </head>
  <body>
    <!-- Begin page content -->
    <div id="app">
      <div class="bg-primary-1">
        <header class="container ">
          <div class="">
            <nav class="navbar justify-content-between">
              <a class="navbar-brand" href="/">
                <img width="100" class="img-fluid img" src="../assets/images/layout/logo-white.svg" alt="">
              </a>
            </nav>
          </div>
        </header>
      </div>
      <div class="container">
        <div class="row text-right">
          <div class="col-12 mt-5">
            <a href="https://chatbot.ideeo.mx/admin/dashboard.php">
              <button style="font-size: 18px; width: 150px; height: 40px" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> &nbsp;  Nuevo chat </button> <br> <br>
            </a>
          </div>
        </div>
      </div>

      <div class="container">
        <table class="tableDirectorio">
                <thead>
                  <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">Título</th>
                    <!-- <th class="text-center">Fecha</th> -->
                    <th class="text-center">Landing</th>
                    <th class="text-center">Editar</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="chat in chats">
                    <td class="text-center">{{ chat.id }}</td>
                    <td>{{ chat.titulo }}</td>
                    <td class="text-center"><a :href="chat.landing"  target="_blank"><i class="fas fa-file"></i> Abrir</a></td>
                    <td class="text-center"><a :href="'https://chatbot.ideeo.mx/admin/editar.php?chat='+chat.id"><i class="fas fa-edit"></i> Editar</a> </td>
                  </tr>
                </tbody>
              </table>


        
    </div>

    <footer style="margin-top: 20px;" class="main-footer bg-primary-1 py-15">
              <div class="container container--chatbot">
                  <div class="flex flex-column md:flex-row mb-13">
                      <div class="mb-8">
                          <a class="block mb-10 md:mb-15" href="/">
                              <img style="width: 100px; margin-bottom: 20px;" class="max-w-30 md:max-w-37" src="../assets/images/layout/logo-white.svg" alt="">
                          </a>
                      </div>
                  </div>
                  <div class="flex flex-column md:flex-row">
                      <p class="copy tx-12 tx-white md:m-0">
                          © 2022 BBVA México, S.A., Institución de Banca Múltiple, Grupo Financiero BBVA México. Avenida Paseo de la Reforma 510, colonia Juárez, código <br class="hidden xl:block"> postal 06600, alcaldía Cuauhtémoc, Ciudad de México.
                      </p>
                      <span class="tx-secondary-1 tx-medium block md:ml-auto">
                          Creando Oportunidades
                      </span>
                  </div>
              </div>
          </footer> 
    </div>
    <script src="js/env.js"></script>
    <!--<script src="./js/popper.min.js"></script>-->
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
    <script src="js/components/_main.js"></script>
    <script src="js/organigrama_chat.js"></script>
    <script>
      var dataLegales = '';
      var dataList = '';
      var id_padre = '';
      CKEDITOR.replace( 'editor' );
      CKEDITOR.replace( 'editorListas' );
      
      $(document).ready(function() {
        localStorage.removeItem('padre');
        $(".loader").hide();
        $(".with-chat").hide();
        $(".enlace").hide();
        $(".label_link").hide();
        $("#btn-apartados").attr("disabled", true);
        $("#btn-app").attr("disabled", true);
        $(".directorio").hide();

        $("form#data").submit(function(e) {
          e.preventDefault();    
          var formData = new FormData(this);
          var chat = "";
          $("#btn-enviar").hide();
          $(".loader").show();
          

          var settings = {
            "url": "https://backoffice.ideeo.mx/chat",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "mimeType": "multipart/form-data",
            "contentType": false,
            "data": formData,
            "headers": {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
          };
          $.ajax(settings).done(function (response) {
            var resp = JSON.parse(response);
            console.log(resp);
            localStorage.setItem('chat',resp.id);
            localStorage.setItem('plantilla',resp.plantilla);
            $(".with-chat").show();
            chat = localStorage.getItem('chat');
            var config = {
              "url": "https://backoffice.ideeo.mx/arbol/"+chat,
              "method": "GET",
              "timeout": 0,
              "processData": false,
              "headers": {
                  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              }
            };
            $.ajax(config).done(function (response) {
              console.log(response);
              actualizarArbol(response);
              $("#padre").val(response.id);
              localStorage.setItem('padre',response.id);
              $(".loader").hide();
              $("#radio1").attr("disabled", true);
              $("#radio2").attr("disabled", true);
              $("#file").attr("disabled", true);
              $("#titulo").attr("disabled", true);
            });
          }).fail(function(d){
            alert("Intenta de nuevo");
            $(".loader").hide();
            $("#btn-enviar").show();
          });
        });
        

        /* FINALIZAR ARBOL */
        $("#link_final").keyup(function(){
          if( validarLink($("#link_final").val()) ){
            $("#link_final").css('border', 'solid 1px #CED4DA');
            $("#label_link_final").hide();
            $("#btn-finalizar").show();
          }else{
            $("#link_final").css('border', 'solid 1px #FF595A');
            $("#label_link_final").show();
            $("#btn-finalizar").hide();
          }
        });
        
        $("#btn-finalizar").click(function() {
          var msg = $("#msg_final").val();
          var linkf = $("#link_final").val();
          var chat = localStorage.getItem('chat');
          var link = "https://chatbot.ideeo.mx/"+chat+"/index.html";
          var config = {
            "url": "https://backoffice.ideeo.mx/finalizar",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "data": JSON.stringify({
              "mensaje": msg,
              "link": linkf,
              "chat": chat
            }),
            "headers": {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
          };
          $.ajax(config).done(function (response) {
            console.log(response);
            $(".opcion-btn").attr("disabled", true);
            $("#texto-pregunta").attr("disabled", true);
            $("#texto-respuesta").attr("disabled", true);
            $("#btn-imagen").attr("disabled", true);
            $("#btn-agregar-nodo").attr("disabled", true);
            $("#btn-finalizar").hide();
          });
        });

        /* APARTADOS */
        $("#link").keyup(function(){
          if( validarLink($("#link").val()) ){
            $("#link").css('border', 'solid 1px #CED4DA');
            $("#label_link_apartados").hide();
            $("#btn-apartados").attr("disabled", false);
          }else{
            $("#link").css('border', 'solid 1px #FF595A');
            $("#label_link_apartados").show();
            $("#btn-apartados").attr("disabled", true);
          }
        });

        /* APP */
        $("#link_app").keyup(function(){
          if( validarLink($("#link_app").val()) ){
            $("#link_app").css('border', 'solid 1px #CED4DA');
            $("#label_link_app").hide();
            $("#btn-app").attr("disabled", false);
          }else{
            $("#link_app").css('border', 'solid 1px #FF595A');
            $("#label_link_app").show();
            $("#btn-app").attr("disabled", true);
          }
        });
        $(".addLista").click(function() {
          dataList = CKEDITOR.instances.editorListas.getData();
          //Guardar sección
          var set = {
            "url": "https://backoffice.ideeo.mx/seccion",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "data": JSON.stringify({
              "plantilla": localStorage.getItem('plantilla'),
              "titulo": $("#titulo_app").val(),
              "subtitulo": dataList,
              "enlace": $("#link_app").val(),
              "accion": $("#accion_app").val(),
              "btn_copy": $("#btn_app").val(),
            }),
            "headers": {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
          };
          $.ajax(set).done(function (response) {
            console.log(response);
            $("#msg-app").text("Sección agregada");
            $("#titulo_app").val('');
            CKEDITOR.instances.editorListas.setData('');;
            $("#link_app").val('');
            $("#accion_app").val('');
            $("#btn_app").val('');
            $("#btn-app").attr("disabled", true);
            setTimeout(function(){
              $("#msg-app").text("");
            }, 4000);
          }).fail(function(d){
            $("#msg-app").text("Error al agregar la sección.");
          });
        });
        
        $("button.opcion-btn").on('click', function(e) {
          e.preventDefault();
          id_padre = $(this).attr("id");
          console.log("Cambiar nodo: " + id_padre);
          $("#padre").val(id_padre);
          localStorage.setItem('padre',id_padre);
        });

        $(".nodo").on('click', function(e) {
          id_padre = $(this).attr("data-id");
          console.log("Cambiar nodo: " + id_padre);
          $("#padre").val(id_padre);
          localStorage.setItem('padre',id_padre);
        });
       

        /* LEGALES */
        $(".guardar").click(function() {
          dataLegales = CKEDITOR.instances.editor.getData();
          chat = localStorage.getItem('chat');
          var link = "https://chatbot.ideeo.mx/"+chat+"/index.html";

          //Guardar legales en chat
          var set = {
            "url": "https://backoffice.ideeo.mx/legales",
            "method": "POST",
            "timeout": 0,
            "processData": false,
            "data": JSON.stringify({
              "chat": chat,
              "legales": dataLegales
            }),
            "headers": {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
          };
          $.ajax(set).done(function (response) {
            console.log(response);
            $("#msg-legales").text("Datos de legales agregados");
            CKEDITOR.instances.editor.setData('');
            $(".enlace").show();
            $("#enlace-chat").text(link);
            $("#enlace-chat").attr("href", link);
            setTimeout(function(){
              $("#msg-legales").text("");
            }, 4000);
            setTimeout(function(){
              window.location = "https://chatbot.ideeo.mx/admin/dashboard.php"
            }, 6000);
          }).fail(function(d){
            $("#msg-legales").text("Error al agregas datos de legales");
          });
        });

        /* DIRECTORIO */
        $("#btn-directorio").click(function() {
          $(".directorio").show();
        });
        $("#btn-cerrar-dir").click(function() {
          $(".directorio").hide();
        });
        
      });

      function actualizarArbol(datos){
        $("#organigrama").empty();
        // Carga de datos para el organigrama
        organigrama.data = datos;
        // creación del organigrama, se le manda el id del contenedor
        organigrama.create('organigrama');

        var userSelection = document.getElementsByClassName('opcion-btn');
        for(var i = 0; i < userSelection.length; i++) {
          (function(index) {
            userSelection[index].addEventListener("click", function() {
              id_padre = userSelection[index].id;
              $("#padre").val(id_padre);
              localStorage.setItem('padre',id_padre);
              $("#label-"+id_padre).text("Bloque en edición");
              $("#padre").css("color","red");
              setTimeout(function(){
                $("#padre").css("color","#000");
              }, 2000);
            })
          })(i);
        }
        return true;
      }
     
      function validarLink(url){
        var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
        //var regexp = /^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/
        return regexp.test(url);
      }

    </script>
  </body>

  </html>