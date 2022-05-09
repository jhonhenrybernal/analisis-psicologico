import Vue from 'vue'
import Router from 'vue-router'
import authorizer from './store'


import HomeComponent from './components/page/HomeComponent.vue'
import Login from './components/auth/LoginComponent.vue'
import Register from './components/auth/RegisterComponent.vue'
import StepOne from './components/process-patients/StepsOneComponent.vue'
import StepTwo from './components/process-patients/StepsTwoComponent.vue'
import StepTree from './components/process-patients/StepsTreeComponent.vue'
import StepFourt from './components/process-patients/StepsFourtComponent.vue'
import StepFive from './components/process-patients/StepsFiveComponent.vue'
import Dashboard from './components/page/DashboardComponent.vue'
import NotFound from './components/page/NotFoundComponent.vue'

/**
 * @author Jhon Bernal
 * @description Parametrizacion  de rutas
 */
Vue.use(Router)

const router = new Router({
	mode:'history',
	routes:[
    {
			path:'',name:'home',component:StepOne
		},
    {
			path:'/stepTwo',name:'stepTwo',component:StepTwo
		},
    {
			path:'/stepTree',name:'stepTwo',component:StepTree
		},
    {
			path:'/stepFourt',name:'stepTwo',component:StepFourt
		},
    {
			path:'/stepFive',name:'stepTwo',component:StepFive
		},
		{
			path:'/dashboard',name:'dashboard',component:Dashboard
		},
		{
			path:'/admin',name:'login',component:Login, meta : {guest: true}
		},
    {
			path:'**',name:'nofound',component:NotFound
		}
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

