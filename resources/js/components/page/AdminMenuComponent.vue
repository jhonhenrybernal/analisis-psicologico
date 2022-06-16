<template>
  <div>
    <!------------fin de header para todos---------------->
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" v-if="isLoggedIn">
        <div class="position-sticky pt-3">
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Valoración</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column">
            <!--<li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-text-bottom" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Dashboard
                </a>
            </li>-->
            <li class="nav-item" v-for="item in items" :key="item.id">
            <router-link  v-if="item.module == 'administrator'" to="/administrator"  @click.native="routerLink(item)" class="nav-link" :class="{ active: activeNow === item.active }" >
                &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-users align-text-bottom" aria-hidden="true">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>{{item.nameButton}}</router-link>
            </li>
        </ul>
        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Parametrización del sistema</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle" class="align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item"  v-for="item in items" :key="item.id">
            <router-link  v-if="item.module == 'parameterization'" to="/administrator"  @click.native="routerLink(item)" class="nav-link" :class="{ active: activeNow === item.active }" >
                &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-layers align-text-bottom" aria-hidden="true">
                <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                <polyline points="2 17 12 22 22 17"></polyline>
                <polyline points="2 12 12 17 22 12"></polyline>
                </svg>{{item.nameButton}}</router-link>
            </li>
            
            <br>
            <li class="nav-item">&nbsp;
            <button class="btn btn-primary" @click="logout()"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                </svg> Salir del sistema</button>
            </li>
        </ul>
        </div>
    </nav>
  </div>
</template>

<script>
import Echo from 'laravel-echo'
window.Pusher = require('pusher-js')
export default {
  name: "App",
     mounted() {
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
           if (e.status && this.routeCurrent == 'administrator') {

               if (e.params.action == 'nueva_pre_imagen') {
                  localStorage.setItem('preImagen', true)
               }

               if (e.params.action =='acceso') {
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
  data() {
    return {
      items: [
        {module:'administrator',pathComponent: 'patient-table', active:  'patientTable' ,nameButton:'Pacientes'},
        {module:'administrator',pathComponent: 'assessment-table', active: 'tableAssessment' ,nameButton:'Valoración'},
        {module:'administrator',pathComponent: 'image-assessment-table', active: 'tableAssessmentImage' ,nameButton:'Imagenes valoración'},
        {module:'parameterization',pathComponent: 'status-table', active:  'statusTable' ,nameButton:'Estados'},
        {module:'parameterization',pathComponent: 'question-table', active: 'questionTable' ,nameButton:'Pregúntas'}
      ],
      user: "",
      activeNow:false,
      routeCurrent:''
    };
  },
  computed: {
    isLoggedIn: function () {
        this.routeCurrent = this.$route.name;
      return this.$store.getters.isLoggedIn;
    },
  },
  created() {
    if (this.isLoggedIn) {
      this.$store.dispatch("getUser");
    }
  },
  methods: {
    async logout() {
      await this.$store.dispatch("logout");
      this.$router.push("/");
    },
    routerLink(route){
      this.activeNow = route.active
        this.$router.push({ name: 'administrator', params: { view: route.pathComponent } }) 
        

    }
  },
};
</script>
