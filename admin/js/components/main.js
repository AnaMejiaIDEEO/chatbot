new Vue({
  el: '#app',
  data: {
    dataArbol: '',
    elementosLocal: [],
    opcionesLocal: [],
    organigrama: '',
    padre: 0,
    dataListSeccion: '',
    agregarOpcion: false,
    agregarTexto: false,
    agregarLista: false,
    dashboard: true,
    textoBbva: false,
    opcionTexto: false,
    imgFondo: false,
    imgTema: false,
    msgAgregarSeccion: false,
    msgAgregarApp: false,
    answer1: '',
    titulo: '',
    imgNodo: {
      tipo: "png",
      contenido: '',
      src: ''
    },
    contenidoText: '',
    texto: { 
      tipo: 'texto',
      contenido: '',
      src: '',
    },
    contenido: '',
    opcion: { 
      tipo: 'button',
      contenido: ''
    }, 
    legales: '',
    lista: '',
    imgEvent: 'https://dev.ideeo.mx/chatbot/img/fondo/',

    imgFileFondo: [],
    listOpcion:[],
    elementos: [],
    msgAddSeccion: '',
    msgAddApp: '',
    imgFile: [],
    apartados: {
      titulo: '',
      subtitulo: '',
      accion: '',
      link: '',
      btn: '',
    },
    appBbva: {
      titulo: '',
      subtitulo: '',
      accion: '',
      link: '',
      btn: '',
    }
  },
  created() {
    localStorage.removeItem('chat');
    localStorage.removeItem('plantilla');
    localStorage.removeItem('elementos');
    localStorage.removeItem('opciones');    
    //console.log("Created");
    //this.uploadImage();
    /* E X A M P L E  C A L L  M E T H O D S */
    /*this.listData();*/
  },
  beforeCreate() {
    
    /*this.$nextTick(() => { graphicValle(this.scheduleLabels, this.scheduleData) })
    this.$nextTick(() => { graphicClick(this.influxLabels, this.influxData) })*/
  },

  methods: { 
    vmActualizarArbol(d) {
      actualizarArbol(d); // Función en template php
    },
    vmGetDataList(){
      this.dataListSeccion = getDataList();
    },
    agregarChat(){
      console.log('Metodo agregarChat')

      var form = new FormData();
      form.append("nombre", '');
      form.append("titulo", this.titulo);
      form.append("subtitulo", '');
      form.append("tema", this.answer1);
      form.append("myfile", fileInput.files[0]);

      var settings = {
        "url": "https://backoffice.ideeo.mx/chat",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "mimeType": "multipart/form-data",
        "contentType": false,
        "data": form
      };

      $.ajax(settings).done(function (response) {
        console.log(response);
        //alert('alerta')
      }).fail(function(data){
        alert("Try again champ!");
      });
    },
    getDataLocal(){
      this.elementosLocal = JSON.parse(localStorage.getItem('elementos'));
      this.opcionesLocal = JSON.parse(localStorage.getItem('opciones'));
    },
    cargarImg(){
      let reader = new FileReader();
      reader.readAsDataURL
      },
    selectFileFondo(event){
      this.imgFondo = true;
      this.imgFileFondo = event.target.files[0];
      console.log(this.imgFileFondo);
    },
    selectFile(event){
      this.padre = localStorage.getItem('padre');
      this.imgTema = true;
      this.opcionTexto = false;
      this.textoBbva = false;
      this.imgFile = event.target.files[0];
      console.log(this.imgFile);
      console.log('nombre imagen: ' + this.imgFile.name);
      this.$nextTick(() => { this.updateThumbnail(this.imgFile) })
      let fields = new FormData();
      for (let key in this.imgFile){
        fields.append(key, this.imgFile[key]);
      }
    },
    selectText(option){
      this.padre = localStorage.getItem('padre');
   
      if(option == 1){
        console.log('agregar input ');
        if(this.textoBbva !== false){
          console.log('entra a if :' );
          this.textoBbva = false;
          this.agregarTexto= false;
        }else{
          this.textoBbva = true;
        }
        this.opcionTexto = false;
        this.agregarOpcion= false;
      }else{
        if(this.opcionTexto !== false){
          console.log('entra a if :' );
          this.opcionTexto = false;
          this.agregarOpcion= false;
        }else{
          this.opcionTexto = true;
        }
        this.textoBbva = false;
        this.agregarTexto= false;
      }

    },
    mostrarDatos(){
      console.log('Tema: ' + this.answer1);
      console.log('Nombre de Imagen de fondo: ' + this.imgFileFondo.name);
      console.log('Titulo: ' + this.titulo);
      console.log('Texto de BBVA: ' + this.contenidoText);
      console.log('Opcion de BBVA: ');
      console.log(this.listOpcion);
      console.log('nombre imagen: ' + this.imgFile.name);
      console.log('Apartados: ');
      console.log(this.apartados);
      console.log('App BBVA: ');
      console.log(this.appBbva);
      console.log('Legales: ' + this.legales)

    },
    mostraBoton(option){
      if(option == 1){
        this.agregarTexto= true;
      }
      if(option == 2){
        this.agregarOpcion= true;
      }
      if(option == 3){
        this.agregarLista= true;
      }
    },
    agregarOpciones(option){
      //this.opcion.contenido = this.contenido;
      var opcion = {
        'tipo': "button",
        'contenido': this.contenido,
      }
      this.listOpcion.push(opcion); //añadimos el ojeto opcion al array

      //Limpiamos el campo
      this.contenido = '';
      this.agregarOpcion= false;
      localStorage.setItem('opciones',JSON.stringify(this.listOpcion));
      this.getDataLocal();
    },
    agregarElementos(){
      var elemento = {
        'tipo': "texto",
        'contenido': this.contenidoText,
        'src': ""
      }
      this.elementos.push(elemento);
      
      //Limpiamos el campo
      this.contenidoText = '';
      this.agregarOpcion= false;
      localStorage.setItem('elementos',JSON.stringify(this.elementos));
      this.getDataLocal();
    },
    agregarListas(){
      console.log('Dentro de agregar lista: '+ this.appBbva.listas);
      var l = {
        'elem': this.lista
      };
      this.appBbva.listas.push(l);//añadimos el la variable lista al array
      console.log('lista+=: '+ JSON.stringify(this.appBbva.listas));
      //Limpiamos el campo
      this.lista = "";
      this.agregarLista= false;
     
    },
    seccionAdd(){
      var t = this;
      var settings = {
        "url": addSeccion,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "plantilla": localStorage.getItem('plantilla'),
          "titulo": this.apartados.titulo,
          "subtitulo": this.apartados.subtitulo,
          "accion": this.apartados.accion,
          "enlace": this.apartados.link,
          "btn_copy": this.apartados.btn
        }),
      };

      this.msgAgregarSeccion = true;
      
      $.ajax(settings).done(function (response) {
        console.log(response);
        t.apartados.titulo = '';
        t.apartados.subtitulo = '';
        t.apartados.accion = '';
        t.apartados.link = '';
        t.apartados.btn = '';
        t.msgAddSeccion = 'Sección agregada con éxito.';
        setTimeout(function(){
          t.msgAddSeccion = '';
          t.msgAgregarSeccion = false;
        }, 4000);

      }).fail(function(d){
        console.log("Error en servicio 'Seccion'");
        console.log(d);
        t.msgAddSeccion = 'Error al agregar la sección';
        setTimeout(function(){
          t.msgAddSeccion = '';
          t.msgAgregarSeccion = false;
        }, 4000);
      });
    },
    /* appAdd(){
      var t = this;
      this.vmGetDataList();
      console.log("this.dataListSeccion "+this.dataListSeccion);
      console.log("app.dataListSeccion "+app.dataList);
      var settings = {
        "url": addSeccion,
        "method": "POST",
        "timeout": 0,
        "headers": {
          "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "plantilla": localStorage.getItem('plantilla'),
          "titulo": this.appBbva.titulo,
          "subtitulo": this.dataListSeccion,
          "enlace": this.appBbva.link,
          "accion": this.appBbva.accion,
          "btn_copy": this.appBbva.btn
        }),
      }; */
      /* "subtitulo": this.dataListSeccion,
      "subtitulo": app.dataList, */
      /* this.msgAgregarApp = true;
      
      $.ajax(settings).done(function (response) {
        console.log(response);
        t.appBbva.titulo = '';
        t.appBbva.listas = '';
        t.lista = '';
        t.appBbva.accion = '';
        t.appBbva.link = '';
        t.appBbva.btn = '';
        t.msgAddApp = 'Sección agregada con éxito.';
        setTimeout(function(){
          t.msgAddApp = '';
          t.msgAgregarApp = false;
        }, 4000);
      }).fail(function(d){
        console.log("Error en servicio 'Seccion'");
        console.log(d);
        t.msgAddApp = 'Error al agregar la sección';
        setTimeout(function(){
          t.msgAddApp = '';
          t.msgAgregarApp = false;
        }, 4000);
      });
    }, */
    addNodes(){
      console.log('mandar datos arbol');
      console.log('Nodo padre: '+this.padre);
      var t = this;
      var chat = localStorage.getItem('chat');
      this.padre = localStorage.getItem('padre');

      var settings = {
        "url": addNode,
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "chat": localStorage.getItem('chat'),
          "nodo": this.padre,
          "elementos": this.elementos,
          "opciones": this.listOpcion
        }),
      };

      $.ajax(settings).done(function (response) {
        console.log(response);
        localStorage.removeItem('elementos');
        localStorage.removeItem('opciones');
        t.listOpcion = [];
        t.elementos = [];
        t.getDataLocal();

        var config = {
          "url": "https://backoffice.ideeo.mx/arbol/"+chat,
          "method": "GET",
          "timeout": 0,
          "processData": false,
          "headers": {
            "Content-Type": "application/json"
          }
        };

        $.ajax(config).done(function (response) {
          console.log(response);
          t.vmActualizarArbol(response);
        });
      }).fail(function(d){
        console.log("Error en servicio 'Agregar nodo'");
        console.log(d);
      });
    },
    /* addLegales(){
      console.log("Legales en vue: "+app.dataLegales);
      var settings = {
        "url": addLegales,
        "method": "POST",
        "timeout": 0,
        "headers": {
            "Content-Type": "application/json"
        },
        "data": JSON.stringify({
          "chat": localStorage.getItem('chat'),
          "legales": app.dataLegales
        }),
      };

      $.ajax(settings).done(function (response) {
        console.log(response);
      }).fail(function(d){
        console.log("Error en servicio 'Legales'");
        console.log(d);
      });
    }, */
    updateThumbnail(file) {
      let thumbnailElement = file;
      console.log('function updateThumbnail');
      console.log(thumbnailElement);
     
      // Show thumbnail for image files
      if (file.type.startsWith("image/")) {
        //console.log('bandera de imagen');
        const reader = new FileReader();
        reader.readAsDataURL(file);
        var formData = new FormData();
        formData.append('fileToUpload', file);
        const vm = this;
        
        $.ajax({
            url : 'upload/upload.php',
            type : 'POST',
            data : formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success : function(data) {  // data: ruta del archivo
              vm.addFile(data);
            }
          });
      } else {
        thumbnailElement.style.backgroundImage = null;
      }
    },
    addFile(data){
      var elemento = {
        'tipo': "img",
        'contenido': "",
        'src': "https://chatbot.ideeo.mx/admin/upload/"+data
      };
      this.elementos.push(elemento);
      
      //Limpiamos el campo
      this.agregarOpcion= false;
      localStorage.setItem('elementos',JSON.stringify(this.elementos));
      this.getDataLocal();
    }
  }
})