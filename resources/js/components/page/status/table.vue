<template>

    <div>
         <router-link :to="{name: 'statusCreate' }" class="btn btn-success">Crear</router-link>
        <h2 class="text-center">Lista {{nameTable}}</h2>
       
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="statu in status" :key="statu.id">
                <td>{{ statu.id}}</td>
                <td>{{ statu.name}}</td>
                <td>{{ statu.description}}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'statusEdit', params: { id: statu.id }}" class="btn btn-success">Editar</router-link>
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
                status: [],
                nameTable:'estados'
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/status/')
                .then(response => {
                    this.status = response.data;
                });
        },
        methods: {
            patient(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/status/${id}`)
                    .then(response => {
                        let i = this.status.map(data => data.id).indexOf(id);
                        this.status.splice(i, 1)
                    });
            }
        }
    }
</script>