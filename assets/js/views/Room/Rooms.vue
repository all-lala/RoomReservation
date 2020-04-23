<template>
  <v-container>
    <v-card>
      <v-toolbar>
        <v-toolbar-title>
          {{ $t('rooms.title') }}
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn text color="primary" :to="{name: 'Room', params: {id: '0', action: 'create'}}">
          <span class="hidden-sm-and-down">{{ $t('rooms.add') }}</span>
          <v-icon class="hidden-md-and-up">mdi-plus</v-icon>
        </v-btn>
      </v-toolbar>
      <v-card-text>
        <RoomList/>
      </v-card-text>
    </v-card>
  </v-container>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import RoomList from '@/components/Room/RoomList.vue';

@Component({
  name: 'Rooms',
  components: {
    RoomList
  }
})
export default class Rooms extends Vue {}
</script>
