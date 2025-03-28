<template>
  <div class="accordion">
    <div
      v-for="(category, index) in categories"
      v-bind:key="index"
      class="card"
    >
      <div class="card-header flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
          <p @click="open(category)" class="mb-1"> 
            <b> 
              {{ category.name }} 
              <fa icon="plus" v-show="!category.is_open" /> 
              <fa icon="minus" v-show="category.is_open" /> 
            </b>
          </p>

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
        <small class="mb-1 description">{{ category.description }}</small>
      </div>

      <div v-show="category.is_open" class="card-body">
    
        <ul v-show="category.is_open" class="list-group list-group-flush">
          <li v-for="(subcategory, index) in category.subategories"
          v-bind:key="index" class="list-subcategory list-group-item flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <p class="mb-1" style="font-size: 14px; font-weight: 550;"> Sub{{ subcategory.name }}</p>
              <div class="list-button">
              
                  <span class="badge badge-primary badge-pill" title="Editar" style="font-size: 15px;">
                    <fa icon="edit" style="color:#0d6efd" />
                  </span>
              
                  <span class="badge badge-danger badge-pill" title="Excluir" style="font-size: 15px;">
                    <fa icon="trash" style="color:#dc3545" />
                  </span>
        
              </div>
            </div>
            <small class="mb-1" style="font-size: 0.775em"> {{ subcategory.description }}</small>
          </li>
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
import { ref } from "vue";
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

const categories = ref([]);
const pages = ref([]);
// const localCategory = [];

const axios = require("axios");

export default {
  name: "MyAccordion",
  components: {
    MyPagination,
  },
  data() {
    return {
      // categorias: localCategory,
      categories: categories,
      pages:pages,
      offset: 0,
      limit: 2,
      total: 5,
    };
  },
  mounted() {
    this.getCategories();
  },
  methods: {
    open(category) {
      /*this.categories.forEach(o => {
        o.is_open = o.id === category.id
      });*/
      category.is_open = !category.is_open
    },
    getCategories() {
      const API_URL = "http://localhost:8000/api";
      const url = `${API_URL}/categories?limit=${this.total}`;

      axios.get(url).then(({ data }) => {
        this.categories = data.data;
        this.pages = data.meta;

        this.categories = this.categories.map((item) => ({
          ...item,
          is_open: false,
        }));


        console.log(this.pages);
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
  /* font-weight: bold; */
}

.card-header:hover {
  background-color: #edeeee;
}

.card-header div:hover {
  cursor: pointer;
}

.card small {
  margin-top: 16px;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  overflow: hidden;
}


.card-header p {
  margin-top:0.25rem;
  display: -webkit-box;
  -webkit-line-clamp: 1;
  line-clamp: 1;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  overflow: hidden;
}

.card-body li {
  margin-top: 5px;
}
.card-body p {
  margin-top: 0.25rem
}

/* .single-item__texts {
  display: flex;
  flex-direction: column;
  gap: 5px;
}

.single-item__2lines {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  line-clamp: 2;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  overflow: hidden;
} */

/* @media (max-width: 768px) {
  .card.header{ 
    font-size: 9px;
  }
} */

/* @media (max-width: 480px) {

  .card-header {
    font-size: 7px;
  }

  .accordion {
    display: grid;
    grid-template-areas: "a a";
  }
} */


.list-button button {
  margin: 0 5px;
}

.card-body {
  padding: 5px 0 5px 0;
}

.list-subcategory {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 15px 0 15px;
}

.active {
  background: #e2e3e5 !important;
}
</style>
