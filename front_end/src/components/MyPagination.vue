<template>
  <!-- <div class="my-pagination"> -->
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li v-if="pagination.current_page > 1" class="page-item">
          <a class="page-link" href="#" aria-label="Anterior" @click.prevent="changePage(pagination.current_page - 1)">«</a>
        </li>
        
        <li 
          v-for="(page, index) in pagesNumber" 
          :class="['page-item', {active: page == pagination.current_page}]" 
          :key="index">
          <a class="page-link" href="#" @click.prevent="changePage(page)">
            {{ page }}
          </a>
        </li>
        
        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
          <a class="page-link" href="#" aria-label="Próximo" @click.prevent="changePage(pagination.current_page + 1)">»</a>
        </li>
      </ul>
    </nav>
    <!-- <button
      v-if="showPrevious"
      class="item prev btn btn-light"
      @click="changePage(current - 1)"
    >
      <fa icon="angles-left" />
    </button>
    <button
      v-for="(page, index) in pages"
      :key="page"
      class="item btn btn-light"
      :class="{ current: page === current }"
      @click="changePage(index)"
    >
      {{ page }}
    </button>
    <button
      v-if="showNext"
      class="item next btn btn-light"
      @click="changePage(current + 1)"
    >
      <fa icon="angles-right" />
    </button> -->
  <!-- </div> -->
</template>
<script>
// import { ref } from "vue";

// const is_active = ref(true);

export default {
  name: "MyPagination",
  props: {
    // offset: {
    //   type: [String, Number],
    //   default: 0,
    // },
    // total: {
    //   type: [String, Number],
    //   required: true,
    // },
    // limit: {
    //   type: [String, Number],
    //   default: 10,
    // },
    pagination: {
      type: Object,
      required: true
    },
    offset: {
      type: Number,
      default: 4,
    },
  },
  computed: {
    pagesNumber() {
      if(!this.pagination.to) {
        return [];
      }

      // Definição da próxima página
      let from = this.pagination.current_page - this.offset;

      if(from < 1) {
        from = 1;
      }

      // Definção da última página
      let to = from + this.offset;

      if(to >= this.pagination.last_page) {
        to = this.pagination.last_page
      }

      let listPages = [];

      for(let page = from; page <= to; page++){
        listPages.push(page);
      }

      return listPages;
    },
    // showPrevious() {
    //   return this.current > 1;
    // },
    // showNext() {
    //   return this.total > this.limit * this.current;
    // },
    // current() {
      
    //   return this.offset ? this.offset + 1 : 1;
    // },
    // pages() {
    //   const qtd = Math.ceil(this.total / this.limit); // calcula para definir a quantidade de paginação

    //   if (qtd <= 1) return [1];

    //   return Array.from(Array(qtd).keys(), (i) => i + 1);
    // },
  },
  methods: {
    changePage(page) {
      // page_url = page_url || 'api/categories'
      // this.$http.get(page_url)
      // Atualiza a página atual
      // this.pagination.current_page = page;

      // Dispara o evento @paginate do Componente Pai (Accordion)
      this.$emit("paginate", page);
    },
  },
};
</script>
<style scoped>
.my-pagination {
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn {
  border-color: #dee2e6;
  margin: 1px;
}

.current {
  background-color: #0d6efd !important;
  color: #fff;
  border-color: #0d6efd;
}
</style>
