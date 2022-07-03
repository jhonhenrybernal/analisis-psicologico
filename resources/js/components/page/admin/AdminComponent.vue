<template>
  <div>
    <patient-table v-if="view == 'patient-table'"></patient-table>
    <assessment-table v-if="view == 'assessment-table'"></assessment-table>
    <image-assessment-table v-if="view == 'image-assessment-table'"></image-assessment-table>
    <status v-if="view == 'status-table'"></status>
    <question v-if="view == 'question-table'"></question>
  </div>
</template>

<script>
import patientTable from './patient/table.vue'
import AssessmentTable from './assessment/table.vue'
import ImageAssessmentTable from './imageAssessment/table.vue'
import Question from './question/table.vue'
import Status from './status/table.vue'

import Echo from 'laravel-echo'
window.Pusher = require('pusher-js')
export default {
    data() {
        return {
            view: ''
        }
    },
    components: {patientTable,AssessmentTable,ImageAssessmentTable,Question,Status},
    mounted() {
        this.view = ''
        this.view = this.$route.params.view
        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: 'ASDASD2121',
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
            disableStats: true,
            forceTLS: false,
            cantidadPreImg :0
        })
        window.Echo.channel('patient').listen('patientProcess', (e) => {
           if (e.status) {

               if (e.params.action === 'nueva_pre_imagen') {
                  localStorage.setItem('preImagen', true)
               }
               if (e.params.action === 'acceso') {
                    Swal.fire({
                        title: 'Hola!',
                        text: 'Tienes una nueva valoracion del paciente ' + e.params.nombrePaciente,
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '<i class="fa fa-thumbs-up"></i> Iniciar Valoración!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.$router.push({ name: 'tracingAssessment', params: { id: e.params.idValoracion } })
                        } else if (result.isDenied) {

                        }
                    })
                    this.activeNotification = true
                }             
            }
        })
    },
};
</script>
