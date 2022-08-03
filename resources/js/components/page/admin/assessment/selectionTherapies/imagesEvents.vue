<template>
    <div>
        <div class="container-select-event" v-if="questionImages">
            <div class="dinamic-select-event">
                <div class="container-button-select-event" v-if="!initQuestions">
                    <button type="button" class="btn btn-success" @click="inicioPregunta()">
                        Iniciar Preguntas
                    </button>
                </div>
                <div class="container"  v-if="initQuestions">
                    <img v-bind:src="'../' + this.imgSelect" alt="Cinque Terre" width="46" height="80" class="image-selected-event" v-if="!finQuestion"/>
                </div>
                
            </div>
            <div class="Content-select-event">
                <div class="container" v-if="finQuestion">
                    <h2 >Fin</h2>
                </div>
                <div class="container" v-if="initListQuestions">
                    <h2>Lista de preguntas</h2>
                    <ul class="list-group" v-for="list in listQuestion" :key="list.id">
                        <button class="form-control" @click="selectQuestion(list.id)"><li class="list-group-item" >{{ list.question }}</li></button>
                    </ul>
                </div>
            </div>
            <div class="Sidebar-select-event">
                <div class="row-images">
                    <div v-for="img in listImage" :key="img.id" class="column-images image-select-event">
                    <div  v-bind:class="{ 'container-check-question': img.question_assessments !== null }">
                        <img v-bind:src="'../' + img.image_assessment.path" alt="Cinque Terre" width="600"
                            height="400" />
                             <div v-bind:class="{ 'center-check-question': img.question_assessments !== null }" v-if="img.question_assessments !== null ">Realizado</div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row">
            <div class="column image-selected-event">
                <div style="text-align: center">
                    <button type="button" class="btn btn-success btn-selected-event" @click="inicioPregunta()">
                        Iniciar Preguntas
                    </button>
                </div>
            </div>
            <div class="column diff-two">
                <h4>Imagenes seleccionadas</h4>
                <div class="container">
                    <div class="row-images">
                        <div v-for="img in listImage" :key="img.id" class="column-images">
                            <img v-bind:src="'../' + img.image_assessment.path" alt="Cinque Terre" width="600"
                                height="400" />
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>
<script>
export default {
    data() {
        return {
            listImage: [],
            listQuestion: [],
            imgSelect: '',
            initQuestions:false,
            idImage:0,
            finQuestion:false,
            initListQuestions:false,
            isImagePatient: false,
            questionImages: true
        };
    },
    created() {
        this.init()
    },
    methods: {

        inicioPregunta() {
            this.isImagePatient = true
            this.findImage(this.listImage)
            this.initQuestions = true
            this.initListQuestions = true
            
            
        },
        selectQuestion(id){
            axios
            .post(
                "/assessments/process/questions/image/find",
                {id_asessment:this.$route.params.id_asessment,id_image:this.idImage,question_id:id}
            )
            .then((response) => {
                this.init()
                 this.isImagePatient = true
            })
            .catch((e) => { });
        },
        init(){
            axios
                .get(
                    "/assessments/process/image/selected/" +
                    this.$route.params.id_asessment,
                    {}
                )
                .then((response) => {
                    if (response.data.status == 'error') {
                        if (response.data.message == 'fin') {
                            this.questionImages = false
                            this.sendImagePatient('fin')    
                            return
                        }
                    }
                    this.listImage = response.data.data;
                    this.findImage(this.listImage)
                })
                .catch((e) => {
                    console.log(e)
                 });
            axios
                .get(
                    "/assessments/process/questions/selected/" +
                    this.$route.params.id_asessment,
                    {}
                )
                .then((response) => {
                    this.listQuestion = response.data.data;
                })
                .catch((e) => { });
        },
        findImage(list){
            const images = list.find(ele => ele.question_assessments == null)
            if (images == undefined) {
                this.imgSelect = ''
                this.idImage = ''
                this.finQuestion = true
                this.initListQuestions = false
                this.sendImagePatient('fin')    
                return
            }
            this.imgSelect = images.image_assessment.path
            this.idImage = images.image_id
            if (this.isImagePatient) {
                this.sendImagePatient(this.imgSelect )    
            }
        },
        sendImagePatient(img){
            axios
            .post(
                "/assessments/process/questions/send/image",
                {id_asessment:this.$route.params.id_asessment,id_image:this.idImage,pathImg:img}
            )
            .then((response) => {
            })
            .catch((e) => { });
        }

    },
};
</script>