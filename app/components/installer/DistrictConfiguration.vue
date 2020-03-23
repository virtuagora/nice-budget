<template>
  <section>
        <h1 class="subtitle is-4 has-text-primary">Distritos</h1>
    <div class="content">
      <p>
        Los distritos son conglomerados de los
        <b>Barrios</b> (Los barrios se completan mas abajo)
      </p>
      <p>En el momento de creacion de un proyecto, se define tambien a que distrito afecta.</p>
      <ul>
        <li>
          <b>¿Puedo poner un barrio en dos distritos?</b> Si, pero recomendamos no hacerlo para no confundir a los usuarios de la plataforma cuando creen proyectos
        </li>
        <li>
          <b>¿Que puedo hacer si no me interesa que los barrios esten agrupados en distritos?</b> Como es un requerimiento para la plataforma, puede definir un solo distrito que contenga todos los barrios. El nombre puede ser la misma region que agrupa todos los barrios
        </li>
      </ul>
      <div class="box">
        <div class="field is-grouped">
          <p class="control is-expanded">
            <input
              class="input"
              v-model="districtName"
              type="text"
              placeholder="Nombre del distrito"
            />
          </p>
          <p class="control">
            <button @click="addDistrict" class="button is-info">
              <i class="fas fa-plus"></i>
            </button>
          </p>
        </div>
      </div>
    </div>
    <table class="table is-fullwidth is-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th class="has-text-centered" width="50px">
            <i class="fas fa-trash fa-lg"></i>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(district,i) in model.districts" :key="`${district}${i}`">
          <td>{{district}}</td>
          <td class="has-text-centered">
            <a @click="removeDistrict(i)">
              <i class="fas fa-times-circle fa-lg"></i>
            </a>
          </td>
        </tr>
        <tr v-if="model.districts.length == 0">
          <td colspan="2">
            <div class="section has-text-centered has-text-danger">
              <p>
                <i class="fas fa-times-circle"></i>&nbsp;Debe ingresar al menos un distrito
              </p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <h1 class="subtitle is-4 has-text-primary">Barrios</h1>
    <div class="content">
      <p>Ingrese los barrios. Los mismos se utilizan a modo estadistico para saber donde se englomeran los usuarios mas activos.</p>
      <p>
        Escriba el nombre del barrio y elija su
        <b>Distrito</b>.
      </p>
      <p>
        <b>NOTA:</b> Los distritos deben haber sido definidos en la sección anterior.
      </p>
      <div class="box">
        <div class="field is-grouped">
          <div class="control is-expanded">
            <input
              class="input"
              v-model="model.neighbourhoodName"
              type="text"
              placeholder="Nombre del distrito"
            />
          </div>
          <div class="control is-expanded">
            <div class="select is-fullwidth">
              <select name v-model="model.neighbourhoodDistrict">
                <option :value="i" v-for="(district,i) in model.districts" :key="district">{{district}}</option>
              </select>
            </div>
          </div>
          <div class="control">
            <button @click="addNeighbourhood" class="button is-info">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <table class="table is-fullwidth is-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Distrito</th>
          <th class="has-text-centered" width="50px">
            <i class="fas fa-trash fa-lg"></i>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(neighbourhood,i) in model.neighbourhoods" :key="`${neighbourhood.name}${neighbourhood.district}${i}`">
          <td>{{neighbourhood.name}}</td>
          <td>{{model.districts[neighbourhood.district]}}</td>
          <td class="has-text-centered">
            <a @click="removeNeighbourhood(i)">
              <i class="fas fa-times-circle fa-lg"></i>
            </a>
          </td>
        </tr>
        <tr v-if="model.districts.length == 0">
          <td colspan="3">
            <div class="section has-text-centered has-text-danger">
              <p>
                <i class="fas fa-times-circle"></i>&nbsp;Debe ingresar al menos un barrio
              </p>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script>
export default {
  data(){
    return {
      districtName: null,
      neighbourhoodName: null,
      neighbourhoodDistrict: null,
    }
  },
  props: {
    model: {
      type: Object,
      required: true
      }
  },
  methods: {
    addDistrict: function() {
      this.districts.push(this.districtName);
      this.districtName = null;
    },
    addNeighbourhood: function() {
      this.model.neighbourhoods.push({
        name: this.neighbourhoodName,
        district: this.neighbourhoodDistrict
      });
      this.neighbourhoodName = null;
      this.neighbourhoodDistrict = null;
    },
    removeDistrict: function(i) {
      this.model.districts.splice(i, 1);
    },
    removeNeighbourhood: function(i) {
      this.model.neighbourhoods.splice(i, 1);
    },
  }
}
</script>