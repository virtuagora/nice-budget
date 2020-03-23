<template>
  <section>
    <b-field class="is-hidden-touch">
      <b-radio-button
        v-model="project.feasible"
        :native-value="null"
        size="is-medium"
        type="is-link"
        :disabled="!editable"
      >
        <i class="fas fa-clock"></i>&nbsp;Aún no evaluado
      </b-radio-button>
      <b-radio-button
        v-model="project.feasible"
        :native-value="true"
        size="is-medium"
        type="is-link"
        :disabled="!editable"
      >
        <i class="fas fa-clipboard-check"></i>&nbsp;Factible
      </b-radio-button>
      <b-radio-button
        v-model="project.feasible"
        :native-value="false"
        size="is-medium"
        type="is-link"
        :disabled="!editable"
      >
        <i class="fas fa-times"></i>&nbsp;No factible
      </b-radio-button>
    </b-field>
    <section class="is-hidden-desktop">
      <div class="field">
        <b-radio v-model="project.feasible" size="is-medium" :native-value="null" type="is-link" :disabled="!editable">
        <i class="fas fa-clock"></i>&nbsp;Aún no evaluado
        </b-radio>
        </div>
      <div class="field">
        <b-radio v-model="project.feasible" size="is-medium" :native-value="true" type="is-link" :disabled="!editable">
        <i class="fas fa-clipboard-check"></i>&nbsp;Factible
      </b-radio>
        </div>
      <div class="field">
        <b-radio v-model="project.feasible" size="is-medium" :native-value="false" type="is-link" :disabled="!editable">
        <i class="fas fa-times"></i>&nbsp;No factible
      </b-radio>
        </div>
    </section>
    <br>
    <div class="field" v-if="project.feasible === true">
      <b-message type="is-danger">
        <p><i class="fas fa-exclamation-triangle"></i>&nbsp;RECUERDE ASIGNAR EL CÓDIGO AL PROYECTO, ES CONDICIÓN NECESARIA PARA LA PROGRAMACIÓN DE LA VOTACIÓN</p>
      </b-message>
    <table class="table is-bordered is-fullwidth">
      <thead>
        <tr>
          <th>Proyecto</th>
          <th>Tipo</th>
          <th>Info</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div>
              <p class="is-size-6 is-300"><b><a :href="`/proyectos/${existingProject.id}`" class="has-text-link">{{existingProject.title}}</a></b></p>
              <p class="is-size-7" v-if="existingProject.organization_name">Organzación: <b>{{existingProject.organization_name}}</b></p>
              <p class="is-size-7">Presenta:&nbsp;<b>{{existingProject.author_names}} {{existingProject.author_surnames}}</b></p>
              </div>
          </td>
          <td width="150">
            <div>
              <p class="is-size-7"><i :class="`${existingProject.category.fontawesome_icon}`"></i>&nbsp;{{existingProject.category.name}}</p>
              <p class="is-size-7">Distrito: {{existingProject.district.name}}</p>
            </div>
          </td>
          <td width="200">
            <div>
              <p class="is-size-7">Presupuesto&nbsp;<i class="fas fa-dollar-sign"></i>&nbsp;<b>{{existingProject.budget_total}}</b></p>       
              <p class="is-size-7" v-if="existingProject.admin_notes == null"><i class="fas fa-times fa-lg fa-fw"></i>&nbsp;Sin observaciones</p>       
              <p class="is-size-7" v-else><i class="far fa-sticky-note fa-lg fa-fw"></i>&nbsp;Hay observaciones hechas</p>       
              <p class="is-size-7" v-if="existingProject.feasible === null"><i class="far fa-clock fa-lg fa-fw"></i>&nbsp;Aun sin evaluar</p>       
              <p class="is-size-7 has-text-danger" v-if="existingProject.feasible === false"><i class="fas fa-times fa-lg fa-fw"></i>&nbsp;<b>No factible</b></p>       
              <p class="is-size-7 has-text-success" v-if="existingProject.feasible === true"><i class="fas fa-clipboard-check fa-lg fa-fw"></i>&nbsp;<b>Factible</b></p>       
            </div>
          </td>
        </tr>
      </tbody>
    </table>
     <div class="columns is-vcentered">
       <div class="column">
         <div class="field">
           <label for="" class="label"  :class="{'has-text-danger': errors.has('code')}">Código del proyecto <span class="is-size-7 is-300 has-text-link">* Requerido</span></label>
           <div class="control">
            <input
                  v-model="project.code"
                  data-vv-name="code"
                  data-vv-as="'Código de proyecto'"
                  type="text"
                  v-validate="'required|min:1|max:80'"
                  class="input is-large"
                  placeholder="Requerido *"
                  :readonly="!editable"
                >
            <span v-show="errors.has('code')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('code')}}
            </span>
          </div>
         </div>
       </div>
       <div class="column is-narrow">
         <div class="notification is-dark has-text-centered">
            <h1 class="subtitle is-6">Código</h1>
            <h1 class="title is-4">{{project.code || '???'}}</h1>
         </div>
       </div>
     </div>
    </div>
    <div class="field" v-if="project.feasible === true || project.feasible === false">
      <label for="" class="label"  :class="{'has-text-danger': errors.has('project.feasibility')}">Sentencia de la factibilidad <span class="is-size-7 is-300 has-text-link">* Requerido</span></label>
      <div class="content">
        <p>Defina la sentencia de factibilidad (porque el proyecto es (o no) factible). Tiene un máximo de 2000 caracteres</p>
        <p><i class="fas fa-exclamation-triangle"></i>&nbsp;<b>Recuerde</b>: Esta sentencia sera <u>publica</u> cuando el sistema pase a la etapa de espera previa a la votación.</p>
      </div>
      <div class="control">
        <b-input
          v-model="project.feasibility"
          data-vv-name="project.feasibility"
          data-vv-as="'Descripcion'"
          v-validate="'required|min:5|max:2000'"
          type="textarea"
          minlength="5"
          maxlength="2000"
          rows="4"
          placeholder="Requerido *"
          :readonly="!editable"
        ></b-input>
        <span v-show="errors.has('project.feasibility')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.feasibility')}}
        </span>
      </div>
    </div>
    <div class="buttons">  
    <button
      class="button is-primary"
      @click="submit"
      v-if="!response.replied && editable"
    >
      <i class="fas fa-save fa-fw"></i> Guardar sentencia de factibilidad
    </button>
    </div>
    <div class="notification is-warning" v-if="!editable">
      <i class="fas fa-exclamation-triangle fa-fw"></i>&nbsp; <b>El proyecto ya no es editable!</b>
    </div>
    <div class="message is-success" v-show="response.replied && response.ok">
      <div class="message-body">
        <i class="fas fa-check fa-fw"></i>&nbsp;
        <b>¡Bien!</b> ¡El proyecto ahora cuenta con sentencia de factibilidad!
      </div>
    </div>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
