<template>
  <section>
    <div class="buttons">
      <button class="button is-danger" @click="confirmDelete = true" v-if="!confirmDelete"><i class="fas fa-trash"></i>&nbsp;Eliminar bloque</button>
      <button class="button is-danger" v-else @click="deleteBlock"><i class="fas fa-exclamation-triangle"></i>&nbsp;Haga click para confirmar eliminar</button>
    </div>
    <div class="field">
      <label class="label">Título del bloque</label>
      <div class="control">
        <input
          class="input"
          v-model="title"
          name="title" 
          />
      </div>
    </div>
    <div class="field">
      <label class="label">Path del bloque</label>
      <div class="control">
        <input
          class="input"
          v-model="path"
          name="path" 
          />
      </div>
    </div>
        <div class="content">
      <p><b>Nota: </b> Escriba el path donde el bloque de texto se mostrará</p>
      <p>Ejemplo:</p>
      <ul>
        <li><code>/</code> - Home o página de inicio</li>
        <li><code>/faq</code> - Preguntas frecuentes</li>
        <li><code>/terms</code> - Terminos y condiciones</li>
      </ul>
    </div>
    <div class="field">
      <label class="label">Orden del bloque</label>
      <div class="control">
        <input
          class="input"
          v-model.number="order"
          name="order" 
          />
      </div>
    </div>
    <div class="field">
      <label class="label">¿Desea ocultar el bloque?</label>
      <div class="control">
        <b-checkbox
          v-model="hidden"
          :native-value="true"
        >Ocultar</b-checkbox>
      </div>
    </div>
    <div class="field">
      <label class="label">Markdown del texto</label>
      <div class="control">
        <textarea
          class="textarea"
          v-model="markdown"
          name="markdown"
          rows="8"
        ></textarea>
      </div>
    </div>
    <div class="field" v-if="!response.success">
      <div class="control">
        <div class="buttons">
          <button
            @click="submit"
            class="button is-large is-primary is-fullwidth"
            :class="{'is-loading': isLoading}"
            :disabled="isLoading"
          >¡Guardar!</button>
        </div>
      </div>
    </div>
    <b-message type="is-success" v-if="response.done && response.success">
      <i class="fas fa-check-circle"></i>&nbsp;Guardado con exito
    </b-message>
    <b-message type="is-danger" v-if="response.done && response.error">
      <i class="fas fa-times-circle"></i>&nbsp; <b>ERROR</b> - El servidor no pudo procesar la instalación y ocurrio un error. Por favor, contactar al administrador y verificar el logger.
    </b-message>
    <b-loading :active="isLoading"></b-loading>
  </section>
</template>

<script>
export default {
  props: ['formUrl','previousBlock','deleteUrl','redirectUrl'],
  data(){
    return { 
      title: null,
      markdown: null,
      path: null,
      order: null,
      hidden: false,
      isLoading: false,
      confirmDelete: false,
      response: {
        done: false,
        success: false,
        error: false
      }
    }
  },
  created: function(){
    this.sync()
  },
  methods: { 
    sync: function(){
      this.title = this.previousBlock.title,
      this.markdown = this.previousBlock.markdown
      this.path = this.previousBlock.path
      this.order = this.previousBlock.order
      this.hidden = this.previousBlock.hidden
    },
    makePayload: function(){
      return {
        title: this.title,
        markdown: this.markdown,
        path: this.path,
        order: this.order,
        hidden: this.hidden,
      }
    },
    submit: function(){
      this.response.done = false
      this.response.success = false
      this.response.error = false
      this.isLoading = true
      let thePayload = this.makePayload()
      this.$http.put(this.formUrl, thePayload)
      .then( (res) => {
        this.response.success = true
        this.$buefy.snackbar.open({
          message: "¡Bloque de texto guardado con exito!",
          type: "is-success",
          actionText: "OK"
        });
      })
      .catch(err => {
        console.error(err)
        this.response.error = true
        this.$buefy.snackbar.open({
          message: "Error. No se pudo editar el bloque.",
          type: "is-danger",
          actionText: "OK"
        });
      })
      .finally( () => {
        this.response.done = true
        this.isLoading = false
      })
    },
    deleteBlock(){
      this.isLoading = true;
      this.$http.delete(this.deleteUrl)
      .then( res => {
        window.location.href = this.redirectUrl
      })
      .catch( err => {
        console.error(err)
        this.isLoading = false
        this.$buefy.snackbar.open({
          message: "Error. No se pudo eliminar",
          type: "is-danger",
          actionText: "OK"
        });
      })
    }
  }
}
</script>