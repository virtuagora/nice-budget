<template>
  <section>
    <b-message type="is-primary">
     <h1 class="title is-4"><i class="fas fa-list"></i>&nbsp;Información del proyecto</h1>
    </b-message>
    <div class="field" v-for="(field,index) in theFields" :key="`${index}`">
      <label class="label" :class="{'has-text-danger': errors.has(`field-${index}`)}">{{field.name}}<span v-show="isPrivate(index)" class="is-size-7 is-300 has-text-danger">&nbsp;* Privado</span><span v-show="isRequired(index)" class="is-size-7 is-300 has-text-link">&nbsp;* Requerido</span></label>
      <div class="content">
        <p><i>{{field.description}}</i></p>
      </div>
      <div class="control">
        <b-input
          v-model="values[index]"
          :data-vv-name="`field-${index}`"
          :data-vv-as="`${field.name}`"
          v-validate="getRules(field,index)"
          :type="fieldsLayout[index]['input']"
          rows="3"
          :placeholder="isRequired(index) ? 'Requerido' : 'Opcional'"
        ></b-input>
        <span v-show="errors.has(`field-${index}`)" class="help is-danger">
          <i class="fas fa-times-circle fa-fw"></i>
          &nbsp;{{errors.first(`field-${index}`)}}
        </span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ['project', 'projectFields', 'editable'],
  data(){
    return {
      values: {}
    }
  },
  created: function(){
    if(this.project.field_values){
      Object.keys(this.theFields).forEach(k => {
      this.values[k] = this.project.field_values[k]
    })
    } else {
    Object.keys(this.theFields).forEach(k => {
      this.values[k] = null
    })
    }
  },
  methods:{
    getValues: function(){
      return this.values
    },
    getRules: function(theField,key){
      let rules = {}
      if(this.isRequired(key)) rules.required = true
      if(theField.minLength) rules.min = theField.minLength
      if(theField.maxLength) rules.max = theField.maxLength
      return rules
    },
    isRequired: function(key){
      return this.requiredFields.includes(key)
    },
    isPrivate: function(key){
      return this.privateFields.includes(key)
    },
    validateForm: function() {
      let promise = new Promise((resolve, reject) => {
        this.$validator.validateAll().then(result => {
          if (!result) {
            console.log(
              "Custom Fields: Hay errores en los datos. Reviselos antes de guardar los campos"
            );
            return resolve(result);
          }
          console.log("Custom Fields: OK");
          return resolve(result);
        });
      });
      return promise;
    }
  },
  computed:{
    theFields: function(){
      return this.projectFields.fields
    },
    requiredFields: function(){
      return this.projectFields.required
    },
    privateFields: function(){
      return this.projectFields.private
    },
    fieldsLayout: function(){
      return this.projectFields.layout
    }
  }
}
</script>

<style>

</style>