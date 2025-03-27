<template lang="">
    <div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <input v-model="form.name" type="text" class="form-control" id="name" placeholder="Digite o nome da Categoria">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descrição:</label>
                        <textarea v-model="form.description" class="form-control" id="description"></textarea>
                    </div>
                    <div class="mb-3 div-subcategory">
                        <label for="message-text" class="col-form-label">Cadastrar Subcategoria:</label>
                        <button class="btn btn-primary btn-subcategory"><fa icon="plus" /> </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button @click="create" type="button" class="btn btn-primary">Cadastrar</button>
            </div>
            </div>
        </div>
        </div>
</template>
<script>
import axios from 'axios';
import { reactive } from 'vue';

const form = reactive({
    name: '',
    description: '',
});

export default {
    name: "MyModal",
    props: {
        title: String,
        type: String
    },
    data(){
        return {
            form: form,
        }
    },
    methods: {
        create() {
            
            axios.post("/api/categories", form);
        }
    }
}
</script>

<style>

.div-subcategory {
    display: flex;
    align-items: center;
}
.btn-subcategory {
    width: 23px;
    height: 23px;
    border-radius: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 5px;
    font-size:14px;
}
</style>