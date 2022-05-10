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

import NotFound from './components/page/NotFoundComponent.vue'

import Dashboard from './components/page/DashboardComponent.vue'
import PatientsTable from './components/page/patient/table.vue'
import PatientsEdit from './components/page/patient/edit.vue'
import PatientsCreate from './components/page/patient/create.vue'
import statusTable from './components/page/status/table.vue'
import statusEdit from './components/page/status/edit.vue'
import statusCreate from './components/page/status/create.vue'

/**
 * @author Jhon Bernal
 * @description Parametrizacion  de rutas
 */
Vue.use(Router)

function guard(to, from, next){
  if(authorizer.getters.isLoggedIn === true) {
      // or however you store your logged in state
      next(); // allow to enter route
  } else{
      next('/admin'); // go to '/login';
  }
}

const router = new Router({
	mode:'history',
	routes:[
    {
			path:'/admin',name:'login',component:Login, meta : {guest: true}
		},
    {
			path:'/dashboard',name:'dashboard',component:Dashboard
		},
    {
			path:'/patient',name:'patientTable',component:PatientsTable, beforeEnter: guard
		}, 
    {
			path:'/patient/edit',name:'patientEdit',component:PatientsEdit, beforeEnter: guard
		},
    {
			path:'/patient/crear',name:'patientCreate',component:PatientsCreate, beforeEnter: guard
		},
    {
			path:'/status',name:'statusTable',component:statusTable, beforeEnter: guard
		}, 
    {
			path:'/status/edit',name:'statusEdit',component:statusEdit, beforeEnter: guard
		},
    {
			path:'/status/crear',name:'statusCreate',component:statusCreate, beforeEnter: guard
		},
    {
			path:'/',name:'home',component:StepOne
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

