
import Vue from 'vue';
import Axios, {AxiosStatic} from 'axios';
declare var BASE_URL: any;

// Full config:  https://github.com/axios/axios#request-config

const config = {
  baseURL: BASE_URL + 'api',
};
const axios = Axios.create(config);

axios.interceptors.request.use(
  cfg =>
    // Do something before request is sent
    cfg,
  err =>
    // Do something with request error
    Promise.reject(err)
    ,
);

declare module 'vue/types/vue' {
    interface Vue {
        $axios: AxiosStatic;
    }
}

export default {
  install() {
      Vue.prototype.$axios = Axios.create(config);
  },
};