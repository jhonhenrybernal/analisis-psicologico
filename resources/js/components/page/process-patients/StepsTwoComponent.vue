<template>
  <div> 
    <div class="lightbox-gallery">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Bienvenido!</h2>
                <p class="text-center">{{firstname }} {{lastname}} seleccione tus imagenes</p>
            </div>
            <div class="container">
                <div class="row-images"> 
                <div class="column-images" v-for="img in images" :key="img.id" >
                  <div class="button-container">
                    <img   v-bind:src="'../'+img.path"><button  type="button" class="btn" v-on:click="clickSelect(img)" @click="open = true">Seleccione</button>
                  </div>
                  
                </div>  
              </div>
            </div>
             <div class="row mb-3">
              <button type="submit" class="btn btn-primary" v-on:click="continueProcess()">Continuar</button>                           
            </div>
        </div>
    </div>
    <div v-if="open" class="modal-images">
        <span class="close-image" @click="close(idImage)">&times;</span>
        <img class="modal-content" v-bind:src="'../'+imgPath">
        <div id="caption" v-if="questionView">
          <div class="form-control">
            <span>Seleccione</span>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" v-model="question.id">
              <label class="form-check-label" for="defaultCheck1">
                {{question.name}}
              </label>
            </div>
          </div>
        </div>
       <!--   <div class="cuestions-modal">
          <div class="form-control">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Default checkbox
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
              <label class="form-check-label" for="defaultCheck2">
                Disabled checkbox
              </label>
            </div>
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
      firstname: localStorage.getItem('firstname'),
      lastname: localStorage.getItem('lastname'),
      isActiveSelect:false,
      listSelect:[] ,
      listFinal:[],
      show: true,
      value: "",
      images: [],
      open: false,
      imgPath:'',
      question:[],
      questionView:false,
      idImage:0
    };
  },
  created() {
    this.getPatientsImage()
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
          selectImages:[]
          
      })
        window.Echo.channel('patient').listen('patientProcess', (e) => {
          if (e.status) {
              if (e.params.action = 'nueva_pre_imagen_patient') {
                if (e.params.evento == 'pre_patient') {      
                    this.open = false
                    this.imgPath = ''
                    this.selectImages = e.params.images_selected
                    this.getPatientsImage()

                }
              }
                
          }

      })
  },
  methods: {
    clickSelect:function (img) {
      this.imgPath = img.path
      this.idImage = img.id
      this.getImage(img.id,'pre')

      
    },
    close(id){
      this.open = false
      this.getImage(id,'close')
    },
    getImage(id,action){
       this.axios.get(`/assessments/images/pre-select/${id}/${action}`)
        .then((res) => {
        });
    },
    builderSelection(status,selected){
      
        this.listSelect.push({
          id: '1111',
          title: selected
        })

        const extractValues = ({id, title}) => [id, title];
        this.listFinal = this.listSelect.map(extractValues)  
        return this.listFinal 
    },
    continueProcess(){
      this.$router.push('stepTree') 
    },
    getPatientsImage(){
       axios.get('assessments/images/patients/'+ this.$route.params.id_asessment, {}).then(response => {
        this.images = response.data.data
      }).catch(e => {
          console.log(e);
      });
    }
  }
};
</script>
<style>
img {
 height: 100%;
 width: 100%;
 object-fit: contain;
}
</style>