<template>
  <div>
    <!-- Modal -->
    <div v-if="showModal">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Para continuar</h4>
                  <!--   <button type="button" class="close" @click="showModal=false">
                    <span aria-hidden="true">&times;</span>
                  </button> -->
                </div>
                <div class="modal-body">
                  <h3>
                    Y tener una mejor experiencia,acepta!
                   
                  </h3>
                  <div class="row mb-3">
                    <button
                      type="submit"
                      class="btn btn-primary"
                      @click="fullscreen()"
                    >
                     <h3> <b> Ver en pantalla completa</b></h3> 
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
    <div class="mt-6 pt-3">
      <div class="row photos video-fullscreen">
        <video
          ref="therapyVideo"
          src=""
          id="video-container"
          width="100%"
          href="javascript:void(0);"
          controls
        ></video>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      viewFullscreen: false.valueOf,
      showModal: false,
    };
  },
  mounted() {
    this.showModal = true;
    this.$refs.therapyVideo.src =
      location.protocol +
      "//" +
      location.host +
      "/video-paciente/sietevideos.mp4";
  },
  methods: {
    fullscreen() {
      this.viewFullscreen = true;
      if (this.$refs.therapyVideo.requestFullscreen) {
        this.$refs.therapyVideo.requestFullscreen();
      } else if (this.$refs.therapyVideo.mozRequestFullScreen) {
        this.$refs.therapyVideo.mozRequestFullScreen();
      } else if (this.$refs.therapyVideo.webkitRequestFullscreen) {
        this.$refs.therapyVideo.webkitRequestFullscreen();
      } else if (this.$refs.therapyVideo.msRequestFullscreen) {
        this.$refs.therapyVideo.msRequestFullscreen();
      }

      this.$refs.therapyVideo.play();
    },
  },
};
</script>
