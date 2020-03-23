<template>
  <section>
    <h1 class="title is-1">Datos básicos de la plataforma</h1>
    <BasicInfo :model.sync="model"/>
    <br />
    <SocialNetworks :model.sync="model" />
    <br>
    <h1 class="title is-1">Configuración del presupuesto</h1>
    <DistrictConfiguration :model.sync="model"/>
    <br>
    <BudgetConfiguration :model.sync="model"/>
    <br>
    <DateSettings :model.sync="model" />
    <hr />
    <h1 class="title is-2">Administrador</h1>
    <div class="content">
      <p>El primer usuario de la plataforma. Podra agregar nuevos administradores una vez de se hayan registrados como usuarios de la plataforma</p>
      <p>Tenga en cuenta que:</p>
      <ul>
        <li>No se enviará un email de verificación sobre su cuenta. La misma se encontrará validada luego de completar la instalación</li>
        <li>Podrá cambiar su contraseña una vez que la plataforma se encuentre completamente instalada</li>
      </ul>
    </div>
    <div class="notification is-warning">
      <p><i class="fas fa-exclamation-triangle"></i>&nbsp;Considere utilizar una cuenta institucional que no represente su cuenta personal. De esta forma, podrá hacer el registro en la plataforma para poder participar (en el caso de que usted quiera y pueda participar como un usuario mas de la plataforma).</p>

    </div>
    <div class="field">
      <label for class="label">Email del admin</label>
      <div class="control">
        <input
          type="text"
          class="input is-medium"
          v-model="model.admin.email"
          name="email"
          v-validate="'required|email'"
        />
      </div>
    </div>
    <div class="field">
      <label for class="label">Contraseña del Admin</label>
      <div class="control">
        <input
          type="password"
          v-model="model.admin.password"
          name="password"
          ref="password"
          v-validate="'required|min:6'"
          class="input is-medium"
          placeholder="Ingrese la contraseña"
        />
        <span class="help is-danger" v-show="errors.has('password')">
          <i class="fas fa-times-circle fa-fw"></i> Error. La contraseña no puede ser vacia, (Mínimo 6 caracteres)
        </span>
      </div>
    </div>
    <div class="field">
      <label class="label">Reescriba su contraseña *</label>
      <div class="control">
        <input
          type="password"
          v-model="model.admin.repeatPassword"
          name="re-password"
          v-validate="'required|confirmed:password'"
          class="input is-medium"
          placeholder="Vuelva a ingresar la contraseña"
        />
        <span class="help is-danger" v-show="errors.has('re-password')">
          <i class="fas fa-times-circle fa-fw"></i> Error. La contraseña no coincide
        </span>
      </div>
    </div>
    <hr />

    <div class="notification is-success" v-if="enableSubmitButton">
      <p>
        <i class="fas fa-check-circle"></i>&nbsp;¡Todo listo para comenzar tu presupuesto participativo!
      </p>
    </div>
    <div class="notification is-danger" v-else>
      <p>
        <i class="fas fa-times-circle"></i>&nbsp;Hay inconsistencias que deben ser atendidas para finalizar la instalación del presupuesto participativo.
      </p>
    </div>
    <div class="field" v-if=" !response.done">
      <div class="control">
        <div class="buttons">
          <button
            @click="submit"
            class="button is-large is-primary is-fullwidth"
            :class="{'is-loading': isLoading}"
            :disabled="!enableSubmitButton && !isLoading && !response.done"
          >¡Instalar mi presupuesto participativo!</button>
        </div>
      </div>
    </div>
    <b-message type="is-link" v-if="response.done && response.success">
      ¡Felicidades! ¡Ya instalaste tu presupuesto participativo! <a href="/"><i class="fa fa-arrow-right"></i>&nbsp;Ir a la pagina principal</a>
    </b-message>
    <b-message type="is-danger" v-if="response.done && response.error">
      <b>ERROR</b> - El servidor no pudo procesar la instalación y ocurrio un error. Por favor, contactar al administrador y verificar el logger.
    </b-message>
    <b-loading :active.sync="isLoading"></b-loading>
  </section>
</template>

<script>
import BasicInfo from './BasicInfo'
import SocialNetworks from './SocialNetworks'
import BudgetConfiguration from './BudgetConfiguration'
import DateSettings from './DateSettings'
import DistrictConfiguration from './DistrictConfiguration'

