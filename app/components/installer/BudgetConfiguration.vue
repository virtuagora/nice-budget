<template>
  <section>
    <h1 class="subtitle is-4 has-text-primary">Tipos de proyectos</h1>
    <div class="content">
      <p>Ingrese los tipos de proyectos de la plataforma.</p>
      <p>A la hora de la votación, puede definir que tipos de proyecto pueden crear los ciudadanos</p>
      <p>
        El
        <code>identificador</code> es un identificador que se guarda en base de datos para filtrar, no es visible, salvo en las planillas para exportar la información. Mantenga este valor corto y consciso
      </p>
      <p>Ejemplo:</p>
      <ul>
        <li>
          Nombre:
          <b>Ambiental</b> // Identificador:
          <code>ambiental</code>
        </li>
        <li>
          Nombre:
          <b>Seguridad</b> // Identificador:
          <code>seguridad</code>
        </li>
        <li>
          Nombre:
          <b>Economia social</b> // Identificador:
          <code>economia-social</code>
        </li>
      </ul>
    </div>
    <div class="box">
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input class="input" v-model="typeName" type="text" placeholder="Nombre del tipo" />
        </p>
        <p class="control is-expanded">
          <input class="input" v-model="typeId" type="text" placeholder="Identificador del tipo" />
        </p>
        <p class="control">
          <button @click="addType" class="button is-info">
            <i class="fas fa-plus"></i>
          </button>
        </p>
      </div>
    </div>
    <table class="table is-fullwidth is-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Identificador</th>
          <th class="has-text-centered" width="50px">
            <i class="fas fa-trash fa-lg"></i>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(type,i) in model.types" :key="type.id">
          <td>{{type.name}}</td>
          <td>
            <code>{{type.id}}</code>
          </td>
          <td class="has-text-centered">
            <a @click="removeType(i)">
              <i class="fas fa-times-circle fa-lg"></i>
            </a>
          </td>
        </tr>
        <tr v-if="model.types.length == 0">
          <td colspan="3">
            <div class="section has-text-centered has-text-danger">
              <p>
                <i class="fas fa-times-circle"></i>&nbsp;Debe ingresar al menos un tipo de proyecto
              </p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <h1 class="subtitle is-4 has-text-primary">Padrón de ciudadanos</h1>
    <div class="content">
      <p>Determine si la plataforma utilizará padron o no para habilitar el voto</p>
      <p>
        <b>Tenga en cuenta</b> las descripciones de cada una
      </p>
      <ul>
        <li>
          <b>Con padrón:</b> Se puede verificar que el usuario que se registro es ciudadano / parte del padrón, lo que lo habilitaria a poder votar.
          <b>Tenga en cuenta</b> que solamente con padrón se habilitan las opciones de voto remoto digital, voto en el celular.
        </li>
        <li>
          <b>Sin pádron:</b> En este caso, la verificacion de la identidad del usuario se tiene que hacer de forma presencial in-situ a la hora de hacer la votación. Esta opcion no habilita el voto remoto, el voto por celular.
        </li>
      </ul>
    </div>
    <div class="box">
      <b-radio
        v-model="model.withPadron"
        :native-value="true"
      >Con padron de ciudadanos habilitados para votar</b-radio>
    </div>
    <div class="box">
      <b-radio v-model="model.withPadron" :native-value="false">Sin padrón de ciudadanos</b-radio>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Mecanicas de participación</h1>
    <div class="content">
      <p>Elija las mecánicas habilitadas para la participación</p>
    </div>
    <div class="columns">
      <div class="column">
        <div class="box">
          <h1 class="title is-5 has-text-primary">Votación Web</h1>
          <div class="content is-small">
            <p>
              Modo que permite que el ciudadano (usuario verificado
              <b>contra padrón</b>) pueda votar desde la comodidad de su casa, cuando la vocación se encuentra disponible.
            </p>
            <p>
              <b>Consideraciones:</b>
            </p>
            <ul>
              <li>Padrón subido al sistema</li>
              <li>Usuario registrado y verificado contra el padrón</li>
            </ul>
          </div>
          <div class="field">
            <div class="control">
              <b-checkbox
                v-model="model.voteRemote"
                size="is-medium"
                :disabled="!model.withPadron"
              >Habilitar modo</b-checkbox>
            </div>
          </div>
          <div class="field" v-if="!model.withPadron">
            <div class="control">
              <p
                class="help is-danger"
              >El modo de votación WEB no se encuentra disponible si no se cuenta con un padron de ciudadanos habilitados para votar</p>
            </div>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="box">
          <h1 class="title is-5 has-text-primary">Votación Mobile</h1>
          <div class="content is-small">
            <p class="is-size-7">
              Se envia por
              <i class="fab fa-whatsapp"></i> WhatsApp un link donde la persona puede entrar y votar.
            </p>
            <p>
              <b>Consideraciones:</b>
            </p>
            <ul>
              <li>El padron de ciudadanos es OPCIONAL</li>
              <li>Se requiere que el oficial de mesa de votación tenga un celular, un lector de QR, y una cuenta de WhatsApp</li>
              <li>Se requiere que el ciudadano tenga un celular con WhatsApp</li>
            </ul>
          </div>
          <div class="field">
            <div class="control">
              <b-checkbox v-model="model.voteMobile" size="is-medium">Habilitar modo</b-checkbox>
            </div>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="box">
          <h1 class="title is-5 has-text-primary">Votación Tablet</h1>
          <div class="content is-small">
            <p
              class="is-size-7"
            >De forma presencial, se le provee una tablet a la persona. Se asigna un código para comenzar el proceso de votación. Ese código una vez usado, no puede volver a usarlo.</p>
            <p>
              <b>Consideraciones:</b>
            </p>
            <ul>
              <li>El padron de ciudadanos es OPCIONAL</li>
              <li>Se requiere que la mesa de votación tenga una tablet con conexion a internet y explorador web (Google Chrome o Firefox)</li>
            </ul>
          </div>
          <div class="field">
            <div class="control">
              <b-checkbox v-model="model.votePhysical" size="is-medium">Habilitar modo</b-checkbox>
            </div>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="box">
          <h1 class="title is-5 has-text-primary">Votación Presencial</h1>
          <div class="content is-small">
            <p
              class="is-size-7"
            >De forma presencial, se le provee una tablet a la persona. Se asigna un código para comenzar el proceso de votación. Ese código una vez usado, no puede volver a usarlo.</p>
            <p>
              <b>Consideraciones:</b>
            </p>
            <ul>
              <li>El padron de ciudadanos es OPCIONAL</li>
              <li>Se requiere que la mesa de votación cuente con una urna cerrada y boletas impresas. Considere todas las necesidades de una votacion anónima y secreta.</li>
            </ul>
          </div>
          <div class="field">
            <div class="control">
              <b-checkbox v-model="model.voteInPlace" size="is-medium">Habilitar modo</b-checkbox>
            </div>
          </div>
        </div>
      </div>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Formato de la votación</h1>
    <div class="content">
      <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Temporibus ipsam consequatur animi eius, eligendi incidunt. Tempora, ipsam error dolorum natus cumque, quo deleniti exercitationem amet eius, maxime iusto reiciendis accusantium.</p>
    </div>
    <div class="box">
      <b-radio v-model="model.enableVotesPerBallot" :native-value="true">
        <b>Votos en general</b>: Se establece un numero de votos que el usuario puede votar, de 0 a N, y puede elegir cualquier tipo de proyecto, sin limitarlos por categoria/tipo.
      </b-radio>
    </div>
    <div class="box" v-if="model.enableVotesPerBallot">
      <b-field>
        <p class="control">
          <button class="button is-static">Cantidad de votos</button>
        </p>
        <b-numberinput v-model="model.votesPerBallot" expanded controlsPosition="compact" min="1" />
      </b-field>
    </div>
    <div class="box">
      <b-radio v-model="model.enableVotesPerType" :native-value="true">
        <b>Votos por tipo de proyecto</b>: Se establece un numero de votos disponibles 0..N por proyecto. Se establece cuantos votos por proyecto se peuden elegir.
      </b-radio>
    </div>
    <div class="box" v-if="model.enableVotesPerType">
      <table class="table is-fullwidth is-bordered">
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="type in model.types" :key="type.id">
            <td>{{type.name}}</td>
            <td>
              <b-numberinput
                v-model="model.votesPerType[type.id]"
                expanded
                controlsPosition="compact"
                min="1"
              />
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <b>Total de votos</b>
              - {{totalVotes}} votos
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Presupuesto detallado</h1>
    <div class="content">
      <p>Si habilita la opción, le puede conceder a los ciudadanos subir un presupuesto detallando el costo por item.</p>
    </div>
    <div class="field">
      <div class="control">
        <b-checkbox
          v-model="model.enableBudget"
          size="is-medium"
        >Habilitar presupuestado </b-checkbox>
      </div>
    </div>
    <div class="field has-addons" v-if="model.enableBudget">
      <div class="control">
        <a class="button is-static is-medium">
          <i class="fas fa-dollar-sign"></i>
        </a>
      </div>
      <div class="control is-expanded">
        <input
          type="text"
          v-model="model.budgetLimit"
          class="input is-medium"
          data-vv-name="limitePresupuesto"
          data-vv-as="'Limite de Presupuesto'"
          v-validate="'required|integer|min_value:10'"
          placeholder="Ingrese un valor, sin decimales"
        />
        <span class="help is-danger" v-show="errors.has('limitePresupuesto')">
          <i class="fas fa-times-circle fa-fw"></i>
          {{errors.first('limitePresupuesto')}}
        </span>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      typeId: null,
      typeName: null
    };
  },
  props: {
    model: {
      type: Object,
      required: true
    }
  },
  methods: {
    addType: function() {
      this.model.types.push({
        id: this.typeId,
        name: this.typeName
      });
      this.typeId = null;
      this.typeName = null;
    },
    removeType: function(i) {
      this.model.types.splice(i, 1);
    }
  },
  computed: {
    totalVotes: function() {
      const accumulateArray = (accumulator, currentValue) =>
        accumulator + currentValue;
      if (!this.model.enableVotesPerType) return 0;
      return Object.values(this.model.votesPerType).reduce(accumulateArray);
    }
  },
  watch: {
    "model.withPadron": function(newVal, oldVal) {
      if (!newVal) this.model.voteRemote = false;
    },
    "model.enableVotesPerBallot": function(newVal, oldVal) {
      if (!newVal) return;
      this.model.votesPerBallot = 1;
      this.model.votesPerType = null;
      this.model.enableVotesPerType = false;
    },
    "model.types": function(newVal, oldVal) {
      if (!this.model.enableVotesPerType) return;
      let auxTypes = {};
      this.model.types.forEach(t => {
        auxTypes[t.id] = 1;
      });
      this.model.votesPerType = auxTypes;
    },
    "model.enableVotesPerType": function(newVal, oldVal) {
      if (!newVal) return;
      this.model.enableVotesPerBallot = false;
      this.model.votesPerBallot = null;
      let auxTypes = {};
      this.model.types.forEach(t => {
        auxTypes[t.id] = 1;
      });
      this.model.votesPerType = auxTypes;
    }
  }
};
</script>