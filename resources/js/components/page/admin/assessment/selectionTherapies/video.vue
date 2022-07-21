<template>
  <div>
    <div class="row">
      <div class="column">
        <div class="row photos video-fullscreen">
          <video
            ref="therapyVideo"
            src=""
            id="video-container"
            width="100%"
            href="javascript:void(0);"
            style="pointer-events: none"
          ></video>
        </div>
      </div>
      <div class="column diff-two">
           <div
          class="botón"
          @click="controlVideo"
          v-bind:class="{ active: isActive }"
        >
          <div class="fondo" x="0" y="0" width="200" height="200"></div>
          <div class="icono" width="200" height="200">
            <div
              class="parte izquierda"
              x="0"
              y="0"
              width="200"
              height="200"
            ></div>
            <div
              class="parte derecha"
              x="0"
              y="0"
              width="200"
              height="200"
            ></div>
          </div>
          <div class="puntero"></div>
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
      transitionEnd:
        "transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd",
      isActive: false,
    };
  },
  mounted() {
    this.showModal = true;
    this.$refs.therapyVideo.src =
      location.protocol +
      "//" +
      location.host +
      "/video-paciente/sietevideos.mp4";

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
      accionControlForPatient:''
    });
    window.Echo.channel("patient").listen("patientProcess", (e) => {
       if (e.status) {
        if ((e.params.accion = "proceso_video")) {
          if(!this.$refs.therapyVideo){
            return
          }
          if (e.params.evento == "play_video") {
            this.$refs.therapyVideo.play();
            this.isActive=true
          }

          if (e.params.evento == "pause_video") {
            this.$refs.therapyVideo.pause();
            this.isActive=false
          }
        }     
      }
    });
  },
  methods: {
    controlVideo() {
      this.isActive = !this.isActive;
      if (this.isActive) {
        this.$refs.therapyVideo.play();
        this.accionControlForPatient = 'play'
      } else {
        this.$refs.therapyVideo.pause();
        this.accionControlForPatient = 'pause'
      }
        axios
        .get(
          "/assessments/process/video/play/" + this.accionControlForPatient + "/" + this.$route.params.id_asessment,
          {}
        )
        .then((response) => {
        })
        .catch((e) => {
        });
    },
  },
};
</script>