<template>
  <div>
    <EdgeHeader color="teal darken-1"/>
    <div class="container free-bird">
      <row>
        <column md="10" class="mx-auto float-none white z-depth-1 py-2 px-2">
          <card-body>
            <h2 class="h2-responsive"><strong>Registro</strong></h2>
            <form v-on:submit.prevent="guardarUser">
              <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" id="materialFormRegisterNombreEx" placeholder="Nombre" class="form-control" v-model="User.nombre">
              </div>
              <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" id="materialFormRegisterApellidosEx" placeholder="Apellidos" class="form-control" v-model="User.apellidos">
              </div>
              <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="date" id="materialFormRegisterDateEx" placeholder="Fecha de nacimiento" class="form-control" v-model="User.fechaNacimiento">
              </div>
              <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" id="materialFormRegisterNameEx" placeholder="Username" class="form-control" v-model="User.username">
              </div>
              <div class="md-form">
                <i class="fa fa-envelope prefix grey-text"></i>
                <input type="email" id="materialFormRegisterEmailEx" placeholder="Email" class="form-control"  v-model="User.email">
              </div>
              <!--<div class="md-form">-->
                <!--<i class="fa fa-exclamation-triangle prefix grey-text"></i>-->
                <!--<input type="email" id="materialFormRegisterConfirmEx" class="form-control">-->
                <!--<label for="materialFormRegisterConfirmEx">Confirm your email</label>-->
              <!--</div>-->
              <div class="md-form">
                <i class="fa fa-lock prefix grey-text"></i>
                <input type="password" id="materialFormLoginPasswordEx" placeholder="Contraseña" class="form-control" v-model="User.password">
              </div>
              <div class="text-center mt-4">
                <button class="btn btn-default" type="submit">Registrarse</button>
              </div>
            </form>
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
    name: "registro",
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
        User: {
          username:null,
          email: '',
          password: null,
          nombre: '',
          apellidos: '',
          fechaNacimiento: '',
        }
      };
    },
    methods: {
      guardarUser(){
        let router = this.$router;

        let json = JSON.stringify(this.User);
        let params = 'json='+json;
        axios.post('http://localhost:8000/user/new', params)
          .then((respuesta) => {
            if (respuesta.data.status == 'success'){
              router.push('/login');
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

</style>
