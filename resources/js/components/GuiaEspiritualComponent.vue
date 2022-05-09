<template>
    <div class="container">
                <div class="card">
                        <b-row  class="justify-content-md-center">
                         <b-col cols="6" lg="8" align-self="stretch">
                            <div class="card-body">
                                <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                             

                                <b-form-group id="input-group-2" label="Nombre Completo:" label-for="input-2">
                                    <b-form-input
                                    id="input-2"
                                    v-model="form.fullName"
                                    placeholder="Nombre Completo"
                                    required
                                    ></b-form-input>
                                </b-form-group>
                                 <b-form-group id="input-group-2" label="Codigo verificación:" label-for="input-2">
                                    <b-form-input
                                    id="input-2"
                                    v-model="form.codeVerify"
                                    placeholder="Codigo verificación"
                                    required
                                    ></b-form-input>
                                </b-form-group>
                                <br>
                                <b-button type="submit" variant="primary">Continuar</b-button>
                                </b-form>
                            </div>
                        </b-col>
                        </b-row>
                        <b-row  class="justify-content-md-center">
                            <b-col cols="6" lg="8">
                               <label for="input-with-list">Si desea tener mas o una nueva sesion consulte la agenda.</label>
                            <div>
                            <br>
                                <b-button v-b-toggle.sidebar-1>Ver calendario</b-button>
                                    <b-sidebar id="sidebar-1" title="Sidebar" shadow>
                                        <div class="px-3 py-2">
                                            <div>
                                                  <b-calendar v-model="value" :date-disabled-fn="dateDisabled" locale="en"></b-calendar>
                                            </div>
                                        </div>
                                    </b-sidebar>
                                </div>                                
                            </b-col>
                        </b-row>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
      return {
        form: {
          email: '',
          name: '',
          food: null,
          checked: []
        },
        foods: [{ text: 'Select One', value: null }, 'Carrots', 'Beans', 'Tomatoes', 'Corn'],
        show: true,
        value: ''
      }
    },
    methods: {
      onSubmit(event) {
        event.preventDefault()
        alert(JSON.stringify(this.form))
      },
      onReset(event) {
        event.preventDefault()
        // Reset our form values
        this.form.email = ''
        this.form.name = ''
        this.form.food = null
        this.form.checked = []
        // Trick to reset/clear native browser form validation state
        this.show = false
        this.$nextTick(() => {
          this.show = true
        })
      },
      dateDisabled(ymd, date) {
        // Disable weekends (Sunday = `0`, Saturday = `6`) and
        // disable days that fall on the 13th of the month
        const weekday = date.getDay()
        const day = date.getDate()
        // Return `true` if the date should be disabled
        return weekday === 0 || weekday === 6 || day === 13
      }
    }
    }
</script>
