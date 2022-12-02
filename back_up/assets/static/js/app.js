var app = new Vue({
    el: '#app',
    data: {
        data: {},
        arbol: [],
        idArbol: '',
        idPlantilla: ''
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
             //   console.log(response.data);
                this.idArbol = response.data.arbol.id
                this.getArbol()
            }).catch( err => {
                console.log(err);
            })
        },
        getReloadArbol(idNodo){
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + idNodo)
            .then( response => {
                this.arbol = response.data
               // console.log(response.data);
            }).catch( err => {
                console.log(err);
            })
        },
        getArbol(){
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + this.idArbol)
            .then( response => {
                this.arbol = response.data
               // console.log(response.data);
            }).catch( err => {
                console.log(err);
            })
           
        },
        metrica(categoria, etiqueta, accion){
            
            console.log("In metrica")

            let data = new FormData();
            data.append('dominio','9');
            data.append('ruta','https://chatbot.ideeo.mx/');
            data.append('localizacion','');
            data.append('sesion','');
            data.append('canal','Directo');
            data.append('seccion','Home');
            data.append('categoria', categoria);
            data.append('etiqueta', etiqueta);
            data.append('accion', accion);
            data.append('tipo','html');

            axios.post('https://backoffice.ideeo.mx/ideeo/metricas', data)
            .then( response => {
                console.log(response.data);
            }).catch( err => {
                console.log(err);
            })
           
        }
    },
    mounted(){
        this.leerarchivo();
        this.getData();
        this.metrica('Inicio', '', 'Ingreso')
    }
})