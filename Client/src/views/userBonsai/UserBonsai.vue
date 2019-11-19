<template>
  <div>
    <h1 class="h1-responsive cabecera teal darken-1">Mi Espacio<router-link :to="{name: 'userBonsai-add'}"><button type="button" class="btn btn-raised btn-add-bonsai pull-right">Añadir Bonsai</button></router-link></h1>
    <container>
      <row>
        <div class="col-lg-4 col-md-6 ficha-bonsai"  id="userBonsai-list" v-if="userBonsai != null" v-for="bonsai in userBonsai">
          <div class="card card-cascade narrower">
            <div class="view overlay">
              <img :src="bonsai.imgbonsai" class="img-fluid tamanyo-img-list" alt="narrower">
              <a>
                <div class="mask rgba-white-slight"></div>
              </a>
            </div>
            <div class="card-body card-bonsai">
              <h5 class="text-default"><i class="r fa fa-tree"></i> {{bonsai.idbonsai.tipo}}</h5>
              <h4 class="card-title"><strong>{{bonsai.alias}}</strong></h4>
              <!--<div class="card card-body">-->
                <!--<h4 class="card-title"><strong>Proximo Cuidado</strong></h4>-->
                <!--<span class="card-text"><strong>Cuidado:</strong> Regar</span>-->
                <!--<span class="card-text"><strong>Fecha:</strong> 21-11-2018</span>-->
                <!--<span class="card-text"></span><span></span>-->
              <!--</div>-->
              <br>
              <row>
                <column md="6">
                  <router-link :to="{name: 'logCuidados', params: {id: bonsai.iduserbonsai}}">
                    <button type="button" class="btn btn-default"><strong>Dar Cuidado</strong></button>
                  </router-link>
                </column>
                <column md="6" class="pull-right">
                  <router-link :to="{name: 'userBonsai-detail', params: {id: bonsai.iduserbonsai}}">
                    <button type="button" class="btn btn-default btn-circle"><i class="fa fa-eye fa-lg" aria-hidden="true"/></button>
                  </router-link>
                  <router-link :to="{name: 'userBonsai-edit', params: {id: bonsai.iduserbonsai}}">
                    <button type="button" class="btn btn-warning btn-circle"><i class="fa fa-pencil fa-lg" aria-hidden="true"/></button>
                  </router-link>
                  <span v-if="showRemove != bonsai.iduserbonsai">
                   <button @click="removeUserBonsai(bonsai.iduserbonsai)" type="button" class="btn btn-danger btn-circle"><i class="fa fa-trash-o fa-lg" aria-hidden="true"/></button>
                  </span>
                  <span v-else>
                    <p>¿Estas seguro de querer borrar este bonsai?</p>
                    <button class="btn btn-warning" @click="cancelRemove()">No</button>
                    <button class="btn btn-danger" @click="confirmRemove(bonsai.iduserbonsai)">Si</button>
                  </span>
                </column>
              </row>
            </div>
          </div>
        </div>
      </row>
    </container>
  </div>
</template>

<script>
  import { Container, Column, Row, Fa, Navbar, NavbarItem, NavbarNav, NavbarCollapse, Btn, EdgeHeader, CardBody } from 'mdbvue';
  import axios from 'axios'
  export default {
    name: "userBonsai-list",
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
    mounted() {
      let router = this.$router;
      let token = localStorage.getItem("token");
      if (!token && token == 'undefined'){
        router.push('/login');
      }
      this.getUserBonsai();
    },
    data() {
      return {
        userBonsai: null,
        showRemove: null
      }
    },
    methods: {
      getUserBonsai(){
        let token = localStorage.getItem("token");
        let params = 'authorization='+token;
        axios.post('http://localhost:8000/userBonsai/list', params)
          .then((respuesta) => {
            this.userBonsai = respuesta.data.data;
          })
          .catch((error)=>{
            // console.log(error);
          });
      },
      removeUserBonsai(id) {
        this.showRemove = id;
      },
      cancelRemove() {
        this.showRemove = null;
      },
      confirmRemove(id){
        let token = localStorage.getItem("token");
        let params = 'authorization='+token;
        axios.post('http://localhost:8000/userBonsai/remove/'+id, params)
          .then((respuesta) => {
            this.showRemove = null;
            this.getUserBonsai();
          })
      }
    },
  }
</script>

<style scoped>
  h1, h2 {
    font-weight: normal;
  }

  .container {
    max-width: 1600px;
  }

  .btn-add-bonsai{
    margin-right: 40px;
    background-color: whitesmoke;
    color: #00897b;
  }

  .ficha-bonsai {
    /*margin-right: 15px;*/
    margin-top: 15px;
    margin-bottom: 15px;
    /*background-color: whitesmoke;*/
  }

  .cabecera {
    height: 100px;
    padding-top: 15px;
    padding-left: 40px;
    font-family: Roboto;
    font-size: 60px;
    color: white;
  }

  .home-feature-box i {
    font-size: 6rem;
  }

  .home-feature-box span {
    display: block;
    color: black;
    font-size: 20px;
    font-weight: bold;
    padding-top: 20px;
  }

  ul {
    list-style-type: none;
    padding: 0;
  }

  li {
    display: inline-block;
  }

  a {
    color: #42b983;
  }

  btn-cuidado {
    max-width: 100%;
  }

  .btn-circle {
    width: 50px;
    height: 50px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.33;
    border-radius: 25px;
  }

  .tamanyo-img-list {
    height: 275px;
    width: 544px;
  }
</style>
