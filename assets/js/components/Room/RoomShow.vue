<template>
<v-card>
  <v-toolbar>
    <v-toolbar-title>{{ $t('room.detail.title', {lib: room.lib}) }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn text color="primary" :to="{ name: 'Room', params: {id: room.id, action: 'edit'} }">
      {{ $t('room.detail.btn.change') }}
    </v-btn>
  </v-toolbar>
  <v-card-text>
      <v-container>
        <v-row>
          <v-col>
            {{ $t('room.detail.lib') }}
          </v-col>
          <v-col>
            {{ room.lib }}
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            {{ $t('room.detail.desc') }}
          </v-col>
          <v-col>
            {{ room.desc }}
          </v-col>
        </v-row>
        <v-row>
          <v-col>
            {{ $t('room.detail.capacity') }}
          </v-col>
          <v-col>
            {{ room.capacity }}
          </v-col>
        </v-row>
      </v-container>
  </v-card-text>
</v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop} from 'vue-property-decorator'
import RoomInterface from '../../models/Room.interface';

@Component({
  name: 'RoomShow'
})
export default class RoomShow extends Vue {
  @Prop()
  room!: RoomInterface;
}
</script>

<style scoped>

</style>