export default {
  props: ["formUrl", "existingProject", "editable"],
  data() {
    return {
      isLoading: false,
      project: {
        feasible: null,
        feasibility: null,
        code: null,
      },
      response: {
        replied: false,
        ok: false
      }
    };
  },
  beforeMount: function() {
    this.project.feasible = this.existingProject.feasible;
    this.project.feasibility = this.existingProject.feasibility;
    this.project.code = this.existingProject.code;

  },
  methods: {
    submit: function() {
      this.isLoading = true;
      this.$validator.validate()
        .then(response => {
          if (response) {
            // Valid
            console.log("Sending form!");
            this.isLoading = true;
            this.$http
              .post(this.formUrl, this.payload)
              .then(response => {
                this.$buefy.snackbar.open({
                  message: "¡Factibilidad guardada!",
                  type: "is-success",
                  actionText: "¡Genial!"
                });
                this.isLoading = false;
                this.response.replied = true;
                this.response.ok = true;
              })
              .catch(error => {
                console.error(error);
                this.isLoading = false;
                this.$buefy.snackbar.open({
                  message: error.response.data.message || "Error inesperado",
                  type: "is-danger",
                  actionText: "Cerrar",
                });
              });
          } else {
            // Not Valid
            this.isLoading = false;
            this.$buefy.snackbar.open({
              message: "Faltan datos o algunos son incorrectos. Verifíquelos.",
              type: "is-danger",
              actionText: "Cerrar",
            });
          }
        })
        .catch(error => {
          console.error(error.message);
          this.isLoading = false;
          this.$buefy.snackbar.open({
            message: "Error inesperado",
            type: "is-danger",
            actionText: "Cerrar",
          });
        });
    }
  },
  computed: {
    payload: function() {
      let payload = {
        feasibility: this.project.feasible != null ? this.project.feasibility : null,
        feasible: this.project.feasible,
        code: this.project.feasible == true ? this.project.code : null,
      };
      return payload;
    },
  },
};
</script>

<style>
</style>
