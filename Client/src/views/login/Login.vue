<template>
  <div>
    <EdgeHeader color="teal darken-1"/>
    <div class="container free-bird">
      <row>
        <column md="10" class="mx-auto float-none white z-depth-1 py-2 px-2">
          <card-body>
            <h2 class="h2-responsive"><strong>Login</strong></h2>
            <form v-on:submit.prevent="login">
              <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <input type="email" id="materialFormLoginEmailEx" placeholder="Tu email" class="form-control" v-model="UserLogin.email">
              </div>
              <div class="md-form">
                <i class="fa fa-lock prefix grey-text"></i>
                <input type="password" id="materialFormLoginPasswordEx" placeholder="Tu contraseña" class="form-control" v-model="UserLogin.password">
              </div>
              <div class="text-center mt-4">
                <button class="btn btn-default" type="submit">Login</button>
              </div>
            </form>
            <hr/>
            <row>
              <column md="12" class="mx-auto float-none">
                <p class="pull-right">No eres miembro? <router-link  :to="{name: 'registro'}">Registrate</router-link></p>
              </column>
            </row>
          </card-body>
        </column>
      </row>
    </div>
  </div>
</template>

<script>
  import { Container, Column, Row, Fa, Navbar, NavbarItem, NavbarNav, NavbarCollapse, Btn, EdgeHeader, CardBody } from 'mdbvue';
  import axios from 'axios';
  export default {
    name: "login",
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
        UserLogin: {
          email: null,
          password: null,
        }
      };
    },
    methods: {
      login(){
        let router = this.$router;
        let json = JSON.stringify(this.UserLogin);

        let params = 'json='+json;
        axios.post('http://localhost:8000/login', params)
          .then((respuesta) => {
            if (respuesta.data.satus !== 'error'){
              localStorage.setItem("token", respuesta.data);
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
  h1, h2 {
    font-weight: normal;
  }

  .home-feature-box {
    padding: 40px 0;
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
</style>
