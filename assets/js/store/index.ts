import Vue from 'vue';
import Vuex, { StoreOptions } from 'vuex';
import RoomStore from './room.store';

Vue.use(Vuex)

const store: StoreOptions<any> ={
  modules: {
    room: new RoomStore()
  }
};

export default new Vuex.Store(store);
