<template>
  <!-- <MyHome /> -->
  <RouterView />
  <!-- <img alt="Vue logo" src="./assets/logo.png" /> -->
  <!-- <HelloWorld msg="Welcome to Your Vue.js App" /> -->
</template>

<script>
// import HelloWorld from "./components/HelloWorld.vue";
// import MyHeader from "./components/MyHeader.vue";
// import MyBody from "./components/MyBody.vue";
// import MyDasboard from "./components/MyDasboard.vue";

export default {
  name: "App",
  components: {
  //   // HelloWorld,
  //   // MyHome,
  //   // MyDasboard,
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

.my-body h5 {
  font-weight: bold;
}

.my-body__title {
  padding: 40px 0 0 0;
}

.my-body__subtitle {
  display: flex;
  align-items: center;
  justify-content: space-between;
  font-size: 12px;
  color: #6e6e6e;
  font-weight: 200;
}

.my-body__subtitle p {
  font-size: 14px;
  margin-bottom: 0px;
  padding: 8px 0;
}

.my-body__subtitle span a {
  text-decoration: none;
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
