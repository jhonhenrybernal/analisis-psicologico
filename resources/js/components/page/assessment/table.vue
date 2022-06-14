<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <router-link :to="{ name: 'patientCreate' }" class="btn btn-success">Crear</router-link>
                    <h2 class="text-center">Lista {{ nameTable }}</h2>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Paciente</th>
                                    <th>Estado</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="ass in assessment" :key="ass.id">
                                    <td>{{ ass.id }}</td>
                                    <td>{{ ass.patient.firstName }} {{ ass.patient.lastName }}</td>
                                    <td>{{ ass.status.description}}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button @click="executeEvent(ass.id,ass.status.name)"
                                                class="btn btn-success">{{nameEvent(ass.status.name)}}</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>

window.Pusher = require('pusher-js')
export default {
    data() {
        return {
            name: 'PageIndex',
            assessment: [],
            nameTable: 'Valoración',
            event:''
        }
    },

    created() {
        this.$store.dispatch("getAssessments").then(
            respo => {
                this.assessment = respo.data.data
            }).catch(err => this.error(err));
    },
    methods:{
        executeEvent(id,status){

            if (status == 'valoracion_iniciada') {
                this.event = 'Ver valoración'
                this.$router.push({ name: 'tracingAssessment', params: { id: id } })   
            }
        },
        nameEvent(status){
            let name = ''
            if (status == 'valoracion_iniciada') {
                name = 'Ver valoración'
                 
            }
            return name
        }
    }

}
</script>