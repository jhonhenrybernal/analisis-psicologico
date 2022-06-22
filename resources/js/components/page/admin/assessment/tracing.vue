<template>
   <div>
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
      <div class="container">
       <div class="progress" v-if="assessmentProcess.length > 0">
           <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" v-bind:style="{width: assessmentProcess.length *10+'%'}" v-bind:aria-valuenow="assessmentProcess.length" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
         <ul class="timeline"  v-for="ass in assessmentProcess" :key="ass.id">
          <li v-if="assessmentProcess.length > 0">
               <div class="timeline-time">
                  <span class="date">{{moment(ass.created_at).format("dddd, MMMM Do YYYY")}}</span>
                  <span class="time">{{moment(ass.created_at).format('h:mm a')}}</span>
               </div>
                <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
               </div>
                <div class="timeline-body">
                  <div class="timeline-header">
                     <span class="userimage"><img
                           src="https://e7.pngegg.com/pngimages/369/691/png-clipart-avatar-computer-icons-patient-avatar-heroes-logo.png"
                           alt=""></span>
                     <span class="username"><a href="javascript:;"><b>Nombre de paciente:</b> {{ass.assessment.patient.firstName}} {{ass.assessment.patient.lastName}}</a> <small></small></span>
                     <span class="pull-right text-muted"><b>Paso: </b>{{ass.status.description}}</span>
                  </div>
                  <div class="timeline-content">
                     <p>
                        Desalles de la valoración
                     </p>
                      <p v-if="procesoPreImagenes">
                        Tiene una imagen pre seleccinada, de click al boton <b>Ver selección de imagenes</b>
                     </p>
                     <p>
                        <button type="button" @click="selectImageQuestion(ass)" class="btn btn-success" >Ver selección de imagenes</button>
                     </p>
                  </div>
                  <div class="timeline-comment-box">
                     <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar6.png"></div>
                     <div class="input">
                        <form action="">
                           <div class="input-group">
                              <input type="text" class="form-control rounded-corner"
                                 placeholder="Añadir Detalles de la valoracion">
                              <span class="input-group-btn p-l-10">
                                 <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comentar</button>
                              </span>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </li>
             <li v-else>
               <!-- begin timeline-icon -->
               <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
               </div>
               <!-- end timeline-icon -->
               <!-- begin timeline-body -->
               <div class="timeline-body">
                  No tiene proceso de valoración
               </div>
               <!-- begin timeline-body -->
            </li>
            <!--------------------------------------->
            <!--<li>
               <div class="timeline-time">
                  <span class="date">today</span>
                  <span class="time">04:20</span>
               </div>
                <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
               </div>
                <div class="timeline-body">
                  <div class="timeline-header">
                     <span class="userimage"><img
                           src="https://e7.pngegg.com/pngimages/369/691/png-clipart-avatar-computer-icons-patient-avatar-heroes-logo.png"
                           alt=""></span>
                     <span class="username"><a href="javascript:;">Nombre de paciente</a> <small></small></span>
                     <span class="pull-right text-muted">Titulo del paso en que va</span>
                  </div>
                  <div class="timeline-content">
                     <p>
                        Desalles de la valoración
                     </p>
                     <p>
                        items que selecciono
                     </p>
                  </div>
                  <div class="timeline-comment-box">
                     <div class="user"><img src="https://bootdey.com/img/Content/avatar/avatar6.png"></div>
                     <div class="input">
                        <form action="">
                           <div class="input-group">
                              <input type="text" class="form-control rounded-corner"
                                 placeholder="Añadir Detalles de la valoracion">
                              <span class="input-group-btn p-l-10">
                                 <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comentar</button>
                              </span>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </li>
            <li>
               <div class="timeline-time">
                  <span class="date">24 February 2014</span>
                  <span class="time">08:17</span>
               </div>
                <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
               </div>
               <div class="timeline-body">
                  <div class="timeline-header">
                     <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                           alt=""></span>
                     <span class="username">Richard Leong</span>
                     <span class="pull-right text-muted">1,282 Views</span>
                  </div>
                  <div class="timeline-content">
                     <p class="lead">
                        <i class="fa fa-quote-left fa-fw pull-left"></i>
                        Quisque sed varius nisl. Nulla facilisi. Phasellus consequat sapien sit amet nibh molestie
                        placerat. Donec nulla quam, ullamcorper ut velit vitae, lobortis condimentum magna. Suspendisse
                        mollis in sem vel mollis.
                        <i class="fa fa-quote-right fa-fw pull-right"></i>
                     </p>
                  </div>
                  <div class="timeline-footer">
                     <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i
                           class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                     <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i
                           class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>
                     <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i
                           class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                  </div>
               </div>
            </li>
            <li>
                <div class="timeline-time">
                  <span class="date">10 January 2014</span>
                  <span class="time">20:43</span>
               </div>
                 <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
               </div>
               <div class="timeline-body">
                  <div class="timeline-header">
                     <span class="userimage"><img src="https://bootdey.com/img/Content/avatar/avatar1.png"
                           alt=""></span>
                     <span class="username">Lelouch Wong</span>
                     <span class="pull-right text-muted">1,021,282 Views</span>
                  </div>
                  <div class="timeline-content">
                     <h4 class="template-title">
                        <i class="fa fa-map-marker text-danger fa-fw"></i>
                        795 Folsom Ave, Suite 600 San Francisco, CA 94107
                     </h4>
                     <p>In hac habitasse platea dictumst. Pellentesque bibendum id sem nec faucibus. Maecenas molestie,
                        augue vel accumsan rutrum, massa mi rutrum odio, id luctus mauris nibh ut leo.</p>
                     <p class="m-t-20">
                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="">
                     </p>
                  </div>
                  <div class="timeline-footer">
                     <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i
                           class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                     <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i
                           class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a>
                     <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i
                           class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                  </div>
               </div>
            </li>
            <li>
                <div class="timeline-icon">
                  <a href="javascript:;">&nbsp;</a>
               </div>
               <div class="timeline-body">
                  Loading...
               </div>
            </li>-->
         </ul>
      </div>
   </div>
</template>
<script>
import Echo from 'laravel-echo'
window.Pusher = require('pusher-js')
export default {
   data() {
      return {
         assessmentProcess: [],
         countAssessmentProcess: '',
         cantidadPreImg:0,
         procesoPreImagenes:false,
      }
   },
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
            localStorage.removeItem('pathImagen');
            if (e.status) {
               if (e.params.action = 'nueva_pre_imagen') {
                  this.procesoPreImagenes = true
                  this.cantidadPreImg = e.params.imagenCantidad
                  localStorage.setItem('pathImagen',e.params.imagen);
               }
            }

        })
    },
   created() {
      axios.get(`/assessments/process/${this.$route.params.id}`)
      .then((res) => {
            this.assessmentProcess = res.data.data;
      });

      const storangpPreImagen = localStorage.getItem('preImagen', true)
      if(storangpPreImagen){
         this.procesoPreImagenes = true
      }
    },
   methods: {
      selectImageQuestion(params){
         this.$router.push({ name: 'selectImageQuestion', params: {params } })   
      }

   }
}
</script>