<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png" />
    <HelloWorld msg="Welcome to Your Vue.js App" />
  </div>
</template>

<script lang="ts">
// @ is an alias to /src
import Vue from "vue";
import Component from "vue-class-component";
import HelloWorld from "@/components/HelloWorld.vue";

@Component({
  name: "Home",
  components: {
    HelloWorld
  }
})
export default class Home extends Vue {}
</script>
