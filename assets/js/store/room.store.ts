import Vue from 'vue';
import { Module, MutationTree, ActionTree } from 'vuex';
import RoomInterface from '@/models/Room.interface';
import Room from '@/models/Room.model';
import Urls from '@/utils/Urls'

interface RoomState{
  room: RoomInterface;
  rooms: RoomInterface[];
}

export default class RoomStore implements Module<RoomState, any>
{
  public namespaced = true;
  
  state: RoomState = {
    room: new Room(),
    rooms: [],
  }

  mutations: MutationTree<RoomState> = {
    room(state: RoomState, newRoom: RoomInterface) {
      state.room = newRoom;
    },
    rooms(state: RoomState, newRooms: RoomInterface[]) {
      state.rooms = newRooms;
    }
  }
  
  actions: ActionTree<RoomState, any> = {
    findRooms(context): void {
      const vue = new Vue();
      vue.$axios.get(Urls.ROOM)
        .then(response => {
          if(response && response.data){
            context.commit('rooms', response.data)
          } else {
            console.error(response)
          }
        })
        .catch(console.log)
    },
    findRoom(context, id): void {
      const vue = new Vue();
      vue.$axios.get(`${Urls.ROOM}/${id}`)
        .then(response => {
          if(response && response.data){
            context.dispatch('room', response.data)
          } else {
            console.error(response)
          }
        })
        .catch(console.log)
    }
  }
}