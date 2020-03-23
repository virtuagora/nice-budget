<template>
  <section>
    <b-message type="is-primary">
        <h1 class="title is-4"><i class="fas fa-file-invoice-dollar"></i>&nbsp;Presupuesto</h1>
      </b-message>
     <b-notification type="is-warning" v-if="budgetLimit">
        <b><i class="fas fa-exclamation-triangle"></i>&nbsp;IMPORTANTE: El limite a presupuestar {{budgetLimit}}</b>
      </b-notification>
    <div class="field">
      <label for="" class="label" :class="{'has-text-danger': errors.has('budget_total')}">Total del monto a presupuestar <span class="is-size-7 is-300 has-text-link">* Requerido</span></label>
      <div class="content">
        <p><i>Escriba el total del monto en pesos (sin centavos)</i></p>
      </div>
      <div class="field has-addons">
      <p class="control">
          <a class="button is-static">
            <i class="fas fa-dollar-sign"></i>
          </a>
        </p>
      <div class="control is-expanded">
        <input
          v-model.number="project.budget_total"
          data-vv-name="budget_total"
          data-vv-as="'Monto a presupuestar'"
          type="text"
          v-validate="getRules()"
          class="input"
          placeholder="Requerido *"
        >
      </div>
      </div>
        <span v-show="errors.has('budget_total')" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first('budget_total')}}
        </span>
    </div>
  </section>
</template>

<script>
export default {
  props: ['project','budgetLimit'],
  methods: {
    getRules: function(){
      let rules = {
        required: true,
        min_value: 1
      }
      if(this.budgetLimit) rules.max_value = this.budgetLimit
      return rules
    },
    validateForm: function() {
      let promise = new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          if (!result) {
            console.log(
              "Budget: Hay errores en los datos. Reviselos antes de guardar los campos"
            );
            return resolve(result);
          }
          console.log("Budget: OK");
          return resolve(result);
        });
      });
      return promise;
    }
  }
}
</script>

<style>

</style>