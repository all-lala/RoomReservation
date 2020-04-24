<template>
  <v-container class="rooms">
    <v-select
          v-model="selected"
          :items="typeOfView"
          label="Affichage"
    ></v-select>
    <component v-if="rooms.length > 0" :is="selected" :rooms="rooms" @show="show" @remove="remove"></component>
    <div v-else class="nothing"><h3>{{ $t('rooms.nothing') }}</h3></div>
    <!-- Modal de validation de la suppression -->
    <v-dialog
      v-if="roomToRemove"
      v-model="showModalRemove"
      max-width="600px"
    >
      <v-card>
        <v-card-title class="headline">{{ $t('rooms.modalRemove.title') }}</v-card-title>
        <v-card-text>
          {{ $t('rooms.modalRemove.message', {lib: roomToRemove.lib}) }}
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="success"
            text
            @click="showModalRemove = false"
          >
           {{ $t('rooms.modalRemove.btn.cancel') }}
          </v-btn>
          <v-btn
            color="warning"
            text
            @click="removeRoom"
          >
            {{ $t('rooms.modalRemove.btn.valid') }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import RoomListCards from './RoomListCards.vue';
import RoomListTable from './RoomListTable.vue';
import { namespace } from 'vuex-class';
import RoomInterface from '../../models/Room.interface';

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

  @roomStore.Action('deleteRoom') deleteRoom!: (id: number) => void;

  @roomStore.State('rooms') rooms!: () => void;
  
  private selected: string = 'RoomListCards';

  private showModalRemove = false;

  private roomToRemove: RoomInterface | null = null;

  mounted() {
    this.findRooms();
  }

  private typeOfView = [
    {text: "Cartes", value: 'RoomListCards'},
    {text: "Table", value: 'RoomListTable'}
  ]

  show(id: number) {
    this.$router.push({name: 'Room', params: {id: id.toString(), action: 'show'}})
  }

  remove(room: RoomInterface) {
    this.roomToRemove = room;
    this.showModalRemove = true;
  }

  removeRoom() {
    console.log(this.roomToRemove)
    if(this.roomToRemove && this.roomToRemove.id){
      this.deleteRoom(this.roomToRemove.id);
    }
    this.showModalRemove = false;
  }
}
</script>

<style>
.nothing{
  text-align: center;
}
</style>