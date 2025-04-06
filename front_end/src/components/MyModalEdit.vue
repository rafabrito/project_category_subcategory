<template lang="">
    <div v-if="alertState" class="container-float">
        <div :class="'alert '+ background_color +' d-flex align-items-center alert-dismissible'" role="alert">
            <svg class="mr-2 bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <fa :icon="icon_alert" />
            </svg> 
            
            <div>
                {{ message }}
            </div>
            <button @click="closeAlert()" type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                &times;
            </button>
        </div>
    </div>
    
    <button v-if="type === 'category'" @click="openCloseModal()" :class="'btn '+color_button+' btn-sm'" :title="title">
        <fa :icon="icon_name" />
    </button>

    <span v-else @click="openCloseModal()" :class="'badge '+color_button+' badge-pill edit'" :title="title">
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
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <div :class="{ error: v.name.$errors.length }">
                            <input v-model="formEdit.name" type="text" class="form-control" id="name" placeholder="Digite o nome da Categoria">
                            <div class="input-errors" v-for="error of v.name.$errors" :key="error.$uid">
                                <span class="error-msg" style="color:#721c24"> Nome é obrigatório</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descrição:</label>
                        <div :class="{ error: v.description.$errors.length }">
                            <textarea v-model="formEdit.description" class="form-control" id="description"></textarea>
                            <div class="input-errors" v-for="error of v.description.$errors" :key="error.$uid">
                                <span class="error-msg" style="color:#721c24"> Descrição é obrigatória</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="mb-3 div-subcategory">
                        <label for="message-text" class="col-form-label">Cadastrar Subcategoria:</label>
                        <button class="btn btn-primary btn-subcategory"><fa icon="plus" /> </button>
                    </div> -->
                </form>
                
            </div>
            <div class="modal-footer">
                <button @click="openCloseModal()" type="button" class="btn btn-secondary">Cancelar</button>
                <button @click="edit(itemObj.id)" type="button" class="btn btn-primary">Salvar</button>
            </div>
            </div>
        </div>
    </div>
</template>
<script>
import useVuelidate from '@vuelidate/core';
import { required } from '@vuelidate/validators';
import axios from 'axios';
import { reactive, ref } from 'vue';

let alertState = ref(false);
let timer = ref(null);
let countDown = ref(0);

let formEdit = reactive({
    'name': '',
    'description': ''
});

let header = {
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  }
}

const  rules = {
    name: { required },
    description: { required }
};

const v$ = useVuelidate(rules, formEdit);


export default {
    name: "MyModalEdit",
    props: {
        title: String,
        type: String,
        icon_name: String,
        color_button: String,
        visible: Boolean,
        itemObj: Object,
        current_page: Number
    },
    data(){
        return {
            formEdit: formEdit,
            v: v$,
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
            if(this.openClose) {
                formEdit.name =  this.itemObj.name;
                formEdit.description = this.itemObj.description;
            }
        },
        closeAlert() {
            clearTimeout(timer.value);
            this.alertState = false;
        },
        async edit(id) {

            const result = await v$.value.$validate();

            if(this.type === 'category'){
                if(result) {
                    const url = `http://localhost:8000/api/categories/${id}`;
                    
                    
                    axios.patch(url, formEdit, header).then(response => {

                        this.openCloseModal();

                        // exibir mensagem de sucesso usando alert

                        console.log(response.data)

                        this.$emit("modalDone", this.current_page);
                        
                    }, error => {
                        this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                        this.openCloseModal();

                        // exibir mensagem de erro usando alert
                        this.message = 'Ocorreu algum erro durante a Edição da Categoria!!';
                        this.icon_alert = 'exclamation-triangle';
                        this.background_color = 'alert-danger';

                        alertState.value = true;

                        this.countDownTimerAlert();

                        console.log(error);
                    });
                }
            } else {
                const url = `http://localhost:8000/api/subcategories/${id}`;
                    
                    
                axios.patch(url, formEdit, header).then(response => {

                    this.openCloseModal();

                    // exibir mensagem de sucesso usando alert

                    console.log(response.data)

                    this.$emit("modalDone", this.current_page);
                    
                }, error => {
                    this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                        this.openCloseModal();

                        // exibir mensagem de erro usando alert
                        this.message = 'Ocorreu algum erro durante a Edição da Subcategoria!!';
                        this.icon_alert = 'exclamation-triangle';
                        this.background_color = 'alert-danger';

                        alertState.value = true;

                        this.countDownTimerAlert();

                        console.log(error);
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

.badge-pill {
  border-radius: 0.2rem;
  font-size: 13px;
  padding: 0.35rem 0.4rem;
  margin: 0 1px 0 1px;
}

.badge-pill.edit:hover {
    cursor: pointer;
    color: #fff;
    background-color: #0069d9;
    border-color: #0062
}

/* span .badge-pill:hover {
    cursor: pointer;
    background-color: aqua;
} */
</style>