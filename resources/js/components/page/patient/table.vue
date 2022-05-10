<template>

    <div>
         <router-link :to="{name: 'patientCreate' }" class="btn btn-success">Crear</router-link>
        <h2 class="text-center">Lista {{nameTable}}</h2>
       
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Numero Whatssap</th>
                <th>Correo</th>
                <th>Estado</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="patient in patients" :key="patient.id" >
                <td>{{ patient.id}}</td>
                <td>{{ patient.firstName}}</td>
                <td>{{ patient.lastName}}</td>
                <td>{{ patient.phoneWhatssap}}</td>
                <td>{{ patient.email}}</td>
                <td>{{ patient.status.description}}</td>              
                <td>{{ patient.name }}</td>
                <td>{{ patient.detail }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'patientEdit', params: { id: patient.id }}" class="btn btn-success">Editar</router-link>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                patients: [],
                nameTable:'pacientes'
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/patients/')
                .then(response => {
                    this.patients = response.data.data;
                });
        },
        methods: {
            patient(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/patients/${id}`)
                    .then(response => {
                        let i = this.patients.map(data => data.id).indexOf(id);
                        this.patients.splice(i, 1)
                    });
            }
        }
       
    }
</script>