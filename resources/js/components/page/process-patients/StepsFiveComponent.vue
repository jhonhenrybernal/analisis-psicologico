<template>
  <div>
    <div v-if="open" class="modal-images">
      <div class="mt-2">
        <div class="slide-item">
          <img src="http://localhost:8000/images/espiritual/prueba.jpg" align="center">
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {

  data() {

    return {
      images: [],
      open: false,
    };
  },
  created() {
    this.getPatientsImage();
  },
  methods: {
    getPatientsImage() {

      this.open = true
      axios
        .get(
          "assessments/images/patients/" + this.$route.params.id_asessment,
          {}
        )
        .then((response) => {
          this.images = response.data.data;
        })
        .catch((e) => {
          console.log(e);
        });
    },
    close(id) {
      this.open = false;
    },
  },
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