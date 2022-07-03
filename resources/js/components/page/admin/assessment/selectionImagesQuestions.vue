<template>
    <div>
        <div class="container-select-image">
            <div>
                <h4>Imagenes pre seleccionadas</h4>
                 <div class="loading-pre-images">
                       <img v-bind:src="'../'+imgPath" alt="Cinque Terre" class="img-pre" v-if="imagenPreseleccionada">           
                    <div v-if="imagenNoPreseleccionada" >    
                        <div class="lds-ellipsis">Escogiendo<div></div><div></div><div></div><div></div></div>
                    </div>
                   
                </div>
            </div>
             <div class="">
                  <button type="button" class="button-select-image" @click="addPreImage(imgPath)">Añadir imagen pre seleccionada</button>
            </div>
            <h4>Imagenes seleccionadas</h4>
             <div class="container">
                <div class="row-images"> 
                    <div v-for="img in listImage" :key="img.id" class="column-images" >
                        <img v-bind:src="'../'+img.image_assessment.path"  alt="Cinque Terre" width="600" height="400">
                        <div class="desc-questions-select">Add a description of the image here</div>  
                    </div>
                </div>
            </div>
           <!--  <div class="">
                   <div class="gallery-questions-select">
                        <a target="_blank" href="https://www.w3schools.com/css/img_5terre.jpg">
                            <img src="https://www.w3schools.com/css/img_5terre.jpg" alt="Cinque Terre" width="600" height="400">
                        </a>
                        <div class="desc-questions-select">Add a description of the image here</div>
                        
                    </div>
                    
                    <div class="gallery-questions-select">
                        <a target="_blank" href="https://www.w3schools.com/css/img_forest.jpg">
                            <img src="https://www.w3schools.com/css/img_forest.jpg" alt="Forest" width="600" height="400">
                        </a>
                        <div class="desc-questions-select">Add a description of the image here</div>
                    </div>

                    <div class="gallery-questions-select">
                        <a target="_blank" href="https://www.w3schools.com/css/img_lights.jpg">
                            <img src="https://www.w3schools.com/css/img_lights.jpg" alt="Northern Lights" width="600" height="400">
                        </a>
                        <div class="desc-questions-select">Add a description of the image here</div>
                    </div>

                    <div class="gallery-questions-select">
                        <a target="_blank" href="https://www.w3schools.com/css/img_mountains.jpg">
                            <img src="https://www.w3schools.com/css/img_mountains.jpg" alt="Mountains" width="600" height="400">
                        </a>
                        <div class="desc-questions-select">Add a description of the image here</div>
                    </div>
            </div> -->
        </div>
      
     
       
        

      
    </div>
</template>
<script>

import Echo from 'laravel-echo'
window.Pusher = require('pusher-js')
export default {
    data() {
        return {
            imagenPreseleccionada:false,
            imagenNoPreseleccionada:true,
            process_assessments_id:0,
            listImage:[]
        }
    },
    mounted() {
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'ASDASD2121',
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
            disableStats: true,
            forceTLS: false,
            cantidadPreImg :0,
            
        })
         window.Echo.channel('patient').listen('patientProcess', (e) => {
            if (e.status) {
               if (e.params.action = 'nueva_pre_imagen') {
                    if (e.params.evento == 'pre') {      
                        this.imagenPreseleccionada = true
                        this.imagenNoPreseleccionada =false
                        this.imgPath = e.params.imagen
                    }else if(e.params.evento == 'close'){
                        localStorage.removeItem('pathImagen');
                        localStorage.removeItem('preImagen')
                        this.imagenPreseleccionada = false
                        this.imagenNoPreseleccionada =true
                        this.imgPath = ''
                    }
                }
                 
            }

        })
    },

    created() {
        this.$store.dispatch("getAssessments").then(
            respo => {
                this.assessment = respo.data.data
            }).catch(err => this.error(err));
            localStorage.removeItem('preImagen');
            if (localStorage.getItem('pathImagen') !== null) {
                this.imagenPreseleccionada = true
                this.imagenNoPreseleccionada =false
                this.imgPath  = localStorage.getItem('pathImagen');
            }
        this.listImageSelect()
    },
    methods: {
        addPreImage(imgPath){
            let preImages = {
                path : this.imgPath,
                process_assessments_id : this.$route.params.params.id}
            this.axios.post('/assessments/process/add-pre-image', preImages)
            .then(response => (
                this.process_assessments_id = response.data.id
                
            ))
            .catch(err => console.log(err))
            .finally(() => this.loading = false)
            localStorage.removeItem('pathImagen');
            localStorage.removeItem('preImagen')
            this.imagenPreseleccionada = false
            this.imagenNoPreseleccionada =true
            this.imgPath = ''
            this.listImageSelect()
        },
        listImageSelect(){
                this.axios
                .get(`/assessments/process/all-image-select/${this.$route.params.params.id}`)
                .then((res) => {

                    this.listImage = res.data.data;
                   
                });
        }

    }

}
</script>