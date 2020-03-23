<template>
  <section>
    <b-message class="is-warning">
  <i class="fas fa-exclamation-triangle fa-fw"></i>&nbsp;No agregue al padron ciudadanos que no hayan sido verificados.
    </b-message>
    <div class="card">
      <div class="card-content">
    <div class="field">
      <div class="field-body">
        <div class="field">
           <label for class="label" :class="{'has-text-danger': errors.has('citizen.names')}">
            Nombres(s)
            <span class="is-size-7 is-300 has-text-link">* Requerido</span>
          </label>
          <div class="control">
            <input
              v-model="citizen.names"
              data-vv-name="citizen.names"
              data-vv-as="'Nombres'"
              type="text"
              v-validate="'required|min:2|max:400'"
              class="input is-medium"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('citizen.names')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('citizen.names')}}
            </span>
          </div>
        </div>
        <div class="field">
           <label for class="label" :class="{'has-text-danger': errors.has('citizen.surnames')}">
            Apellido(s)
            <span class="is-size-7 is-300 has-text-link">* Requerido</span>
          </label>
          <div class="control">
            <input
              v-model="citizen.surnames"
              data-vv-name="citizen.surnames"
              data-vv-as="'Apellidos'"
              type="text"
              v-validate="'required|min:2|max:400'"
              class="input is-medium"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('citizen.surnames')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('citizen.surnames')}}
            </span>
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <div class="field-body">
        <div class="field">
          <label for class="label" :class="{'has-text-danger': errors.has('citizen.number')}">
            Numero de identidad
            <span class="is-size-7 is-300 has-text-link">* Requerido</span>
          </label>
          <div class="control">
            <input
              v-model="citizen.number"
              data-vv-name="citizen.number"
              data-vv-as="'Numero de identidad'"
              type="text"
              v-validate="'required|integer|min:2|max:15'"
              class="input is-medium"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('citizen.number')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('citizen.number')}}
            </span>
          </div>
       </div>
          <div class="field">
            <label for class="label" :class="{'has-text-danger': errors.has('citizen.year')}">
            Año de nacimiento
            <span class="is-size-7 is-300 has-text-link">* Requerido</span>
          </label>
          <div class="control">
            <input
              v-model.number="citizen.year"
              data-vv-name="citizen.year"
              data-vv-as="'Año de nacimiento'"
              type="text"
              v-validate="'required|integer|min:2|max:4|min_value:1900'"
              class="input is-medium"
              placeholder="Requerido *"
            />
            <span v-show="errors.has('citizen.year')" class="help is-danger">
              <i class="fas fa-times-circle fa-fw"></i>
              &nbsp;{{errors.first('citizen.year')}}
            </span>
          </div>
          </div>
          <div class="field">
         <label for class="label" :class="{'has-text-danger': errors.has('citizen.genre')}">
            Genero</label>
          <input type="hidden" v-model="citizen.genre" v-validate="'required'" data-vv-as="'Genero'" data-vv-name="citizen.genre">
          <b-field>
            <b-radio-button v-model="citizen.genre" size="is-medium" v-validate="'required'" native-value="M">
              Masculino
            </b-radio-button>
            <b-radio-button v-model="citizen.genre" size="is-medium" native-value="F">
              Femenino
            </b-radio-button>
          </b-field>
          <span v-show="errors.has('citizen.genre')" class="help is-danger">
            <i class="fas fa-times-circle fa-fw"></i>&nbsp;{{errors.first('citizen.genre')}}</span>
        </div>
      </div>
    </div>
      </div>
    </div>
     <b-collapse class="card" aria-id="contentIdForA11y3" :open="false">
            <div
                slot="trigger" 
                slot-scope="props"
                class="card-header"
                role="button"
                aria-controls="contentIdForA11y3">
                <p class="card-header-title">
                    Datos extras (Opcional)
                </p>
                <a class="card-header-icon">
                  <i class="fas" :class="props.open ? 'fa-angle-double-down' : 'fa-angle-double-up'"></i>
                </a>
            </div>
            <div class="card-content">
               <div class="field is-grouped" v-for="(field, index) in extraData" :key="index">
                    <div class="control">
                      <a @click="deleteField(index)" class="has-text-danger"><i class="fas fa-times fa-fw"></i></a>
                    </div>
                    <div class="control is-expanded">
                      <input type="text" class="input is-small is-family-code" v-validate="'alpha_num'" :data-vv-name="index" :class="{'is-danger has-text-danger': errors.has(index)}" v-model="extraData[index]['key']" />
                    </div>
                    <div class="control is-expanded">
                      <input type="text" class="input is-small is-family-code" v-model="extraData[index]['value']" placeholder="Opcional..." />
                    </div>
              </div>
                <p><a @click="addField" class="button is-primary is-inverted is-fullwidth is-small"><i class="fas fa-plus fa-fw"></i> Agregar nuevo campo extra (Opcional)</a></p>
            </div>
        </b-collapse>
    <br>
    <div class="field" v-if="!response.ok">
      <div class="control">
        <button @click="submit()" class="button is-primary">
          <i class="fas fa-save fa-fw"></i>&nbsp;Guardar</button>
      </div>
    </div>
    <div v-else>
      <div class="notification is-success has-text-centered">
        <i class="fas fa-check fa-fw"></i>&nbsp;¡Se ha registrado con éxito en el padrón!
      </div>
      <div class="columns">
        <div class="column" v-if="allowRestart">
          <button @click="restart()" class="button is-primary is-outlined is-medium is-fullwidth">
            <i class="fas fa-undo fa-fw"></i>&nbsp;Reiniciar
          </button>
        </div>
        <div class="column" v-if="allowStartVoting">
        <button @click="startVoting" class="button is-link is-medium is-fullwidth">
          <i class="fas fa-arrow-right fa-fw fa-lg"></i>&nbsp;Comenzar proceso de votación
        </button>
        </div>
      </div>
    </div>
    <b-loading :is-full-page="true" :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
