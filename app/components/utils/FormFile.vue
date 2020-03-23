<template>
  <section>
      <b-message>
         <div class="content">
        <p>Suba un archivo para ser presentado a la administración.</p>
        <ul>
          <li>Debe de ser de un tamaño menor de 3MB</li>
          <li>Se aceptan imagenes, escaneos, archivos PDF o documentos de Microsoft Word</li>
          <li>Los formatos aceptables son: .JPG, .JPEG, .PDF, .DOC o .DOCX</li>
        </ul>
        </div>
      </b-message>

      <form :action="formUrl" ref="formProFile" method="post" enctype="multipart/form-data">
      <div class="field">
        <label class="label" :class="{'has-text-danger': errors.has('name')}">Nombre del archivo <span class="is-size-7 is-300 has-text-link">* Requerido.</span></label>
        <div class="control">
          <input
            v-model="name"
            name="name"
            data-vv-name="name"
            data-vv-as="'Nombre del archivo'"
            type="text"
            v-validate="'required|min:2|max:250'"
            class="input"
            placeholder="Requerido *"
          >
          <span v-show="errors.has('name')" class="help is-danger">
            <i class="fas fa-times-circle fa-fw"></i>
            &nbsp;{{errors.first('name')}}
          </span>
        </div>
      </div>
      <div class="field">
        <label class="label" :class="{'has-text-danger': errors.has('description')}">Descripción del archivo</label>
        <div class="content">
          <p>Utilice este campo si desea dejar alguna aclaracion con respecto al archivo</p>
        </div>
        <div class="control">
          <b-input
            v-model="description"
            data-vv-name="description"
            data-vv-as="'Descripción del archivo'"
            v-validate="'min:2|max:2000'"
            type="textarea"
            minlength="10"
            maxlength="2000"
            rows="2"
            placeholder="Descripcion del archivo"
          ></b-input>
          <span v-show="errors.has('description')" class="help is-danger">
            <i class="fas fa-times-circle fa-fw"></i>
            &nbsp;{{errors.first('description')}}
          </span>
          <input type="hidden" name="description" :value="descriptionFinal" v-if="descriptionFinal">
        </div>
      </div>
      <div class="field">
        <label class="label" :class="{'has-text-danger': !isFileOk && file !== null }">Archivo <span class="is-size-7 is-300 has-text-link">* Requerido.</span></label>
        <b-field class="file">
          <b-upload v-model="file" :required="true" accept="application/pdf,invalid/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpeg,image/pjpeg,image/png" name="archivo">
            <a class="button is-primary">
              <i class="fas fa-upload"></i>&nbsp;
              <span>Click para cargar</span>
            </a>
          </b-upload>
          <span class="file-name" style="max-width: none;" v-if="file">{{ file.name }}</span>
        </b-field>
        <p
          v-show="!isFileOk && file != null"
          class="has-text-danger"
        ><b>Requerido:</b> Debe ser un archivo .JPG, .JPEG, .PNG, .PDF, .DOC o .DOCX de hasta 3MB como máximo.</p>
        </div>
        <div class="field">
          <div class="control is-clearfix">
            <button
              @click.prevent="submit"
              type="submit"
              class="button is-primary is-medium is-pulled-right"
              :class="{'is-loading': isLoading}"
              :disabled="!isFileOk || file == null || errors.any()"
            >
              <i class="fa fa-paper-plane fa-fw"></i> Enviar
            </button>
          </div>
        </div>
      </form>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
export default {
  props: ["formUrl", "project"],
  data() {
    return {
      name: null,
      description: null,
      file: null,
      isLoading: false,
      mimes: ['application/pdf','invalid/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','image/jpeg','image/pjpeg','image/png']
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
          this.$refs.formProFile.submit();
        })
        .catch(error => {
          this.$buefy.snackbar.open({
            message: "Error inesperado",
            type: "is-danger",
            actionText: "Cerrar"
          });
          return false;
        });
    }
  },
  computed: {
    isFileOk: function() {
      if (this.file === null) return false;
      if (this.file && this.file.size > 3145728) return false;
      if (this.file && !this.mimes.includes(this.file.type)) return false;
      return true;
    },
    descriptionFinal: function(){
      return this.isOptional(this.description)
    }
  }
};
</script>