<template>
<section>
  <b-table :data="projects">
    <template slot-scope="props">
      <b-table-column field="name" label="Proyecto">
        <div>
        <p class="is-size-6 is-300"><b><a :href="`/proyectos/${props.row.id}`" class="has-text-link">{{props.row.title}}</a></b></p>
        <p class="is-size-7" v-if="props.row.organization_name">Organzación: <b>{{props.row.organization_name}}</b></p>
        <p class="is-size-7">Presenta:&nbsp;<b-tooltip position="is-left" multilined label="El responsable se encuentra registrado en la plataforma"  v-if="props.row.author_id"><i class="fas fa-user fa-fw has-text-link"></i></b-tooltip><b>{{props.row.author_names}} {{props.row.author_surnames}}</b></p>
        <span class="tag is-link" v-if="props.row.code">{{props.row.code}}</span>
        </div>
      </b-table-column>
      <b-table-column label="Información" width="200">
        <div>
        <p class="is-size-7">Presupuesto&nbsp;<i class="fas fa-dollar-sign"></i>&nbsp;<b>{{props.row.budget_total}}</b></p>             
        <p class="is-size-7"><i :class="`${props.row.category.fontawesome_icon}`"></i>&nbsp;{{props.row.category.name}}</p>
        <p class="is-size-7">Distrito: {{props.row.district.name}}</p>
        </div>
      </b-table-column>
      <b-table-column label="Acciones" width="150">
        <p v-if="editAvailable"><a :href="`/panel/proyectos/${props.row.id}/editar`" class="button is-link is-inverted is-small"><i class="fas fa-edit fa-lg fa-fw"></i>&nbsp;Editar proyecto</a></p>
        <b-dropdown aria-role="list" position="is-bottom-left" >
          <p class="button is-link is-inverted is-small" slot="trigger">
              Otras acciones&nbsp;<i class="fas fa-caret-down fa-lg"></i>
          </p>
          <b-dropdown-item has-link v-if="editAvailable
          "><a :href="`/panel/proyectos/${props.row.id}/archivos`" class="has-text-link is-size-7"><i class="fas fa-upload fa-lg fa-fw"></i>&nbsp;Subir archivos</a></b-dropdown-item>
          <b-dropdown-item has-link v-if="editAvailable
          "><a :href="`/panel/proyectos/${props.row.id}/imagen`" class="has-text-link is-size-7"><i class="fas fa-image fa-lg fa-fw"></i>&nbsp;Cargar una portada</a></b-dropdown-item>
          <b-dropdown-item has-link><a :href="`/panel/proyectos/${props.row.id}/bitacora`" class="has-text-link is-size-7"><i class="fas fa-history fa-lg fa-fw"></i>&nbsp;Ver bicatora</a></b-dropdown-item>
        </b-dropdown>
      </b-table-column>
    </template>
    <template slot="empty">
      <section class="section">
        <div class="content has-text-grey has-text-centered">
            <p><i class="far fa-sad-cry fa-2x"></i></p>
            <p>No cargaste ninguna propuesta</p>
          </div>
      </section>
    </template>
  </b-table>
</section>
</template>

<script>
import { debounce } from "lodash";

export default {
  props: ["projects","url","editAvailable"],
  data() {
    return {};
  },
  methods: {
  },
  computed: {
  },
  watch: {
  }
};

</script>

<style>
</style>
