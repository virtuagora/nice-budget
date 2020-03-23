<template>
  <section>
      <b-message type="is-primary">
        <h1 class="title is-4"><i class="fas fa-file-invoice-dollar"></i>&nbsp;Presupuesto</h1>
      </b-message>
     <b-notification type="is-warning" v-if="budgetLimit">
        <b><i class="fas fa-exclamation-triangle"></i>&nbsp;IMPORTANTE: El limite a presupuestar {{budgetLimit}}</b>
      </b-notification>
      <div class="content">
        <p :class="{'has-text-danger': errors.has('budget')}"><b><i class="fas fa-caret-right"></i>&nbsp; Items del presupuesto</b></p>
        <p>A modo de supuestos, ingrese cada item del presupuesto que presenta el proyecto. Escriba la descripción del mismo y el monto en pesos (sin centavos)</p>
      </div>
      <h1 class="title is-4" :class="{'has-text-danger': errors.has('budget')}">
          <i class="fas fa-caret-right"></i>&nbsp; Items del presupuesto
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
        v-model="budget"
        data-vv-name="budget"
        data-vv-as="'Presupuesto'"
        v-validate="'required'"
      >
      <b-table 
        :data="budget"
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
       <span v-show="errors.has('budget')" class="help is-danger">
        <i class="fas fa-times-circle fa-fw"></i>
        &nbsp;{{errors.first('budget')}}
      </span>
      <br>
      <div class="notification is-link">
        <h1 class="subtitle is-5">Monto total del presupuesto ingresado: <span class="is-700"> $ {{montoTotal}}</span></h1>
      </div>
  </section>
</template>

<script>
export default {
  props: ['budgetLimit','editable'],
  data(){
    return {
    inputItemDescripcion: null,
    inputItemMonto: null,
    budget: []
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
                this.budgetLimit &&
                (parseFloat(this.inputItemMonto) + this.montoTotal >
                this.budgetLimit)
              ) {
                this.$buefy.snackbar.open(
                  "El item excede el total permitido ($" + this.budgetLimit + ")"
                );
                return;
              }
              this.budget.push({
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
      this.budget.splice(index, 1);
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
    },
    getValue: function(){
      return this.budget
    }
  },
  computed: {
    montoTotal: function() {
      const reducer = (accumulator, item) =>
        accumulator + parseFloat(item.amount);
      return this.budget.reduce(reducer, 0);
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
}
</script>

<style>

</style>