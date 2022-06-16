<template>
  <div>
    <!------------fin de header para todos---------------->
   <nav class="navbar navbar-light" style="background-color: #d2d7db;" v-if="!isLoggedIn">
      <div class="container-fluid justify-content-center">
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
          <li class="nav-item">
            <router-link to="/" class="nav-link" :class="{ active: $route.name === 'home' }">
              &nbsp;Home</router-link>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "App",
  data() {
    return {
      user: "",
      activeNow:false
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
    routerLink(route){
      this.activeNow = route.active
        this.$router.push({ name: 'administrator', params: { view: route.pathComponent } }) 
        

    }
  },

};
</script>
