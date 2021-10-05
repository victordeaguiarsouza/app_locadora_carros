<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th v-for="t,key in titulos" :key="key" scope="col">{{t.titulo}}</th>
                    <th v-if="visualizar.visivel || editar.visivel || remover.visivel"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj,chave in dadosFiltrados" :key="chave">
                    <td v-for="valor,key in obj" :key="key">
                        <span v-if="titulos[key].tipo == 'text'">{{valor}}</span>
                        <span v-if="titulos[key].tipo == 'img'">
                            <img :src="'/storage/'+valor">
                        </span>
                        <!-- <span v-if="titulos[key].tipo == 'date'">{{valor | moment("D/MM/Y")}}</span> -->
                        <span v-if="titulos[key].tipo == 'date'">{{valor | formatarDataTempoGlobal }}</span>
                    </td>
                    <td>
                        <button v-if="visualizar.visivel" @click="setStore(obj)" class="btn btn-outline-primary btn-sm" :data-toggle="visualizar.dataToggle" :data-target="visualizar.dataTarget">
                            <i class="fas fa-search"></i>
                        </button>
                        <button v-if="editar.visivel" @click="setStore(obj)" class="btn btn-outline-success btn-sm" :data-toggle="editar.dataToggle" :data-target="editar.dataTarget">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button v-if="remover.visivel" @click="setStore(obj)" class="btn btn-outline-danger btn-sm"  :data-toggle="remover.dataToggle" :data-target="remover.dataTarget">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        props: ['data','titulos','visualizar', 'editar', 'remover'],
        methods:{
            setStore(obj){
                this.$store.state.transacao.status   = '';
                this.$store.state.transacao.mensagem = '';
                this.$store.state.transacao.errors   = '';

                this.$store.state.item = obj;
            }
        },
        computed: {
            dadosFiltrados(){

                let campos = Object.keys(this.titulos);
                let dadosFiltrados = [];

                this.data.map((item, chave) => {
                    
                    let itemFiltrado = {};
                    
                    campos.forEach(campo =>{
                        itemFiltrado[campo] = item[campo]
                    });

                    dadosFiltrados.push(itemFiltrado);
                })
                return dadosFiltrados;
            }
        }
    }
</script>
