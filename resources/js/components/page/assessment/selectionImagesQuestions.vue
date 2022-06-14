<template>
</template>
<script>
export default {
    data() {
        return {
         
        }
    },

    created() {
        this.$store.dispatch("getAssessments").then(
            respo => {
                this.assessment = respo.data.data
            }).catch(err => this.error(err));
    },
    methods:{
       
       
    }

}
</script>