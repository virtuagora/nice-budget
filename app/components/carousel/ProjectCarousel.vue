<template>
  <div v-if="!isLoading" style="padding:10px 30px">
    <carousel class="project-carousel" v-if="projects.length > 0"
      :autoplay="autoplayEnabled"
      :loop="loopEnabled" 
      :autoplay-timeout="timeout" 
      :per-page-custom="responsiveLayout"
      :navigation-enabled="navigationEnabled" 
      navigationNextLabel="<i class='fas fa-angle-double-right fa-2x has-text-black'></i>"
      navigationPrevLabel="<i class='fas fa-angle-double-left fa-2x has-text-black'></i>">
      <slide class="item-carousel" v-for="project in projects" :key="project.id">
        <a :href="'/proyectos/' + project.id">
          <div class="box-project" :class="{'has-image-background': project.picture_name}" :style="getStyle(project)">
          <div class="icon-category">
            <i :class="`${project.category.fontawesome_icon} fa-2x`"></i>
          </div>
            <div class="box-content">
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
                </div>
                <h1 class="title is-4 is-500 is-marginless">{{project.title}}</h1>
            <p>
              Por
              <span class="is-600">{{getWho(project)}}</span>
              - {{getShortDescription(project.objective,100)}}
            </p>
              </div>
            </div>
          </div>
        </a>
      </slide>
      <slide class="item-carousel" v-if="more">
        <a :href="catalogUrl">
        <div class="box-project and-more">
            <div>
              <div class="to-bottom">
                <h1 class="title is-1 is-marginless"><i class="fas fa-book-reader"></i></h1>
                <h1 class="title is-3">¡Y mucho más!</h1>
                <h1 class="subtitle is-5">¡Ingresá al catálogo para ver mas ideas que participan!</h1>
              </div>
            </div>
          </div>
        </a>
      </slide>
    </carousel>
    <div v-else class="notification">
      No se encontraron resultados
    </div>

  </div>
  <div class="notification" v-else>
    <br>
    <b-loading :is-full-page="false" :active.sync="isLoading"></b-loading>
    <br>
  </div>
</template>

<script>
import { Carousel, Slide } from "vue-carousel";


export default {
  props: ["url", "timeout", "catalogUrl", "more"],
  components: {
    Carousel,
    Slide
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
      .get(this.url)
      .then(response => {
        this.isLoading = false;
        this.projects = response.data.data;
      })
      .catch(error => {
        this.isLoading = false;
        console.error(error);
      });
  },
  methods: {
    getStyle: function(project){
      if(project.picture_name){
        return `background-image: url("/proyectos/${project.id}/imagen")`
      }
      return null
    },
    getWho(project) {
      if(project.organization_name) return `${project.organization_name} (Org.)`
      return project.author_names + " " + project.author_surnames;
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
    }
  },
  
  computed: {
    navigationEnabled: function() {
      return this.projects.length - 1 ? true : false;
    },
    autoplayEnabled: function() {
      return this.projects.length - 1 ? true : false;
    },
    perPage: function() {
      if (this.projects.length > 2) {
        return 3;
      } else {
        return this.projects.length;
      }
    },
    loopEnabled: function() {
      return this.projects.length - 1 ? true : false;
    },
    responsiveLayout: function() {
      console.log(this.projects.length)
      if (this.projects.length > 2) {
        return [[0,1],[768, 2], [1024, 3]];
      } else if (this.projects.length == 2) {
        return [[0, 1], [768, 2]];
      } else if (this.projects.length == 1) {
        return null;
      }
    }
  }
};
</script>



