<template>
  <div> 
    <div class="lightbox-gallery">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Bienvenido!</h2>
                <p class="text-center">{{firstname }} {{lastname}} seleccione tus imagenes</p>
            </div>
            <div class="row photos">  
             <video width="100%" controls id="myvideo">
              <source :src="videourl" type="video/mp4">
            </video>
            </div>
            <div class="row mb-3">
              <button type="submit" class="btn btn-primary" v-on:click="continueProcess()">Continuar</button>                           
            </div>
        </div>
    </div>
  </div>
</template>
<script>
export default {
  
  data() {
     
    return {
      videourl:location.protocol+"//"+location.host+"/video-paciente/sietevideos.mp4",
    };
  },
  methods: {
    clickSelect:function (Selected) {
     if (event.target.classList.contains('activeSelect')) {
        event.target.classList.remove("activeSelect");
        this.builderSelection('false',Selected)
        return
      }
      event.target.className += "activeSelect";
      this.builderSelection('true',Selected)

    
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
      this.$router.push('stepFive') 
    }
    
  },
};
</script>
