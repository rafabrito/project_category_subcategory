<template>
  <div class="my-pagination">
    <button
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
    </button>
  </div>
</template>
<script>
// import { ref } from "vue";

// const is_active = ref(true);

export default {
  name: "MyPagination",
  props: {
    offset: {
      type: [String, Number],
      default: 0,
    },
    total: {
      type: [String, Number],
      required: true,
    },
    limit: {
      type: [String, Number],
      default: 10,
    },
  },
  computed: {
    showPrevious() {
      return this.current > 1;
    },
    showNext() {
      return this.total > this.limit * this.current;
    },
    current() {
      
      return this.offset ? this.offset + 1 : 1;
    },
    pages() {
      const qtd = Math.ceil(this.total / this.limit); // calcula para definir a quantidade de paginação

      if (qtd <= 1) return [1];

      return Array.from(Array(qtd).keys(), (i) => i + 1);
    },
  },
  methods: {
    changePage(offset) {
      this.$emit("change-page", offset);
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
