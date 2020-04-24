import Vue from 'vue';
import { Module, MutationTree, ActionTree, ActionContext } from 'vuex';
import PeopleInterface from '@/models/People.interface';
import People from '@/models/People.model';
import Urls from '@/utils/Urls'

interface PeopleState{
  people: PeopleInterface;
  peoples: PeopleInterface[];
}

export default class PeopleStore implements Module<PeopleState, any>
{
  public namespaced = true;
  
  state: PeopleState = {
    people: new People(),
    peoples: [],
  }

  mutations: MutationTree<PeopleState> = {
    people(state: PeopleState, newPeople: PeopleInterface) {
      state.people = newPeople;
    },
    peoples(state: PeopleState, newPeoples: PeopleInterface[]) {
      state.peoples = newPeoples;
    }
  }
  
  actions: ActionTree<PeopleState, any> = {
    newPeople(context: ActionContext<PeopleState, any>): void{
      context.commit('people', new People());
    },
    findPeoples(context: ActionContext<PeopleState, any>): void {
      const vue = new Vue();
      vue.$axios.get(Urls.PEOPLE)
        .then(response => {
          if(response && response.data){
            context.commit('peoples', response.data)
          } else {
            console.error(response)
          }
        })
        .catch(console.log)
    },
    getPeople(context: ActionContext<PeopleState, any>, id): void {
      const vue = new Vue();
      vue.$axios.get(`${Urls.PEOPLE}/${id}`)
        .then(response => {
          if(response && response.data){
            context.commit('people', response.data);
          } else {
            console.error(response);
          }
        })
        .catch(console.log)
    },
    addPeople(context: ActionContext<PeopleState, any>, people: PeopleInterface): void {
      const vue = new Vue();
      vue.$axios.post(Urls.PEOPLE, people)
      .then(response => {
        if(response && response.data){
          context.commit('people', response.data);
        } else {
          console.error(response);
        }
      })
      .catch(console.log)
    },
    savePeople(context: ActionContext<PeopleState, any>, people: PeopleInterface): void {
      const vue = new Vue();
      vue.$axios.patch(`${Urls.PEOPLE}/${people.id}`, people)
      .then(response => {
        if(response && response.data){
          context.commit('people', response.data);
        } else {
          console.error(response);
        }
      })
      .catch(console.log)
    },
    deletePeople(context: ActionContext<PeopleState, any>, id: number): void {
      const vue = new Vue();
      vue.$axios.delete(`${Urls.PEOPLE}/${id}`)
      .then(response => {
        context.dispatch('newPeople');
        context.dispatch('findPeoples');
      })
      .catch(console.log)
    }
  }
}