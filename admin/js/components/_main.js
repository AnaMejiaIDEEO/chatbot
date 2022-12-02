new Vue({
  el: '#app',
  data: {
    /** DIRECTORIO */
    chats: [],

    /* CREAR CHAT */
    // Data form
    answer1: '',
    titulo: '',
    // Labels
    imgFondo: false,
    imgFileFondo: [],

    /* CREAR ARBOL */
    // Elementos
    elementos: [],
    elementosLocal: [], // For table
    textoBbva: false,
    contenidoText: '',
    agregarTexto: false,
    // Imagen
    imgTema: false,
    imgFile: [],
    // Opciones
    listOpcion:[],
    opcionesLocal: [], // For table
    opcionTexto: false,
    contenido: '',
    agregarOpcion: false,
    // Agregar bloque
    padre: 0,

    // Editar imagenes
    imgTema0: false,
    imgFile0: [],
    imgTema1: false,
    imgFile1: [],
    imgTema2: false,
    imgFile2: [],
    imgEditadas: [],

    /* APARTADOS */
    apartados: {
      titulo: '',
      subtitulo: '',
      accion: '',
      link: '',
      btn: '',
    },
    selectData: true,
    msgAgregarSeccion: false,
    msgAddSeccion: '',

    /* APP */
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
    this.getChats();
  },
  methods: { 
    vmActualizarArbol(d) {
      actualizarArbol(d); // Función en template php
    },
    vmGetDataList(){
      this.dataListSeccion = getDataList();
    },
    /* DIRECTORIO*/
    getChats(){
      const b = axios({
        method: 'get',
        url: getChatService,
        headers: {
            "Content-Type": 'application/json',
            "Accept": 'application/json',
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
      })
      .then(({ data }) => {
        //console.log(data);
        this.chats = data;
      })
      .catch(function (error) {
          console.log(error);
      });
    },

    // CREAR CHAT
    selectFileFondo(event){
      this.imgFondo = true;
      this.imgFileFondo = event.target.files[0];
      console.log(this.imgFileFondo);
      this.$nextTick(() => { this.updateThumbnailF(this.imgFileFondo) })
      let fields = new FormData();
      for (let key in this.imgFile){
        fields.append(key, this.imgFile[key]);
      }
    },

    /* CREAR ARBOL */
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
    mostraBoton(option){
      if(option == 1){
        this.agregarTexto= true;
      }
      if(option == 2){
        this.agregarOpcion= true;
      }
    },
    // Elementos
    agregarElementos(){
      var elemento = {
        'tipo': "texto",
        'contenido': this.contenidoText,
        'src': ""
      }
      this.elementos.push(elemento);
      this.contenidoText = '';
      this.agregarTexto= false;
      localStorage.setItem('elementos',JSON.stringify(this.elementos));
      this.getDataLocal();
    },
    // Imagen
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
    selectFile0(event){
      this.imgTema0 = true;
      this.imgFile0 = event.target.files[0];
      console.log(this.imgFile0);
      console.log('nombre imagen: ' + this.imgFile0.name);
      this.$nextTick(() => { this.updateThumbnail0(this.imgFile0) })
      let fields = new FormData();
      for (let key in this.imgFile0){
        fields.append(key, this.imgFile0[key]);
      }
    },
    selectFile1(event){
      this.imgTema1 = true;
      this.imgFile1 = event.target.files[0];
      console.log(this.imgFile1);
      console.log('nombre imagen: ' + this.imgFile1.name);
      this.$nextTick(() => { this.updateThumbnail1(this.imgFile1) })
      let fields = new FormData();
      for (let key in this.imgFile1){
        fields.append(key, this.imgFile1[key]);
      }
    },
    selectFile2(event){
      this.imgTema2 = true;
      this.imgFile2 = event.target.files[0];
      console.log(this.imgFile2);
      console.log('nombre imagen: ' + this.imgFile2.name);
      this.$nextTick(() => { this.updateThumbnail2(this.imgFile2) })
      let fields = new FormData();
      for (let key in this.imgFile2){
        fields.append(key, this.imgFile2[key]);
      }
    },
    // Opciones
    agregarOpciones(){
      //this.opcion.contenido = this.contenido;
      var opcion = {
        'tipo': "button",
        'contenido': this.contenido,
      }
      this.listOpcion.push(opcion); //añadimos el ojeto opcion al array
      this.contenido = '';
      this.agregarOpcion= false;
      localStorage.setItem('opciones',JSON.stringify(this.listOpcion));
      this.getDataLocal();
    },
    // Agregar bloque    
    getDataLocal(){ // Actualizar tabla en vista de elementos y opciones
      this.elementosLocal = JSON.parse(localStorage.getItem('elementos'));
      this.opcionesLocal = JSON.parse(localStorage.getItem('opciones'));
    },
    addNodes(){
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
        t.imgFile = [];
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
    saveNewImg(){
      var t = this;
      var settings = {
        "url": "https://backoffice.ideeo.mx/elemento/edicion",
        "method": "POST",
        "timeout": 0,
        "processData": false,
        "data": JSON.stringify({
          "data": this.imgEditadas,
          "tipo": "img",
          "chat": localStorage.getItem('chat'),
          "nodo": localStorage.getItem('padre'),
        }),
        "headers": {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
      };
      $.ajax(settings).done(function (response) {
        console.log(response);
        t.imgEditadas = [];
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
    
    /* APARTADOS */
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
        t.selectData = false;
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
      this.agregarOpcion= false;
      localStorage.setItem('elementos',JSON.stringify(this.elementos));
      this.getDataLocal();
    },
    updateThumbnailF(file) {
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
              vm.addFileF(data);
            }
          });
      } else {
        thumbnailElement.style.backgroundImage = null;
      }
    },
    addFileF(data){
      var src = "https://chatbot.ideeo.mx/admin/upload/"+data
      localStorage.setItem('src-fondo',src);
    },
    updateThumbnail0(file) {
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
              vm.addFile0(data);
            }
          });
      } else {
        thumbnailElement.style.backgroundImage = null;
      }
    },
    addFile0(data){
      var src = "https://chatbot.ideeo.mx/admin/upload/"+data
      var elemento = {
        'id': 0,
        'src': src
      }
      console.log(elemento);
      this.imgEditadas.push(elemento);
    },
    updateThumbnail1(file) {
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
              vm.addFileF(data);
            }
          });
      } else {
        thumbnailElement.style.backgroundImage = null;
      }
    },
    addFile1(data){
      var src = "https://chatbot.ideeo.mx/admin/upload/"+data
      var elemento = {
        'id': 1,
        'src': src
      }
      this.imgEditadas.push(elemento);
    },
    updateThumbnail2(file) {
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
              vm.addFile2(data);
            }
          });
      } else {
        thumbnailElement.style.backgroundImage = null;
      }
    },
    addFile2(data){
      var src = "https://chatbot.ideeo.mx/admin/upload/"+data
      var elemento = {
        'id': 2,
        'src': src
      }
      this.imgEditadas.push(elemento);
    }
  }
})