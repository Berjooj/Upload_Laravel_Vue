<template>
  <div id="app">
    <NavComponent></NavComponent>

    <router-view></router-view>

    <FooterComponent></FooterComponent>
  </div>
</template>

<script>
import NavComponent from "@/components/NavComponent";
import FooterComponent from "@/components/FooterComponent";


export default {
  name: 'app',
  components: {NavComponent, FooterComponent}
}

</script>

<style scoped>
body {
  background-color: whitesmoke;
}

#app {
  width: 100%;
  margin-left: auto;
  margin-right: auto;
}
</style>