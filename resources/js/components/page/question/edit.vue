<template>
    <div>
        <h3 class="text-center">Editar Paciente</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateQuestion">
                    <div class="form-group">
                        <label>Pregunta</label>
                        <input type="text" class="form-control" v-model="question.question">
                    </div>
                      <div class="form-group">
                        <label>Estado</label>
                        <select v-model="question.status_id" class="form-control">
                            <option disabled value="">Seleccione un estado</option>
                            <option v-for="item in status" :value="item.id" :key="item.id">
                                  {{ item.description }}
                            </option>
                        </select>
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
                question: {},
                checked: Boolean,
                 status:[]
            }
        },
        created() {
           axios.get(`questions/${this.$route.params.id}`)
            .then((res) => {
                this.question = res.data;
            });
            axios.get('status', {}).then(response => {
                this.status = response.data
            }).catch(e => {
                console.log(e);
            });
            
        },
        methods: {
            updateQuestion() {
                axios.patch(`questions/${this.$route.params.id}`, this.question)
                    .then((res) => {
                        this.$router.push({ name: 'questionTable' });
                    });
            }
        }
    }
</script>