<template>
  <section>
    <div class="message is-black" v-if="showFilters">
      <div class="message-body">
        <h1 class="title is-4">Filtros de busqueda</h1>
      <div class="field">
        <label class="label">Nombre del proyecto</label>
        <div class="control">
          <div class="field has-addons">
            <p class="control is-expanded has-icons-left">
              <input
                v-model="nameToSearch"
                class="input is-medium"
                placeholder="Escriba aqui el nombre..."
                type="text"
              />
              <span class="icon is-left">
                <i class="fas fa-chevron-right"></i>
              </span>
            </p>
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="column">
          <b-field expanded label="Estado del proyecto">
            <b-select
              v-model="statusSelected"
              expanded
              :disabled="forceWinners || forceFeasible || forceUnfeasible || forceProposals "
            >
              <option :value="null">Cualquier estado</option>
              <option value="selected" v-if="!hideSelectedFilter">🏅 Seleccionados</option>
              <option value="feasible" v-if="!hideFeasibleFilter">✔️ Factibles</option>
              <option value="unfeasible" v-if="!hideUnfeasibleFilter">❌ No factibles</option>
              <option value="proposals" v-if="!hideProposalFilter">📝 Propuestas</option>
            </b-select>
          </b-field>
        </div>
        <div class="column">
          <b-field expanded label="Categoria">
            <b-select
              v-model="categorySelected"
              :disabled="forceCategory"
              expanded
            >
              <option :value="null">Todas las categorias</option>
              <option
                :value="category.key"
                v-for="category in categories"
                :key="category.id"
              >{{category.name}}</option>
            </b-select>
          </b-field>
        </div>
        <div class="column">
          <b-field expanded label="Distrito">
            <b-select
              v-model="districtSelected"
              :disabled="forceDistrict"
              expanded
            >
              <option :value="null">Todos los distritos</option>
              <option
                :value="district.id"
                v-for="district in districts"
                :key="district.id"
              >{{district.name}}</option>
            </b-select>
          </b-field>
        </div>
      </div>
      <div class="buttons is-centered">
        <a @click="search()" class="button is-primary">
          <i class="fas fa-search fa-fw"></i>&nbsp;Buscar
        </a>
        <a @click="cleanFilters()" class="button is-dark is-outlined">
          <i class="fas fa-eraser fa-fw"></i>&nbsp;Borrar filtros
        </a>
      </div>
      </div>
    </div>
    <masonry :cols="{default: 5,1344: 4, 1152: 3, 960: 2, 769: 1}" :gutter="{default: '10px'}">
      <div class="item-mosaic" v-for="project in projects" :key="project.id">
        <div
          class="catalog-project"
          :class="{'has-image-background': project.picture_name}"
          :style="getStyle(project)"
        >
          <div class="icon-category">
            <i :class="`${project.category.fontawesome_icon} fa-2x`"></i>
          </div>
          <div class="box-content" :class="{'with-image': project.picture_name}">
            <div class="to-bottom">
              <div class="field is-grouped is-grouped-multiline">
                <div class="control">
                  <div class="tags has-addons">
                    <span class="tag is-dark">
                      <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <span class="tag is-white">{{project.district.name}}</span>
                  </div>
                </div>
                <div class="control" v-if="showFeasibility">
                  <div class="tags has-addons">
                    <span class="tag is-dark" v-if="project.feasible == false">
                      <i class="fas fa-times has-text-danger"></i>
                    </span>
                    <span class="tag is-dark" v-else-if="project.selected == true && showWinners">
                      <i class="fas fa-star has-text-warning"></i>
                    </span>
                    <span class="tag is-dark" v-else-if="project.feasible == true">
                      <i class="fas fa-check has-text-success"></i>
                    </span>
                    <span class="tag is-dark" v-else>
                      <i class="fas fa-question-circle"></i>
                    </span>
                    <span class="tag is-danger" v-if="project.feasible == false">No factible</span>
                    <span
                      class="tag is-warning"
                      v-else-if="project.selected == true && showWinners"
                    >¡Seleccionado!</span>
                    <span class="tag is-success" v-else-if="project.feasible == true">Factible</span>
                    <span class="tag is-white" v-else>No evaluado</span>
                  </div>
                </div>
              </div>
              <a :href="'/proyectos/'+project.id" target="_blank">
                <h1 class="title is-4 is-500 is-marginless">{{project.title}}</h1>
                <p class="has-text-white">
                  Por
                  <span class="is-600">{{getWho(project)}}</span>
                  - {{getShortDescription(project.objective,100)}}
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </masonry>

    <!-- <div v-masonry transition-duration="1s" item-selector=".item-mosaic" :gutter="10">
      <div v-masonry-tile class="item-mosaic" v-for="project in projects" :key="project.id">
        <div class="catalog-project"  :class="{'has-image-background': project.picture_name}" :style="getStyle(project)">
          <div class="icon-category">
            <i :class="`${project.category.fontawesome_icon} fa-2x`"></i>
          </div>
            <div class="box-content" :class="{'with-image': project.picture_name}">
              <div class="to-bottom">
                <div class="field is-grouped is-grouped-multiline">
                  <div class="control">
                    <div class="tags has-addons">
                    <span class="tag is-dark">
                      <i class="fas fa-map-marker-alt"></i>
                    </span>
                    <span class="tag is-white">{{project.district.name}}</span>
                  </div>
                  </div>
                  <div class="control" v-if="showFeasibility">
                    <div class="tags has-addons">
                      <span class="tag is-dark" v-if="project.feasible == false">
                        <i class="fas fa-times has-text-danger"></i>
                      </span>
                      <span class="tag is-dark" v-else-if="project.selected == true && showWinners">
                        <i class="fas fa-star has-text-warning"></i>
                      </span>
                      <span class="tag is-dark" v-else-if="project.feasible == true">
                        <i class="fas fa-check has-text-success"></i>
                      </span>
                      <span class="tag is-dark" v-else>
                        <i class="fas fa-question-circle"></i>
                      </span>
                      <span class="tag is-danger" v-if="project.feasible == false">No factible</span>
                      <span class="tag is-warning" v-else-if="project.selected == true && showWinners">¡Seleccionado!</span>
                      <span class="tag is-success" v-else-if="project.feasible == true">Factible</span>
                      <span class="tag is-white" v-else>No evaluado</span>
                    </div>
                  </div>
                </div>
                <h1 class="title is-4 is-500 is-marginless">{{project.title}}</h1>
            <p>
              Por
              <span class="is-600">{{getWho(project)}}</span>
              - {{getShortDescription(project.objective,100)}}
            </p>
              </div>
            </div>
    </div>-->
    <!-- <div
          class="catalog-item"
        >
          <img
            :src="'/assets/img/icons/medal-' + project.type + '.svg'"
            class="ribbon"
            alt
            v-if="project.selected && forceWinners"
          >
           <div class="icon-category">
            <i :class="`${project.category.fontawesome_icon} fa-2x`"></i>
          </div>
          <a :href="'/proyectos/'+project.id" target="_blank" style="text-decoration:none;">
            <div class="field is-grouped is-grouped-multiline">
              <div class="control">
                <div class="tags has-addons">
                  <span class="tag is-dark">
                    <i class="fas fa-map-marker-alt"></i>
                  </span>
                  <span class="tag is-white">{{project.district.name}}</span>
                </div>
              </div>
              <div class="control" v-if="showFeasibility">
                <div class="tags has-addons">
                  <span class="tag is-dark" v-if="project.feasible == false">
                    <i class="fas fa-times has-text-danger"></i>
                  </span>
                  <span class="tag is-dark" v-else-if="project.selected == true && showWinners">
                    <i class="fas fa-star has-text-warning"></i>
                  </span>
                  <span class="tag is-dark" v-else-if="project.feasible == true">
                    <i class="fas fa-check has-text-success"></i>
                  </span>
                  <span class="tag is-dark" v-else>
                    <i class="fas fa-question-circle"></i>
                  </span>
                  <span class="tag is-danger" v-if="project.feasible == false">No factible</span>
                  <span class="tag is-warning" v-else-if="project.selected == true && showWinners">¡Seleccionado!</span>
                  <span class="tag is-success" v-else-if="project.feasible == true">Factible</span>
                  <span class="tag is-white" v-else>No evaluado</span>
                </div>
              </div>
            </div>
            <h1 class="title is-4 is-500 is-marginless">{{project.title}}</h1>
            <p>
              Por
              <span class="is-600">{{getWho(project)}}</span>
              - {{getShortDescription(project.objective,250)}}
            </p>
          </a>
    </div>-->
    <!-- </div> -->
    <!-- </div> -->
    <br />
    <infinite-loading @infinite="infiniteHandler" ref="infiniteLoading">
      <span slot="no-results">
        <i class="fas fa-info-circle"></i> Fin de los resultados
      </span>
      <span slot="no-more">
        <i class="fas fa-info-circle"></i> ¡Fín de la lista!
      </span>
    </infinite-loading>
  </section>
