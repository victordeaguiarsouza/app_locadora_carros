<template>
    <div :class="estilo" role="alert">
        {{mensagem}}
        <ul v-if="erros">
            <li v-for="e, key in erros" :key="key">
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