<template>
<section>
  <b-table :data="projects" detail-key="id">
    <template slot-scope="props">
      <b-table-column field="id" label="ID" width="40" numeric sortable>
      {{ props.row.id }}
      </b-table-column>
      <b-table-column field="name" label="Proyecto" sortable>
        <div>

        <p class="is-size-6 is-300"><b><a :href="`/proyectos/${props.row.id}`" class="has-text-link">{{props.row.title}}</a></b></p>
        <p class="is-size-7" v-if="props.row.organization_name">Organzación: <b>{{props.row.organization_name}}</b></p>
        <p class="is-size-7">Presenta:&nbsp;<b-tooltip position="is-left" multilined label="El responsable se encuentra registrado en la plataforma"  v-if="props.row.author_id"><i class="fas fa-user fa-fw has-text-link"></i></b-tooltip><b>{{props.row.author_names}} {{props.row.author_surnames}}</b></p>
        <span class="tag is-link" v-if="props.row.code">{{props.row.code}}</span>
        </div>
      </b-table-column>

      <b-table-column label="Tipo" width="150">
        <div>
        <p class="is-size-7"><i :class="`${props.row.category.fontawesome_icon}`"></i>&nbsp;{{props.row.category.name}}</p>
        <p class="is-size-7">Distrito: {{props.row.district.name}}</p>
        </div>
      </b-table-column>
      <b-table-column label="Info" width="200">
        <div>
        <p class="is-size-7">Presupuesto&nbsp;<i class="fas fa-dollar-sign"></i>&nbsp;<b>{{props.row.budget_total}}</b></p>       
        <p class="is-size-7" v-if="props.row.admin_notes == null"><i class="fas fa-times fa-lg fa-fw"></i>&nbsp;Sin observaciones</p>       
        <p class="is-size-7" v-else><i class="far fa-sticky-note fa-lg fa-fw"></i>&nbsp;Hay observaciones hechas</p>       
        <p class="is-size-7" v-if="props.row.feasible === null"><i class="far fa-clock fa-lg fa-fw"></i>&nbsp;Aun sin evaluar</p>       
        <p class="is-size-7 has-text-danger" v-if="props.row.feasible === false"><i class="fas fa-times fa-lg fa-fw"></i>&nbsp;<b>No factible</b></p>       
        <p class="is-size-7 has-text-success" v-if="props.row.feasible === true"><i class="fas fa-clipboard-check fa-lg fa-fw"></i>&nbsp;<b>Factible</b></p>       
        </div>
      </b-table-column>
      <b-table-column label="Acciones">
        <div>
        <p><a :href="`/admin/proyectos/${props.row.id}/editar`" class="button is-link is-inverted is-small"><i class="fas fa-edit fa-lg fa-fw"></i>&nbsp;Editar proyecto</a></p>
        <b-dropdown aria-role="list" position="is-bottom-left" >
            <p class="button is-link is-inverted is-small" slot="trigger">
                Otras acciones&nbsp;<i class="fas fa-caret-down fa-lg"></i>
            </p>
            <b-dropdown-item has-link><a :href="`/admin/proyectos/${props.row.id}/usuario`" class="has-text-link is-size-7"><i class="fas fa-user-edit fa-lg fa-fw"></i>&nbsp;Vincular usuario</a></b-dropdown-item>
            <b-dropdown-item has-link><a :href="`/admin/proyectos/${props.row.id}/archivos`" class="has-text-link is-size-7"><i class="fas fa-upload fa-lg fa-fw"></i>&nbsp;Subir archivos</a></b-dropdown-item>
            <b-dropdown-item has-link><a :href="`/admin/proyectos/${props.row.id}/imagen`" class="has-text-link is-size-7"><i class="fas fa-image fa-lg fa-fw"></i>&nbsp;Cargar una portada</a></b-dropdown-item>
            <b-dropdown-item has-link><a :href="`/admin/proyectos/${props.row.id}/factibilidad`" class="has-text-link is-size-7"><i class="fas fa-clipboard-check fa-lg fa-fw"></i>&nbsp;Factibilidad</a></b-dropdown-item>
            <b-dropdown-item has-link><a :href="`/admin/proyectos/${props.row.id}/bitacora`" class="has-text-link is-size-7"><i class="fas fa-history fa-lg fa-fw"></i>&nbsp;Ver bitacora</a></b-dropdown-item>
        </b-dropdown>
        </div>
      </b-table-column>
    </template>
    <template slot="empty">
      <section class="section">
        <div class="content has-text-grey has-text-centered">
            <p><i class="far fa-sad-cry fa-2x"></i></p>
            <p>No se han cargado proyectos</p>
          </div>
      </section>
    </template>
  </b-table>
</section>
</template>

<script>
import { debounce } from "lodash";

export default {
  props: ["projects","url","editable",],
  data() {
    return {
        listing: this.projects,
        // search: ''
    };
  },
  methods: {
    // filterRows: debounce(function(){
    //   this.isLoading = true;
    //       this.$http
    //         .get(this.urlGet)
    //         .then(response => {
    //           this.showResults = true;
    //           this.isLoading = false;
    //           this.listing = response.data;
    //         })
    //         .catch(error => {
    //           this.isLoading = false;
    //           console.error(error);
    //           this.$buefy.snackbar.open({
    //             message: "Ocurrio un error inesperado. Recargue la página",
    //             type: "is-danger",
    //             actionText: "Ok"
    //           });
    //         });
    // }, 500),
    // // getSearchedRow: function() {
    //   return this.model.data.filter(row => {
    //     let value = row[this.query.search_column];
    //     for (var key in row) {
    //       if (String(row[key]).indexOf(this.query.search_input) !== -1) {
    //         // Return true required to populate table
    //         if (this.query.search_column.length < 1) {
    //           return true;
    //         }

    //         // when condition gets here, The table shows 0 records
    //         if (this.query.search_operator == "less_than") {
    //           return value < this.query.search_input;
    //         }
    //       }
    //     }
    //   });
    // },
    capitalizeFirstLetter: function(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }
  },
  computed: {
    // urlGet: function() {
    //   let query = [];
    //   if (this.search) {
    //     query.push("s=" + this.search);
    //     query.push("size=100");
    //   }
    //   // query.push("size=" + 7);
    //   return this.url.concat(query.length > 0 ? "?" : "", query.join("&"));
    // },
  },
  watch: {
    // search: function(newVal, oldVal){
    //   if(this.search.length > 0){
    //     this.filterRows();
    //   } else {
    //     this.listing = this.projects
    //   }
    // }
  }
};

</script>

<style>
</style>
