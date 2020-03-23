<template>
<section>
   <h1 class="subtitle is-4 has-text-primary">Comienzo de la subida de propuestas</h1>
    <div class="content">
      <p>Fecha y hora que se abre el formulario para la subida de proyectos</p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Día de apertura
          </label>
          <b-datepicker
            v-model="model.proposalLaunchDate"
            placeholder="Click para elegir..."
            icon="calendar"
            size="is-medium"
            :mobile-native="false"
            :date-formatter="(date) => date.toLocaleDateString('es-AR')"
          ></b-datepicker>
        </div>
      </div>
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Hora de apertura
          </label>
          <b-timepicker
            v-model="model.proposalLaunchTime"
            size="is-medium"
            placeholder="Click para elegir..."
            icon="clock"
          ></b-timepicker>
        </div>
      </div>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Fecha de cierre de la subida de propuestas</h1>
    <div class="content">
      <p>Fecha y hora que se cierra el formulario para la subida de proyectos</p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Día de cierre
          </label>
          <b-datepicker
            v-model="model.proposalClosingDate"
            placeholder="Click para elegir..."
            icon="calendar"
            size="is-medium"
            :mobile-native="false"
            :date-formatter="(date) => date.toLocaleDateString('es-AR')"
          ></b-datepicker>
        </div>
      </div>
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Hora de cierre
          </label>
          <b-timepicker
            v-model="model.proposalClosingTime"
            size="is-medium"
            placeholder="Click para elegir..."
            icon="clock"
          ></b-timepicker>
        </div>
      </div>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Comienzo de la votación</h1>
    <div class="content">
      <p>Fecha y hora que se abre la votación</p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Día de apertura
          </label>
          <b-datepicker
            v-model="model.votingLaunchDate"
            placeholder="Click para elegir..."
            icon="calendar"
            size="is-medium"
            :mobile-native="false"
            :date-formatter="(date) => date.toLocaleDateString('es-AR')"
          ></b-datepicker>
        </div>
      </div>
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Hora de apertura
          </label>
          <b-timepicker
            v-model="model.votingLaunchTime"
            size="is-medium"
            placeholder="Click para elegir..."
            icon="clock"
          ></b-timepicker>
        </div>
      </div>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Cierre de la votación</h1>
    <div class="content">
      <p>Fecha y hora que se cierra la votación</p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Día de cierre
          </label>
          <b-datepicker
            v-model="model.votingClosingDate"
            placeholder="Click para elegir..."
            icon="calendar"
            size="is-medium"
            :mobile-native="false"
            :date-formatter="(date) => date.toLocaleDateString('es-AR')"
          ></b-datepicker>
        </div>
      </div>
      <div class="column">
        <div class="field">
          <label class="label is-size-5">
            <i class="fas fa-angle-double-right"></i>&nbsp;Hora de cierre
          </label>
          <b-timepicker
            v-model="model.votingClosingTime"
            size="is-medium"
            placeholder="Click para elegir..."
            icon="clock"
          ></b-timepicker>
        </div>
      </div>
    </div>
</section>
</template>

<script>
export default {
  props: {
    model: {
      type: Object,
      required: true
    }
  },
}
</script>