<template>
<v-card>
  <v-toolbar>
    <v-toolbar-title>{{ $t('people.detail.title', {lib: people.lib}) }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn text color="primary" :to="{ name: 'People', params: {id: people.id, action: 'edit'} }">
      {{ $t('people.detail.btn.change') }}
    </v-btn>
  </v-toolbar>
  <v-card-text>
      <v-container>
        <v-row>
          <v-col>
            {{ $t('people.detail.lastname') }}
          </v-col>
          <v-col>
            {{ people.lastname }}
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            {{ $t('people.detail.firstname') }}
          </v-col>
          <v-col>
            {{ people.firstname }}
          </v-col>
        </v-row>
      </v-container>
  </v-card-text>
</v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop} from 'vue-property-decorator'
import PeopleInterface from '../../models/People.interface';

@Component({
  name: 'PeopleShow'
})
export default class PeopleShow extends Vue {
  @Prop()
  people!: PeopleInterface;
}
</script>

<style scoped>

</style>