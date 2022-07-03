<template>
  <div>

    <header class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0 shadow" v-if="isLoggedIn">
      <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Espiritual</a>
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </header>

    <div class="container-fluid">
      <div class="row">
        <admin-process-patients-component ></admin-process-patients-component>
        <!------------fin de header para todos---------------->
        <admin-menu-component v-if="isLoggedIn"></admin-menu-component>
        <main :class="{ 'col-md-9 ms-sm-auto col-lg-10 px-md-4': isLoggedIn }">
          <div class="mt-5 pt-3">
            <transition name="view">
                <router-view/>
            </transition>
          </div>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import AdminMenuComponent from '../components/page/AdminMenuComponent.vue';
import AdminProcessPatientsComponent from '../components/page/AdminProcessPatientsComponent.vue'
export default {
  name: "App",
  components:{AdminMenuComponent, AdminProcessPatientsComponent},
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
  },
};
</script>
