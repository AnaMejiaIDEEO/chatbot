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
    <header class="container">
      <div class="">
        <nav class="navbar justify-content-between">
          <a class="navbar-brand" href="/">
            <img width="100" class="img-fluid img" src="img/logo-blue.svg" alt="">
          </a>
          <button class="btn btn-light my-2 my-sm-0" id="btn-directorio"> <i class="fas fa-angle-down"></i> &nbsp; Directorio</button>
        </nav>
      </div>
    </header>
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
                  <th class="text-center">Landing</th>
                  <th class="text-center">Editar</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="chat in chats">
                  <td class="text-center">{{ chat.id }}</td>
                  <td>{{ chat.titulo }}</td>
                  <td class="text-center"><a :href="chat.landing"  target="_blank">Abrir</a></td>
                  <td class="text-center"><a :href="'https://chatbot.ideeo.mx/admin/editar.html?chat='+chat.id">Editar</a> </td>
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
                  Tema
                </p>                        
                <div class="">
                  <input class="form-radio-input" type="radio" id="radio1" value="light" name="tema" required>
                  <label class="form-radio-label text-medium" for="radio1">
                    Light
                  </label>
                </div>
                <div class="form-radio mb-4">
                  <input class="form-radio-input" type="radio" id="radio2" value="dark" name="tema" required>
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
                  <label for="exampleInputEmail1" class="dark-valor">Fondo: </label> &nbsp; 
                  <img src="" alt="" id="img-fondo" style="width:400px; margin: 0px 20px;" v-if="imgFondo === false">
                  <div class="col-md-12 p-3 float-int">
                    <button class="btn btn-primary" for="file">Cambiar imagen</button>
                    <input type="file" id="file" name="file" accept="image/png, image/jpeg" @change="selectFileFondo($event)" required>
                    <label v-show="imgFondo" class="dark-valor">{{imgFileFondo.name}}</label>
                  </div>
                </div>
              </div>
              <div class="row"> 
                  <button for="upload" class="btn dark-valor text-left">Título</button> <br>
                  <input type="text" id="titulo" class="" name="titulo" placeholder="Ingresa Titulo" required>
              </div>
          </div>
        </div>
      </div> 
      </form>


      <div class="detail-gral with-chat">
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="container-form">
                <label class="dark-valor text-negro">Apartado:</label>
                <input type="text" id="titulo2" class="" name="apartados" placeholder="Titulo">
                <input type="text" id="subtitulo" class="" name="apartados" placeholder="Subtitulo">
                <input type="text" id="accion" class="" name="apartados" placeholder="Acción">
                <input type="url" id="link" class="" name="apartados" placeholder="Link"> <br>
                <label id="label_link_apartados" class="label_link"> &nbsp; <i> &nbsp; El link no es una url válida</i></label>
                <input type="text" id="btn" class="" name="apartados" placeholder="Copy del botón"> 
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
                <label class="dark-valor text-negro">App BBVA:</label>
                <input type="text" id="titulo_app" class="" name="app" placeholder="Titulo"> <br>
                <label class="dark-valor text-negro">Listas</label>
                <div id="div-listas">
                  <div id="editorListas">
                      <p>Ingresar Lista</p>
                  </div>
                </div>
                <input type="text" id="accion_app" class="" name="app" placeholder="Acción">
                <input type="url" id="link_app" class="" name="app" placeholder="Link"> <br>
                <label id="label_link_app" class="label_link"> &nbsp; <i> &nbsp; El link no es una url válida</i></label>
                <input type="text" id="btn_app" class="" name="app" placeholder="Copy del botón">
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
                    <button class="btn btn-primary" id="btn-actualizar">Actualizar datos</button>
                    <label class="msg-confirm" id="msg-legales"></label>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>


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


        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="col-md-4 p-3 float-int">
                <p for="upload" class="btn dark-valor text-left">
                  Actualizar bloque:
                  <input type="text" class="" style="width:70px;" name="padre" id="padre" placeholder="Nodo padre" disabled>
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="justify-content:center;">
          <div class="col-md-4 text-center upload-button">
            <form class="form-bloque" id="form-bloque-elementos" method="post" enctype="multipart/form-data">
            <table id="tabla-nodo" class="tableArbol">
              <thead>
                <tr>
                  <th>Texto</th>
                </tr>
              </thead>
              <tbody id="data-bloque-elementos">
                
              </tbody>
              <tr>
                <td><input class="btn-guardar" id="btn-guardar-elementos" type="submit" value="Guardar"></td>
              </tr>
            </table>
            </form>
            <br> <br>
          </div>
          <div class="col-md-4 text-center upload-button">
            <form class="form-bloque" id="form-bloque-imagenes" method="post" enctype="multipart/form-data">
            <table id="tabla-nodo" class="tableArbol">
              <thead>
                <tr>
                  <th>Imagen</th>
                  <th>Cambiar</th>
                </tr>
              </thead>
              <tbody id="data-bloque-imagenes">
                <tr id="tr-img-0" class="tr-img">
                  <td>
                    <img src="" alt="" id="img-fondo-0" style="width:70px; margin: 2px;">
                    <label v-show="imgTema0" class="dark-valor">{{imgFile0.name}}</label>
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm" for="upfile">Imagen</button>
                    <input class="upfile" @change="selectFile0($event)" type="file" name="upfile" />
                  </td>
                </tr>
                <tr id="tr-img-1" class="tr-img">
                  <td>
                    <img src="" alt="" id="img-fondo-1" style="width:70px; margin: 2px;">
                    <label v-show="imgTema1" class="dark-valor">{{imgFile1.name}}</label>
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm" for="upfile">Imagen</button>
                    <input class="upfile" @change="selectFile1($event)" type="file" name="upfile" />
                  </td>
                </tr>
                <tr id="tr-img-2" class="tr-img">
                  <td>
                    <img src="" alt="" id="img-fondo-2" style="width:70px; margin: 2px;">
                    <label v-show="imgTema2" class="dark-valor">{{imgFile2.name}}</label>
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm" for="upfile">Imagen</button>
                    <input class="upfile" @change="selectFile2($event)" type="file" name="upfile" />
                  </td>
                </tr>
              </tbody>
              <tr>
                <td>
                  <br> <br>
                  <input class="btn-guardar" id="btn-guardar-imagenes" type="button" @click="saveNewImg()" value="Guardar"></td>
              </tr>
            </table>
            </form>
            <br> <br>
          </div>
          <div class="col-md-4 text-center upload-button">
            <form class="form-bloque" id="form-bloque-opciones" method="post" enctype="multipart/form-data">
            <table id="tabla-nodo" class="tableArbol">
              <thead>
                <tr>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody id="data-bloque-opciones">
                
              </tbody>
              <tr>
                <td><input class="btn-guardar" id="btn-guardar-opciones" type="submit" value="Guardar"></td>
              </tr>
            </table>
            </form>
            <br> <br>
          </div>
        </div>
        <label class="msg-confirm" id="msg-forms"></label>
        <hr>    

        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <div class="row"> 
              <div class="col-md-5 pt-3 float-int">
                <p for="upload" class="btn dark-valor text-left">
                  Complementar bloque:
                  <input type="text" class="" style="width:70px;" name="padre" id="padre2" placeholder="Nodo padre" disabled>
                </p>
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
              <!-- <label for="padre" style="width:200px;">Bloque a editar: </label>
              <input type="text" class="" style="width:70px;" name="padre" id="padre" placeholder="Nodo padre" disabled> -->
              <button class="btn btn-primary" @click="addNodes()" id="btn-agregar-nodo" style="width:250px;">Agregar elementos</button>
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
                <p for="upload" class="btn dark-valor text-left">Bloque final:</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 upload-button">
            <input type="text" id="msg_final" class="" name="msg_final" placeholder="Mensaje final">
            <input type="url" id="link_final" class="" name="link_final" placeholder="Link final"> &nbsp; 
            <label id="label_link_final" class="label_link"> &nbsp; <i> &nbsp; El link no es una url válida</i></label> <br> <br>
            <button class="btn btn-primary" id="btn-finalizar" style="width:250px;">Finalizar árbol</button>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center upload-button">
            <br> <hr>
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
  <script src="js/organigrama_chat_edit.js"></script>
  <script>
    const URL = "https://backoffice.ideeo.mx/chatbot/";
    var dataLegales = '';
    var dataList = '';
    var id_padre = '';
    CKEDITOR.replace( 'editor' );
    CKEDITOR.replace( 'editorListas' );
    
    $(document).ready(function() {
      localStorage.removeItem('chat');
      $(".directorio").hide();
      $(".label_link").hide();
      $(".btn-guardar").attr("disabled", true);
      $("#tr-img-0").hide();
      $("#tr-img-1").hide();
      $("#tr-img-2").hide();

      const valores = window.location.search;
      const urlParams = new URLSearchParams(valores);
      const chat = urlParams.get('chat');

      if( chat=="" || chat==null ){
          window.location = "dashboard.php"
      }else{
        var settings = {
          "url": URL + "full/" + chat,
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
          localStorage.setItem('chat',chat);
          pintarDatos(resp);
        }).fail(function(d){
          alert("Intenta de nuevo");
        });
      }


      /* FINALIZAR ARBOL */
      /* $("#link_final").keyup(function(){
        if( validarLink($("#link_final").val()) ){
          $("#link_final").css('border', 'solid 1px #CED4DA');
          $("#label_link_final").hide();
          $("#btn-finalizar").show();
        }else{
          $("#link_final").css('border', 'solid 1px #FF595A');
          $("#label_link_final").show();
          $("#btn-finalizar").hide();
        }
      }); */
      
      $("#btn-finalizar").click(function() {
        var msg = $("#msg_final").val();
        var linkf = $("#link_final").val();
        var chat = localStorage.getItem('chat');
        var config = {
          "url": "https://backoffice.ideeo.mx/finalizar/update",
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
     

      /* ACTUALIZAR */
      $("#btn-actualizar").click(function() {
        if( !validarDatos() ){
          $("#msg-legales").text("Todos los datos son obligatorios.");
          setTimeout(function(){
            $("#msg-legales").text("");
          }, 4000);
          return false;
        }

        var chat = localStorage.getItem('chat');
        dataLegales = CKEDITOR.instances.editor.getData();
        dataList = CKEDITOR.instances.editorListas.getData();

        var fondoLocal = "";

        if(localStorage.getItem('src-fondo') !== undefined && localStorage.getItem('src-fondo')){
          fondoLocal = localStorage.getItem('src-fondo');
        }
        
        var set = {
          "url": URL + "update/" + chat,
          "method": "POST",
          "timeout": 0,
          "processData": false,
          "data": JSON.stringify({
            "tema": $('input:radio[name=tema]:checked').val(),
            "fondo": fondoLocal,
            "titulo": $("#titulo").val(),
            "apartado_titulo": $("#titulo2").val(),
            "apartado_subtitulo": $("#subtitulo").val(),
            "apartado_accion": $("#accion").val(),
            "apartado_enlace": $("#link").val(),
            "apartado_btn": $("#btn").val(),
            "app_titulo": $("#titulo_app").val(),
            "app_subtitulo": dataList,
            "app_accion": $("#accion_app").val(),
            "app_enlace": $("#link_app").val(),
            "app_btn": $("#btn_app").val(),
            "legales": dataLegales
          }),
          "headers": {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        };
        $.ajax(set).done(function (response) {
          console.log(response);
          $("#msg-legales").text("Datos actualizados");
          setTimeout(function(){
            $("#msg-legales").text("");
          }, 4000);
        }).fail(function(d){
          $("#msg-legales").text("Error al actualizar los datos");
        });
      });

      /* DIRECTORIO */
      $("#btn-directorio").click(function() {
        $(".directorio").show();
      });
      $("#btn-cerrar-dir").click(function() {
        $(".directorio").hide();
      });

      /* FORMS EDICION*/
      $("form#form-bloque-elementos").submit(function(e) {
        e.preventDefault();    
        var data1 = "";
        var elem = [];
        var e = "";
        for (i = 0; i < localStorage.getItem('nElementos'); i++) {
          elem.push($("#contenido-"+i).val());
        }
        var set1 = {
          "url": "https://backoffice.ideeo.mx/elemento/edicion",
          "method": "POST",
          "timeout": 0,
          "processData": false,
          "data": JSON.stringify({
            "data": elem,
            "tipo": "texto",
            "chat": localStorage.getItem('chat'),
            "nodo": localStorage.getItem('padre'),
          }),
          "headers": {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        };
        $.ajax(set1).done(function (resp) {
          console.log(resp);
          $("#msg-forms").text("Datos actualizados");
          setTimeout(function(){
            $("#msg-forms").text("");
          }, 4000);
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
          });
        }).fail(function(d){
          alert("Intenta de nuevo");
        });
      });

      /* $("form#form-bloque-imagenes").submit(function(e) {
        e.preventDefault();    
        var data1 = "";
        var img = [];
        var im = "";
        for (i = 0; i < localStorage.getItem('nImagenes'); i++) {
          img.push($("#img-fondo-"+i).val());
        }
        var set1 = {
          "url": "https://backoffice.ideeo.mx/elemento/edicion",
          "method": "POST",
          "timeout": 0,
          "processData": false,
          "data": JSON.stringify({
            "data": img,
            "tipo": "img",
            "chat": localStorage.getItem('chat'),
            "nodo": localStorage.getItem('padre'),
          }),
          "headers": {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        };
        $.ajax(set1).done(function (resp) {
          console.log(resp);
          $("#msg-forms").text("Datos actualizados");
          setTimeout(function(){
            $("#msg-forms").text("");
          }, 4000);
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
          });
        }).fail(function(d){
          alert("Intenta de nuevo");
        });
      }); */
      $("form#form-bloque-opciones").submit(function(e) {
        e.preventDefault();    
        var data1 = "";
        var ops = [];
        var o = "";
        for (i = 0; i < localStorage.getItem('nOpciones'); i++) {
          ops.push($("#contenido-op-"+i).val());
        }
        var set1 = {
          "url": "https://backoffice.ideeo.mx/opcion/edicion",
          "method": "POST",
          "timeout": 0,
          "processData": false,
          "data": JSON.stringify({
            "data": ops,
            "chat": localStorage.getItem('chat'),
            "nodo": localStorage.getItem('padre'),
          }),
          "headers": {
              "Content-Type": "application/json",
              "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        };
        $.ajax(set1).done(function (resp) {
          console.log(resp);
          $("#msg-forms").text("Datos actualizados");
          setTimeout(function(){
            $("#msg-forms").text("");
          }, 4000);
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
          });
        }).fail(function(d){
          alert("Intenta de nuevo");
        });
      });
    });

    function pintarDatos(resp){
      // Tema
      if( resp.tema == "light" )
        $("#radio1").prop("checked", true);
      else
        $("#radio2").prop("checked", true);

      // Fondo
      $("#img-fondo").attr("src", resp.fondo)

      // Titulo
      $("#titulo").val(resp.titulo);

      // Arbol
      actualizarArbol(resp.arbol)

      // Final
      $("#msg_final").val(resp.final.contenido);
      $("#link_final").val(resp.final.src);

      // Apartado
      $("#titulo2").val(resp.apartado.titulo);
      $("#subtitulo").val(resp.apartado.subtitulo);
      $("#accion").val(resp.apartado.accion);
      $("#link").val(resp.apartado.enlace);
      $("#btn").val(resp.apartado.btn_copy);

      // App
      $("#titulo_app").val(resp.app.titulo);
      CKEDITOR.instances.editorListas.setData(resp.app.subtitulo);
      $("#accion_app").val(resp.app.accion);
      $("#link_app").val(resp.app.enlace);
      $("#btn_app").val(resp.app.btn_copy);

      // Legales
      CKEDITOR.instances.editor.setData(resp.legales);

      // Landing
      var enlace = "https://chatbot.ideeo.mx/"+localStorage.getItem('chat')+"/index.html";
      $("#enlace-chat").text(enlace);
      $("#enlace-chat").attr("href", enlace);
    }

    function validarDatos(){
      if( $("#titulo").val() == '' ){
        console.log("titulo");
        return false;
      }
      if( $("#titulo2").val() == '' ){
        console.log("titulo2");
        return false;
      }
      if( $("#subtitulo").val() == '' ){
        console.log("subtitulo");
        return false;
      }
      if( $("#accion").val() == '' ){
        console.log("accion");
        return false;
      }
      if( $("#link").val() == '' ){
        console.log("link");
        return false;
      }
      if( $("#btn").val() == '' ){
        console.log("btn");
        return false;
      }
      if( $("#titulo_app").val() == '' ){
        console.log("titulo_app");
        return false;
      }
      if( $("#accion_app").val() == '' ){
        console.log("accion_app");
        return false;
      }
      if( $("#link_app").val() == '' ){
        console.log("link_app");
        return false;
      }
      if( $("#btn_app").val() == '' ){
        console.log("btn_app");
        return false;
      }
      if( CKEDITOR.instances.editor.getData() == "" ){
        console.log("Legales vacio");
        return false;
      }
      if( CKEDITOR.instances.editorListas.getData() == "" )
        return false;
      console.log("Es valido");
      return true;
    }

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
   
    function validarLink(url){
      var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
      //var regexp = /^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/
      return regexp.test(url);
    }

    function pintarTabla(nodo){
      var settings = {
        "url": "https://backoffice.ideeo.mx/edicion?nodo="+nodo,
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
        var html = "";       
        localStorage.setItem('nOpciones',resp.opciones.length);
        console.log(resp);
        if( resp.final == 1 ){
          $("#msg-forms").text("Este bloque debe editarse en la sección de Bloque final");
          setTimeout(function(){
            $("#msg-forms").text("");
          }, 4000);
          $(".btn-guardar").attr("disabled", true);
        }else{
          $(".btn-guardar").attr("disabled", false);
          // Elementos
          for (i = 0; i < resp.elementos.length; i++) {
            if( resp.elementos[i].tipo == "texto"){
              html += '<tr>' +
                '<td><input type="text" name="contenido'+i+'" id="contenido-'+i+'" value="' + resp.elementos[i].contenido + '"></td>' +
                '</tr>';  
            }
          }
          localStorage.setItem('nElementos',i);
          $('#data-bloque-elementos').html(html);

          // Imagenes
          var k = 0;
          for (i = 0; i < resp.elementos.length; i++) {
            if( resp.elementos[i].tipo == "img"){
              $("#tr-img-"+k).show();
              $("#img-fondo-"+k).attr("src",resp.elementos[i].src);
              k = k + 1;
            }
          }
          localStorage.setItem('nImagenes',i);

          // Opciones
          html = "";
          for (i = 0; i < resp.opciones.length; i++) {
            html += '<tr>' +
              '<td><input type="text" name="contenido-'+i+'" id="contenido-op-'+i+'" value="' + resp.opciones[i].contenido + '"></td>' +
              '</tr>';  
          }
          $('#data-bloque-opciones').html(html);
        }
      }).fail(function(d){
        alert("Intenta de nuevo");
      });
    }

  </script>
</body>

</html>