<template>
  <div class="my-header">
    <div class="sidebar">
      <SidebarContent />
    </div>

    <div class="contents">
      <div class="navbar">
        <NavbarContent />
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
import NavbarContent from "./NavbarContent.vue";
import SidebarContent from "./SidebarContent.vue";

export default {
  name: "MyDasboard",
  components: {
    SidebarContent,
    NavbarContent,
  },
};
</script>

<style>
.my-header {
  display: flex;
  width: 100%;
  height: 100vh;
}

.sidebar {
  width: 200px;
  height: 100vh;
  background-color: #343a40;
}

.contents {
  width: calc(100% - 200px);
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
/* .navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px 10px;
} */
</style>
