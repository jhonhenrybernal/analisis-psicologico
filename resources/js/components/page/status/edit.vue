<template>
    <div>
        <h3 class="text-center">Editar stato</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateStatus">
                      <div class="form-group">
                        <label>Nombre <b>ejemplo(prueba_uno)</b> </label>
                        <input type="text" class="form-control" v-model="status.name">
                    </div>
                      <div class="form-group">
                         <label>Descripcion <b>ejemplo(Prueba uno)</b> </label>
                        <input type="text" class="form-control" v-model="status.description">
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
            this.axios
                .get(`status/${this.$route.params.id}`)
                .then((res) => {
                    this.status = res.data.data;
                });
        },
        methods: {
            updateStatus() {
                this.axios
                    .put(`status/${this.$route.params.id}`, this.status)
                    .then((res) => {
                        this.$router.push({ name: 'statusTable' });
                    });
            }
        }
    }
</script>