<template>
    <div>
        <h3 class="text-center">Editar Paciente</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatePatient">
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
                     <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" id="checkbox" v-model="patient.status_id" :true-value="'1'"  :false-value="'2'">
                            <label for="checkbox">{{ patient.status_id ==1?'Activo':'Inactivo' }}</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                patient: {},
                checked: Boolean,
                descripcion: ''
            }
        },
        created() {
            this.axios
                .get(`patients/${this.$route.params.id}`)
                .then((res) => {
                    this.patient = res.data;
                    this.descripcion = res.data.status.description
                });
        },
        methods: {
            updatePatient() {
                this.axios
                    .put(`patients/${this.$route.params.id}`, this.patient)
                    .then((res) => {
                        this.$router.push({ name: 'patientTable' });
                    });
            }
        }
    }
</script>