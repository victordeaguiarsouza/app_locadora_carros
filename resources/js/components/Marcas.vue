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
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input-container-component titulo="Nome" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional. Informe o nome da marca.">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome">
                                </input-container-component>
                            </div>
                        </div>
                    </template>

                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary float-right">Pesquisar</button>
                    </template>
                </card-component>
                <!-- fim do card de busca -->

                <!-- inicio do card de marcas -->
                <card-component titulo="Relação de Marcas">
                    <template v-slot:conteudo>
                        <table-component :data="marcas"></table-component>
                    </template>

                    <template v-slot:rodape>
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
    export default {
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
                marcas: [],
            }
        },
        methods: {  
            carregarLista(){

                let config = {
                    headers: {
                        'Accept'        : 'application/json',
                        'Authorization' : this.token
                    }
                };

                axios.get('api/v1/marca',config)
                    .then(response => {
                        this.marcas = response.data;
                        console.log(this.marcas); 
                    })
                    .catch(erros => {
                        console.log(erros);
                    });;
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

                axios.post('api/v1/marca', formData, config)
                     .then(response => {
                         
                        this.transacaoStatus = true;
                        this.tipo = 'success';
                        this.mensagem = 'Registro salvo com sucesso.';

                        //console.log(response);
 
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
