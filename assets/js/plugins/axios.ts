import Vue, { PluginObject } from 'vue';
import Axios, { AxiosRequestConfig, AxiosInstance } from 'axios';
import { VueConstructor } from 'vue/types/umd';

// Full config:  https://github.com/axios/axios#request-config
// axios.defaults.baseURL = process.env.baseURL || process.env.apiUrl || '';
// axios.defaults.headers.common['Authorization'] = AUTH_TOKEN;
// axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';


const config: AxiosRequestConfig = {
  baseURL: window.location.pathname + 'api',
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

const Plugin: PluginObject<any> = {
  install: (vue) => { },
};
Plugin.install = (vue) => {
  Vue.prototype.$axios = axios;
  Object.defineProperties(Vue.prototype, {
    $axios: {
      get() {
        return axios;
      },
    },
  });
};

declare module 'vue/types/vue' {
  // 3. Declare augmentation for Vue
  interface Vue {
    $axios: AxiosInstance
  }
}

Vue.use(Plugin);

export default Plugin;