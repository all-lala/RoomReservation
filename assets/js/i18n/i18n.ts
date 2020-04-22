import Vue from 'vue';
import VueI18n from 'vue-i18n';
import fr from '@/i18n/message-fr.json';

Vue.use(VueI18n);

let locale = navigator.language

export default new VueI18n({
  fallbackLocale: 'fr',
  locale: locale,
  messages: {
    fr
  }
})
