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
        arbol: [],
        arbol2: [],
        idArbol: '',
        idPlantilla: '',
        puntosDisposicion: 0,        
        puntosEscala: 0,
        puntosExpertise: 0,
        showAddText: false,
        cookie: '',
        otro: '',
        recomendacion: 'Intro',
        flagShowOptions: false,
        setI: '',
        show: true,
        count: 0
    },
    methods: {
        leerarchivo(){
           this.idPlantilla = id;
        },
        getData(){
            axios.get('https://backoffice.ideeo.mx/chat/' + this.idPlantilla)
            .then( response => {
                this.data = response.data
                this.idArbol = response.data.arbol.id
                this.getArbol()
                console.log("Data: ")
                console.log(this.data)
            }).catch( err => {
                console.log(err);
            })
        },
        validateReloadArbol(idNodo,nodoInit,final,add_text){
            let v = this
            console.log(idNodo+"-"+nodoInit+"-"+final+"-"+add_text)
            clearTimeout(v.setI)
            if( add_text == 1 ){
                v.showAddText = true;
            }else{
                v.determinateShow()
                v.arbol = []
                v.arbol2 = []
                v.flagShowOptions = false
                v.showAddText = false;
                if( final == 0 ){
                    if( idNodo == null ){
                        console.log("Nodo = null");
                    }else{
                        v.validateFlow(idNodo)
                        v.getReloadArbol(idNodo)
                    }
                }else{ //Validar existencia del nodo y continuidad del flujo
                    var data = JSON.stringify({
                        "nodo": nodoInit,
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
                            console.log("Continuación: "+JSON.stringify(response.data));
                            v.scroll_top()
                            if( response.data.content == 0 ){
                                //Fin chat
                                console.log("Final")
                                v.recomendacion = "Intro"
                                v.metrica('Arbol', 'Fin', 'Finalizar', 0)
                            }else{
                                if( v.show )
                                    v.arbol = response.data
                                else
                                    v.arbol2 = response.data                                
                                v.validateFlow(response.data.id)
                                v.recomendacion = response.data.etiqueta
                                v.metrica('Arbol', 'Recomendación', response.data.etiqueta, 0)
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
                if( this.show )
                    this.arbol = response.data
                else
                    this.arbol2 = response.data    
            }).catch( err => {
                console.log(err);
            })
        },
        getArbol(){
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + this.idArbol)
            .then( response => {
                if( this.show )
                    this.arbol = response.data
                else
                    this.arbol2 = response.data
            }).catch( err => {
                console.log(err);
            })
           
        },
        metrica(categoria, etiqueta, accion, opcion){
            if( opcion != 0 )
                categoria = categoria + " " + opcion
                etiqueta = this.otro

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
                console.log("metricas: add");
            }).catch( err => {
                console.log(err);
            })
            this.otro = ''
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
        getCookie() { /* Cookie google*/
            this.cookie = $cookies.get('_ga');
        },
        validateFlow(idNodo){
            let flag_inicio = false;
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
        showOptions(i){
            let v = this
            let time = i * 2 * 1000
            if( i <= 1 ) /* <= */
                time = time + 1000
            if( i > 4 )
                time = time - 500
            if( i >= 4 )
                time = time + 500
            this.setI = setTimeout(function(){
                v.flagShowOptions = true
            },time);
            v.scroll_bottom(i)
        },
        scroll_bottom(i){
            let time2 = i * 2 * 1000
            if( i < 2 )
                time2 = time2 - 1000
            this.setI = setTimeout(function(){
                document.getElementById('content-chat').scrollTop=document.getElementById('content-chat').scrollHeight
            },time2);
        },
        scroll_top(){
            document.getElementById('content-chat').scrollTop=0
        },
        determinateShow(){
            this.count = this.count + 1
            if( this.count%2 == 0 ){
                this.show = true
                document.getElementsByClassName('chat1').block
                document.getElementsByClassName('chat2').none
            }else{
                this.show = false
                document.getElementsByClassName('chat1').none
                document.getElementsByClassName('chat2').block
            }
        }
    },
    mounted(){
        this.leerarchivo();
        this.getData();
        this.getCookie()
        this.metrica('Arbol', 'Inicio', 'Iniciar', 0)
    }
})