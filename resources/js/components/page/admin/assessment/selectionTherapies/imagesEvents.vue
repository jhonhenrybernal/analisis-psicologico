<template>
    <div>
      
    </div>
</template>
 
<script>

export default {
    data() {
        return {
         
        }
    },
    created() {
          this.$store.dispatch("getRequest","assessments").then(
            respo => {
                this.assessment = respo.data.data
            }).catch(err => this.error(err));
    },
    methods:{
       
    }
}
</script>