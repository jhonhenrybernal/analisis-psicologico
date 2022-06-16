<template>
    <div>
        <h3 class="text-center">Crear preguntas</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addQuestion">
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
                question: {},
                status:[]
            }
        },
        created() {
            
            axios.get('status', {}).then(response => {
                this.status = response.data
            }).catch(e => {
                console.log(e);
            });
            
        },
        methods: {
            addQuestion() {
                axios.post('questions', this.question).then(response => {
                   this.$router.push({ name: 'questionTable' })
                }).catch(e => {
                    console.log(e);
                });
            },
            
        }
    }
</script>