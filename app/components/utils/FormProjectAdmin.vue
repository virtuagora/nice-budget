<template>
  <section>
    <b-message type="is-primary">
    <h1 class="title is-4"><i class="fas fa-user"></i>&nbsp;Datos del autor</h1>
    </b-message>
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
              placeholder="Requerido *"
            >
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
              placeholder="Requerido *"
            >
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
              placeholder="Requerido *"
            >
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
            >
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
              placeholder="Requerido *"
            >
            <span v-show="errors.has('project.author_email')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('project.author_email')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <p>Si el proyecto se realiza en conjunto una organización, por favor, escriba aquí los datos del mismo.</p>
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
            >
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
          >
          <span v-show="errors.has('project.organization_address')" class="help is-danger">
            <i class="fas fa-times-circle fa-fw"></i>
            &nbsp;{{errors.first('project.organization_address')}}
          </span>
        </div>
        </div>
      </div>
    </div>

    <b-message type="is-primary">
     <h1 class="title is-4"><i class="fas fa-list"></i>&nbsp;Datos del proyecto</h1>
    </b-message>
    <div class="field">
      <label for="" class="label" :class="{'has-text-danger': errors.has('project.category_id')}">Categoria de la propuesta <span class="is-size-7 is-300 has-text-link">* Requerido</span></label>
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
            <option :value="category.id" v-for="category in categories" :key="category.key">{{category.name}}</option>
          </select>
        </div>
        <span v-show="errors.has('project.category_id')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.category_id')}}
        </span>
      </div>
    </div>
    <div class="field">
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.district_id')}">
        <i class="fas fa-caret-right"></i>&nbsp;Elegí el distrito
      </h1>
      <h1 class="subtitle is-6">
        <span class="has-text-link">* Requerido.</span> ¿En donde tendrá impacto tu propuesta?
      </h1>
      <div class="control">
        <div class="select is-large is-fullwidth">
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
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.title')}">
        <i class="fas fa-caret-right"></i>&nbsp;Nombre del proyecto
      </h1>
      <h1 class="subtitle is-6">
        <span class="has-text-link">* Requerido.</span>
      </h1>
      <div class="control">
        <input
          v-model="project.title"
          data-vv-name="project.title"
          data-vv-as="'Nombre del proyecto'"
          type="text"
          v-validate="'required|min:2|max:250'"
          class="input is-large"
          placeholder="Requerido *"
        >
        <span v-show="errors.has('project.title')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.title')}}
        </span>
      </div>
    </div>
        <div class="field">
        <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.objective')}">
          <i class="fas fa-caret-right"></i>&nbsp;Objetivo del proyecto
        </h1>
        <h1 class="subtitle is-6">
          <span class="has-text-link">* Requerido.</span> Defina el objetivo del proyecto. Tenes un máximo de 1500 caracteres
        </h1>
      <div class="control">
        <b-input
          v-model="project.objective"
          data-vv-name="project.objective"
          data-vv-as="'Objetivo'"
          v-validate="'required|min:5|max:1500'"
          type="textarea"
          minlength="10"
          maxlength="1500"
          rows="3"
          placeholder="Requerido *"
        ></b-input>
        <span v-show="errors.has('project.objective')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.objective')}}
        </span>
      </div>
    </div>
    <!-- <div class="field">
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.description')}">
          <i class="fas fa-caret-right"></i>&nbsp; Definición de la situación problemática
      </h1>
      <h1 class="subtitle is-6">
          <span class="has-text-link">* Requerido.</span> ¿Cual es la problematica que atiende el proyecto?. Tenes un máximo de 1500 caracteres
      </h1>
      <div class="control">
        <b-input
          v-model="project.description"
          data-vv-name="project.description"
          data-vv-as="'Descripcion'"
          v-validate="'required|min:5|max:1500'"
          type="textarea"
          minlength="10"
          maxlength="1500"
          rows="3"
          placeholder="Requerido *"
        ></b-input>
        <span v-show="errors.has('project.description')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.description')}}
        </span>
      </div>
    </div>
    <div class="field">
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.benefited_population')}">
          <i class="fas fa-caret-right"></i>&nbsp; Población beneficiada
      </h1>
      <h1 class="subtitle is-6">
          <span class="has-text-link">* Requerido.</span> ¿Cual es la población identificada que se verá beneficiada con tu propuesta?. Tenes un máximo de 1500 caracteres
      </h1>
      <div class="control">
        <b-input
          v-model="project.benefited_population"
          data-vv-name="project.benefited_population"
          data-vv-as="'Poblacion beneficiada'"
          v-validate="'required|min:5|max:1500'"
          type="textarea"
          minlength="10"
          maxlength="1500"
          rows="3"
          placeholder="Requerido *"
        ></b-input>
        <span v-show="errors.has('project.benefited_population')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.benefited_population')}}
        </span>
      </div>
    </div>
    <div class="field">
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.community_contributions')}">
          <i class="fas fa-caret-right"></i>&nbsp; Aportes comunitarios
      </h1>
      <h1 class="subtitle is-6">
          <span class="has-text-link">* Requerido.</span> ¿Cuales van a ser los aportes comunitarios que ofrecerá tu propuesta?. Tenes un máximo de 1500 caracteres
      </h1>
      <div class="control">
        <b-input
          v-model="project.community_contributions"
          data-vv-name="project.community_contributions"
          data-vv-as="'Contribución a la comunidad'"
          v-validate="'required|min:5|max:1500'"
          type="textarea"
          minlength="10"
          maxlength="1500"
          rows="3"
          placeholder="Requerido *"
        ></b-input>
        <span v-show="errors.has('project.community_contributions')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('project.community_contributions')}}
        </span>
      </div>
    </div> -->
    <!-- <div class="field">
      <div class="notification is-primary">
     <h1 class="title is-3 is-marginless"><i class="fas fa-file-invoice-dollar"></i>&nbsp;El presupuesto de tu propuesta</h1>
      <p>Detalle como se compone el presupuesto del proyecto.</p>
    </div>
     <b-message type="is-warning">
        <b><i class="fas fa-exclamation-triangle"></i>&nbsp;IMPORTANTE: El limite a presupuestar en proyectos institucionales es $ 400.140 y en proyectos comunitarios $ 600.210</b>
      </b-message>
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('project.budget')}">
          <i class="fas fa-caret-right"></i>&nbsp; Items del presupuesto
      </h1>
      <h1 class="subtitle is-6">
          <span class="has-text-link">* Requerido.</span> Defina cada item del presupuesto que presenta el proyecto. Escribí descripción del mismo, y el monto en pesos (sin centavos)
      </h1>
      <div class="field is-grouped" v-if="editable">
        <p class="control is-expanded">
          <b-input
            size="is-medium"
            v-model="inputItemDescripcion"
            maxlength="300"
            placeholder="Descripción Item"
          ></b-input>
        </p>
        <p class="control">
          <input
            class="input is-medium"
            v-model.number="inputItemMonto"
            data-vv-name="inputItemMonto"
            data-vv-as="'Monto'"
            v-validate="'numeric'"
            type="text"
            placeholder="Monto en AR$"
          >
          <span v-if="errors.has('inputItemMonto')" class="help is-danger">
            <i class="fas fa-times-circle fa-fw"></i>
            &nbsp;{{errors.first('inputItemMonto')}}
          </span>
          <span v-else class="help">Ingrese números sin decimal, puntos o comas</span>
        </p>
        <p class="control">
          <b-tooltip
            :label="disableAddItem ? 'Falta información' : 'Agregar!'"
            :type="disableAddItem ? 'is-danger' : 'is-primary'"
            position="is-bottom"
          >
            <button @click="addItem" class="button is-primary is-medium" :disabled="disableAddItem">
              <i class="fas fa-plus"></i>&nbsp;Agregar
            </button>
          </b-tooltip>
        </p>
      </div>
      <input
        type="hidden"
        v-model="project.budget"
        data-vv-name="project.budget"
        data-vv-as="'Presupuesto'"
        v-validate="'required'"
      >
      <b-table 
        :data="project.budget"
        bordered>
       <template slot-scope="props">
         <b-table-column label="Descripción" >
            {{ props.row.description }}
          </b-table-column>
         <b-table-column label="Monto" width="100" centered>
            $ {{ props.row.amount }}
          </b-table-column>
         <b-table-column label="Quitar" width="40" centered v-if="editable">
            <a @click="removeItem(props.index)">
              <i class="fas fa-times has-text-danger"></i>
            </a>
          </b-table-column>
       </template>
       <template slot="empty">
        <section class="section">
            <div class="content has-text-grey has-text-centered">
                <p>
                   <i class="far fa-sad-cry fa-2x"></i>
                </p>
                <p>No se han ingresado items en el presupuesto</p>
                </div>
            </section>
        </template>
      </b-table>
       <span v-show="errors.has('project.budget')" class="help is-danger">
        <i class="fas fa-times-circle fa-fw"></i>
        &nbsp;{{errors.first('project.budget')}}
      </span>
      <br>
      <div class="notification is-link">
        <h1 class="subtitle is-5">Monto total del presupuesto ingresado: <span class="is-700"> $ {{montoTotal}}</span></h1>
      </div>
    </div> -->
  </section>
