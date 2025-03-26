<template>
  <div class="accordion">
    <div
      v-for="(category, index) in categories"
      v-bind:key="index"
      class="card"
    >
      <div class="card-header">
        <div @click="open(category)">{{ category.title }}</div>

        <div class="list-button">
          <button
            type="button"
            class="btn btn-warning btn-sm"
            title="Criar Subcategoria"
          >
            <fa icon="layer-group" />
          </button>
          <button type="button" class="btn btn-primary btn-sm" title="Editar">
            <fa icon="edit" />
          </button>
          <button type="button" class="btn btn-danger btn-sm" title="Excluir">
            <fa icon="trash" />
          </button>
        </div>
      </div>
      <div v-show="category.is_open" class="card-body">
        <ul v-show="category.is_open" class="list-group list-group-flush">
          <li class="list-group-item">{{ category.category.name }}</li>
        </ul>
      </div>
    </div>
  </div>

  <MyPagination
    v-if="categories.length"
    :offset="offset"
    :total="total"
    :limit="limit"
    @change-page="changePage"
  />
</template>

<script>
import MyPagination from "./MyPagination.vue";

// const categories = [
//         {
//             "id": 1,
//             "name": "Categoria 1",
//             "description": "Descrição da categoria 1",

//         },
//         {
//             "id": 2,
//             "name": "Categoria 2",
//             "description": "Descrição da categoria 2",
//         },
//         {
//             "id": 3,
//             "name": "Categoria 3",
//             "description": "Descrição da categoria 3",
//         },
//         {
//             "id": 4,
//             "name": "Categoria 4",
//             "description": "Descrição da categoria 4",
//         },
//         {
//             "id": 5,
//             "name": "Categoria 5",
//             "description": "Descrição da categoria 5",
//         }
//   ]

let localCategory = [];

const axios = require("axios");

export default {
  name: "MyAccordion",
  components: {
    MyPagination,
  },
  // data() {
  //   return {
  //     categories: localCategory,
  //   };
  // },
  // methods: {
  //   open(category){
  //     category.is_open = !category.is_open

  //   },
  // },
  data() {
    return {
      // categorias: localCategory,
      categories: [],
      offset: 0,
      limit: 2,
      total: 6,
    };
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    open(category) {
      category.is_open = !category.is_open;
    },
    getCategories() {
      const API_URL = "https://api.escuelajs.co/api";
      const url = `${API_URL}/v1/products?offset=${this.offset}&limit=${this.total}`;

      axios.get(url).then(({ data }) => {
        this.categories = data;

        localCategory = this.categories.map((item) => ({
          ...item,
          is_open: false,
        }));

        this.categories = localCategory;

        console.log(data);
      });
    },
    changePage(value) {
      this.offset = value;
      this.getCategories();
    },
  },
};
</script>

<style>
.accordion {
  margin-top: 40px;
  padding: 0;
}

.accordion .card {
  margin: 0 0 7px 0;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-weight: bold;
}

.card-header:hover {
  background-color: #edeeee;
}

.card-header div:hover {
  cursor: pointer;
}

.list-button button {
  margin: 0 5px;
}

.card-body {
  padding: 5px 0 5px 0;
}

.active {
  background: #e2e3e5 !important;
}
</style>
