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
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Numero Whatssap</th>
                                    <th>Correo</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="patient in patients" :key="patient.id">
                                    <td>{{ patient.id }}</td>
                                    <td>{{ patient.firstName }}</td>
                                    <td>{{ patient.lastName }}</td>
                                    <td>{{ patient.phoneWhatssap }}</td>
                                    <td>{{ patient.email }}</td>
                                    <td>{{ patient.name }}</td>
                                    <td>{{ patient.detail }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <router-link :to="{ name: 'patientEdit', params: { id: patient.id } }"
                                                class="btn btn-success">Editar</router-link>
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
export default {
    data() {
        return {
            name: 'PageIndex',
            patients: [],
            nameTable: 'pacientes'
        }
    },
    created() {
        this.$store.dispatch("getPatients").then(
            respo => {
                this.patients = respo.data.data
            }).catch(err => this.error(err));
    },

}
</script>