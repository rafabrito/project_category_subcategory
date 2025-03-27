<template>
  <MyDasboard>
    <template v-slot:slote-page>
      <div class="content-page">
        <div class="my-body__title">
          <h5>Categorias</h5>
          <div class="my-body__subtitle">
            <span class="links">
              <span>
                <RouterLink to="/"><fa icon="home" /> Início </RouterLink>
              </span>
              /
              <span> Categorias </span>
            </span>
            <button class="btn btn-success btn-sm" title="Criar Categoria" data-bs-toggle="modal" data-bs-target="#create">
              <fa icon="plus-circle" /> Cadastrar Categoria
            </button>
          </div>
        </div>

        <!-- Modal para Cadastro de Categoria -->
        <MyModal title="Cadastrar Categoria" type="category"/>

        <MyAccordion />
      </div>
    </template>
  </MyDasboard>
</template>

<script>
import MyDasboard from "./MyDasboard.vue";
import MyAccordion from "./MyAccordion.vue";
import MyModal from "./MyModal.vue";


// const categories = ref( [
//         { "id": 1, "category": "categoria1" },
//         { "id": 2, "category": "categoria3" },
//         { "id": 3, "category": "categoria4" },
//         { "id": 4, "category": "categoria2" },
//         { "id": 5, "category": "categoria5" },
//       ]
// )



export default {
  name: "MyBody",
  components: {
    MyAccordion,
    MyDasboard,
    MyModal
  },
  data() {
    return {
      status: true,
      // categories: [
      //   { "id": 1, "category": "categoria1" },
      //   { "id": 3, "category": "categoria3" },
      //   { "id": 4, "category": "categoria4" },
      //   { "id": 2, "category": "categoria2" },
      //   { "id": 5, "category": "categoria5" },
      // ],
      acessLevel: "admin",
    };
  },
};
</script>

<style scoped>
/* .my-body {
  background-color: #fff;
  padding: 0 7px 0 7px;
  min-height: 100svh;
} */

.todos-item {
  background-color: #efefef;
  margin: 0 0 5px 0;
  padding: 0.75rem 1.25rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.acordion .card {
  margin: 0 0 5px 0;
}

.list-button button {
  margin: 0 5px;
}
</style>
