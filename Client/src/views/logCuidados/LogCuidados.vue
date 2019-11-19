<template>
  <div>
    <EdgeHeader color="teal darken-1"/>
    <div id="useBonsai-edit" class="container free-bird">
      <row>
        <column md="10" class="mx-auto float-none white z-depth-1 py-2 px-2">
          <card-body>
              <row>
                <column md="6">
                  <row class="margin-right-15">
                    <h2 class="h2-responsive"><strong>Nuevo Cuidado</strong></h2>
                    <column md="12">
                      <form v-on:submit.prevent="guardarLogCuidado">
                        <row>
                          <column md="4" class="md-form">
                            <p class="pull-right">Tipo</p>
                          </column>
                          <column md="8" class="md-form">
                            <select class="custom-select"  v-model="logCuidados.cuidado">
                              <option value="Regar">Regar</option>
                              <option value="Abonar">Abonar</option>
                              <option value="Pulverizar">Pulverizar</option>
                              <option value="Transplantar">Transplantar</option>
                            </select>
                          </column>
                        </row>
                        <row>
                          <column md="4" class="md-form">
                            <p class="pull-right">Fecha</p>
                          </column>
                          <column md="8" class="md-form">
                            <input type="date" id="materialFormRegisterDateEx" class="form-control md-input" v-model="logCuidados.createdAt">
                          </column>
                        </row>
                        <button class="btn btn-default margin-top-12 pull-right" type="submit">Editar</button>
                      </form>
                    </column>
                  </row>
                  <!--<row>-->
                    <!--<h2 class="h2-responsive"><strong>Proximos Cuidados</strong></h2>-->
                    <!--<column md="12">-->
                      <!--<row>-->
                        <!--<column md="4" class="md-form">-->
                          <!--<p class="pull-right">Regar</p>-->
                        <!--</column>-->
                        <!--<column md="8" class="md-form">-->
                          <!--<p class="">21-11-2018</p>-->
                        <!--</column>-->
                      <!--</row>-->
                      <!--<row>-->
                        <!--<column md="4" class="md-form">-->
                          <!--<p class="pull-right">Pulverizar</p>-->
                        <!--</column>-->
                        <!--<column md="8" class="md-form">-->
                          <!--<p class="">25-11-2018</p>-->
                        <!--</column>-->
                      <!--</row>-->
                      <!--<row>-->
                        <!--<column md="4" class="md-form">-->
                          <!--<p class="pull-right">Abonar</p>-->
                        <!--</column>-->
                        <!--<column md="8" class="md-form">-->
                          <!--<p class="">21-12-2018</p>-->
                        <!--</column>-->
                      <!--</row>-->
                      <!--<row>-->
                        <!--<column md="4" class="md-form">-->
                          <!--<p class="pull-right">Transplantar</p>-->
                        <!--</column>-->
                        <!--<column md="8" class="md-form">-->
                          <!--<p class="">21-01-2019</p>-->
                        <!--</column>-->
                      <!--</row>-->
                    <!--</column>-->
                  <!--</row>-->
                </column>
                <column md="6" class="border-left-3">
                  <h2 class="h2-responsive"><strong>Historial de Cuidados</strong></h2>
                  <table v-if="getCuidados != null" class="table table-hover width-100 margin-top-30 margin-left-15">
                    <thead class="default-color lighten-4">
                    <tr>
                      <th>Fecha</th>
                      <th>Cuidado</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="cuidado in getCuidados">
                      <td>{{ cuidado.createdat.timestamp|fechaCuidado }}</td>
                      <td>{{ cuidado.cuidado }}</td>
                      <td>
                        <span v-if="showRemove != cuidado.idlogcuidados">
                          <button @click="removeLogCuidados(cuidado.idlogcuidados)" type="button" class="btn btn-danger btn-circle"><i class="fa fa-trash-o fa-lg" aria-hidden="true"/></button>
                        </span>
                        <span v-else>
                            <p>¿Estas seguro de querer borrar este bonsai?</p>
                            <button class="btn btn-warning" @click="cancelRemove()">No</button>
                            <button class="btn btn-danger" @click="confirmRemove(cuidado.idlogcuidados)">Si</button>
                        </span>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                  <span v-else>No hay ningun cuidado registrado</span>
                </column>
              </row>
          </card-body>
        </column>
      </row>
    </div>
  </div>
</template>

<script>
  import axios from 'axios';
  import moment from 'moment';
  import { Container, Column, Row, Fa, Navbar, NavbarItem, NavbarNav, NavbarCollapse, Btn, EdgeHeader, CardBody } from 'mdbvue';
  export default {
    name: "UserBonsaiEdit",
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
      this.getLogCuidados();
    },
    data(){
      return {
        id: null,
        cuidados: null,
        getCuidados: null,
        logCuidados: {
          cuidado: '',
          createdAt: ''
        },
        showRemove: null
      };
    },
    filters: {
      fechaCuidado(createdat) {
        let date = new Date();
        // let day = false;
        // if (date.getMonth(createdat)+1 <= 9)
        //   day = '0'+date.getMonth(createdat)+1;
        // else
        let day = date.getDay(createdat);
        // let month = false;
        // if (date.getMonth(createdat)+1 <= 9)
        //   month = '0'+date.getMonth(createdat)+1;
        // else
        let month = date.getMonth(createdat)+1;
        let year = date.getFullYear(createdat);
        let fecha = day+'-'+month+'-'+year;
        console.log(fecha);
        return fecha;
        // return moment(createdat).format("DD-MM-YYYY")
      }
    },
    methods: {
      getLogCuidados(){
        this.id = this.$route.params.id;
        let token = localStorage.getItem("token");
        let params = 'authorization='+token;
        axios.post('http://localhost:8000/logCuidados/' + this.id, params)
          .then((respuesta) => {
            this.getCuidados = respuesta.data.data;
          });
      },

      guardarLogCuidado(){
        let id = this.id;
        let router = this.$router;
        let json = JSON.stringify(this.logCuidados);
        let token = localStorage.getItem("token");
        let params = 'json='+json+'&authorization='+token;

        axios.post('http://localhost:8000/logCuidados/new/'+id, params)
          .then((respuesta) => {
            if (respuesta.data.status == 'success'){
             this.getLogCuidados();
            }
          })
          .catch((error)=>{
            // console.log(error);
          });
      },
      removeLogCuidados(id) {
        this.showRemove = id;
      },
      cancelRemove() {
        this.showRemove = null;
      },
      confirmRemove(id){
        let token = localStorage.getItem("token");
        let params = 'authorization='+token;
        axios.post('http://localhost:8000/logCuidados/remove/'+id, params)
          .then((respuesta) => {
            this.showRemove = null;
            this.getLogCuidados();
          })
      }
    }
  }
</script>

<style scoped>
  .margin-top-12 {
    margin-top: 12px;
  }

  .margin-top-30 {
    margin-top: 30px;
  }

  .margin-right-15 {
    margin-right: 15px;
  }

  .margin-left-15 {
    margin-left: 15px;
  }

  .active-green-vue textarea.md-textarea, input.md-input{
    border-bottom: 1px solid #00897B;
    box-shadow: 0 1px 0 0 #00897B;
  }

  .padding-left-10 {
    padding-left: 10px;
  }

  .border-left-3 {
    border-left: 3px solid #00897B;
  }

  .btn-circle {
    width: 45px;
    height: 45px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
  }
  .width-100 {
    width: 100%;
  }

</style>

