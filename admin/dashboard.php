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

    .bg-primary-1{
          background-color: #072146;
    }
  </style>

</head>
<body>
  <!-- Begin page content -->
  <div id="app">


    <div class="bg-primary-1">
      <header class="container">
        <div class="">
          <nav class="navbar justify-content-between">
            <a class="navbar-brand" href="/">
              <img width="100" class="img-fluid img" src="../assets/images/layout/logo-white.svg" alt="">
            </a>
            <a style="color: #fff" href="directorio.php" class="btn" id="btn-directorio"> <i class="fas fa-arrow-left"></i> &nbsp; Regresar</a>
          </nav>
        </div>
      </header>
    </div>

    <div class="container">
      <div class="directorio">
        <div class="row justify-content-center">
          <div class="col-10">
            <div class="d-flex justify-content-between" style="height: 60px; margin-bottom:10px;">
              <p for="upload" class="btn dark-valor text-left">Directorio</p>
              <button class="btn btn-light btn-sm" id="btn-cerrar-dir">Cerrar</button>
            </div>            
            <a href="https://chatbot.ideeo.mx/admin/dashboard.php">
              <button class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> &nbsp;  Nuevo chat </button> <br> <br>
            </a>
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
                  <!-- <td>{{ chat.fecha }}</td> -->
                  <td class="text-center"><a :href="chat.landing"  target="_blank">Abrir</a></td>
                  <td class="text-center"><a :href="'https://chatbot.ideeo.mx/admin/editar.php?chat='+chat.id">Editar</a> </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    

    <div id="label-required">
      <div>
        <p>Todos los datos son obligatorios</p>
      </div>
    </div>
    <div class="container">
      <form id="data" method="post" enctype="multipart/form-data">
      <div class="detail-gral mt-5">
        <div class="row">
          <div class="col-md-12 upload-button">
            <div class="row">
              <div class="col-md-12  float-int">
                <p class="dark-valor">
                  Elige un tema
                </p>                        
                <div class="">
                  <input class="form-radio-input" type="radio" id="radio1" value="light" name="tema" v-model="answer1" required>
                  <label class="form-radio-label text-medium" for="radio1">
                    Light
                  </label>
                </div>
                <div class="form-radio mb-4">
                  <input class="form-radio-input" type="radio" id="radio2" value="dark" name="tema" v-model="answer1" required>
                  <label class="form-radio-label text-medium" for="radio2">
                    Dark
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="detail-gral">
        <div class="row">
          <div class="col-md-12 upload-button">
              <div class="row">
                <div class="col-md-12 p-3 float-int">
                  <label for="exampleInputEmail1" class="dark-valor">Elige un fondo</label><br>
                  <div class="col-md-12 p-3 float-int">
                    <button class="btn btn-primary" for="file">Selecciona una Imagen</button>
                    <input type="file" id="file" name="file" accept="image/png, image/jpeg" @change="selectFileFondo($event)" required>
                    <label v-show="imgFondo" class="dark-valor">{{imgFileFondo.name}}</label>
                  </div>
                </div>
              </div>
              <div class="row"> 
                  <button for="upload" class="btn dark-valor text-left">Agregar Título</button>
                  <input type="text" id="titulo" class="" name="titulo" placeholder="Ingresa Titulo" v-model="titulo" required>
              </div>
              <input type="hidden" name="nombre" value="">
              <input type="hidden" name="subtitulo" value="">
              <a href="#arbol">
                <input type="submit" id="btn-enviar" value="Enviar">
              </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12" style="display: flex; justify-content:center">
            <div class="loader"></div>
          </div>
        </div>
      </div> 
      </form>


      <div class="detail-gral with-chat" id="arbol">
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <br> <hr>
            <br><label for="exampleInputEmail1" class="dark-valor">CREA TU ÁRBOL DE DECISIONES</label><br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <br> <br>
            <div id='organigrama'></div>
            <br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="col-md-4 p-3 float-int">
                <p for="upload" class="btn dark-valor text-left">Agregar bloque:</p>
              </div>
            </div>   
            <div class="row"> 
              <div class="col-md-4 p-3 float-int">
                <button @click="selectText(1)" id="texto-pregunta" class="btn btn-primary">Texto bbva</button>
                <input @click="mostraBoton(1)" v-show="textoBbva" type="text" class="" name="respuesta" placeholder="Ingresa un texto" v-model="contenidoText">
                <button v-show="agregarTexto" @click="agregarElementos()" class="btn btn-primary">Agregar</button>
              </div>
              <div class="col-md-4 p-3 float-int">
                <button class="btn btn-primary" id="btn-imagen" for="upfile">Imagen</button>
                <input class="upfile" @change="selectFile($event)" type="file" name="upfile" />
                <label v-show="imgTema" class="dark-valor">{{imgFile.name}}</label>
              </div>
              <div class="col-md-4 p-3 float-int">
                <button @click="selectText(2)" id="texto-respuesta" class="btn btn-primary">Opciones</button>
                <input @click="mostraBoton(2)" v-show="opcionTexto" type="text" class="" name="respuesta" placeholder="Opcion" v-model="contenido">
                <button v-show="agregarOpcion" @click="agregarOpciones()" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="justify-content:center;">
          <div class="col-md-12 text-center upload-button">
            <br>
            <table id="tabla-nodo" class="tableArbol">
              <thead>
                <tr>
                  <th>Tipo</th>
                  <th>Contenido</th>
                  <th>src</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="elemento in elementosLocal">
                  <td>{{ elemento.tipo }}</td>
                  <td>{{ elemento.contenido }}</td>
                  <td>{{ elemento.src }}</td>
                </tr>
                <tr v-for="opcion in opcionesLocal">
                  <td>{{ opcion.tipo }}</td>
                  <td>{{ opcion.contenido }}</td>
                </tr>
              </tbody>
            </table>
            <br> <br>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 text-center upload-button">
            <div class="div-agregar-padre">
              <label for="padre" style="width:200px;">Bloque a editar: </label>
              <input type="text" class="" style="width:70px;" name="padre" id="padre" placeholder="Nodo padre" v-model="padre" disabled>
              <button class="btn btn-primary" @click="addNodes()" id="btn-agregar-nodo" style="width:250px;">Agregar bloque</button>
              <br>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <br> <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="col-md-4 p-3 float-int">
                <p for="upload" class="btn dark-valor text-left">Finalizar árbol:</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 upload-button">
            <input type="text" id="msg_final" class="" name="msg_final" placeholder="Mensaje final">
            <input type="url" id="link_final" class="" name="link_final" placeholder="Link final"> &nbsp; 
            <label id="label_link_final" class="label_link"> &nbsp; <i> &nbsp; El link no es una url válida</i></label> <br> <br>
            <a href="#secciones">
              <button class="btn btn-primary" id="btn-finalizar" style="width:250px;">Finalizar árbol</button>
            </a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <br> <hr>
          </div>
        </div>
        <div class="row" id="secciones">
          <div class="col-md-12 upload-button text-center">
            <br>
            <p class="p-instrucciones"> Árbol de desiciones creado.</p>
            <p class="p-instrucciones"> Completa las siguientes secciones para generar la landing.</p>
          </div>
        </div>
      </div>
      
      <div class="detail-gral with-chat">
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="container-form">
                <form>
                  <label class="dark-valor text-negro">Crear apartados</label>
                  <input type="text" id="titulo" class="" name="apartados" placeholder="Titulo" v-model="apartados.titulo">
                  <input type="text" id="subtitulo" class="" name="apartados" placeholder="Subtitulo" v-model="apartados.subtitulo">
                  <input type="text" id="accion" class="" name="apartados" placeholder="Acción" v-model="apartados.accion">
                  <input type="url" id="link" class="" name="apartados" placeholder="Link" v-model="apartados.link"> <br>
                  <label id="label_link_apartados" class="label_link"> &nbsp; <i> &nbsp; El link no es una url válida</i></label>
                  <input type="text" id="btn" class="" name="apartados" placeholder="Copy del botón" v-model="apartados.btn"> 
                </form>
                <button class="btn btn-primary" id="btn-apartados" @click="seccionAdd()" :disabled="!selectData">Agregar sección</button>
                <label v-show="msgAgregarSeccion" class="msg-confirm">{{msgAddSeccion}}</label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="detail-gral with-chat">
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="container-form">
                <label class="dark-valor text-negro">App BBVA</label>
                <input type="text" id="titulo_app" class="" name="app" placeholder="Titulo" v-model="appBbva.titulo"> <br>
                <label class="dark-valor text-negro">Listas</label>
                <div id="div-listas">
                  <div id="editorListas">
                      <p>Ingresar Lista</p>
                  </div>
                </div>
                <input type="text" id="accion_app" class="" name="app" placeholder="Acción" v-model="appBbva.accion">
                <input type="url" id="link_app" class="" name="app" placeholder="Link" v-model="appBbva.link"> <br>
                <label id="label_link_app" class="label_link"> &nbsp; <i> &nbsp; El link no es una url válida</i></label>
                <input type="text" id="btn_app" class="" name="app" placeholder="Copy del botón" v-model="appBbva.btn">
                <button class="btn btn-primary addLista" id="btn-app">Agregar sección</button>
                <label class="msg-confirm" id="msg-app"></label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="detail-gral with-chat">
        <div class="row">
          <div class="col-md-12 text-center upload-button">
              <div class="row"> 
                <div class="container-form">
                  <label class="dark-valor text-negro">Legales</label>
                  <div id="editor">
                      <p>Editar Legales</p>
                  </div>
                  <div>
                    <br>
                    <!-- <button class="btn btn-primary guardar" @click="addLegales()">Guardar</button> -->
                    <button class="btn btn-primary guardar">Guardar</button>
                    <label class="msg-confirm" id="msg-legales"></label>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

      <div class="detail-gral">
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="container-form">
                <br>
                <label class="dark-valor text-negro enlace">Landing para el chat creado: </label>
                <label class="dark-valor text-negro enlace">
                  <a href="" id="enlace-chat"></a>
                </label>
                <br> <br>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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