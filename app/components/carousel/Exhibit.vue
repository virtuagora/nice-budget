<template>
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
      <div class="item-mosaic" v-if="showMore">
        <div class="notification is-primary and-more">
            <a href="/catalogo" style="text-decoration: none;">
              <img src="/assets/img/icons/w-agreement.svg" style="height:70px; vertical-align:top" alt="">
              <h1 class="title is-3">¡Conocelos a todos!</h1>
              <h1 class="subtitle is-5">¡Hay un monton de propuestas y proyectos para descubrir en el cátalogo! ¡Conocelos!</h1>
          </a>
        </div>
      </div>
    </masonry>
  
    <!-- <div v-masonry-tile class="item-mosaic" v-if="!showMore">
      <div class="notification is-primary and-more">
            <a href="/catalogo" style="text-decoration: none;">
              <h1 class="title is-1 is-marginless">
                <i class="fas fa-book-reader"></i>
              </h1>
              <h1 class="title is-2">¡Y mucho más!</h1>
              <h1 class="subtitle is-5">¡Ingresá al catálogo para ver mas proyectos que participan!</h1>
          </a>
      </div>
    </div> -->
</template>

<script>
export default {
  props: {
    url: {
      type: String,
      required: true
    },
    random: {
      type: Boolean
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
      type: String,
      validator: function(value) {
        // The value must match one of these strings
        return ["comunitario", "institucional"].indexOf(value) !== -1;
      }
    },
    forceType: {
      type: Number
    },
    showAll: {
      type: Boolean
    },
    forceSize: {
      type: Number
    },
    showMore: {
      type: Boolean
    },
  },
  data() {
    return {
      projects: [],
      isLoading: true
    };
  },
  beforeMount: function() {
    this.isLoading = true;
    this.$http
      .get(this.urlGet)
      .then(response => {
        this.isLoading = false;
        this.projects = response.data.data;
      })
      .catch(error => {
        this.isLoading = false;
        console.error(error);
      });
  },
  mounted: function() {},
  methods: {
   getWho(project) {
      if(project.organization_name) return `${project.organization_name} (Org.)`
      return project.author_names + " " + project.author_surnames;
    },
    getStyle: function(project){
      if(project.picture_name){
        return `background-image: url("/proyectos/${project.id}/imagen")`
      }
      return null
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
  },
  computed: {
    urlGet: function() {
      let query = [];
      if (this.forceWinners == true) {
        query.push(`selected=1`);
      }
      if (this.forceFeasible == true) {
        query.push(`feasible=1`);
      }
      if (this.forceUnfeasible == true) {
        query.push(`feasible=0`);
      }
      if (this.forceProposals == true) {
        query.push(`proposals=1`);
      }
      if (this.forceDistrict) {
        query.push("district=" + this.forceDistrict);
      }
      if (this.forceType) {
        query.push("type=" + this.forceType);
      }
      if (this.showAll) {
        query.push("size=200");
      } else {
        if (this.forceSize) {
        query.push("size=" + this.forceSize);
        } else {
        query.push("size=11");
        }
      }
      if (this.random) {
        query.push("random=1");
      }
      return this.url.concat(query.length > 0 ? "?" : "", query.join("&"));
    }
  }
};
</script>


<style lang="scss" scoped>
.some-other-effects{
  line-height: normal;
margin-top: 5px;
font-size: 0.85rem;
}
.ribbon{
  position: absolute;
  top: 10px;
  left: 10px;
  height: 70px;
}
</style>
