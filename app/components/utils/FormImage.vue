<template>
  <section>
    <div>
      <b-message>
        <div class="content">
        <p>Suba una imagen que tenga relacion con el proyecto.</p>
        <ul>
          <li>Debe de ser de un tamaño menor de 3MB</li>
          <li>Se aceptan imagenes con formato .JPG, JPEG, o PNG. (Sin transparencia)</li>
          <li>Se recomiendan que las dimensiones sean al menos de un ancho de 1000px y alto de 500 px (De no se así se ajustaran las dimensiones)</li>
        </ul>
        </div>
      </b-message>
      <form :action="formUrl" ref="formProImg" method="post" enctype="multipart/form-data">
        <div class="columns">
          <div class="column">
        <b-field class="file">
          <b-upload v-model="file" :required="true" accept="image/jpeg,image/pjpeg,image/png" @input="check" name="archivo">
            <a class="button is-dark">
              <i class="fas fa-upload"></i>&nbsp;
              <span>Click para cargar</span>
            </a>
          </b-upload>
          <span class="file-name" style="max-width: none;" v-if="file">{{ file.name }}</span>
        </b-field>
        <p
          v-show="!isFileOk && file != null"
          class="has-text-danger"
        ><b>Requerido:</b> Debe ser un archivo .JPG, .JPEG, .PNG de hasta 3MB como máximo.</p>
          </div>
          <div class="column is-narrow">
            <button
              @click.prevent="submit"
              type="submit"
              class="button is-primary"
              :class="{'is-loading': isLoading}"
              :disabled="!isFileOk || file == null"
            >
              <i class="fa fa-paper-plane"></i>&nbsp;Enviar
            </button>

          </div>
        </div>
      </form>
    </div>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
export default {
  props: ["formUrl", "project"],
  data() {
    return {
      file: null,
      isLoading: false,
      mimes: ["image/jpeg", "image/pjpeg", "image/png"]
    };
  },
  methods: {
    submit: function() {
      this.$validator
        .validateAll()
        .then(result => {
          if (!result) {
            this.$buefy.snackbar.open({
              message: "Error en el formulario. Verifíquelo",
              type: "is-danger",
              actionText: "Cerrar"
            });
            return false;
          }
          this.isLoading = true;
          this.$refs.formProImg.submit();
        })
        .catch(error => {
          this.$buefy.snackbar.open({
            message: "Error inesperado",
            type: "is-danger",
            actionText: "Cerrar"
          });
          return false;
        });
    },
  },
  computed: {
    isFileOk: function() {
      if (this.file === null) return false;
      if (this.file && this.file.size > 3145728) return false;
      if (this.file && !this.mimes.includes(this.file.type)) return false;
      return true;
    }
  }
};
</script>
