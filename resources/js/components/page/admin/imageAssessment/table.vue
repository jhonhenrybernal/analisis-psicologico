<template>
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <router-link :to="{ name: 'imageAssessmentImage' }" class="btn btn-success">Cargar imagen</router-link>
                    <h2 class="text-center">Lista {{ nameTable }}</h2>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Quien lo cargo</th>
                                    <th>Image</th>
                                    <!-- <th>Actions</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="img in image" :key="img.id">
                                    <td>{{ img.id }}</td>
                                    <td>{{ img.name }}</td>
                                    <td>{{ img.user.name }}</td>
                                    <td><img v-bind:src="'../'+img.path" class="img-thumbnail"  width="130" height="30"></td>
                                </tr>
                            </tbody>
                        </table>
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
            name: 'PageIndex',
            image: [],
            nameTable: 'Imagenes Valoración',
            event:''
        }
    },

    created() {
        console.log('acass')
        this.$store.dispatch("getImages").then(
            respo => {
                this.image = respo.data.data
            }).catch(err => this.error(err));
    }

}
</script>