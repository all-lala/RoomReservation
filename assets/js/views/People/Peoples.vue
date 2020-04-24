<template>
  <v-container>
    <v-card>
      <v-toolbar>
        <v-toolbar-title>
          {{ $t('peoples.title') }}
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn text color="primary" :to="{name: 'People', params: {id: '0', action: 'create'}}">
          <span class="hidden-sm-and-down">{{ $t('peoples.add') }}</span>
          <v-icon class="hidden-md-and-up">mdi-plus</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <PeopleList/>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component} from 'vue-property-decorator';
import PeopleList from '@/components/People/PeopleList.vue';

@Component({
  name: 'Peoples',
  components: {
    PeopleList
  }
})
export default class Peoples extends Vue {}
</script>

<style scoped>

</style>