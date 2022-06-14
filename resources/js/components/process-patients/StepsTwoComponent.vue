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
                    <img   v-bind:src="'../'+img.path"><button  type="button" class="btn" v-on:click="clickSelect(img.path)" @click="open = true">Seleccione</button>
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
        <span class="close-image" @click="open = false">&times;</span>
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
      question:[]
    };
  },
  created() {
    axios.get('assessments/images/patients', {}).then(response => {
        this.images = response.data.data
    }).catch(e => {
        console.log(e);
    });
  },
  methods: {
    clickSelect:function (img) {
      this.imgPath = img
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
      console.log(this.listFinal)
      this.$router.push('stepTree') 
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