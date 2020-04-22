<template>
  <div>
    <v-data-table
    :headers="headers"
    :items="rooms"
    :items-per-page="5"
    ></v-data-table>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'

@Component({
  name: 'RoomListTable'
})
export default class RoomListTable extends Vue{
  @Prop({default: () => []})
  rooms!: [];

  private headers: any[] = [];
  
  mounted() {
    this.headers = [
      {
        text: this.$t('rooms.table.headers.lib'),
        value: 'lib'
      },
      {
        text: this.$t('rooms.table.headers.desc'),
        value: 'desc'
      },
      {
        text: this.$t('rooms.table.headers.capacity'),
        value: 'capacity'
      },
    ];
  }


}






</script>

<style>

</style>
