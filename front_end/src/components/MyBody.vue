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

        <!-- Campos para filtragem das Categorias e das Subcategorias -->
        <div class="form-inline">
          <div class="form-group mb-2">
          <select v-model="filter.typeFilter" @change="typeFilter($event)" class="form-control" id="typeFilter">
            <option value="" selected>Filtrar por</option>
            <option value="categories">Categorias</option>
            <option value="subcategories">Subcategorias</option>
          </select>
          </div>
          <div class="form-group mx-sm-3 mb-2">
            <input @keyup="onKeyup()" v-model="filter.textFilter" type="text" class="form-control" id="textFilter" placeholder="Pesquisar">
          </div>
        </div>

        <!-- Lista no formato accordion das Categorias e Subcategorias sem filtro-->
        <MyAccordion v-if="JSON.stringify(dataFilter) === '{}'"
          :typeData="'categories'"
          :categories="categories" 
          @paginate="getCategories"
        />

        <MyPagination v-if="JSON.stringify(dataFilter) === '{}'"
          :pagination="categories"
          @paginate="getCategories"
          :offset="offset"
        />

        <!-- Lista no formato accordion das Categorias e Subcategorias com filtro-->
        <MyAccordion v-if="JSON.stringify(dataFilter) != '{}'"
          :typeData="filter.typeFilter"
          :categories="dataFilter" 
          @paginate="getCategories"
        />

        <MyPagination v-if="JSON.stringify(dataFilter) != '{}'"
          :pagination="dataFilter"
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
import { debounce } from '@/utilities/debounce';
import axios from 'axios';

const categories = reactive({ total: 0, per_page: 5, from: 1, to: 0, current_page: 1, data:[]});
const filter = reactive({ typeFilter: '', textFilter: ''});
let dataFilter = reactive({ total: 0, per_page: 5, from: 1, to: 0, current_page: 1, data:[]});

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
      filter: filter,
      dataFilter: dataFilter,
      debounceFilter: null
    };
  },
  created () {
    this.getCategories();
  },
  mounted(){
    this.debounceFilter = debounce(() => this.textFilter(), 800)
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
    async typeFilter(){
      if(filter.typeFilter != '') {
        const url = `http://localhost:8000/api/filter`;

        await axios.post(url, this.filter).then( response => {
          this.dataFilter = response.data;
          console.log(response);

          // this.pagination = {
          //   links: data.data.links,
          //   meta: data.data.meta,
          // };
        }, error => {
            console.log(error)
        });
      }

    },
    onKeyup() {
      this.debounceFilter()
    },
    async textFilter() {
      if(filter.typeFilter != '') {
        const url = `http://localhost:8000/api/filter`;

        await axios.post(url, this.filter).then( response => {
          this.dataFilter = response.data;
          console.log(response);

          // this.pagination = {
          //   links: data.data.links,
          //   meta: data.data.meta,
          // };
        }, error => {
            console.log(error)
        });
      }
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

.form-inline{
  margin-top: 20px;
  flex-direction: row-reverse
} 
</style>
