import Vue from 'vue';
import Vuex, { StoreOptions } from 'vuex';
import RoomStore from './room.store';
import PeopleStore from './people.store';

Vue.use(Vuex)

const store: StoreOptions<any> ={
  modules: {
    room: new RoomStore(),
    people: new PeopleStore()
  }
};

export default new Vuex.Store(store);