</template>

<script>
export default {
  props: ["project", "budget", "categories", "editable", "districts"],
  data() {
    return {
      inputItemDescripcion: null,
      inputItemMonto: null,
      canComplete: true
    };
  },
  created: function() {
    if (!this.project.budget) {
      this.project.budget = [];
      // this.isInitialized = true;
    }
  },
  methods: {
    addItem: function() {
      this.$validator
        .validate("inputItemMonto", this.inputItemMonto)
        .then(result => {
          if (result) {
            if (!this.disableAddItem) {
              if (
                parseFloat(this.inputItemMonto) + this.montoTotal >
                this.budget
              ) {
                this.$buefy.snackbar.open(
                  "El item excede el total permitido ($" + this.budget + ")"
                );
                return;
              }
              this.project.budget.push({
                description: this.inputItemDescripcion,
                amount: this.inputItemMonto
              });
              this.inputItemDescripcion = null;
              this.inputItemMonto = null;
            }
          } else {
            this.$buefy.snackbar.open(
              "El monto debe ser un número sin coma ni punto decimal"
            );
          }
        });
    },
    removeItem: function(index) {
      this.project.budget.splice(index, 1);
    },
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
  },
  computed: {
    montoTotal: function() {
      const reducer = (accumulator, item) =>
        accumulator + parseFloat(item.amount);
      return this.project.budget.reduce(reducer, 0);
    },
    disableAddItem: function() {
      return (
        this.inputItemDescripcion == null ||
        this.inputItemDescripcion == "" ||
        this.inputItemMonto == null ||
        this.inputItemMonto == ""
      );
    }
  }
};
</script>

<style lang="scss" scoped>
.field:not(:last-child) {
  margin-bottom: 20px;
}
</style>

