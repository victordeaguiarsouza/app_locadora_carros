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
                        }" 
                        :data="marcas.data"
                        :visualizar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaVisualizar'}"
                        :editar="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaEditar'}"
                        :remover="{visivel: true, dataToggle: 'modal', dataTarget: '#modalMarcaRemover'}"
                        >
                        </table-component>
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

        <!-- inicio modal de cadastro de marca -->
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
        <!-- fim modal de cadastro de marca -->

        <!-- inicio modal de edição de marca -->
        <modal-component id="modalMarcaEditar" titulo="Editar Marca">

            <template v-slot:alertas>
                <alert-component v-if="$store.state.transacao.mensagem != ''" :tipo="tipo" :mensagem="$store.state.transacao.mensagem" ></alert-component>
            </template>

            <template v-slot:conteudo>

                <div class="form-group">
                    <div class="col-md-12 mb-3">
                        <input-container-component titulo="ID">
                            <input type="text" class="form-control" v-model="$store.state.item.id" disabled>
                        </input-container-component>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input-container-component titulo="Nome" id="editarNome" id-help="editarNomeHelp" texto-ajuda="Informe o nome da marca.">
                            <input type="text" class="form-control" id="editarNome" aria-describedby="editarNomeHelp" placeholder="Nome" v-model="$store.state.item.nome">
                        </input-container-component>
                    </div>
                    <div class="col-md-12 mb-3">
                        <input-container-component titulo="Imagem" id="editarImagem" id-help="editarImagemHelp" texto-ajuda="Insira uma imagem.">
                            <input type="file" class="form-control-file" id="editarImagem" aria-describedby="editarImagemHelp" placeholder="Imagem" @change="carregarImagem($event)">
                        </input-container-component>
                    </div>
                </div>

            </template>

            <template v-slot:rodape>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" @click="editar()">Salvar</button>
            </template>

        </modal-component>
        <!-- fim modal de edição de marca -->

        <!-- inicio modal de visualizacao de marca -->
        <modal-component id="modalMarcaVisualizar" titulo="Visualizar Marca">

            <template v-slot:alertas></template>

            <template v-slot:conteudo>
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>
                <input-container-component titulo="Nome">
                    <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
                </input-container-component>
                <input-container-component titulo="Data de criação">
                    <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
                </input-container-component>
                <input-container-component titulo="Imagem">
                    <img :src="'storage/'+$store.state.item.imagem" v-if="$store.state.item.imagem">
                </input-container-component>
            </template>

            <template v-slot:rodape>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </template>

        </modal-component>
        <!-- fim modal de visualizacao de marca -->

         <!-- inicio modal de remoção de marca -->
        <modal-component id="modalMarcaRemover" titulo="Remover Marca">

            <template v-slot:alertas>
                <alert-component v-if="$store.state.transacao.mensagem != ''" :tipo="tipo" :mensagem="$store.state.transacao.mensagem" ></alert-component>
            </template>

            <template v-slot:conteudo v-if="$store.state.transacao.status != 'sucesso'">
                <input-container-component titulo="ID">
                    <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                </input-container-component>
                <input-container-component titulo="Nome">
                    <input type="text" class="form-control" :value="$store.state.item.nome" disabled>
                </input-container-component>
            </template>

            <template v-slot:rodape>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button v-if="$store.state.transacao.status != 'sucesso'" type="button" class="btn btn-danger" @click="remover()">Remover</button>
            </template>

        </modal-component>
        <!-- fim modal de remoção de marca -->

    </div>
</template>

<script>
import InputContainer from './InputContainer.vue';
import Paginate from './Paginate.vue';
    export default {
  components: { Paginate, InputContainer },
        data() {
            return {
                urlBase: 'api/v1/marca',
                urlPaginacao: '',
                urlFiltro: '',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoStatus: true,
                tipo: '',
                mensagem: '',
                erros: [],
                marcas: { data: [] },
                busca: { 
                    id: '',
                    nome: '',
                },
            }
        },
        methods: {
            editar(){
                
                let config = {
                    headers: {
                        'Content-Type'  : 'multipart/form-data',
                    }
                };

                let formData = new FormData();
                
                formData.append('_method', 'patch');
                formData.append('nome', this.$store.state.item.nome);

                if(this.arquivoImagem[0]){ formData.append('imagem', this.arquivoImagem[0]); }
                
                let url = this.urlBase + '/'+this.$store.state.item.id;

                axios.post(url, formData, config)
                     .then(response => {

                        this.$store.state.transacao.status   = 'sucesso';
                        this.$store.state.transacao.mensagem = 'Registro salvo com sucesso.';
                        this.tipo = 'success';
                        editarImagem.value = '';
                        this.carregarLista();
                     })
                     .catch(erros => {
                        this.$store.state.transacao.status   = 'erro';
                        this.$store.state.transacao.mensagem = erros.response.data.erro;
                        this.$store.state.transacao.errors   = erros.response.data.errors;
                        this.tipo = 'danger';
                        console.log(erros.response.data);
                     });
            },
            remover(){

                let url = this.urlBase + '/'+this.$store.state.item.id;

                axios.delete(url)
                     .then(response => {

                        this.$store.state.transacao.status   = 'sucesso';
                        this.$store.state.transacao.mensagem = response.data.msg;
                        this.tipo = 'success';
                        this.carregarLista();
                     })
                     .catch(erros => {
                        this.$store.state.transacao.status   = 'erro';
                        this.$store.state.transacao.mensagem = erros.response.data.erro;
                        this.tipo = 'danger';
                        console.log(erros.response.data);
                     });

            },
            pesquisar(){

                let filtro = '';
                
                this.urlPaginacao = '';

                for(let chave in this.busca){

                    filtro += (filtro != '' && this.busca[chave] != '')? ';' : '';

                    filtro += (this.busca[chave])? chave +':like:'+this.busca[chave] : '';
                }
                
                this.urlFiltro = (filtro)? '&filtro='+filtro : '';

                this.carregarLista();
            },
            paginacao(l){
                
                if(!l.url) return;

                this.urlPaginacao = l.url.split('?')[1];
                this.carregarLista(); 
            },
            carregarLista(){

                let url = this.urlBase + '?' + this.urlPaginacao + this.urlFiltro

                axios.get(url)
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
