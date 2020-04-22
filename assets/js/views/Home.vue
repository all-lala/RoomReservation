<template>
  <v-container class="home" fluid>
    <v-btn color="primary">{{ $t("home.btn.booking") }}</v-btn>
  </v-container>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator';

@Component({
  name: "Home",
})
export default class Home extends Vue {
  mounted() {
    this.$axios
  }
}
</script>

<style scoped>
.home{
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
