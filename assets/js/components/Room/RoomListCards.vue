<template>
  <v-row>
    <v-col v-for="room in rooms" :key="room.id">
      <RoomCard :room="room" @show="$emit('show', room.id)" @remove="$emit('remove', room)" />
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