<template>
  <div>
    <v-data-table
    :headers="headers"
    :items="peoples"
    :items-per-page="5"
    >
    <template v-slot:item.name="{ item }">
        {{item.lastname}} {{item.fisrt}}
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        small
        class="mr-2"
        @click="$emit('show', item.id)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        small
        @click="$emit('remove', item)"
      >
        mdi-delete
      </v-icon>
    </template>
    </v-data-table>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'

@Component({
  name: 'PeopleListTable'
})
export default class PeopleListTable extends Vue{
  @Prop({default: () => []})
  peoples!: [];

  private headers: any[] = [];
  
  mounted() {
    this.headers = [
      {
        text: this.$t('peoples.table.headers.name'),
        value: 'name'
      },
      {
        text: this.$t('peoples.table.headers.actions'),
        value: 'actions'
      }
    ];
  }
}
</script>
