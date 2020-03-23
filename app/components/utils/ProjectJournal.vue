<template>
  <section>
    <div class="timeline">
      <header class="timeline-header">
        <span class="tag is-medium is-primary">Creación</span>
      </header>
      <div class="timeline-item" v-for="(j,index) in project.journal" :key="index">
        <div class="timeline-marker is-icon">
          <i class="fas fa-edit"></i>
        </div>
        <div class="timeline-content is-fullwidth">
          <p class="heading">Editado el dia {{getDate(index)}}</p>
          <p class="heading">Editó: {{ getUser(j.author_id) }}</p>
          <br>
          <b-collapse class="card" :open="false">
            <div slot="trigger" slot-scope="props" class="card-header" role="button">
              <p class="card-header-title">Ver información previa a la edición</p>
              <a class="card-header-icon">
                <i :class="props.open ? 'fas fa-angle-up fa-lg' : 'fas fa-angle-down fa-lg'"></i>
              </a>
            </div>
            <div class="card-content">
              <div class="content">
                <p class="title is-6">Título</p>
                <p class="is-size-7">{{j.title}}</p>
              </div>
              <div class="content">
                <p class="title is-6">Objetivo</p>
                <p class="is-size-7">{{j.objective}}</p>
              </div>
              <div class="content" v-for="(value,field,index2) in j.field_values" :key="index2">
                <p class="title is-6">{{projectFields.fields[field].name}}&nbsp;&nbsp;<span class="tag is-primary" v-if="projectFields.private.includes(field)">Privado</span></p>
                <p class="is-size-7">{{value || '- Sin completar -'}}</p>
              </div>
              <div class="content">
                <p class="title is-6">Monto total del presupuesto</p>
                <p>$ {{j.budget_total}}</p>
              </div>
            </div>
          </b-collapse>
          <b-collapse class="card" :open="false" v-if="j.budget">
            <div slot="trigger" slot-scope="props" class="card-header" role="button">
              <p class="card-header-title">Presupuesto detallado</p>
              <a class="card-header-icon">
                <i :class="props.open ? 'fas fa-angle-down fa-lg' : 'fas fa-angle-up fa-lg'"></i>
              </a>
            </div>
            <div class="card-content">
              <table class="table is-narrow is-fullwidth">
                <thead>
                  <tr>
                    <th class="is-size-7">Descripción</th>
                    <th class="is-size-7 has-text-centered">Monto</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(b,index3) in j.budget" :key="index3">
                    <td class="is-size-7">{{b.description}}</td>
                    <td class="is-size-7 has-text-centered">$ {{b.amount}}</td>
                  </tr>
                  <tr>
                    <td class="is-size-7 has-text-right">Monto total:</td>
                    <td class="is-size-7 has-text-centered">
                      <b>$ {{montoTotal(b)}}</b>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </b-collapse>
        </div>
      </div>
       <div class="timeline-item">
        <div class="timeline-marker is-primary"></div>
        <div class="timeline-content">
          <p class="heading">Hasta el dia de hoy</p>
          <p><a :href="`/proyectos/${project.id}`"><i class="fas fa-arrow-right fa-lg"></i>&nbsp;Ver la última versión</a></p>
        </div>
        </div>
      <div class="timeline-header">
        <span class="tag is-medium is-primary">Presente</span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  props: ["project","projectFields","users"],
  data() {
    return {};
  },
  created: function() {},
  mounted: function() {},
  methods: {
    montoTotal: function(b) {
      const reducer = (accumulator, item) =>
        accumulator + parseFloat(item.amount);
      return b.reduce(reducer, 0);
    },
    getUser: function(userId){
      if(this.users[userId].roles.includes('admin')){
        return 'Administrador '
      } else {
        return 'Responsable del proyecto'
      }
    },
    getDate: function(UNIX_timestamp) {
      let a = new Date(UNIX_timestamp * 1000);
      let months = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
      ];
      let year = a.getFullYear();
      let month = months[a.getMonth()];
      let date = a.getDate();
      let hour = a.getHours();
      let min = a.getMinutes();
      let sec = a.getSeconds();
      let time =
        date + " " + month + " " + year + " - " + hour + ":" + min;
      return time;
    }
  },
  computed: {}
};
</script>

<style lang="scss" scoped>
.timeline-content{
  width: 100%;
}
</style>