</template>

<script>
import InfiniteLoading from "vue-infinite-loading";

export default {
  props: {
    url: {
      type: String,
      required: true
    },
    showFilters: {
      type: Boolean,
      default: true
    },
    forceWinners: {
      type: Boolean
    },
    forceFeasible: {
      type: Boolean
    },
    forceUnfeasible: {
      type: Boolean
    },
    forceProposals: {
      type: Boolean
    },
    forceDistrict: {
      type: Number
    },
    forceCategory: {
      type: String
    },
    random: {
      type: Boolean,
      default: false
    },
    hideSelectedFilter: {
      type: Boolean,
      default: false
    },
    hideFeasibleFilter: {
      type: Boolean,
      default: false
    },
    hideUnfeasibleFilter: {
      type: Boolean,
      default: false
    },
    hideProposalFilter: {
      type: Boolean,
      default: false
    },
    showFeasibility: {
      type: Boolean,
      default: false
    },
    showWinners: {
      type: Boolean,
      default: false
    },
    categories: {
      type: Array
    },
    districts: {
      type: Array
    }
  },
  components: {
    InfiniteLoading
  },
  data() {
    return {
      isLoading: false,
      projects: [],
      paginator: {
        current_page: null,
        last_page: null,
        next_page_url: null,
        prev_page_url: null
      },
      nameToSearch: "",
      statusSelected: null,
      categorySelected: null,
      districtSelected: null
    };
  },
  created: function() {
    if (this.forceWinners) {
      this.statusSelected = "selected";
    }
    if (this.forceFeasible) {
      this.statusSelected = "feasible";
    }
    if (this.forceUnfeasible) {
      this.statusSelected = "unfeasible";
    }
    if (this.forceProposals) {
      this.statusSelected = "proposals";
    }
    if (this.forceCategory) {
      this.categorySelected = this.forceCategory;
    }
    if (this.forceDistrict) {
      this.districtSelected = this.forceDistrict;
    }
  },
  mounted: function() {},
  methods: {
    getWho(project) {
      if(project.organization_name) return `${project.organization_name} (Org.)`
      return project.author_names + " " + project.author_surnames;
    },
    cleanFilters: function() {
      this.statusSelected = null;
      this.districtSelected = null;
      this.categorySelected = null;
      this.nameToSearch = "";
      this.projects = [];
      this.paginator.current_page = null;
      this.paginator.last_page = null;
      this.paginator.next_page_url = null;
      this.paginator.prev_page_url = null;
      this.$nextTick(() => {
        // this.$redrawVueMasonry();
        this.$refs.infiniteLoading.$emit("$InfiniteLoading:reset");
      });
    },
    resetEverything: function() {
      this.projects = [];
      this.paginator.current_page = null;
      this.paginator.last_page = null;
      this.paginator.next_page_url = null;
      this.paginator.prev_page_url = null;
      this.$nextTick(() => {
        // this.$redrawVueMasonry();
        this.$refs.infiniteLoading.$emit("$InfiniteLoading:reset");
      });
    },
    search: function() {
      this.resetEverything();
    },
    getStyle: function(project) {
      if (project.picture_name) {
        return `background-image: url("/proyectos/${project.id}/imagen")`;
      }
      return null;
    },
    getShortDescription: function(text, limit) {
      if (text.length > limit) {
        for (let i = limit; i > 0; i--) {
          if (
            text.charAt(i) === " " &&
            (text.charAt(i - 1) != "," ||
              text.charAt(i - 1) != "." ||
              text.charAt(i - 1) != ";")
          ) {
            return text.substring(0, i) + "...";
          }
        }
      } else {
        return text;
      }
    },
    shuffleArray: function(arr) {
      return arr
        .map(a => [Math.random(), a])
        .sort((a, b) => a[0] - b[0])
        .map(a => a[1]);
    },
    fillPaginator: function(data) {
      this.paginator.current_page = data.current_page;
      this.paginator.last_page = data.last_page;
      this.paginator.next_page_url = data.next_page_url;
      this.paginator.prev_page_url = data.prev_page_url;
    },
    infiniteHandler: function($state) {
      if (this.paginator.current_page == null) {
        this.$http
          .get(this.urlGet)
          .then(response => {
            if (response.data.data === undefined)
              throw { message: "Error en query" };
            this.projects = this.projects.concat(
              this.shuffleArray(response.data.data)
            );
            // this.$redrawVueMasonry();
            this.fillPaginator(response.data);
            $state.loaded();
          })
          .catch(error => {
            console.error(error.message);
            this.$buefy.snackbar.open({
              message: "Error al obtener la lista de proyectos",
              type: "is-danger",
              actionText: "Cerrar"
            });
            $state.complete();
          });
      } else if (this.paginator.next_page_url) {
        this.$http
          .get(this.paginator.next_page_url)
          .then(response => {
            if (response.data.data === undefined)
              throw { message: "Error en query" };
            this.projects = this.projects.concat(
              this.shuffleArray(response.data.data)
            );
            // this.$redrawVueMasonry();
            this.fillPaginator(response.data);
            $state.loaded();
          })
          .catch(error => {
            console.error(error.message);
            this.$buefy.snackbar.open({
              message: "Error al obtener la lista de proyectos",
              type: "is-danger",
              actionText: "Cerrar"
            });
            $state.complete();
          });
      } else {
        $state.complete();
      }
    }
  },
  watch: {
    selectedFilter: function(newVal, oldVal) {
      this.resetEverything();
    }
  },
  computed: {
    urlGet: function() {
      let query = [];
      if (this.random) {
        query.push("random=1");
      }
      if (this.nameToSearch !== "") {
        query.push("s=" + this.nameToSearch);
      }
      if (this.statusSelected == "selected" || this.forceWinners == true) {
        query.push(`selected=1`);
      }
      if (this.statusSelected == "feasible" || this.forceFeasible == true) {
        query.push(`feasible=1`);
      }
      if (this.statusSelected == "unfeasible" || this.forceUnfeasible == true) {
        query.push(`feasible=0`);
      }
      if (this.statusSelected == "proposals" || this.forceProposals == true) {
        query.push(`proposals=1`);
      }
      if (this.categorySelected !== null) {
        query.push("type=" + this.categorySelected);
      }
      if (this.districtSelected !== null) {
        query.push("district=" + this.districtSelected);
      }
      return this.url.concat(query.length > 0 ? "?" : "", query.join("&"));
    }
  }
};
</script>

<style lang="scss" scoped>
.name-search {
  background-color: transparent;
  border: 0;
  border-radius: 0;
  border-bottom: 1px solid #5a5a5a;
}

.delete-padding-touch {
  @media screen and (max-width: 769px) {
    padding-bottom: 0;
  }
}
</style>
