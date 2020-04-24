<template>
  <v-container>
    <div class="loading" v-if="loading"><h2>{{ $t(loadingMsg) }}</h2></div>
    <component v-else :is="peopleActionClass" :people="people" @update="update"/>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Watch} from 'vue-property-decorator';
import PeopleEdit from '@/components/People/PeopleEdit.vue';
import PeopleShow from '@/components/People/PeopleShow.vue';
import { namespace } from 'vuex-class';
import PeopleInterface from '../../models/People.interface';

const peopleStore = namespace('people');

@Component({
  name: 'People',
  components: {
    PeopleEdit,
    PeopleShow
  }
})
export default class People extends Vue {
  @peopleStore.Action('getPeople') getPeople!: (id: number) => void;

  @peopleStore.Action('addPeople') addPeople!: (people: PeopleInterface) => Promise<PeopleInterface>;

  @peopleStore.Action('savePeople') savePeople!: (people: PeopleInterface) => Promise<PeopleInterface>;

  @peopleStore.State('people') people!: PeopleInterface;

  @peopleStore.Action('newPeople') newPeople!: () => void ;

  private id: number = -1;
  
  private action: string = 'show';

  private loading: boolean = true;

  private init: boolean = true;

  private loadingMsg: string = 'people.loading.base';

  private showModalRemove: boolean = false;

  get peopleActionClass() {
    return this.action === 'edit' || this.action === 'create' ? 'PeopleEdit' : 'PeopleShow' ;
  }

  mounted() {
    this.id = Number(this.$route.params.id);
    this.action = this.$route.params.action;

    if(this.action === 'create') {
      this.newPeople();
      this.loading = false;
    } else {
      this.getPeople(this.id);
    }
  }

  @Watch('people')
  peopleUpdated() {
    if(this.people && this.people.id && this.loading && !this.init){
      this.$router.push({name: 'People', params: {id: this.people.id.toString(), action: 'show'}});
    }
    this.init = false;
    this.loading = false;
  }

  update(people: PeopleInterface) {
    this.loading = true;
    // Création
    if(this.id === 0) {
    this.loadingMsg = 'people.loading.add';
      this.addPeople(people);
    } else {
      // Mise à jour
      this.loadingMsg = 'people.loading.save';
      this.savePeople(people);
    }
  }
}
</script>

<style scoped>
.loading{
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  text-shadow: 2px 2px 5px grey;
}
</style>
