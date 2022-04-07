import Vue from 'vue'
import Router from 'vue-router'
import authorizer from './store'


import HomeComponent from './components/page/HomeComponent.vue'
import Login from './components/auth/LoginComponent.vue'
import Register from './components/auth/RegisterComponent.vue'


/**
 * @author Jhon Bernal
 * @description Parametrizacion  de rutas
 */
Vue.use(Router)

const router = new Router({
	mode:'history',
	routes:[
		{
			path:'',name:'home',component:HomeComponent
		},
		{
			path:'/login',name:'login',component:Login, meta : {guest: true}
		},
		{
			path:'/register',name:'register',component:Register, meta : {guest: true}
		},
	]
});

/**
 * @author Jhon Bernal
 * @description middleware 
 */
router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.requireAuth)) {
    if (authorizer.getters.isLoggedIn) {
      next();
      return;
    }
    next("/login");
  } else {
    next();
  }
});

router.beforeEach((to, from, next) => {
  if (to.matched.some((record) => record.meta.guest)) {
    if (authorizer.getters.isLoggedIn) {
      next("/home");
      return;
    }
    next();
  } else {
    next();
  }
});


export default router;

