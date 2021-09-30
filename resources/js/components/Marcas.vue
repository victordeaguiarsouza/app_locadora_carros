<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- inicio do card de busca -->
                <card-component titulo="Busca de Marcas">
                    <template v-slot:conteudo>
                         <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp" texto-ajuda="Opcional. Informe o Id da marca.">
                                    <input type="number" class="form-control" id="inputId" v-model="busca.id" aria-describedby="idHelp" placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input-container-component titulo="Nome" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional. Informe o nome da marca.">
                                    <input type="text" class="form-control" id="inputNome" v-model="busca.nome" aria-describedby="nomeHelp" placeholder="Nome">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary float-right" @click.prevent="pesquisar()">Pesquisar</button>
                    </template>
                </card-component>
                <!-- fim do card de busca -->

                <!-- inicio do card de marcas -->
                <card-component titulo="Relação de Marcas">
                    <template v-slot:conteudo>
                        <table-component :titulos="{
                            id         : {titulo: 'ID'             , tipo: 'text'},
                            nome       : {titulo: 'Nome'           , tipo: 'text'},
                            imagem     : {titulo: 'Imagem'         , tipo: 'img'},
                            created_at : {titulo: 'Data de Criação', tipo: 'date'},
                        }" :data="marcas.data"></table-component>
                    </template>

                    <template v-slot:rodape>

                       <paginate-component>
                            <li v-for="l,key in marcas.links" :key="key" :class="l.active ? 'page-item active' : 'page-item' " @click.prevent="paginacao(l)">
                                <a class="page-link" v-html="l.label"></a>
                            </li>
                       </paginate-component>
                       
                       <button type="submit" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalMarca">Adicionar</button>
                    
                    </template>
                </card-component>
                <!-- fim do card de marcas -->

            </div>
        </div>

        <modal-component id="modalMarca" titulo="Adicionar Marcas">

            <template v-slot:alertas>
                <alert-component :erros="erros" :mensagem="mensagem" :tipo="tipo" v-if="transacaoStatus"></alert-component>
            </template>

            <template v-slot:conteudo>

                <div class="form-group">
                    <div class="col-md-12 mb-3">
                        <input-container-component titulo="Nome" id="novoNome" id-help="novoNomeHelp" texto-ajuda="Informe o nome da marca.">
                            <input type="text" class="form-control" id="novoNome" aria-describedby="novoNomeHelp" placeholder="Nome" v-model="nomeMarca">
                        </input-container-component>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input-container-component titulo="Imagem" id="novaImagem" id-help="novaImagemHelp" texto-ajuda="Insira uma imagem.">
                            <input type="file" class="form-control-file" id="novaImagem" aria-describedby="novaImagemHelp" placeholder="Imagem" @change="carregarImagem($event)">
                        </input-container-component>
                    </div>
                </div>

            </template>

            <template v-slot:rodape>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>

        </modal-component>

    </div>
</template>

<script>
import Paginate from './Paginate.vue';
    export default {
  components: { Paginate },
        computed: {
            token() {
                
                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=');
                });

                return 'Bearer ' + token.split('=')[1];
            }
        },
        data() {
            return {
                nomeMarca: '',
                arquivoImagem: [],
                transacaoStatus: true,
                tipo: '',
                mensagem: '',
                erros: [],
                marcas: { data: [] },
                urlBase: 'api/v1/marca',
                busca: { 
                    id: '',
                    nome: '',
                },
            }
        },
        methods: {
            pesquisar(){

                let filtro = '';

                for(let chave in this.busca){

                    filtro += (filtro != '')? ';' : '';

                    filtro += chave +':like:'+this.busca[chave];

                }

            },
            paginacao(l){
                
                if(!l.url) return;

                this.urlBase = l.url;
                this.carregarLista(); 
            },
            carregarLista(){

                let config = {
                    headers: {
                        'Accept'        : 'application/json',
                        'Authorization' : this.token
                    }
                };

                axios.get(this.urlBase, config)
                    .then(response => {
                        this.marcas = response.data;
                    })
                    .catch(erros => {
                        console.log(erros);
                    });
            },
            carregarImagem(e){
                this.arquivoImagem = e.target.files;
            },
            salvar(){

                let formData = new FormData();
                let config = {
                    headers: {
                        'Content-Type'  : 'multipart/form-data',
                        'Accept'        : 'application/json',
                        'Authorization' : this.token
                    }
                };

                formData.append('nome', this.nomeMarca);
                formData.append('imagem', this.arquivoImagem[0]);

                axios.post(this.urlBase, formData, config)
                     .then(response => {
                        this.transacaoStatus = true;
                        this.tipo = 'success';
                        this.mensagem = 'Registro salvo com sucesso.';
                     })
                     .catch(erros => {
                        this.transacaoStatus = true;
                        this.tipo = 'danger';
                        this.mensagem = 'Falha ao salvar o registro.';
                        this.erros = erros.response.data.errors;
                        console.log(erros);
                     });
            }
        },
        mounted() {
            this.carregarLista();
        }
    }
</script>
