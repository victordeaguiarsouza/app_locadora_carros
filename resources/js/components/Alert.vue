<template>
    <div :class="estilo" role="alert">
        {{mensagem}}
        <ul v-if="$store.state.transacao.errors != ''">
            <li v-for="e, key in $store.state.transacao.errors" :key="key">
                {{e[0]}}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['tipo', 'mensagem','erros'],
        computed: {
            estilo(){
                return 'alert alert-' + this.tipo;
            }
        }
    }
</script>