var app = new Vue({
    el: '#app',
    data: {
        data: {},
        arbol: [],
        idArbol: '',
        idPlantilla: '',
        puntosDisposicion: 0,        
        puntosEscala: 0,
        puntosExpertise: 0,
        showAddText: false,
        cookie: '',
        otro: '',
        recomendacion: 'Intro',
    },
    methods: {
        leerarchivo(){
           this.idPlantilla = id;
           //console.log("Plantilla: " + this.idPlantilla);
        },
        getData(){
            axios.get('https://backoffice.ideeo.mx/chat/' + this.idPlantilla)
            .then( response => {
                this.data = response.data
                //console.log("/chat/ "+response.data);
                this.idArbol = response.data.arbol.id
                this.getArbol()
            }).catch( err => {
                console.log(err);
            })
        },
        validateReloadArbol(idNodo,nodoInit,final,add_text){
            console.log(idNodo+"-"+nodoInit+"-"+final+"-"+add_text)
            this.arbol = []
            if( add_text == 1 ){
                this.showAddText = true;
            }else{
                window.location = "#init";
                this.showAddText = false;
                if( final == 0 ){
                    if( idNodo == null ){
                        console.log("Nodo = null");
                    }else{
                        this.validateFlow(idNodo)
                        this.getReloadArbol(idNodo)
                    }
                }else{ //Validar existencia del nodo y continuidad del flujo
                    var data = JSON.stringify({
                        "nodo": nodoInit,
                        "expertise": this.puntosExpertise,
                        "disposicion": this.puntosDisposicion
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
                            console.log("Continuación: "+JSON.stringify(response.data));
                            if( response.data.content == 0 ){
                                //Fin chat
                                console.log("Final")
                                this.recomendacion = "Intro"
                                this.metrica('Arbol', 'Fin', 'Finalizar', 0)
                            }else{
                                this.arbol = response.data.data
                                this.validateFlow(response.data.id)
                                /* this.recomendacion = response.data.etiqueta
                                this.metrica('Arbol', 'Recomendación', response.data.etiqueta, 0) */
                            }
                        })
                        .catch( error=> {
                            console.log(error);
                        });
                }
                this.otro = ''
            }
        },
        getReloadArbol(idNodo){            
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + idNodo)
            .then( response => {
                this.arbol = response.data
            }).catch( err => {
                console.log(err);
            })
        },
        getArbol(){
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + this.idArbol)
            .then( response => {
                this.arbol = response.data
                //console.log("/nodo="+idNodo+": "+response.data);
            }).catch( err => {
                console.log(err);
            })
           
        },
        metrica(categoria, etiqueta, accion, opcion){
            if( opcion != 0 )
                categoria = categoria + " " + opcion

            let data = new FormData();
            data.append('dominio','9');
            data.append('ruta','https://chatbot.ideeo.mx/');
            data.append('localizacion','');
            data.append('sesion',this.cookie);
            data.append('canal','Directo');
            data.append('seccion',this.recomendacion);
            data.append('categoria', categoria);
            data.append('etiqueta', etiqueta);
            data.append('accion', accion);
            data.append('tipo','html');

            axios.post('https://backoffice.ideeo.mx/ideeo/metricas', data)
            .then( response => {
                //console.log("metricas: "+JSON.stringify(response.data));
            }).catch( err => {
                console.log(err);
            })
           
        },
        validateScore(puntuaciones){
            if( puntuaciones.length > 0 ){
                puntuaciones.forEach(element => {
                    //console.log("Puntuacion: " + element.tipo);
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
        getCookie() { /* Cookie google*/
            this.cookie = $cookies.get('_ga');
        },
        validateFlow(idNodo){
            let flag_inicio = false;
            /* if( idNodo == 6 ){
                this.recomendacion = "Manejo 01"
                flag_inicio = true
            }else if( idNodo == 12 || idNodo == 13 ){
                this.recomendacion = "Manejo 02"                
                flag_inicio = true
            }else if( idNodo == 14 ){
                this.recomendacion = "Preferencias de digitalización"
                flag_inicio = true
            }else if( idNodo == 22 ){
                this.recomendacion = "Razones 01"
                flag_inicio = true
            }else if( idNodo == 30 ){
                this.recomendacion = "Razones 02"
                flag_inicio = true
            }else */
            if( idNodo == 32 ){
                this.recomendacion = "Domiciliar pagos"
                flag_inicio = true
            }else if( idNodo == 41 ){
                this.recomendacion = "Aprovechar MSI y otros beneficios"
                flag_inicio = true
            }else if( idNodo == 49 ){
                this.recomendacion = "Ser totalero"
                flag_inicio = true
            }else if( idNodo == 59 ){
                this.recomendacion = "Aprovechar fecha de corte"
                flag_inicio = true
            }else{
                true
            }
            if( flag_inicio )
                this.metrica('Arbol', 'Inicio', 'Iniciar', 0)
        },
    },
    mounted(){
        this.leerarchivo();
        this.getData();
        this.getCookie()
        this.metrica('Arbol', 'Inicio', 'Iniciar', 0)
    }
})