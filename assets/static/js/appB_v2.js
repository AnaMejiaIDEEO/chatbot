var app = new Vue({
    el: '#app',
    props: {
        delay: {
            type: Number,
            default: 0
        }
    },
    data: {
        data: {},
        posicion: '',
        coin: -4,
        arbol: [],
        arbol_id: 0,
        arbol_final: 0,
        /* arbol2: [], */
        /* idArbol: '', */
        idPlantilla: '',
        puntosDisposicion: 0,        
        puntosEscala: 0,
        puntosExpertise: 0,
        showAddText: true,
        cookie: '',
        otro: '',
        recomendacion: 'Intro',
        /* flagShowOptions: false, */
        /* setI: '', */
        show: true,
        count: 0,
        mensajesInit: [],
        mensajes: [],
        modal: false,
        imgModalSrc: "https://chatbot.ideeo.mx/admin/upload/img/20220603015214-03.gif",
        stars: 0,
        starSelect: false,
        srcStarEmpty: "https://chatbot.ideeo.mx/assets/images/chat/star_empty.png",
        srcStarFull: "https://chatbot.ideeo.mx/assets/images/chat/star_full.png",
        srcStar1: "https://chatbot.ideeo.mx/assets/images/chat/star_empty.png",
        srcStar2: "https://chatbot.ideeo.mx/assets/images/chat/star_empty.png",
        srcStar3: "https://chatbot.ideeo.mx/assets/images/chat/star_empty.png",
        srcStar4: "https://chatbot.ideeo.mx/assets/images/chat/star_empty.png",
        srcStar5: "https://chatbot.ideeo.mx/assets/images/chat/star_empty.png",
        sesion: '',
    },
    methods: {
        /* LANDING INIT */
        leerarchivo(){
           this.idPlantilla = id;
        },
        getData(){
            axios.get('https://backoffice.ideeo.mx/chat/' + this.idPlantilla)
            .then( response => {
                this.data = response.data
                this.getArbol(response.data.arbol.id)
            }).catch( err => {
                console.log(err);
            })
        },
        /* getCookie() {
            this.cookie = $cookies.get('_ga');
        }, */
        metrica(categoria, etiqueta, accion, opcion){
            if( opcion != 0 ){
                categoria = categoria + " " + opcion
                etiqueta = this.otro
            }
            
            if( this.posicion == '' )
                this.getLocation()

            if( this.sesion == '' || this.sesion == undefined){
                this.sesion = localStorage.getItem('sesion')
            }

            let data = new FormData();
            data.append('dominio','9');
            data.append('ruta','B');
            data.append('localizacion',this.posicion);
            data.append('sesion',this.sesion);
            data.append('canal','Directo');
            data.append('seccion',this.recomendacion);
            data.append('categoria', categoria);
            data.append('etiqueta', etiqueta);
            data.append('accion', accion);
            data.append('tipo','html');

            axios.post('https://backoffice.ideeo.mx/ideeo/metricas', data)
            .then( response => {
                console.log("metricas: add");
            }).catch( err => {
                console.log(err);
            })
            this.otro = ''
        },

        /* CHAT */
        /* - Obtener y desplegar nodo */
        getArbol(nodo_init){ 
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + nodo_init)
            .then( response => {
                this.getMensajes(response.data.elementos,response.data.opciones)
                this.arbol_id = response.data.id
                this.arbol_final = response.data.final
                this.coin = this.coin + 4
            }).catch( err => {
                console.log(err);
            })           
        },
        getMensajes(elementos,opciones){ /* Unificar mensajes */
            let v = this
            v.mensajesInit = []
            elementos.forEach(function(element){
                v.mensajesInit.push(element)                
            });
            v.mensajesInit.push({
                opciones: opciones
            });            
            this.renderMensajes()
        },
        renderMensajes(){ /* Agregar nuevos mensajes y desplegarlos */
            let v = this
            this.mensajesInit.forEach(function(obj,index,collection){
                setTimeout(function(){
                    v.pushMensajes(obj)
                },index*4000)
            });
        },
        pushMensajes(elemento_mensaje){
            console.log("Push")
            this.mensajes.push(elemento_mensaje)
        },

        /* ANSWER OPTION SELECTION */
        validateReloadArbol(idNodo,flag_data,contenido){
            /** flag_data = 1  => Indicador de cuadro de texto */
            /** flag_data = 2  => Indicador de puntuacion de estrellas */
            
            let v = this
            let nodo_actual = v.arbol_id
            console.log(idNodo+"-"+flag_data)
            if( flag_data == 1 ){ /** flag_data = 1  => Indicador de cuadro de texto */
                v.showAddText = true;
            }else{
                v.arbol = []
                v.showAddText = false;
                if( v.arbol_final == 0 ){
                    if( idNodo == null ){
                        console.log("Nodo = null");
                    }else{
                        v.validateFlow(idNodo)
                        v.getReloadArbol(idNodo)
                    }
                }else{ //Validar existencia del nodo y continuidad del flujo
                    var data = JSON.stringify({
                        "nodo": v.arbol_id, /* nodoInit, */
                        "expertise": v.puntosExpertise,
                        "disposicion": v.puntosDisposicion
                    });
                    
                    var config = {
                        method: 'post',
                        url: 'https://backoffice.ideeo.mx/chatbot/continuacion',
                        headers: { 
                            'Content-Type': 'application/json'
                        },
                        data : data
                    };
                    axios(config)
                    .then( response => {
                        /* console.log("Continuación: "+JSON.stringify(response.data)); */
                        console.log("continuacion: "+response.data.data)
                        if( response.data.content == 0 ){
                            //Fin chat
                            console.log("Final")
                            v.recomendacion = "Intro"
                            v.metrica('Arbol', 'Fin', 'Finalizar', 0)
                        }else{
                            v.arbol_id = response.data.data.id
                            v.arbol_final = response.data.data.final
                            v.recomendacion = response.data.data.etiqueta
                            v.getMensajes(response.data.data.elementos,response.data.data.opciones)
                            v.validateFlow(response.data.data.id)
                        }
                                           
                    })
                    .catch( error=> {
                        console.log(error);
                    });
                }
                
                console.log("Metrica",v.otro)
                if(flag_data==3)
                    contenido = "Otra: " + v.otro
                if(flag_data==2)
                    contenido = v.stars
                v.metrica(v.recomendacion+"-"+nodo_actual, contenido, 'Click', 0) 
                v.otro = ''
            }
        },
        blockedButtons(){
            const collection = document.getElementsByClassName("btn-destion")
            console.log("Buttons: " + collection)
            for (let i = 0; i < collection.length; i++) {
                collection[i].disabled = true
            }
        },
        getReloadArbol(idNodo){        
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + idNodo)
            .then( response => {
                this.arbol = response.data
                this.arbol_id = response.data.id
                this.arbol_final = response.data.final
                this.coin = this.coin + 4
                this.getMensajes(response.data.elementos,response.data.opciones)
            }).catch( err => {
                console.log(err);
            })
        },
        
        validateScore(puntuaciones){
            if( puntuaciones.length > 0 ){
                puntuaciones.forEach(element => {
                    if( element.tipo == "Expertise" ){
                        this.puntosExpertise = this.puntosExpertise + element.valor;
                        console.log("Expertise: "+this.puntosExpertise);
                    }
                    if( element.tipo == "Escala" ){
                        this.puntosEscala = this.puntosEscala + element.valor;
                        console.log("Escala: "+this.puntosEscala);
                    }
                    if( element.tipo == "Disposicion de uso" ){
                        this.puntosDisposicion = this.puntosDisposicion + element.valor;
                        console.log("Disposicion: "+this.puntosDisposicion);
                    }
                });
            }
        },
        validateFlow(idNodo){
            let v = this
            let flag_inicio = false;
            if( idNodo == 101 ){
                this.recomendacion = "Domiciliar pagos"
                flag_inicio = true
            }else if( idNodo == 110 ){
                this.recomendacion = "Aprovechar MSI y otros beneficios"
                flag_inicio = true
            }else if( idNodo == 118 ){
                this.recomendacion = "Ser totalero"
                flag_inicio = true
            }else if( idNodo == 128 ){
                this.recomendacion = "Aprovechar fecha de corte"
                flag_inicio = true
            }else{
                true
            }
            if( flag_inicio )
                this.metrica(v.recomendacion, 'Inicio', 'Iniciar', 0)
        },

        /* MODAL FILES*/
        showModal(src_img){
            let v = this
            this.imgModalSrc = src_img;
            this.modal = true
            this.metrica(v.recomendacion+"-"+v.arbol_id, src_img, 'Visualizar', 0)
        },
        closeModal(){
            this.modal = false
        },

        /* SCORE STARS */
        changeStar(n_star){
            let v = this

            v.srcStar1 = v.srcStarEmpty
            v.srcStar2 = v.srcStarEmpty
            v.srcStar3 = v.srcStarEmpty
            v.srcStar4 = v.srcStarEmpty
            v.srcStar5 = v.srcStarEmpty

            if(v.stars == n_star){ /* Vaciar estrellas*/
                v.starSelect = false
                v.stars = 0
            }else{
                v.starSelect = true
                v.stars = n_star

                v.srcStar1 = v.srcStarFull
                if(n_star > 1)
                    v.srcStar2 = v.srcStarFull
                if(n_star > 2)
                    v.srcStar3 = v.srcStarFull
                if(n_star > 3)
                    v.srcStar4 = v.srcStarFull
                if(n_star > 4)
                    v.srcStar5 = v.srcStarFull
            }
        },

        /* DOWNLOAD FILES */
        toDataURL(url) {
            return fetch(url).then((response) => {
                    return response.blob();
                }).then(blob => {
                    return URL.createObjectURL(blob);
                });
        },
        async downloadFile() {
            let v = this
            v.metrica(v.recomendacion+"-"+v.arbol_id, v.imgModalSrc, 'Descargar', 0)
            const a = document.createElement("a");
            a.href = await this.toDataURL(v.imgModalSrc);
            let extension = this.getExtensionFile(v.imgModalSrc)
            a.download = "file"+extension;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        },
        getExtensionFile(str_file){
            if(str_file.includes('.png'))
                return ".png"
            else if(str_file.includes('.jpg'))
                return ".jpg"
            else if(str_file.includes('.pdf'))
                return ".pdf"
            else if(str_file.includes('.gif'))
                return ".gif"
            else
                return ".txt"
        },

        /** OPEN LINK ELEMENTS */
        openLink(src){
            let v = this
            v.metrica(v.recomendacion+"-"+v.arbol_id, src, 'Abrir', 0)
        },
        getLocation(){
            let v = this
            if (navigator.geolocation) { //check if geolocation is available
                try {
                    navigator.geolocation.getCurrentPosition(function(position){
                        console.log(position);
                        v.posicion = position.coords.latitude + "," + position.coords.longitude;
                        /* $.get( "http://maps.googleapis.com/maps/api/geocode/json?latlng="+ position.coords.latitude + "," + position.coords.longitude +"&sensor=false", function(data) {
                            console.log(data);
                        }) */
                    });
                }catch(error){
                    console.error(error);
                }
            }
        },

        getSesion(){
            let num = String(Math.random() * (1 - 10) + 10)
            let fecha = new Date()
            fecha = fecha.toISOString() +num
            
            var sha256 = new jsSHA('SHA-256', 'TEXT');
            sha256.update(fecha + num);
            this.cookie = sha256.getHash("HEX");
        },
        getSesionBack(){
            let v = this
            let sesion_ls = localStorage.getItem('sesion')
            if( sesion_ls == '' || sesion_ls == undefined ){
                axios.post('https://backoffice.ideeo.mx/ideeo/metricas/sesion')
                .then( response => {
                    console.log("Sesion: " + response.data);
                    localStorage.setItem('sesion',response.data.session)
                    v.sesion = response.data.session
                    v.metrica('Arbol', 'Inicio', 'Iniciar', 0)
                }).catch( err => {
                    console.log(err);
                })
            }else{
                v.sesion = localStorage.getItem('sesion')
                v.metrica('Arbol', 'Inicio', 'Iniciar', 0)
            }
        }
    },
    beforeMount(){
    },
    mounted(){
        let v = this
        this.getLocation()
        this.getSesionBack()
        this.leerarchivo()
        setTimeout(function(){
            v.getData()
        }, 2000)
    }
})