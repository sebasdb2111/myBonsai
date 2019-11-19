<template>
  <div>
    <EdgeHeader color="teal darken-1"/>
    <div id="useBonsai-add" class="container free-bird">
      <row>
        <column md="10" class="mx-auto float-none white z-depth-1 py-2 px-2">
          <card-body>
            <h2 class="h2-responsive"><strong>Añadir Bonsai</strong></h2>
            <form  v-on:submit.prevent="guardarUserBonsai">
              <row>
                <column md="6 margin-top-12 text-center">
                  <img src="../../assets/icon-bonsai.jpg" class="tamanyo-img-300 img-fluid z-depth-1" alt="1" width="450px" height="450px">
                </column>
                <column md="6">
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right">Tipo</p>
                    </column>
                    <column md="8" class="md-form">
                      <select class="custom-select" v-model="UserBonsai.idBonsai">
                        <option value="1">Ficus</option>
                        <option value="2">Manzano</option>
                        <option value="3">Olmo</option>
                        <option value="4">Olivo</option>
                      </select>
                    </column>
                  </row>
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right">Alias</p>
                    </column>
                    <column md="8" class="md-form">
                      <input type="text" class="form-control md-input" id="formGroupExampleInputMD" v-model="UserBonsai.alias">
                    </column>
                  </row>
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right">Edad</p>
                    </column>
                    <column md="8" class="md-form">
                      <select class="custom-select" v-model="UserBonsai.edad">
                        <option disabled>---</option>
                        <option  v-for="i in 100" :value="i">{{i}}</option>
                      </select>
                    </column>
                  </row>
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right">Adquisicion</p>
                    </column>
                    <column md="8" class="md-form">
                      <input type="date" id="materialFormRegisterDateEx" class="form-control md-input" v-model="UserBonsai.fechaAdquisicion">
                    </column>
                  </row>
                </column>
              </row>
              <row>
                <column md="12" class="md-form mb-4 active-green-vue">
                  <label class="padding-left-10" for="form17"><strong>Descripcion</strong></label>
                  <textarea type="text" id="form17" class="md-textarea form-control margin-top-12" rows="2" v-model="UserBonsai.descripcion"></textarea>
                </column>
              </row>
              <button class="btn btn-default pull-right" type="submit">Guardar</button>
            </form>
          </card-body>
        </column>
      </row>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import { Container, Column, Row, Fa, Navbar, NavbarItem, NavbarNav, NavbarCollapse, Btn, EdgeHeader, CardBody } from 'mdbvue';
  export default {
    name: "UserBonsaiAdd",
    components: {
      Container,
      Column,
      Row,
      Fa,
      Navbar,
      NavbarItem,
      NavbarNav,
      NavbarCollapse,
      Btn,
      EdgeHeader,
      CardBody
    },
    mounted(){

    },
    data(){
      return {
        UserBonsai: {
          idBonsai:null,
          alias: '',
          edad: null,
          fechaAdquisicion: '',
          descripcion: '',
        }
      };
    },
    methods: {
      guardarUserBonsai(){
        let router = this.$router;
        let json = JSON.stringify(this.UserBonsai);
        let token = localStorage.getItem("token");
        let params = 'json='+json+'&authorization='+token;
        //let params = '&json='+JSON.stringify(this.UserBonsai);

        axios.post('http://localhost:8000/userBonsai/new', params)
          .then((respuesta) => {
            if (respuesta.data.status == 'success'){
              router.push('/');
            }

          })
          .catch((error)=>{
            // console.log(error);
          });
      }
    }
  }
</script>

<style scoped>
  .margin-top-12 {
    margin-top: 12px;
  }

  .active-green-vue textarea.md-textarea, input.md-input{
    border-bottom: 1px solid #00897B;
    box-shadow: 0 1px 0 0 #00897B;
  }

  .padding-left-10 {
    padding-left: 10px;
  }
</style>
