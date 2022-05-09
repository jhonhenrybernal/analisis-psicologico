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
    continueProcess(){
      console.log(location.protocol);
      //this.$router.push('stepFourt') 
    }
    
  },
  
};
</script>
