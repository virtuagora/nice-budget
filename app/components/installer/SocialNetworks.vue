<template>
  <section>
      <h1 class="subtitle is-4 has-text-primary">Redes sociales</h1>
    <div class="content">
      <p>Estos links se muestran en la barra de navegación de la plataforma y en el footer.</p>
      <p>Por favor, complete con la URL del la red social. Puede hacer clic en la "Vista previa" para corroborar que el link funciona como deberia.</p>
      <p>
        Por defecto, automaticamente le anteponemos
        <code>https://</code> a la URL.
      </p>
      <p>
        <b>Nota:</b> Deje el campo vacio si no cuenta con la red social
      </p>
    </div>
    <div class="field">
      <label for class="label">Web oficial</label>
      <div class="control">
        <div class="field has-addons">
          <div class="control">
            <a class="button is-static is-medium">https://</a>
          </div>
          <div class="control is-expanded">
            <input
              type="text"
              class="input is-medium"
              v-model="model.social.web"
              placeholder="google.com"
              v-validate="'required'"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <label for class="label">Facebook</label>
      <div class="control">
        <div class="field has-addons">
          <div class="control">
            <a class="button is-static is-medium">https://facebook.com/</a>
          </div>
          <div class="control is-expanded">
            <input
              type="text"
              class="input is-medium"
              v-model="model.social.facebook"
              placeholder="Ingrese texto..."
              v-validate="'required'"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <label for class="label">Twitter</label>
      <div class="control">
        <div class="field has-addons">
          <div class="control">
            <a class="button is-static is-medium">https://twitter.com/</a>
          </div>
          <div class="control is-expanded">
            <input
              type="text"
              class="input is-medium"
              v-model="model.social.twitter"
              placeholder="Ingrese texto..."
              v-validate="'required'"
            />
          </div>
        </div>
      </div>
    </div>
    <div class="field">
      <label for class="label">Instagram</label>
      <div class="field has-addons">
        <div class="control">
          <a class="button is-static is-medium">https://instagram.com/</a>
        </div>
        <div class="control is-expanded">
          <input
            type="text"
            class="input is-medium"
            v-model="model.social.instagram"
            placeholder="Ingrese texto..."
            v-validate="'required'"
          />
        </div>
      </div>
    </div>
    <div class="field">
      <label for class="label">YouTube</label>
      <div class="field has-addons">
        <div class="control">
          <a class="button is-static is-medium">https://youtube.com/</a>
        </div>
        <div class="control is-expanded">
          <input
            type="text"
            class="input is-medium"
            v-model="model.social.youtube"
            placeholder="Ingrese texto.."
            v-validate="'required'"
          />
        </div>
      </div>
    </div>
    <h1 class="subtitle is-4 has-text-primary">Google Analytics</h1>
    <div class="content">
      <p>Si desea habilitar el tracking de <a href="https://analytics.google.com/">Google Analytics</a> en la página web, debe ingresar el Tracking ID</p>
    </div>
    <div class="field">
      <div class="control">
        <b-checkbox
          v-model="model.enableGoogleAnalytics"
          size="is-medium"
        >Habilitar Google Analytics para la web</b-checkbox>
      </div>
    </div>
    <div class="field has-addons" v-if="model.enableGoogleAnalytics">
      <div class="control">
        <a class="button is-static is-medium">
          <i class="fab fa-google"></i>
        </a>
      </div>
      <div class="control is-expanded">
        <input
          type="text"
          v-model="model.googleAnalyticsId"
          class="input is-medium"
          data-vv-name="googleAnalyticsId"
          data-vv-as="'Google Analytics ID'"
          v-validate="'required'"
          placeholder="Ingrese el Tracking ID. Ej: UA-99999999-99 "
        />
        <span class="help is-danger" v-show="errors.has('googleAnalyticsId')">
          <i class="fas fa-times-circle fa-fw"></i>
          {{errors.first('googleAnalyticsId')}}
        </span>
      </div>
    </div>

    <h1 class="subtitle is-4 has-text-primary">Compartir en Facebook</h1>
    <div class="content">
      <p>Para habilitar el boton de compartir un proyecto en Facebook, debe crear una aplicacion en <a href="https://developers.facebook.com/">https://developers.facebook.com</a> y colocar el ID del mismo para que Facebook permita habilitar el dialogo para compartir en las redes</p>
      <p><b>NOTA</b>: Consulte con un programador/developer para ayudarlo en este paso ante cualquier duda</p>
    </div>
    <div class="field">
      <div class="control">
        <b-checkbox
          v-model="model.enableFacebookApp"
          size="is-medium"
        >Habilitar Google Analytics para la web</b-checkbox>
      </div>
    </div>
    <div class="field has-addons" v-if="model.enableFacebookApp">
      <div class="control">
        <a class="button is-static is-medium">
          <i class="fab fa-facebook-square"></i>
        </a>
      </div>
      <div class="control is-expanded">
        <input
          type="text"
          v-model="model.facebookAppId"
          class="input is-medium"
          data-vv-name="facebookAppId"
          data-vv-as="'Facebook App ID'"
          v-validate="'required'"
          placeholder="Ingrese el App ID"
        />
        <span class="help is-danger" v-show="errors.has('facebookAppId')">
          <i class="fas fa-times-circle fa-fw"></i>
          {{errors.first('facebookAppId')}}
        </span>
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