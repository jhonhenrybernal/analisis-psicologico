<template>
    <div>
        <h3 class="text-center">Editar stato</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateStatus">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="patient.name">
                    </div>
                      <div class="form-group">
                        <label>Descripcion</label>
                        <input type="text" class="form-control" v-model="patient.description">
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
                status: {}
            }
        },
        created() {
            console.log('aca')
            this.axios
                .get(`http://localhost:8000/api/status/${this.$route.params.id}`)
                .then((res) => {
                    this.status = res.data;
                });
        },
        methods: {
            updateStatus() {
                this.axios
                    .patch(`http://localhost:8000/api/status/${this.$route.params.id}`, this.status)
                    .then((res) => {
                        this.$router.push({ name: 'statusTable' });
                    });
            }
        }
    }
</script>