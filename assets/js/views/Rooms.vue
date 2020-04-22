<template>
  <div>
    <RoomList/>
  </div>
</template>

<script lang="ts">
import Vue from 'vue';
import Component from 'vue-class-component';
import RoomList from '@/components/RoomList/RoomList.vue';

@Component({
  name: 'Rooms',
  components: {
    RoomList
  }
})
export default class Rooms extends Vue {
}
</script>

<style>

</style>