<template>
  <section>
    <b-message type="is-primary">
      <h1 class="title is-4"><i class="fas fa-tools"></i>&nbsp;Notas y observaciones (Administrador)</h1>
    </b-message>
    <div class="field">
       <div class="content">
        <p>Utilice este campo para guardar notas y observaciones para todos los administradores. Este campo es solo visible para todos los administradores. Cuenta con un limite de 2000 caracteres.</p>
      </div>
      <div class="control">
        <b-input
          v-model="project.admin_notes"
          data-vv-name="project.admin_notes"
          data-vv-as="'Observaciones'"
          v-validate="'min:5|max:2000'"
          type="textarea"
          minlength="10"
          maxlength="2000"
          rows="2"
          :disabled="isLoading"
          :readonly="response.ok"
          placeholder="(Opcional)"
        ></b-input>
        <span v-show="errors.has('project.admin_notes')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.admin_notes')}}
        </span>
      </div>
    </div>
    <div class="field" v-if="!response.replied">
      <div class="buttons">
        <a @click="submitNotes" class="button is-primary" :class="{'is-loading': isLoading}" :disabled="isLoading">
          <i class="fas fa-save"></i>&nbsp;Guardar observaciones
        </a>
      </div>
    </div>
    <b-message type="is-success" v-show="response.replied && response.ok">

      <p>
        <i class="fas fa-check"></i>&nbsp;Las observaciones han sido guardadas
      </p>
    </b-message>
  </section>
</template>

<script>
export default {
  props: ["project", "notesUrl"],
  data() {
    return {
      isLoading: false,
      response: {
        replied: false,
        ok: false
      }
    };
  },
  methods: {
    submitNotes: function() {
      this.$http
        .post(this.notesUrl, {
          admin_notes: this.isOptional(this.project.admin_notes)
        })
        .then(response => {
          this.$buefy.snackbar.open({
            message: "¡Observaciones guardadas!",
            type: "is-success",
            actionText: "¡Genial!"
          });
          this.isLoading = false;
          this.response.replied = true;
          this.response.ok = true;
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
  }
};
</script>

<style>
</style>