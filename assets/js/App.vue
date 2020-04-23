<template>
  <v-app id="layout">
    <v-app-bar app clipped-right color="blue-grey" dark>
      <v-toolbar-title>
        <router-link class="title" :to="{name: 'Home'}">
          RoomReservation
        </router-link>
      </v-toolbar-title>
      <v-spacer />
      <v-btn text :to="{name: 'Rooms'}" class="hidden-sm-and-down">
        {{$t('layout.btn.rooms')}}<v-icon>mdi-door-open</v-icon>
      </v-btn>
      <v-app-bar-nav-icon @click.stop="right = !right" class="hidden-md-and-up"/>
    </v-app-bar>

    <v-content>
      <router-view :key="$route.fullPath"/>
    </v-content>

    <v-navigation-drawer v-model="right" fixed right temporary >
      <v-list>
        <v-list-item :to="{name: 'Rooms'}">
          <v-list-item-action>
            <v-icon color="purple">mdi-door-open</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{$t('layout.btn.rooms')}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-footer app color="blue-grey" class="white--text">
      <span>All-lala</span>
      <v-spacer />
      <span>&copy; 2020</span>
    </v-footer>
  </v-app>
</template>

<script lang="ts">
import Vue from "vue";
import Component from "vue-class-component";
import axios from "axios";

@Component({
  name: "App"
})
export default class App extends Vue {
  private drawer: any = null;
  private drawerRight: any = null;
  private right: boolean = false;
  private left: boolean = false;
}
</script>

<style scoped>
.title {
  color: inherit;
  text-decoration: inherit;
}
</style>
