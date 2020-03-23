// Base Components
import Vue from 'vue'
import Buefy from 'buefy'
import http from './http'
// import router from './installer/router'
// import store from './store'
import es from 'vee-validate/dist/locale/es';
import VeeValidate, { Validator } from 'vee-validate';
import VueMasonry from 'vue-masonry-css'

Validator.localize('es',es);

Vue.use(VeeValidate,{
  locale: 'es'
});
Vue.use(VueMasonry);

import Installer from './installer/Installer'

// We are going to use Buefy
Vue.use(Buefy, {
  defaultIconPack: 'fas',
  defaultDialogConfirmText: 'OK',
  defaultDialogCancelText: 'Cancelar',
  defaultDayNames: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
  defaultMonthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
})

// Axios configuration
// go to http.js to configure axios according to your needs
Vue.prototype.$http = http

window.vm = new Vue({ // eslint-disable-line no-new
  el: '#vue', // The id of the DOM element,
  http,
  // router,
  // store,
  components: {
    Installer,
  },
  // beforeCreate: function () {
  //   store.dispatch('prepareData', window.getUserId()).then(response => {
  //     // response => true if the user state expired.
  //     if(response){
  //     this.updateState()
  //     }
  //   })
  // }
})