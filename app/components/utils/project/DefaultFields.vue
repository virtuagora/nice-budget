<template>
  <section>
    <b-message type="is-primary">
      <h1 class="title is-4">
        <i class="fas fa-user"></i>&nbsp;Datos del responsable
      </h1>
    </b-message>
    <div class="content" v-if="lockAuthorFields">
      <p>
        <b>NOTA:</b> Al encontrarse registrado, algunos campos han sido completados automaticamente con los datos del registro
      </p>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Nombre(s)</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.author_names"
              data-vv-name="project.author_names"
              data-vv-as="'Nombre(s) del autor'"
              type="text"
              v-validate="'required|min:2|max:100'"
              class="input"
              :class="{'is-static': lockAuthorFields}"
              :readonly="lockAuthorFields"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('project.author_names')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.author_names')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Apellido(s)</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.author_surnames"
              data-vv-name="project.author_surnames"
              data-vv-as="'Apellido(s) del autor'"
              type="text"
              v-validate="'required|min:2|max:100'"
              class="input"
              :class="{'is-static': lockAuthorFields}"
              :readonly="lockAuthorFields"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('project.author_surnames')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.author_surnames')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Nro. Documento</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.author_dni"
              data-vv-name="project.author_dni"
              data-vv-as="'Número de documento del autor'"
              type="text"
              v-validate="'required|min:2|max:100'"
              class="input"
              :class="{'is-static': lockAuthorFields}"
              :readonly="lockAuthorFields"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('project.author_dni')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.author_dni')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Teléfono</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.author_phone"
              data-vv-name="project.author_phone"
              data-vv-as="'Telefono del autor'"
              type="text"
              v-validate="'min:2|max:100'"
              class="input"
              placeholder="Opcional"
            />
            <span v-show="errors.has('project.author_phone')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.author_phone')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Email</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.author_email"
              data-vv-name="project.author_email"
              data-vv-as="'Email del autor'"
              type="text"
              v-validate="'required|email|min:2|max:100'"
              class="input"
              :class="{'is-static': lockAuthorFields}"
              :readonly="lockAuthorFields"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('project.author_email')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.author_email')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <div class="control">
        <p>Si el proyecto se realiza en conjunto una organización, por favor, escriba aquí los datos del mismo.</p>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Nombre Org.</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.organization_name"
              data-vv-name="project.organization_name"
              data-vv-as="'Nombre de la organización'"
              type="text"
              v-validate="'min:2|max:250'"
              class="input"
              placeholder="Si corresponde, requerido"
            />
            <span v-show="errors.has('project.organization_name')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.organization_name')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field is-horizontal">
      <div class="field-label is-normal">
        <label class="label">Domicilio Org.</label>
      </div>
      <div class="field-body">
        <div class="field">
          <div class="control">
            <input
              v-model="project.organization_address"
              data-vv-name="project.organization_address"
              data-vv-as="'Dirección de la organización'"
              type="text"
              v-validate="'min:2|max:250'"
              class="input"
              placeholder="Si corresponde, requerido"
            />
            <span v-show="errors.has('project.organization_address')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.organization_address')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <br />

    <b-message type="is-primary">
      <h1 class="title is-4">
        <i class="fas fa-list"></i>&nbsp;Datos básicos del proyecto
      </h1>
    </b-message>
    <div class="field">
      <label for class="label" :class="{'has-text-danger': errors.has('project.title')}">
        Titulo
        <span class="is-size-7 is-300 has-text-link">* Requerido</span>
      </label>
      <div class="control">
        <input
          v-model="project.title"
          data-vv-name="project.title"
          data-vv-as="'Titulo del proyecto'"
          type="text"
          v-validate="'required|min:2|max:250'"
          class="input"
          placeholder="Requerido *"
        />
        <span v-show="errors.has('project.title')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.title')}}
        </span>
      </div>
    </div>
    <div class="field">
      <label for class="label" :class="{'has-text-danger': errors.has('project.category_id')}">
        Categoria
        <span class="is-size-7 is-300 has-text-link">* Requerido</span>
      </label>
      <div class="control">
        <div class="select is-fullwidth">
          <select
            data-vv-name="project.category_id"
            data-vv-as="'Categoría'"
            v-validate="'required'"
            v-model="project.category_id"
            placeholder="Seleccione la categoria"
          >
            <option :value="null" disabled>- Seleccione la categoria -</option>
            <option
              :value="category.id"
              v-for="category in categories"
              :key="category.key"
            >{{category.name}}</option>
          </select>
        </div>
        <span v-show="errors.has('project.category_id')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.category_id')}}
        </span>
      </div>
    </div>
    <div class="field">
      <label for class="label" :class="{'has-text-danger': errors.has('project.district_id')}">
        Distrito
        <span class="is-size-7 is-300 has-text-link">* Requerido</span>
      </label>
      <div class="control">
        <div class="select is-fullwidth">
          <select
            data-vv-name="project.district_id"
            data-vv-as="'Distrito'"
            v-validate="'required'"
            v-model="project.district_id"
            placeholder="Seleccione el distrito"
          >
            <option :value="null" disabled>- Selecciona el distrito -</option>
            <option
              v-for="district in districts"
              :key="district.id"
              :value="district.id"
            >{{district.name}}</option>
          </select>
        </div>
        <span v-show="errors.has('project.district_id')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.district_id')}}
        </span>
      </div>
    </div>
    <div class="field">
      <label for class="label" :class="{'has-text-danger': errors.has('project.objective')}">
        Objetivo
        <span class="is-size-7 is-300 has-text-link">* Requerido</span>
      </label>
      <div class="content">
        <p>En simples palabras, escriba el objetivo del proyecto, que intenta cumplir el mismo. Cuenta con un limite de 2000 caracteres.</p>
      </div>
      <div class="control">
        <b-input
          v-model="project.objective"
          data-vv-name="project.objective"
          data-vv-as="'Objetivo'"
          v-validate="'required|min:5|max:2000'"
          type="textarea"
          minlength="10"
          maxlength="2000"
          rows="3"
          placeholder="Requerido *"
        ></b-input>
        <span v-show="errors.has('project.objective')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.objective')}}
        </span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["project", "categories", "editable", "districts"],
  data() {
    return {
      lockAuthorFields: false
    };
  },
  beforeMount: function() {
    if (this.project.author) {
      this.lockAuthorFields = true;
    }
  },
  methods: {
    validateForm: function() {
      let promise = new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          if (!result) {
            console.log(
              "Proyecto: Hay errores en los datos. Reviselos antes de guardar los campos"
            );
            return resolve(result);
          }
          console.log("Proyecto: OK");
          return resolve(result);
        });
      });
      return promise;
    }
  }
};
</script>

<style>
</style>