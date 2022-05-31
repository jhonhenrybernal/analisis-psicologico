<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">Iniciar valoración</div>
            <div class="card-body">
              <form action="#" @submit.prevent="inforPatients">
                <div class="alert" v-bind:class="{ 'alert-danger': typeAlert }" v-if="alert" role="alert">
                  {{ messageError }}
                </div>
                <div class="row mb-3">
                  <div class="input-group ">
                    <input v-model="form.email" placeholder="Correo" class="form-control" autocomplete="off">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="Codigo" class="col-md-4 col-form-label text-md-end">Codigo</label>

                  <div class="col-auto">
                    <input id="codigo" type="password" class="form-control" v-model="form.cod" autocomplete="off"
                      required>
                    <div id="codigoHelp" class="form-text">Ingrese el codigo que fue enviado a su correo.</div>
                  </div>
                </div>
                <div class="row mb-3">
                  <button type="submit" class="btn btn-primary">Continuar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      form: {
        email: "",
        cod: ''
      },
      show: true,
      value: "",
      typeAlert: false,
      alert: false,
      messageError: ''

    };
  },
  methods: {
    inforPatients(event) {
      event.preventDefault();
      this.$store.dispatch("getProcessPatient", { email: this.form.email, code: this.form.cod }).then(
        respo => {
          this.response(respo)
        }).catch(err => console.log(err)).finally(() => this.loading = false);

    },
    response(value) {
      if (value.data.status) {
        this.$router.push('stepTwo')
        localStorage.setItem('access-assessments', true)
        localStorage.setItem('cod', this.form.cod)
      } else {
        this.alert = true
        this.typeAlert = true
        this.typeAlert = 'alert-danger'
        this.messageError = value.data.message
      }
    },
    noAccess(value) {
      console.log(JSON.parse(value))
      Swal.fire({
        title: 'Error!',
        text: 'No tienes acceso',
        icon: 'error',
        confirmButtonColor: '#3085d6',
        confirmButtonText: '<i class="fa fa-thumbs-down"></i> Bueno!'
      })
    },
    onReset(event) {
      event.preventDefault();
      // Reset our form values
      this.form.firstname = "";
      this.form.lastname = "";
      this.form.cod = '';

      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
  },
};
</script>
