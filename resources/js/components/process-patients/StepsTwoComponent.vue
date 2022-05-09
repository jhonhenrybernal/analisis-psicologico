<template>
  <div> 
    <div class="lightbox-gallery">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Bienvenido!</h2>
                <p class="text-center">{{firstname }} {{lastname}} seleccione tus imagenes</p>
            </div>
            <div class="row photos"> 
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"> <button   v-on:click="clickSelect('selectone')"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"> <button   v-on:click="clickSelect('selecttwo')"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/zmzERpe.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/gX11Vt5.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/pZcUS2Y.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
                <div class="col-sm-6 col-md-4 col-lg-3 item"><div class="button-container"><img class="img-fluid" src="https://i.imgur.com/06Ajq7f.jpg"> <button   v-on:click="clickSelect()"  :class="{activeSelect: isActiveSelect}">Seleccione</button></div></div>
            </div>
            <div class="row mb-3">
              <button type="submit" class="btn btn-primary" v-on:click="continueProcess()">Continuar</button>                           
            </div>
        </div>
    </div>
  </div>
</template>
<script>
export default {
  
  data() {
     
    return {
      firstname: localStorage.getItem('firstname'),
      lastname: localStorage.getItem('lastname'),
      isActiveSelect:false,
      listSelect:[] ,
      listFinal:[],
      show: true,
      value: "",
    };
  },
  methods: {
    clickSelect:function (Selected) {
     if (event.target.classList.contains('activeSelect')) {
        event.target.classList.remove("activeSelect");
        this.builderSelection('false',Selected)
        return
      }
      event.target.className += "activeSelect";
      this.builderSelection('true',Selected)

    
    },
    builderSelection(status,selected){
      
        this.listSelect.push({
          id: '1111',
          title: selected
        })

        const extractValues = ({id, title}) => [id, title];
        this.listFinal = this.listSelect.map(extractValues)  
        return this.listFinal 
    },
    continueProcess(){
      console.log(this.listFinal)
      this.$router.push('stepTree') 
    }
    
  },
};
</script>
