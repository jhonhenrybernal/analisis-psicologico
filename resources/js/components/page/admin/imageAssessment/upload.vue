<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Carga de imagenes</div>
                    <div class="card-body">
                        <div v-if="success != ''" class="alert alert-success">
                            {{success}}
                        </div>
                        <form @submit="formSubmit" enctype="multipart/form-data">
                            <div class="form-group col-md-2">
                                <label for="tipeImage">Tipo de imagenes</label>
                                <select v-model="type_image" class="form-control" id="tipeImage">
                                    <option value="">Seleccione</option>
                                    <option value="patient">Pacientes</option>
                                    <option value="castastrofes_naturales">Castastrofes naturales</option>
                                </select>
                            </div>
                                <div class="form-group col-md-12">
                                <label for="tipeImage">Puede cargas varias imagenes</label>
                                <input type="file" class="form-control"  ref="file"  multiple="multiple">
                            </div>
                            

                            
                            <button class="btn btn-primary btn-block">Cargar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: '',
                file: [],
                success: '',
                type_image:''
            };
        },
        methods: {
            formSubmit(e) {
                e.preventDefault();
                let existingObj = this;
                const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                }
                let formData  = new FormData();
                for( var i = 0; i < this.$refs.file.files.length; i++ ){
                    let file = this.$refs.file.files[i];
                    formData.append('files[' + i + ']', file);
                }
                if (this.type_image == '') {
                    alert('seleccione un tipo de imagen')
                    return
                }
                formData.append('type_image', this.type_image);
                axios.post('/imagesAssessment', formData, config)
                    .then(function (res) {
                        existingObj.success = res.data.success;
                    })
                    .catch(function (err) {
                        existingObj.output = err;
                    });
            }
        }
    }
</script>