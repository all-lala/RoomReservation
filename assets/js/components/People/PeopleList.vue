<template>
  <v-container class="peoples">
    <PeopleListTable :peoples="peoples" v-if="peoples.length" @show="show" @remove="remove"/>
    <div v-else class="nothing"><h3>{{ $t('peoples.nothing') }}</h3></div>
    <!-- Modal de validation de la suppression -->
    <v-dialog
      v-if="peopleToRemove"
      v-model="showModalRemove"
      max-width="600px"
    >
      <v-card>
        <v-card-title class="headline">{{ $t('peoples.modalRemove.title') }}</v-card-title>
        <v-card-text>
          {{ $t('peoples.modalRemove.message', {lib: peopleToRemove.lib}) }}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="success"
            text
            @click="showModalRemove = false"
          >
           {{ $t('peoples.modalRemove.btn.cancel') }}
          </v-btn>
          <v-btn
            color="warning"
            text
            @click="removePeople"
          >
            {{ $t('peoples.modalRemove.btn.valid') }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component} from 'vue-property-decorator'
import { namespace } from 'vuex-class';
import PeopleInterface from '../../models/People.interface';
import PeopleListTable from './PeopleListTable.vue'

const peopleStore = namespace('people');

@Component({
  name: 'PeopleList',
  components: {
    PeopleListTable
  }
})
export default class PeopleList extends Vue {
  @peopleStore.Action('findPeoples') findPeoples!: () => void;

  @peopleStore.Action('deletePeople') deletePeople!: (id: number) => void;

  @peopleStore.State('peoples') peoples!: () => void; 

  private showModalRemove = false;

  private peopleToRemove: PeopleInterface | null = null;

  mounted() {
    this.findPeoples();
  }

  show(id: number) {
    this.$router.push({name: 'People', params: {id: id.toString(), action: 'show'}})
  }

  remove(people: PeopleInterface) {
    this.peopleToRemove = people;
    this.showModalRemove = true;
  }

  removePeople() {
    console.log(this.peopleToRemove)
    if(this.peopleToRemove && this.peopleToRemove.id){
      this.deletePeople(this.peopleToRemove.id);
    }
    this.showModalRemove = false;
  }
}
</script>

<style scoped>

</style>