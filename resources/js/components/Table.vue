<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th v-for="t,key in titulos" :key="key" scope="col">{{t.titulo}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj,chave in dadosFiltrados" :key="chave">
                    <td v-for="valor,key in obj" :key="key">
                        <span v-if="titulos[key].tipo == 'text'">{{valor}}</span>
                        <span v-if="titulos[key].tipo == 'img'">
                            <img :src="'/storage/'+valor">
                        </span>
                        <span v-if="titulos[key].tipo == 'date'">{{valor | moment("D/MM/Y")}}</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        props: ['data','titulos'],
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
