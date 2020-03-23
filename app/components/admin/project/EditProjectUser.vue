<template>
  <section>
      <div class="" v-if="projectCopy.author">
        <div class="columns">
          <div class="column">
            <div class="card">
              <div class="card-content has-text-centered">
                <h1 class="title is-5">Responsable declarado</h1>
                <h2 class="subtitle is-5">{{projectCopy.author_names}} {{projectCopy.author_surnames}}</h2>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="card">
              <div class="card-content has-text-centered">
                <h1 class="title is-5">Usuario vinculado</h1>
                <h2 class="subtitle is-5">{{projectCopy.author.subject.display_name}}</h2>
              </div>
            </div>
          </div>
        </div>
        <div class="buttons">
          <button v-if="projectCopy.author" @click="desvincularUsuario" class="button is-primary">
            <i class="fas fa-user-times"></i>&nbsp;Desvincular usuario</button>
        </div>
      </div>
      <div v-else>
        <div class="notification is-light" v-if="isFetching">
          <i class="fas fa-spinner fa-spin"></i>&nbsp;Buscando ciudadano registrado con documento&nbsp;<b>{{projectCopy.author_dni}}</b>
        </div>
        <div class="notification is-dark" v-if="notFound">
          No se encuentra un usuario ciudadano registrado con matrícula&nbsp;<b>{{projectCopy.author_dni}}</b>
        </div>
        <div v-if="!projectCopy.author_dni" class="notification is-link">
          <i class="fas fa-times"></i>&nbsp;Debe completar el campo DNI en el formulario del proyecto para buscar un usuario
        </div>
        <div class="notification is-primary" v-if="fetchedUser && foundUser">
          <i class="fas fa-check"></i>&nbsp;Se encontró un ciudadano registrado con matrícula&nbsp;<b>{{projectCopy.author_dni}}</b>
        </div>
        <table class="table is-fullwidth" v-if="fetchedUser && foundUser">
          <thead>
            <th>Responsable declarado</th>
            <th>Usuario Registrado</th>
            <th>Datos padron</th>
            <th class="has-text-centered">Email</th>
            <th class="has-text-centered">DNI</th>
          </thead>
          <tbody>
            <tr>
              <td>
                <p>{{projectCopy.author_names}} {{projectCopy.author_surnames}}</p>
              </td>
              <td>
                <div>
                <p><b>{{fetchedUser.user.names}} {{fetchedUser.user.surnames}}</b></p>
                <p class="is-size-7"><i class="fas fa-check"></i>&nbsp; Es ciudadano empadronado</p>
                </div>
              </td>
              <td>
                <div>
                  
                <p class="is-size-7 is-family-monospace" v-for="(v,k) in fetchedUser.data" :key="k">{{k}}: {{v}} </p>
                </div>
              </td>
              <td class="has-text-centered">{{fetchedUser.user.email}}</td>
              <td class="has-text-centered">{{fetchedUser.dni}}</td>
            </tr>
          </tbody>
        </table>
        <div class="buttons">
        <button v-if="fetchedUser && foundUser && !assigned" @click="vincular" class="button is-primary">
          <i class="fas fa-user-edit"></i>&nbsp;Vincular usuario</button>
        </div>
        <b-message type="is-success" v-if="assigned">
          <i class="fas fa-check"></i>&nbsp;El usuario ha sido vinculado al proyecto <b>{{projectCopy.title}}</b>
        </b-message>
      </div>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
export default {
  props: ['getUrl','submitUrl','project'],
  data(){
    return {
      fetchedUser: null,
      foundUser: false,
      isFetching: false,
      notFound: false,
      projectCopy: this.project,
      assigned: false,
      isLoading: false,
    }
  },
  created: function(){
    if(this.projectCopy.author_dni && !this.projectCopy.author){
    this.getUser(this.projectCopy.author_dni)
    }
  },
  methods:{
    getUser: function(dni){
      this.isFetching = true;
      this.$http
        .get(`${this.getUrl}?matricula=${dni}`)
        .then(({ data }) => {
          if(data){
            this.fetchedUser = data
          } else {
            this.notFound = true
          }
          this.foundUser = true
          this.isFetching = false
        })
        .catch(error => {
          this.notFound = true
          this.isFetching = false
          throw error
        });
    },
    vincular: function(){
      this.isLoading = true
      this.$http
        .post(this.submitUrl, {
          author_id: this.fetchedUser.user.id
        })
        .then(response => {
          this.assigned = true
          this.$buefy.snackbar.open({
            message: "Usuario vinculado al proyecto",
            type: "is-success",
            actionText: "¡Genial!"
          });
          this.isLoading = false
        })
        .catch(error => {
          console.error(error.message);
          this.isLoading = false;
          this.$buefy.snackbar.open({
            message: "Error inesperado",
            type: "is-danger",
            actionText: "Cerrar",
            indefinite: true
          });
        });
    },
    desvincularUsuario(){
      this.isLoading = true
      this.$http
        .post(this.submitUrl, {
        })
        .then(response => {
          this.fetchedUser = null
          this.foundUser = false
          this.projectCopy.author = null
          this.getUser(this.projectCopy.author_dni)
          this.$buefy.snackbar.open({
            message: "Usuario desvinculado del proyecto",
            type: "is-success",
            actionText: "¡Genial!"
          });
          this.isLoading = false
        })
        .catch(error => {
          console.error(error.message);
          this.isLoading = false;
          this.$buefy.snackbar.open({
            message: "Error inesperado",
            type: "is-danger",
            actionText: "Cerrar",
            indefinite: true
          });
        });
    }
  },
}
</script>

<style>

</style>
