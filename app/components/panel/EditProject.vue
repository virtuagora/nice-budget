<template>
  <section>
    <default-fields ref="defaultFields" :project.sync="project" :categories="categories" :districts="districts" :editable="editable"></default-fields>
    <br>
    <project-fields ref="projectFields" :project.sync="project" :project-fields="projectFields" :editable="editable"></project-fields>
    <br>
    <div v-if="projectFields.enable_budget">
      <budget-builder v-if="projectFields.enabled_detailed_budget"  ref="budget" :budget-limit="projectFields.budget_limit" :editable="editable"></budget-builder>
      <budget-simple v-else ref="budget" :project.sync="project" :budget-limit="projectFields.budget_limit" :editable="editable"></budget-simple>
    </div>
    <hr>
    <button
      class="button is-primary is-large is-fullwidth"
      @click="submit"
      v-if="!response.replied && editable"
    >
      <i class="fas fa-save fa-fw"></i>&nbsp;Editar
    </button>
    <div class="notification is-warning" v-if="!editable">
      <i class="fas fa-exclamation-triangle fa-fw"></i>&nbsp; <b>¡El proyecto ya no es editable!</b>
    </div>
    <div class="message is-success" v-show="response.replied && response.ok">
      <div class="message-body">
        <i class="fas fa-check fa-fw"></i>&nbsp;
        <b>¡Bien!</b> ¡El proyecto ha sido editado correctamente!
      </div>
    </div>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
  </section>
</template>


<script>
import DefaultFields from "../utils/project/DefaultFields";
import ProjectFields from "../utils/project/ProjectFields";
import BudgetSimple from "../utils/project/BudgetSimple";
import BudgetBuilder from "../utils/project/BudgetBuilder";

export default {
  props: ["formUrl", 'notesUrl', 'categories', 'districts', 'projectFields', 'existingProject', 'editable'],
  components: {
    DefaultFields,
    ProjectFields,
    BudgetSimple,
    BudgetBuilder
  },
  data() {
    return {
      isLoading: false,
      project: {
        author: null,
        author_names: null,
        author_surnames: null,
        author_phone: null,
        author_email: null,
        author_dni: null,
        organization_name: null,
        organization_address: null,
        title: null,
        category_id: null,
        district_id: null,
        objective: null,
        budget: [],
        budget_total: null,
        admin_notes: null,
        field_values: {},
      },
      response: {
        replied: false,
        ok: false
      } 
    };
  },
  beforeMount: function() {
    this.project.code = this.existingProject.code;
    this.project.title = this.existingProject.title;
    this.project.category_id = this.existingProject.category_id;
    this.project.district_id = this.existingProject.district_id;
    this.project.objective = this.existingProject.objective;
    this.project.budget = this.existingProject.budget;
    this.project.budget_total = this.existingProject.budget_total;
    this.project.author = this.existingProject.author;
    this.project.author_names = this.existingProject.author_names;
    this.project.author_surnames = this.existingProject.author_surnames;
    this.project.author_phone = this.existingProject.author_phone;
    this.project.author_email = this.existingProject.author_email;
    this.project.author_dni = this.existingProject.author_dni;
    this.project.organization_name = this.existingProject.organization_name;
    this.project.organization_address = this.existingProject.organization_address;
    this.project.field_values = this.existingProject.field_values;
    this.project.admin_notes = this.existingProject.admin_notes;
  },
  methods: {
    checkEverythingIsTrue: function(arr){
      return arr.every(v => v === true);
    },
    makePayload: function(){
      let payload = {
        author_names: this.project.author_names,
        author_surnames: this.project.author_surnames,
        author_dni: this.project.author_dni,
        author_email: this.project.author_email,
        author_phone: this.isOptional(this.project.author_phone),
        organization_name: this.isOptional(this.project.organization_name),
        organization_address: this.isOptional(this.project.organization_address),
        title: this.project.title,
        category_id: this.project.category_id,
        district_id: this.project.district_id,
        objective: this.project.objective,
      }
      payload.field_values = this.$refs.projectFields.getValues()
      if(this.projectFields.enable_budget){
        if(this.projectFields.enabled_detailed_budget){
          payload.budget = this.$refs.budget.getValue()
        } else {
          payload.budget_total = this.project.budget_total
        }
      }
      return payload
    },
    submit: function() {
      this.isLoading = true
      let formsToValidate = [
        this.$refs.defaultFields.validateForm(),
        this.$refs.projectFields.validateForm(),
      ]
      if(this.projectFields.enable_budget){
        formsToValidate.push(this.$refs.budget.validateForm())
      }
      Promise.all(formsToValidate).
      then(responses => {
        if(!this.checkEverythingIsTrue(responses)){
          this.isLoading = false;
          this.$buefy.snackbar.open({
            message: "Faltan datos o algunos campos son incorrectos. Verifíquelos.",
            type: "is-danger",
            actionText: "Cerrar",
          });
          return;
        } else {
          // Valid
          console.log("Sending form");
          this.isLoading = true;
          let payload = this.makePayload()
          this.$http
            .post(this.formUrl, payload)
            .then(response => {
              this.$buefy.snackbar.open({
                message: "¡Proyecto guardado!",
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
      })
      .catch( error => {
          this.isLoading = false;
          console.error(error.message);
          this.$buefy.snackbar.open({
            message: "Error inesperado",
            type: "is-danger",
            actionText: "Cerrar",
            indefinite: true
          });
      })
    },
  }
};
</script>