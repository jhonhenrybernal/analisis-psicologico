<template>
  <div>
    <nav class="navbar navbar-light" style="background-color: #d2d7db;">
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
        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0" v-if="isLoggedIn">
          <li class="nav-item">
            <router-link
              to="/dashboard"
              class="nav-link"
              :class="{ active: $route.name === 'dashboard' }"
            >
              &nbsp;Dashboard</router-link
            >
          </li>
        </ul>
        <div class="col-md-3 text-end sing-up navbar-main" v-if="isLoggedIn">
          <button type="button" class="btn btn-primary"  @click="logout()">Cerrar sesion</button>
        </div>
      </div>
    </nav>

    <div class="mt-5 pt-3">
      <router-view></router-view>
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
