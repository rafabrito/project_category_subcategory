<template>
  <MyDasboard>
    <template v-slot:slote-page>
      <div class="content-page">
        <div class="my-body__title">
          <h5>Início</h5>
          <div class="my-body__subtitle">
            <span class="links">
              <span>
                <fa icon="home" /> Início
              </span>
            </span>

          </div>
        </div>
      </div>
    </template>
  </MyDasboard>
</template>
<script>
import MyDasboard from "./MyDasboard.vue";

export default {
  name: "MyHome",
  components: {
    MyDasboard,
  },
};
</script>
<style lang=""></style>
