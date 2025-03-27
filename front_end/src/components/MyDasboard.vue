<template>
  <div class="my-header">
    <div class="sidebar" :class="!is_expanded && 'is-expanded'">
      <SidebarContent :expanded="!is_expanded" />
    </div>

    <div class="contents">
      <div class="navbar">
        <!-- <NavbarContent /> -->
        <div class="navbar-content">
        
            <button @click="changeMenu">
                <h2 class="logo-bars"><fa icon="bars" /></h2>
            </button>
        
        
            <!-- <a href="" class="logo-user">
                <fa icon="user"/>
            </a> -->
        </div>
      </div>

      <div class="page">
        <slot name="slote-page"></slot>
      </div>
    </div>
    <!-- <nav class="navbar navbar-light">
        <fa icon="bars" />
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a href="">
          <fa icon="user"/>
        </a>
    </nav> -->
  </div>
</template>

<script>
// import NavbarContent from "./NavbarContent.vue";
import SidebarContent from "./SidebarContent.vue";
import { ref } from "vue";

const is_expanded = ref(false);


export default {
  name: "MyDasboard",
  components: {
    SidebarContent,
    // NavbarContent,
  },
  data() {
    return {
      is_expanded: is_expanded,
    };
  },
  methods: {
    changeMenu() {
      // console.log(is_expanded.value)
      is_expanded.value = !is_expanded.value
    },
  }
};
</script>

<style>
.my-header {
  display: flex;
  width: 100%;
  /* width: (100% - 200px); */
  height: 100vh;
}

.sidebar {
  display: flex;
  flex-direction: column;
  width: 0;
  min-height: 100vh;
  background-color: #343a40;
  transition: 0.2s ease-out;
}

.navbar-content {
    display: contents;
}

.navbar-content button{
    border: none;
    background-color: #f8f9fa;
}

.logo-user{
    font-size: 18px;
    padding: 0 0 12px 0;
    text-decoration: none;
 }

/* .sidebar {
  width: 200px;
  height: 100vh;
} */

.contents {
  width: 100%;
  height: 100vh;
}

.navbar {
  width: 100%;
  padding: 12px 10px;
  height: 60px;
  background-color: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
}

.page {
  width: 100%;
  height: auto;
}

.sidebar.is-expanded {
  width: 200px;
}

/* .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 10px;
} */
</style>
