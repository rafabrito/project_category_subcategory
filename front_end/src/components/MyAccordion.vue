<template>

  <div class="accordion"> 
    <div v-if="typeData === 'categories' || typeData === ''"> 
    <div
      v-for="(category, index) in categories.data"
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
            <!-- <button type="button" class="btn btn-warning btn-sm" title="Criar Subcategoria">
              <fa icon="layer-group" />
            </button> -->
            <!-- <button type="button" class="btn btn-primary btn-sm" title="Editar">
              <fa icon="edit" />
            </button>
            
            <button type="button" class="btn btn-danger btn-sm" title="Excluir">
              <fa icon="trash" />
            </button>
            
            -->
            <!-- Modal para Cadastro de Subcategoria -->
            <MyModalCreate 
              :id="category.id"
              title="Cadastrar Subcategoria" 
              type="subcategory" 
              icon_name="tags" 
              color_button="btn-warning"
              :visible="false"
              @modalDone="refreshCategories"
              />

            <!-- Modal para Editar Categoria -->
            <MyModalEdit
              title="Editar Categoria" 
              icon_name="edit"
              type="category" 
              color_button="btn-primary"
              :visible="false"
              :itemObj=category
              :current_page="categories.current_page"
              @modalDone="refreshCategories"
            />

            <!-- Modal para Deletar Categoria -->
            <MyModalDelete
              title="Deletar Categoria"
              type="category" 
              icon_name="trash" 
              color_button="btn-danger"
              :visible="false"
              :item_id=category.id
              :current_page="categories.current_page"
              @modalDone="refreshCategories"
            />
            
            
          </div>
        </div>
        <small class="mb-1 description">{{ category.description }}</small>
      </div>

      <div v-show="category.is_open" class="card-body">
    
        <ul v-if="category.subcategories.length != 0" v-show="category.is_open" class="list-group list-group-flush">
          <li v-for="(subcategory, index) in category.subcategories"
          v-bind:key="index" class="list-subcategory list-group-item flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <p class="mb-1" style="font-size: 14px; font-weight: 550;"> Sub{{ subcategory.name }}</p>
              <div class="list-button">
              
                  <!-- Modal para Editar Categoria -->
                  <MyModalEdit
                    title="Editar Subcategoria" 
                    icon_name="edit"
                    type="subcategory" 
                    color_button="badge-primary"
                    :visible="false"
                    :itemObj=subcategory
                    :current_page="categories.current_page"
                    @modalDone="refreshCategories"
                  />
              
                <!-- Modal para Deletar Subcategoria -->
                <MyModalDelete
                  title="Deletar Subcategoria"
                  type="subcategory" 
                  icon_name="trash" 
                  color_button="badge-danger"
                  :visible="false"
                  :item_id=subcategory.id
                  :current_page="categories.current_page"
                  @modalDone="refreshCategories"
                />
        
              </div>
            </div>
            <small class="mb-1" style="font-size: 0.775em"> {{ subcategory.description }}</small>
          </li>
        </ul>

        <ul v-else class="list-group list-group-flush" role="alert">
          <li class="list-subcategory list-group-item flex-column align-items-center text-danger fw-bolder fs-6">
            <p style="font-size:14px">Não existem Subcategorias cadastradas ainda.</p>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div v-else> 
    Colocar listagem subcategorias
  </div>
</div>

</template>

<script>
// import MyPagination from "./MyPagination.vue";
// import axios from 'axios';
// import { reactive } from "vue";
import MyModalCreate from "./MyModalCreate.vue";
import MyModalEdit from "./MyModalEdit.vue";
import MyModalDelete from "./MyModalDelete.vue";

export default {
  name: "MyAccordion",
  components: {
    MyModalCreate,
    MyModalEdit,
    MyModalDelete,
  },
  props: {
    categories: {
      type: Object,
      required: true
    },
    typeData: {String}
  },
  // data() {
  //   return {
      
  //   };
  // },
  methods: {
    open(category) {
      category.is_open = !category.is_open
    },
    refreshCategories(page) {
      this.$emit("paginate", page);
    //   this.categories.current_page = page;

    //   const url = `http://localhost:8000/api/categories?page=${this.categories.current_page}`;

    //   // axios.get(url).then(({ data }) => {
    //   //   this.categories = data.data;

    //   //   this.pagination = {
    //   //     links: data.data.links,
    //   //     meta: data.data.meta,
    //   //   };

    //   //   this.categories = this.categories.map((item) => ({
    //   //     ...item,
    //   //     is_open: false,
    //   //   }));


    //   //   // console.log(this.pages);
    //   // });

    //   axios.get(url).then(response => {
    //     this.categories = response.data;
        
    //     this.categories.data = this.categories.data.map((item) => ({
    //       ...item,
    //       is_open: false,
    //     }));

    //     console.log(this.categories)
        
    //   }, error => {
    //     console.log(error)
    //   });
      
    // },
    // changePage(value) {
    //   this.offset = value;
    //   this.getCategories();
      // console.log(categories)
    }
  },
};
</script>

<style>
.accordion {
  margin-top: 20px;
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
  margin-bottom: 0;
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
  margin: 0 2px 0 2px;;
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

.container-float {
  position:fixed; 
  top: 0px; 
  left: 0px; 
  width: 100%;
  z-index:9999; 
}
</style>
