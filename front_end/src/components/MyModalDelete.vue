<template lang="">
    <button @click="openCloseModal()" :class="'btn '+color_button+' btn-sm'" :title="title">
        <fa :icon="icon_name" />
    </button>
    <div v-if="openClose" class="modal fade show" aria-label="true" role="dialog"
    style="display: block">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ title }}</h1>
                <button type="button" class="btn-close" @click="openCloseModal()"  aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir esta categoria?</p>
            </div>
            <div class="modal-footer">
                <button @click="openCloseModal()" type="button" class="btn btn-secondary">Cancelar</button>
                <button @click="deleteItem(category_id)" type="button" class="btn btn-danger">Deletar</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';


let header = {
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  }
}


export default {
    name: "MyModalDelete",
    props: {
        title: String,
        icon_name: String,
        color_button: String,
        visible: Boolean,
        category_id: Number,
        current_page: Number
    },
    data(){
        return {
            openClose: this.visible,
        }
    },
    methods: {
        openCloseModal() {
            this.openClose = !this.openClose;
        },
        async deleteItem(id) {
            const url = `http://localhost:8000/api/categories/${id}`;
            
            
            await axios.delete(url, header).then(response => {

                this.openCloseModal();

                // exibir mensagem de sucesso usando alert

                console.log(response.data)

                this.$emit("modalDone", this.current_page);
                
            }, error => {
                // exibir mensagem de erro usando alert
                console.log(error)
            });
        
        },
    }, 
    watch: {
        visible: function(newValue, oldValue) {
            this.openClose = newValue;
            console.log('novo ' + newValue + ' == ' + oldValue);
        }
    }
}
</script>

<style>

</style>