<template>

    <div>     
        <div class="container">
  <div class="row">
    <div class="col-12">
         <router-link :to="{name: 'statusCreate' }" class="btn btn-success">Crear</router-link>
        <h2 class="text-center">Lista {{nameTable}}</h2>

      <div class="table-responsive">
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
     </div>
      </div>
       </div>
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
            this.$store.dispatch("getStatus").then(
                respo=> {
                    this.status = respo.data
                }).catch(err => this.error(err));
        },
    }
</script>