<template>
  <v-row>
    <v-col v-for="room in rooms" :key="room.lib">
      <RoomCard :room="room" />
    </v-col>
  </v-row>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator';
import RoomCard from './RoomCard.vue';

@Component({
  name: 'RoomListCards',
  components: {
    RoomCard
  }
})
export default class RoomListCards extends Vue {
  @Prop({default: () => []})
  rooms!: [];
}
</script>

<style scoped>

</style>