<template>
  <section>
    <h1 class="subtitle is-4 has-text-primary">Nombre del presupuesto</h1>
    <div class="content">
      <p>
        Tenga en cuenta que tanto
        <b>Nombre del presupuesto</b> como
        <b>Descripción del presupuesto</b> apareceran en las previsualizaciones de las redes sociales y será el título de la página web.
      </p>
      <p>Considere completarlo tal como le gustaría que aparezca en las redes sociales</p>
    </div>
    <div class="field">
      <div class="control">
        <input
          type="text"
          class="input is-medium"
          v-model="model.budgetName"
          name="budgetName"
          v-validate="'required'"
        />
      </div>
    </div>
    <br>
    <h1 class="subtitle is-4 has-text-primary">Descripción del presupuesto</h1>
    <div class="content">
      <p>Considere una descripcion corta. Este es el texto que aparece cada vez que comparten el link en las redes sociales o aplicaciones de mensajerias como <i class="fab fa-whatsapp"></i> WhatsApp y otros.</p>
      <p>¡Escriba un texto consico (entre 250-350 letras) que invite a los usuarios a entrar!</p>
    </div>
    <div class="field">
      <div class="control">
        <textarea
          class="textarea"
          v-model="model.budgetDescription"
          name="budgetName"
          rows="3"
          v-validate="'required'"
        ></textarea>
      </div>
    </div>
    <br>
    <h1 class="subtitle is-4 has-text-primary">Email de contacto</h1>
    <div class="content">
      <p>
        Defina un email donde el usuario puede contactarlo para hacer consultas y resolver inconvenientes. Este email será visible en toda la plataforma.
      </p>
    </div>
    <div class="field">
      <div class="control">
        <input
          type="text"
          class="input is-medium"
          v-model="model.contactEmail"
          name="contactEmail"
          v-validate="'required|email'"
        />
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    model: {
      type: Object,
      required: true
    }
  },
}
</script>