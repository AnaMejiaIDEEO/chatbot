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
           console.log("Plantilla: " + this.idPlantilla);
        },
        getData(){
            axios.get('https://backoffice.ideeo.mx/chat/' + this.idPlantilla)
            .then( response => {
                this.data = response.data
                console.log(response.data);
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
                console.log(response.data);
            }).catch( err => {
                console.log(err);
            })
        },
        getArbol(){
            axios.get('https://backoffice.ideeo.mx/respuesta?nodo=' + this.idArbol)
            .then( response => {
                this.arbol = response.data
                console.log(response.data);
            }).catch( err => {
                console.log(err);
            })
           
        }
    },
    mounted(){
        this.leerarchivo();
        this.getData();
    }
})