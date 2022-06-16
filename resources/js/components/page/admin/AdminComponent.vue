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
    },
};
</script>
