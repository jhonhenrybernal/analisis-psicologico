<template>
    <div>
        <h3 class="text-center">Crear estados</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addStatus">
                    <div class="form-group">
                        <label>Nombre <b>ejemplo(prueba_uno)</b> </label>
                        <input type="text" class="form-control" v-model="status.name">
                    </div>
                      <div class="form-group">
                        <label>Descripcion <b>ejemplo(Prueba uno)</b> </label>
                        <input type="text" class="form-control" v-model="status.description">
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
                status: {}
            }
        },
        methods: {
            addStatus() {
                this.axios
                    .post('status', this.status)
                    .then(response => (
                        this.$router.push({ name: 'statusTable' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>