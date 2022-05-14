<template>
  <div>
    
     <nav class="navbar navbar-light" style="background-color: #d2d7db;" v-if="!isLoggedIn">
      <div class="container-fluid justify-content-center">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li class="nav-item">
            <router-link
              to="/"
              class="nav-link"
              :class="{ active: $route.name === 'home' }"
            >
              &nbsp;Home</router-link
            >
          </li>
        </ul>
      </div>
    </nav>
    <!------------fin de header para todos---------------->

    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow" v-if="isLoggedIn">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Espiritual</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
     
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <a class="nav-link px-3" @click="logout()">Salir</a>
        </div>
      </div>
    </header>

    <div class="container-fluid">
      <div class="row">
          <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" v-if="isLoggedIn">
            <div class="position-sticky pt-3" >
              <ul class="nav flex-column">
                <!--<li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home align-text-bottom" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    Dashboard
                  </a>
                </li>-->
                <li class="nav-item">
                  
                     <router-link
                      to="/patient"
                      class="nav-link"
                      :class="{ active: $route.name === 'patientTable' }"
                    >
                      &nbsp; <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-text-bottom" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>Pacientes</router-link
                    >
                </li>
              </ul>
               <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                <span>Parametrización del sistema</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                  <span data-feather="plus-circle" class="align-text-bottom"></span>
                </a>
              </h6>
              <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <router-link
                      to="/status"
                      class="nav-link"
                      :class="{ active: $route.name === 'statusTable' }"
                    >
                      &nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers align-text-bottom" aria-hidden="true"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>Estados</router-link>
                </li>
              </ul>          
            </div>
          </nav>
          <div v-if="isLoggedIn">
              <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="mt-5 pt-3">
                  <router-view></router-view>
                </div>
              </main>
          </div>
          <div v-if="!isLoggedIn">            
              <div class="mt-5 pt-3">
                <router-view></router-view>
              </div>
          </div>
      </div>
    </div>
</div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      user: "",
    };
  },
  computed: {
    isLoggedIn: function () {
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
  },
};
</script>
