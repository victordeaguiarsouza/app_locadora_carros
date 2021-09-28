<template>
    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="d in data" :key="d.id">
                    <th scope="row">{{d.id}}</th>
                    <td>{{d.nome}}</td>
                    <td><img :src="'/storage/'+d.imagem" width="30"></td>
                </tr>
            </tbody>
        </table>
    </div>

</template>

<script>
    export default {
        props: ['data']
    }
</script>
