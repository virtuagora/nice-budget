<template>
    <p v-if="(new Date(date)) > (new Date())">Faltan
      <i class="fas fa-clock"></i> {{days}} días, {{hours}}:{{minutes}}:{{seconds}}</p>
    <p v-else>
      Faltan <i class="fas fa-clock"></i> 00 días, 00:00:00
    </p>
</template>

<script>
export default {
  props: ['date'],
  data() {
    return {
      now: Math.trunc(new Date().getTime() / 1000),
      dateDeadline: new Date(this.date),
      deadline: Math.trunc((new Date(this.date)).getTime() / 1000),
      options: {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "numeric",
        minute: "numeric",
        second: "numeric",
        hour12: false
      },
      idInterval: null,
    };
  },
  beforeDestroy: function(){
    clearInterval(this.idInterval)
  },
  mounted: function() {
    this.idInterval = setInterval(() => {
      this.now = Math.trunc(new Date().getTime() / 1000);
    }, 1000);
  },
  methods: {
    twoDigits: function(value) {
      if (value.toString().length <= 1) {
        return "0" + value.toString();
      }
      return value.toString();
    }
  },
  computed: {
    seconds() {
      return this.twoDigits((this.deadline - this.now) % 60);
    },
    minutes() {
      return this.twoDigits(Math.trunc((this.deadline - this.now) / 60) % 60);
    },
    hours() {
      return this.twoDigits(
        Math.trunc((this.deadline - this.now) / 60 / 60) % 24
      );
    },
    days() {
      return this.twoDigits(
        Math.trunc((this.deadline - this.now) / 60 / 60 / 24)
      );
    }
  }
};
</script>

<style lang="scss" scoped>
section{
  margin-bottom:10px; 
}
</style>