export default {
  components:{
    BasicInfo,
    SocialNetworks,
    BudgetConfiguration,
    DateSettings,
    DistrictConfiguration
  },
  data() {
    return {
      model: {
        budgetName: 'Mi gran presupuesto',
        budgetDescription: 'Maecenas posuere sem odio, eu molestie justo luctus sed. Quisque pulvinar, arcu ac posuere sodales, augue risus accumsan odio, eleifend tincidunt purus enim et lectus. Nullam blandit ac nisi ac bibendum. Proin libero ante, dignissim sit amet turpis a, pretium condimentum dolor. Suspendisse sit amet volutpat velit. In ut est ac erat euismod malesuada non id velit.',
        contactEmail: 'presupuesto@niceBudget.com',
        social: {
          web: 'guillecro.com',
          facebook: 'guillermocroppi',
          twitter: 'justZaqueo',
          instagram: 'guillermocroppi',
          youtube: null
        },
        admin: {
          email: 'admin@virtuagora.org',
          password: '123456',
          rePassword: '123456',
        },
        types: [{"id":"ambiental","name":"Ambiental", "fontawesome_icon": "fas fa-tree"},{"id":"seguridad","name":"Seguridad", "fontawesome_icon": "fas fa-shield-alt" },{"id":"economia-social","name":"Economia social", "fontawesome_icon": "fas fa-money-bill-alt"}],
        districts: ["Norte","Sur"],
        neighbourhoods: [{"name":"Pepe","district":0},{"name":"Cucuy","district":0},{"name":"Parito","district":1}],
        withPadron: true,
        voteMobile: true,
        voteRemote: true,
        votePhysical: true,
        voteInPlace: true,
        enableVotesPerBallot: false,
        votesPerBallot: null,
        enableVotesPerType: true,
        votesPerType: {"ambiental":3,"seguridad":5,"economia-social":1},
        proposalLaunchDate: new Date('2020-01-20 15:00:00'),
        proposalLaunchTime: new Date('2020-01-20 15:00:00'),
        proposalClosingDate: new Date('2020-03-20 15:00:00'),
        proposalClosingTime: new Date('2020-03-20 15:00:00'),
        votingLaunchDate: new Date('2020-06-01 15:00'),
        votingLaunchTime: new Date('2020-06-01 15:00'),
        votingClosingDate: new Date('2020-06-20 15:00'),
        votingClosingTime: new Date('2020-06-20 15:00'),
        enableBudget: false,
        enableDetailedBudget: false,
        budgetLimit: null,
        enableGoogleAnalytics: false,
        googleAnalyticsId: null,
        enableFacebookApp: false,
        facebookAppId: null,
      },
      isLoading: false,
      response: {
        done: false,
        success: false,
        error: false
      }
      // budgetName: null,
      // budgetDescription: null,
      // social: {
      //   web: null,
      //   facebook: null,
      //   twitter: null,
      //   instagram: null,
      //   youtube: null
      // },
      // input: {
      //   typeId: null,
      //   typeName: null,
      //   districtName: null,
      //   neighbourhoodName: null,
      //   neighbourhoodDistrict: null
      // },
      // admin: {
      //   email: null,
      //   password: null,
      //   rePassword: null,
      // },
      // types: [],
      // districts: [],
      // neighbourhoods: [],
      // withPadron: true,
      // voteMobile: true,
      // voteRemote: true,
      // votePhysical: true,
      // voteInPlace: true,
      // proposalLaunchDate: null,
      // proposalLaunchTime: null,
      // proposalClosingDate: null,
      // proposalClosingTime: null,
      // votingLaunchDate: null,
      // votingLaunchTime: null,
      // votingClosingDate: null,
      // votingClosingTime: null,
      // enableBudgetLimit: false,
      // budgetLimit: null,
      // isLoading: false,
      // response: {
      //   done: false,
      //   success: false,
      //   error: false
      // }
    };
  },
  methods: {
    makePayload: function(){
      return {
        budgetName: this.model.budgetName,
        budgetDescription: this.model.budgetDescription,
        contactEmail: this.model.contactEmail,
        social: this.model.social,
        admin: this.model.admin,
        types: this.model.types,
        districts: this.model.districts,
        neighbourhoods: this.model.neighbourhoods,
        withPadron: this.model.withPadron,
        voteMobile: this.model.voteMobile,
        voteRemote: this.model.voteRemote,
        votePhysical: this.model.votePhysical,
        voteInPlace: this.model.voteInPlace,
        enableVotesPerBallot: this.model.enableVotesPerBallot,
        votesPerBallot: this.model.enableVotesPerBallot ? this.model.votesPerBallot : null,
        enableVotesPerType: this.model.enableVotesPerType,
        votesPerType: this.model.enableVotesPerType ? this.model.votesPerType : null,
        proposalLaunchDatetime: this.proposalLaunchDatetime,
        proposalClosingDatetime: this.proposalClosingDatetime,
        votingLaunchDatetime: this.votingLaunchDatetime,
        votingClosingDatetime: this.votingClosingDatetime,
        enableBudget: this.model.enableBudget,
        enableDetailedBudget: this.model.enableBudget ? this.model.enableDetailedBudget : false,
        budgetLimit: this.model.enableBudget ? this.model.budgetLimit : null,
        enableGoogleAnalytics: this.model.enableGoogleAnalytics,
        googleAnalyticsId: this.model.enableGoogleAnalytics ? this.model.googleAnalyticsId : null,
        enableFacebookApp: this.model.enableFacebookApp,
        facebookAppId: this.model.enableFacebookApp ? this.model.facebookAppId : null,
        projectFields: {
          "problem": {
            "type": "string",
            "name": "Definición de la situación problemática ",
            "description": "¿Cual es la problematica que atiende el proyecto?. Tenes un máximo de 1500 caracteres ",
            "minLength": 1,
            "maxLength": 2000
          },
          "benefit_population": {
            "type": "string",
            "name": "Beneficio a la comunidad",
            "description": "El beneficio que se le esta dando a la comunidad con este proyecto",
            "minLength": 1,
            "maxLength": 2000
          },
          "community_contributions": {
            "name": "Contribucion a la comunidad",
            "description": "Como este proyecto contribuye al futuro,",
            "minLength": 1,
            "maxLength": 2000
          },
          "private_field":{
            "name": "Campo muy privado!",
            "description": "Shhh este campo solo va a ser visible por el autor y por el admin. Nadie mas podra verlo!",
            "minLength": 1,
            "maxLength": 300
          }
        },
        projectFieldsRequired: ['problem','benefit_population','community_contributions'],
        projectFieldsPrivate: ['private_field'],
        projectFieldsLayout: {"problem":{"input": "textarea"},"benefit_population":{"input": "input"},"community_contributions":{"input": "textarea"}}
      }
    },
    submit: function() {
      this.isLoading = true;
      let thePayload = this.makePayload()
      console.log(thePayload)
      this.$http.post('/installer', thePayload)
      .then( res => {
        console.log(res.data)
        this.response.success = true
      })
      .catch( err => {
        console.error(err)
        this.response.error = true
      })
      .finally( () => {
        this.response.done = true
        this.isLoading = false  
      })
    }
  },
  computed: {
    cantVoteRemote: function() {
      //
      return this.model.voteRemote && !this.model.withPadron;
    },
    proposalLaunchDatetime: function() {
      if (!this.hasProposalLaunchDatetime) return null;
      return `${this.model.proposalLaunchDate.toISOString().split("T")[0]} ${this.model.proposalLaunchTime.toTimeString().split(" ")[0]}`
    },
    proposalClosingDatetime: function() {
      if (!this.hasVotingClosingDatetime) return null;
      return `${this.model.proposalClosingDate.toISOString().split("T")[0]} ${this.model.proposalClosingTime.toTimeString().split(" ")[0]}`
    },
    votingLaunchDatetime: function() {
      if (!this.hasVotingLaunchDatetime) return null;
      return `${this.model.votingLaunchDate.toISOString().split("T")[0]} ${this.model.votingLaunchTime.toTimeString().split(" ")[0]}`
    },
    votingClosingDatetime: function() {
      if (!this.hasVotingClosingDatetime) return null;
      return `${this.model.votingClosingDate.toISOString().split("T")[0]} ${this.model.votingClosingTime.toTimeString().split(" ")[0]}`
    },
    hasProposalLaunchDatetime: function() {
      return this.model.proposalLaunchDate && this.model.proposalLaunchTime;
    },
    hasProposalClosingDatetime: function() {
      return this.model.proposalClosingDate && this.model.proposalClosingTime;
    },
    hasVotingLaunchDatetime: function() {
      return this.model.votingLaunchDate && this.model.votingLaunchTime;
    },
    hasVotingClosingDatetime: function() {
      return this.model.votingClosingDate && this.model.votingClosingTime;
    },
    /**
     * Incoherence #1
     * You cannot vote remotely if there budget is without a "padron"
     *
     * false means that the conditions is OK. Good to submit
     */
    incoherenceVoteRemoteAndNoPadron: function() {
      if (this.model.voteRemote && !this.model.withPadron) return true;
      return false;
    },
    /**
     * Incoherence #2
     * At least one voting method has to be enabled
     *
     */
    incoherenceAtLeastOneVotingMethod: function() {
      return !(
        this.model.voteMobile ||
        this.model.voteRemote ||
        this.model.votePhysical ||
        this.model.voteInPlace
      );
    },
    /**
     * Incoherence #3
     * At least one District
     */
    incoherenceAtLeastOneDistrict: function() {
      return this.model.districts.length == 0;
    },
    /**
     * Incoherence #4
     * At least one Neighbourhood per district
     */
    incoherenceAtLeastOneNeighbourhoodPerDistrict: function() {
      if (this.model.districts.length == 0) return true;
      if (this.model.neighbourhoods.length == 0) return true;
      let countNeighbourhoodsPerDistrict = {};
      this.model.districts.forEach((d, index) => {
        countNeighbourhoodsPerDistrict[index] = 0;
      });
      this.model.neighbourhoods.forEach(n => {
        countNeighbourhoodsPerDistrict[n.district] += 1;
      });
      let quantityPerNeighbourhood = Object.values(
        countNeighbourhoodsPerDistrict
      );
      return !quantityPerNeighbourhood.every(q => {
        return q > 0;
      });
    },
    enableSubmitButton: function() {
      if (
        this.hasProposalLaunchDatetime &&
        this.hasProposalClosingDatetime &&
        this.hasVotingLaunchDatetime &&
        this.hasVotingClosingDatetime &&
        !this.incoherenceVoteRemoteAndNoPadron &&
        !this.incoherenceAtLeastOneVotingMethod &&
        !this.incoherenceAtLeastOneDistrict &&
        !this.incoherenceAtLeastOneNeighbourhoodPerDistrict
      )
        return true;
      return false;
    }
  },
};
</script>