export default {
  props: ["url", "allowRestart","allowStartVoting", "urlParticipacion"],
  data() {
    return {
      isLoading: false,
      response: {
        ok: false,
        replied: false,
        citizen: null
      },
      citizen: {
        surnames: null,
        names: null,
        year: null,
        number: null,
        genre: "M"
      },
      extraDataKeys: [
        'tipo',
        'domicilio'
      ],
      extraData: {

      },
      extraDataKeyNumber: 0
    };
  },
  mounted: function(){
    this.makeExtraData()
  },
  methods: {
    makeExtraData(){
      this.extraDataKeys.forEach( k => {
        this.extraData[`field_${this.extraDataKeyNumber}`] = {
          key: k,
          value: null
        }
        this.extraDataKeyNumber++;
      })
    },
    submit: function() {
      this.$validator.validateAll().then(result => {
        if (!result) {
          this.$buefy.snackbar.open({
            message: "Faltan datos o algunos son incorrectos. Verifíquelos.",
            type: "is-danger",
            actionText: "Cerrar",
          });
          return;
        }
        this.isLoading = true;
        this.$http
          .post(this.url, this.makePayload())
          .then(response => {
            this.$buefy.snackbar.open({
              message: "¡Ciudadano agregado al padron con éxito!",
              type: "is-success",
              actionText: "¡Genial!"
            });
            this.isLoading = false;
            this.response.ok = true;
            this.response.replied = true;
            this.response.citizen = response.data.citizen;
          })
          .catch(error => {
            console.error(error.message);
            this.isLoading = false;
            this.response.ok = false;
            this.response.replied = true;
            this.$buefy.snackbar.open({
              message: "Error inesperado: " + error.message,
              type: "is-danger",
              actionText: "Cerrar",
              indefinite: true
            });
          });
      });
    },
    restart: function() {
      this.citizen = {
        surnames: null,
        names: null,
        year: null,
        number: null,
        genre: "M"
      },
      this.$set(this, 'extraData', {})
      this.makeExtraData()
      this.extraDataKeyNumber = 0
      this.response = {
        ok: false,
        replied: false,
        citizen: null
      };
      this.$nextTick().then(() => {
        this.$validator.reset();
        this.errors.clear();
      });
    },
    startVoting: function(){
      this.$emit('startVoting',this.response.citizen)
      this.restart()
    },
    addField: function(){
      let theField = {
        key: `campo${this.extraDataKeyNumber}`,
        value: null,
      }
      this.$set(this.extraData, `field_${this.extraDataKeyNumber}`, theField )
      this.extraDataKeyNumber++;
    },
    deleteField: function(index){
      let copy = Object.assign({},this.extraData)
      delete copy[index]
      this.$set(this, 'extraData', copy )
    },
    makePayload: function(){
      let thePayload = {
        number: this.citizen.number,
        fullname: `${this.citizen.names} ${this.citizen.surnames}`,
        year: this.citizen.year,
        genre: this.citizen.genre,
        data: {}
      }
      Object.keys(this.extraData).forEach(k => {
        thePayload.data[this.extraData[k]['key']] = this.extraData[k]['value']
      })
      return thePayload
    }
  },
  computed: {
    payloadMarking: function() {
      return {
        matricula: this.response.citizen.dni
      };
    }
  }
};
</script>

<style>
</style>
