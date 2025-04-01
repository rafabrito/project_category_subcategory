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

            <!-- Modal para Cadastro de Categoria -->
            <MyModalCreate 
              :id="null"
              title="Cadastrar Categoria" 
              type="category" 
              icon_name="plus-circle" 
              color_button="btn-success"
              :visible="false"
              @paginate="getCategories"
              />
          </div>
        </div>

        <!-- Lista no formato accordion das Categorias e Subcategorias-->
        <MyAccordion :categories="categories" @paginate="getCategories"/>

        <MyPagination
          :pagination="categories"
          @paginate="getCategories"
          :offset="offset"
        />      
      </div>
    </template>
  </MyDasboard>
</template>

<script>
import MyDasboard from "./MyDasboard.vue";
import MyAccordion from "./MyAccordion.vue";
import MyPagination from "./MyPagination.vue";
import MyModalCreate from "./MyModalCreate.vue";
import { reactive } from "vue";
import axios from 'axios';


const categories = reactive({ total: 0, per_page: 5, from: 1, to: 0, current_page: 1, data:[]});

export default {
  name: "MyBody",
  components: {
    MyDasboard,
    MyAccordion,
    MyPagination,
    MyModalCreate,
  },
  data() {
    return {
      categories: categories,
      offset: 5,
    };
  },
  created () {
    this.getCategories();
  },
  methods: {
    async getCategories(page) {
      this.categories.current_page = page;

      const url = `http://localhost:8000/api/categories?page=${this.categories.current_page}`;

      axios.get(url).then(response => {
        this.categories = response.data;
        
        this.categories.data = this.categories.data.map((item) => ({
          ...item,
          is_open: false,
        }));

        // console.log(this.categories)
        
      }, error => {
        console.log(error)
      });
      
    },
  }
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
