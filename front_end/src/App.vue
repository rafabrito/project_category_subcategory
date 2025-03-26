<template>
  <!-- <MyHeader /> -->
  <MyBody />
  <!-- <img alt="Vue logo" src="./assets/logo.png" /> -->
  <!-- <HelloWorld msg="Welcome to Your Vue.js App" /> -->
</template>

<script>
// import HelloWorld from "./components/HelloWorld.vue";
// import MyHeader from "./components/MyHeader.vue";
import MyBody from "./components/MyBody.vue";

export default {
  name: "App",
  components: {
    // HelloWorld,
    // MyHeader,
    MyBody,
  },
};
</script>

<style>
#app {
  display: flex;
  height: 100vh;
  font-family: "Google Sans", sans-serif;
}

.content-page {
  padding: 15px;
}

/* #app { */
/* -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px; */
/* }  */

/* Reset */
/*Seletor universal */
/* * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

a {
  color: inherit;
  text-decoration: none;
} */
</style>
