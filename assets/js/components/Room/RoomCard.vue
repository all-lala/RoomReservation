<template>
  <v-card
    class="mx-auto"
    max-width="400"
  >
    <v-img
      class="white--text align-end"
      height="200px"
      src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
    >
      <v-card-title>{{ room.lib }}</v-card-title>
    </v-img>
    <v-card-subtitle class="pb-0">{{ $tc('room.card.capacity', room.capacity, {count: room.capacity}) }}</v-card-subtitle>
    <v-card-text class="text--primary">
      <div>{{ room.desc }}</div>
    </v-card-text>

    <v-card-actions>
      <v-btn
        color="warning"
        text
        @click="$emit('remove')"
      >
        {{$t('room.card.btn.delete')}}
      </v-btn>
      <v-spacer></v-spacer>
      <v-btn
        color="primary"
        text
        @click="$emit('show')"
        >
        {{$t('room.card.btn.show')}}
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop} from 'vue-property-decorator'
import RoomInterface from '@/models/Room.interface';

@Component({
  name: 'RoomCard'
})
export default class RoomCard extends Vue {
  @Prop({default: () => {}})
  room!: RoomInterface;
}
</script>

<style scoped>

</style>