<template>
  <div>
    <div v-if="open" class="modal-images">
      <div class="mt-2">
        <div class="slide-item">
          <img v-bind:src="'../'+ path" align="center">
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import Echo from "laravel-echo";
window.Pusher = require("pusher-js");
export default {

  data() {

    return {
      images: [],
      open: false,
      path:''
    };
  },
  
   mounted() {

    window.Echo = new Echo({
      broadcaster: "pusher",
      key: "ASDASD2121",
      wsHost: window.location.hostname,
      wsPort: 6001,
      disableStats: true,
      disableStats: true,
      forceTLS: false,
      cantidadPreImg: 0,
      selectImages: [],
      routeName: '',
      actionEvent:''
    });
    window.Echo.channel("patient").listen("patientProcess", (e) => {
       if (e.status) {
        if ((e.params.accion = "imagen_select_question")) {
          if (e.params.evento == "imagen_seleccionado") {
             this.open = true
              this.path = e.params.path
              if (this.path == 'fin') {
                this.$router.push({
                  name: 'stepFive',
                  params: {
                    tipo: this.$route.params.evento,
                    id_asessment: this.$route.params.id_asessment,
                  },
                 });
              }
          }
          if (e.params.evento == "pause_video") {
           this.$refs.therapyVideo.pause();
          }
        }     
      }
    });
  }
};
</script>
<style>
.slide-item{
  width: 100%; 
  height: 100%; 
  position: fixed; 
  left: 0px; 
  top: 0px; 
  z-index: -1;
  background-size: cover;
}

.slide-item img{
    height: 99%;
    
}
</style>