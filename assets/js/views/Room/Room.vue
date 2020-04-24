<template>
  <v-container>
    <div class="loading" v-if="loading"><h2>{{ $t(loadingMsg) }}</h2></div>
    <component v-else :is="roomActionClass" :room="room" @update="update"/>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component, Watch} from 'vue-property-decorator';
import RoomEdit from '@/components/Room/RoomEdit.vue';
import RoomShow from '@/components/Room/RoomShow.vue';
import { namespace } from 'vuex-class';
import RoomInterface from '../../models/Room.interface';

const roomStore = namespace('room');

@Component({
  name: 'Room',
  components: {
    RoomEdit,
    RoomShow
  }
})
export default class Room extends Vue {
  @roomStore.Action('getRoom') getRoom!: (id: number) => void;

  @roomStore.Action('addRoom') addRoom!: (room: RoomInterface) => Promise<RoomInterface>;

  @roomStore.Action('saveRoom') saveRoom!: (room: RoomInterface) => Promise<RoomInterface>;

  @roomStore.State('room') room!: RoomInterface;

  @roomStore.Action('newRoom') newRoom!: () => void ;

  private id: number = -1;
  
  private action: string = 'show';

  private loading: boolean = true;

  private init: boolean = true;

  private loadingMsg: string = 'room.loading.base';

  private showModalRemove: boolean = false;

  get roomActionClass() {
    return this.action === 'edit' || this.action === 'create' ? 'RoomEdit' : 'RoomShow' ;
  }

  mounted() {
    this.id = Number(this.$route.params.id);
    this.action = this.$route.params.action;

    if(this.action === 'create') {
      this.newRoom();
      this.loading = false;
    } else {
      this.getRoom(this.id);
    }
  }

  @Watch('room')
  roomUpdated() {
    if(this.room && this.room.id && this.loading && !this.init){
      this.$router.push({name: 'Room', params: {id: this.room.id.toString(), action: 'show'}});
    }
    this.init = false;
    this.loading = false;
  }

  update(room: RoomInterface) {
    this.loading = true;
    // Création
    if(this.id === 0) {
    this.loadingMsg = 'room.loading.add';
      this.addRoom(room);
    } else {
      // Mise à jour
      this.loadingMsg = 'room.loading.save';
      this.saveRoom(room);
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
