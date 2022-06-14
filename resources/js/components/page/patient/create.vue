<template>
    <div>
        <h3 class="text-center">Crear paciente</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addPatient">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="patient.firstName">
                    </div>
                      <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" class="form-control" v-model="patient.lastName">
                    </div>
                      <div class="form-group">
                        <label>Numero Whatssap</label>
                        <input type="text" class="form-control" v-model="patient.phoneWhatssap">
                    </div>
                     <div class="form-group">
                        <label>Correo</label>
                        <input type="text" class="form-control" v-model="patient.email">
                    </div>
                    <button type="submit" class="btn btn-primary">Crear</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                patient: {}
            }
        },
        methods: {
            addPatient() {
                this.axios
                    .post('patients', this.patient)
                    .then(response => (
                        this.$router.push({ name: 'patientTable' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>