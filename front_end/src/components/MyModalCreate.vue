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
        <fa :icon="icon_name" /> {{ title }}
    </button>
    <button v-else @click="openCloseModal()" :class="'btn '+color_button+' btn-sm'" :title="title">
        <fa :icon="icon_name" />
    </button>

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
                    <input v-if="id != null" v-model="form.category_id" type="hidden"/>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nome:</label>
                        <div :class="{ error: v.name.$errors.length }">
                            <input v-if="type === 'category'" v-model="form.name" type="text" class="form-control" id="name" placeholder="Digite o nome da Categoria">
                            <input v-else v-model="form.name" type="text" class="form-control" id="name" placeholder="Digite o nome da Subcategoria">
                            <div class="input-errors" v-for="error of v.name.$errors" :key="error.$uid">
                                <span class="error-msg" style="color:#721c24"> Nome é obrigatório</span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Descrição:</label>
                        <div :class="{ error: v.description.$errors.length }">
                            <textarea v-model="form.description" class="form-control" id="description"></textarea>
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
                <button @click="create()" type="button" class="btn btn-primary">Cadastrar</button>
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
let countDown = 0;

let header = {
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
  }
};

let form = reactive({
    category_id: '', 
    name: '', 
    description: '',
});

const  rules = {
    name: { required },
    description: { required }
}

const v$ = useVuelidate(rules, form);

export default {
    name: "MyModalCreate",
    props: {
        id: Number,
        title: String,
        type: String,
        icon_name: String,
        color_button: String,
        visible: Boolean
    },
    data(){
        return {
            form: form,
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
            if(!this.openClose && this.id == null) {
                form.name = '';
                form.description = '';
            } else {
                form.category_id = '';
                form.name = '';
                form.description = '';
            }

            if(!this.openClose && v$.value.$error) {
                v$.value.$reset(); // reseta os avisos de erro de campo obrigatório, caso existam
            }

            if(this.openClose && this.id != null) {
                form.category_id = this.id
            }
        },
        closeAlert() {
            clearTimeout(timer.value);
            this.alertState = false;
        },
        async create() {
            const result = await v$.value.$validate(); // valida se os campos nome e descrição foram preenchidos

            if(result && this.type === 'category') {
                const url = 'http://localhost:8000/api/categories';
                
                
                axios.post(url, form, header).then(response => {

                    form.name = '';
                    form.description = '';
                    this.openCloseModal();

                    this.$emit("paginate");

                    console.log(response.data)
                    
                }, error => {
                    this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                    this.openCloseModal();

                    // exibir mensagem de erro usando alert
                    this.message = 'Ocorreu algum erro ao Cadastrar a Categoria!!';
                    this.icon_alert = 'exclamation-triangle';
                    this.background_color = 'alert-danger';

                    alertState.value = true;

                    this.countDownTimerAlert();

                    console.log(error)
                });
            } else if(result && this.type === 'subcategory') {
                const url = 'http://localhost:8000/api/subcategories';
                
                
                axios.post(url, form, header).then(response => {

                    form.name = '';
                    form.description = '';
                    this.openCloseModal();

                    this.$emit("modalDone");

                    console.log(response.data)
                    
                }, error => {
                    this.countDown = 10; // definir o tempo de exibição do alerta para 10 segundos

                    this.openCloseModal();

                    // exibir mensagem de erro usando alert
                    this.message = 'Ocorreu algum erro durante ao Cadastrar a Subcategoria!!';
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