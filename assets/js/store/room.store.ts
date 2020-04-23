import Vue from 'vue';
import { Module, MutationTree, ActionTree, ActionContext } from 'vuex';
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
    newRoom(context: ActionContext<RoomState, any>): void{
      context.commit('room', new Room());
    },
    findRooms(context: ActionContext<RoomState, any>): void {
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
    getRoom(context: ActionContext<RoomState, any>, id): void {
      const vue = new Vue();
      vue.$axios.get(`${Urls.ROOM}/${id}`)
        .then(response => {
          if(response && response.data){
            context.commit('room', response.data);
          } else {
            console.error(response);
          }
        })
        .catch(console.log)
    },
    addRoom(context: ActionContext<RoomState, any>, room: RoomInterface): void {
      const vue = new Vue();
      vue.$axios.post(Urls.ROOM, room)
      .then(response => {
        if(response && response.data){
          context.commit('room', response.data);
        } else {
          console.error(response);
        }
      })
      .catch(console.log)
    },
    saveRoom(context: ActionContext<RoomState, any>, room: RoomInterface): void {
      const vue = new Vue();
      vue.$axios.patch(`${Urls.ROOM}/${room.id}`, room)
      .then(response => {
        if(response && response.data){
          context.commit('room', response.data);
        } else {
          console.error(response);
        }
      })
      .catch(console.log)
    },
    deleteRoom(context: ActionContext<RoomState, any>, id: number): void {
      const vue = new Vue();
      vue.$axios.delete(`${Urls.ROOM}/${id}`)
      .then(response => {
        context.dispatch('newRoom');
        context.dispatch('findRooms');
      })
      .catch(console.log)
    }
  }
}