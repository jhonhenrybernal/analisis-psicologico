<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <router-link :to="{ name: 'questionCreate' }" class="btn btn-success">Crear</router-link>
                    <h2 class="text-center">Lista {{ nameTable }}</h2>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pregunta</th>
                                    <th>Estado</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="question in questions" :key="question.id">
                                    <td>{{ question.id }}</td>
                                    <td>{{ question.question }}</td>
                                    <td>{{ question.status.description }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <router-link :to="{ name: 'questionEdit', params: { id: question.id } }"
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

import Swal from 'sweetalert2'
export default {
    data() {
        return {
            name: 'PageIndex',
            questions: [],
            nameTable: 'Preguntas'
        }
    },

    created() {
        this.$store.dispatch("getRequest","questions").then(
        respo => {
            this.questions = respo.data.data
        }).catch(err => this.error(err));
    },

}
</script>