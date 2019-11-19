<template>
  <div>
    <EdgeHeader color="teal darken-1"/>
    <div id="useBonsai-detail" class="container free-bird">
      <row>
        <column md="10" class="mx-auto float-none white z-depth-1 py-2 px-2">
          <card-body>
            <h2 class="h2-responsive"><strong>Detalle Bonsai</strong></h2>
              <row>
                <column md="6 margin-top-12 text-center">
                  <img :src="userBonsaiDetail.imgbonsai" class="tamanyo-img-300 img-fluid z-depth-1" alt="1">
                </column>
                <column md="6">
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right"><strong>Alias</strong></p>
                    </column>
                    <column md="8" class="md-form">
                      <p v-text="userBonsaiDetail.alias"></p>
                    </column>
                  </row>
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right"><strong>Edad</strong></p>
                    </column>
                    <column md="8" class="md-form">
                      <p v-text="userBonsaiDetail.edad"></p>
                    </column>
                  </row>
                  <row>
                    <column md="4" class="md-form">
                      <p class="pull-right"><strong>Adquisicion</strong></p>
                    </column>
                    <column md="8" class="md-form">
                      <p v-text="userBonsaiDetail.fechaadquisicion"></p>
                    </column>
                  </row>
                </column>
              </row>
            <row>
              <column md="10" class="md-form">
                <p><strong>Descripcion</strong></p>
                <p v-text="userBonsaiDetail.descripcion"></p>
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
    name: "UserBonsaiDetail",
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
      this.id = this.$route.params.id;
      let token = localStorage.getItem("token");
      let params = 'authorization='+token;
      axios.post('http://localhost:8000/userBonsai/detail/' + this.id, params)
        .then((respuesta) => {
            this.userBonsaiDetail.alias = respuesta.data.data.alias;
            this.userBonsaiDetail.edad = respuesta.data.data.edad;
            this.userBonsaiDetail.descripcion = respuesta.data.data.descripcion;
            this.userBonsaiDetail.imgbonsai = respuesta.data.data.imgbonsai;
            this.userBonsaiDetail.fechaadquisicion = moment(respuesta.data.data.fechaadquisicion.timestamp).format("DD-MM-YYYY");
        })
        .catch((error)=>{
          // console.log(error);
        });
    },
    data(){
      return {
        id: null,
        userBonsaiDetail: {
          tipo: null,
          alias: null,
          edad: null,
          fechaadquisicion: null,
          descripcion :null,
          imgbonsai: null
        }
      }

    }
  }
</script>

<style scoped>

</style>
