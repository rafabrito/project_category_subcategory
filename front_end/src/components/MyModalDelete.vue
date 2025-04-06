<template lang="">
    <div v-if="alertState" class="container-float">
        <div :class="'alert '+ background_color +' d-flex align-items-center alert-dismissible'" role="alert">
        <svg class="mr-2 bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <fa :icon="icon_alert" />
        </svg> 
        
        <div>
            {{ message}}
        </div>
        <button @click="closeAlert()" type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
            &times;
        </button>
        </div>
    </div>

    <button v-if="type === 'category'" @click="openCloseModal()" :class="'btn '+ color_button +' btn-sm'" :title="title">
        <fa :icon="icon_name" />
    </button>

    <span v-else @click="openCloseModal()" :class="'badge '+ color_button +' badge-pill delete'" :title="title">
        <fa :icon="icon_name" />
    </span>
    <div v-if="openClose" class="modal fade show" aria-label="true" role="dialog"
    style="display: block">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ title }}</h1>
                <button type="button" class="close" @click="openCloseModal()"  aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p v-if="type === 'category'">Tem certeza de que deseja excluir esta Categoria?</p>
                <p v-else >Tem certeza de que deseja excluir esta Subcategoria?</p>
            </div>
            <div class="modal-footer">
                <button @click="openCloseModal()" type="button" class="btn btn-secondary">Cancelar</button>
                <button @click="deleteItem(item_id)" type="button" class="btn btn-danger">Deletar</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import { ref } from 'vue';

let alertState = ref(false);
let timer = ref(null);
let countDown = 0;

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
        type: String,
        icon_name: String,
        color_button: String,
        visible: Boolean,
        item_id: Number,
        current_page: Number
    },
    data(){
        return {
            openClose: this.visible,
            countDown: countDown,
            alertState: alertState,
            message: '',
            icon_alert: '',
            color_background: '',
        }
    },
    methods: {
        openCloseModal() {
            this.openClose = !this.openClose;
        },
        closeAlert() {
            clearTimeout(timer.value);
            this.alertState = false;
        },
        async deleteItem(id) {

            if(this.type === 'category') {
                const url = `http://localhost:8000/api/categories/${id}`;
                
                
                await axios.delete(url, header).then(response => {
                    // this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                    this.openCloseModal();

                    // exibir mensagem de sucesso usando alert

                    console.log(response.data)

                    this.$emit("modalDone", this.current_page);
                    
                    // this.message = 'Categoria excluída com sucesso!';
                    // this.icon_alert = 'check-circle';
                    // this.background_color = 'alert-success';

                    // alertState.value = true;

                    // this.countDownTimerAlert();

                }, error => {
                    this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                    this.openCloseModal();

                    // exibir mensagem de erro usando alert
                    this.message = 'Ocorreu algum erro durante a Exclusão da Categoria!!';
                    this.icon_alert = 'exclamation-triangle';
                    this.background_color = 'alert-danger';

                    alertState.value = true;

                    this.countDownTimerAlert();
                    console.log(error)
                });
            } else {
                const url = `http://localhost:8000/api/subcategories/${id}`;
                
                
                await axios.delete(url, header).then(response => {
                    // this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos


                    this.openCloseModal();


                    console.log(response.data)

                    this.$emit("modalDone", this.current_page);
                    

                    // this.message = 'Subcategoria excluída com sucesso!';
                    // this.icon_alert = 'check-circle';
                    // this.background_color = 'alert-success';

                    // alertState.value = true;

                    // this.countDownTimerAlert();
                }, error => {
                    this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                    this.openCloseModal();

                    // exibir mensagem de erro usando alert
                    this.message = 'Ocorreu algum erro durante a Exclusão da Subcategoria!!';
                    this.icon_alert = 'exclamation-triangle';
                    this.background_color = 'alert-danger';

                    alertState.value = true;

                    this.countDownTimerAlert();

                    console.log(error)
                });
            }
        },
        countDownTimerAlert () {
            if (this.countDown > 0) {
                timer.value = setTimeout(() => {
                    this.countDown -= 1
                    this.countDownTimerAlert()
                    console.log(this.countDown)
                }, 1000)
            } else {
                clearTimeout(timer.value);
                alertState.value = false;
            }
        }
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
.badge-pill.delete:hover {
    cursor: pointer;
    color: #fff;
    background-color: #c82333;
    border-color: #bd2130;
}
</style>