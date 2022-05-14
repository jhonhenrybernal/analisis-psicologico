<template>
  <div class="container">
     <div class="row">
        <div class="col-md-4 offset-md-4">
           <div class="card form-holder">
              <div class="card-body pt-5 pb-5">
                 <h1 class="text-muted">Acceso</h1>
                  <form action="" method="post" @submit.prevent="submit">
                    <div class="alert" v-bind:class="{'alert-danger':classAlert}" v-if="alert" role="alert">
                                {{messageError}}
                     </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Dirección de correo electrónico</label>
                        <input type="email" class="form-control" v-model="form.email" aria-describedby="emailHelp" placeholder="Enter email">
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Clave</label>
                        <input type="password" class="form-control" v-model="form.password"  placeholder="Password">
                     </div>
                     <div class="form-check">
                     </div>
                     <button type="submit" class="btn btn-primary">Acceder</button>
                     </form>
              </div>
           </div>
        </div>
     </div>
  </div>
</template>


<script>
import { mapActions } from 'vuex'
/**
 * @author Jhon Bernal
 * @description Oyente vuex para enviar peticion al store
 */
   export default{
   
    data(){
      return{
         name:'Login',
         alert:false,
         messageError:'',
         typeAlert:false,
         classAlert:'',
      	form:{
      		email:'',
      		password:''
      	},
      	showError: false,
      }
    },

    methods:{
    	...mapActions(["login"]),

        submit: function () {
           this.$store.dispatch('login', this.form)
          .then(() => this.$router.push('/dashboard'))
          .catch(err => this.error(err))
        },
        error(value){
            this.alert=true
            this.classAlert= 'alert-danger'
            this.messageError= 'Error al acceder verifique correo o contraseña'
        }
    }


   }
</script>



<style>

.form-holder{
   margin-top:20%;
   margin-bottom:20%;
}
</style>