// Base Components
import Vue from 'vue'
import Buefy from 'buefy'
import http from './http'
import router from './router'
import store from './store'
import es from 'vee-validate/dist/locale/es';
import VeeValidate, { Validator } from 'vee-validate';
import VueMasonry from 'vue-masonry-css'

Validator.localize('es',es);

Vue.use(VeeValidate,{
  locale: 'es'
});
Vue.use(VueMasonry);

// Ingenia 2018 Componentes
import VueCarousel from 'vue-carousel';
import Avatar from './utils/Avatar';
import ProjectJournal from './utils/ProjectJournal';
import Budget from './utils/Budget';
import FormImage from './utils/FormImage';
import FormFile from './utils/FormFile';
import PublicStamp from './utils/PublicStamp';
import Login from './auth/Login'
import CompletarRegistro from './auth/CompletarRegistro'
import CompletarResetPassword from './auth/CompletarResetPassword'
import ProjectCarousel from './carousel/ProjectCarousel'
import Exhibit from './carousel/Exhibit'
import Catalogo from './carousel/Catalogo'
import AdminAssignAdmin from './admin/AssignAdmin'
import AdminListProjects from './admin/project/ListProjects'
import AdminCreateProject from './admin/project/CreateProject'
import AdminEditProject from './admin/project/EditProject'
import AdminEditProjectUser from './admin/project/EditProjectUser'
import AdminEditProjectFeasibility from './admin/project/EditProjectFeasibility'
import AdminStamp from './admin/Stamp'
import Boletas from './admin/Boletas'
import VotesChart from './admin/stats/VotesChart'
import GenreDonut from './admin/stats/GenreDonut'
import PendingSender from './admin/PendingSender'
import PendingVoterSender from './admin/PendingVoterSender'
// import SyncPadron from './admin/SyncPadron'
import SyncPadron from './admin/padron/Sync'
import AddCitizen from './admin/padron/AddCitizen'
import PageblockCreate from './admin/pageblocks/Create'
import PageblockEdit from './admin/pageblocks/Edit'
import PageblockUploadImage from './admin/pageblocks/UploadImage'
import Settings from './admin/Settings'
import CountdownTo from './utils/CountdownTo'
import CountdownClosing from './utils/CountdownClosing'
import CalendarIndex from './utils/CalendarIndex'
import PrivateVote from './private-vote/PrivateVote'
import PublicVote from './public-vote/PublicVote'
import StatLines from './stats/StatLines'
import StatBars from './stats/StatBars'
import StatStackedBars from './stats/StatStackedBars'
import UserPanelListProjects from './panel/ListProjects'
import UserPanelCreateProject from './panel/CreateProject'
import UserPanelEditProject from './panel/EditProject'
import UserPanelEditPassword from './panel/EditPassword'

Vue.use(VueCarousel)

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

Vue.mixin(require('./globals'))

window.vm = new Vue({ // eslint-disable-line no-new
  el: '#vue', // The id of the DOM element,
  http,
  router,
  store,
  components: {
    Avatar,
    Login,
    CompletarRegistro,
    CompletarResetPassword,
    ProjectCarousel,
    AdminAssignAdmin,
    AdminListProjects,
    AdminCreateProject,
    AdminEditProject,
    AdminEditProjectUser,
    AdminEditProjectFeasibility,
    AdminStamp,
    PageblockCreate,
    PageblockEdit,
    PageblockUploadImage,
    PublicStamp,
    ProjectJournal,
    Budget,
    FormImage,
    FormFile,
    UserPanelListProjects,
    UserPanelCreateProject,
    UserPanelEditProject,
    UserPanelEditPassword,
    SyncPadron,
    AddCitizen,
    CountdownTo,
    CountdownClosing,
    PublicVote,
    PrivateVote,
    Settings,
    Exhibit,
    CalendarIndex,
    Catalogo,
    PendingSender,
    PendingVoterSender,
    VotesChart,
    GenreDonut,
    Boletas,
    StatLines,
    StatBars,
    StatStackedBars
  },
})