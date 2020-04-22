<template>
  <v-container class="rooms">
    <v-select
          v-model="selected"
          :items="typeOfView"
          label="Affichage"
    ></v-select>
    <component v-if="rooms.length > 0" :is="selected" :rooms="rooms" @update="update"></component>
    <div v-else class="nothing"><h3>{{ $t('rooms.nothing') }}</h3></div>
  </v-container>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import RoomListCards from './RoomListCards.vue';
import RoomListTable from './RoomListTable.vue';
import { namespace } from 'vuex-class';

const roomStore = namespace('room');

@Component({
  name: 'RoomList',
  components: {
    RoomListCards,
    RoomListTable
  }
})
export default class RoomList extends Vue {
  @roomStore.Action('findRooms') findRooms!: () => void;

  @roomStore.State('rooms') rooms!: () => void;

  mounted() {
    this.findRooms();
  }

  private typeOfView = [
    {text: "Cartes", value: 'RoomListCards'},
    {text: "Table", value: 'RoomListTable'}
  ]

  private selected: string = 'RoomListCards'

  update(roomId: number) {
  }
}
</script>

<style>
.nothing{
  text-align: center;
}
</style>