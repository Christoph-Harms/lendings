<template>
    <table class="table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Lent on</th>
                <th colspan="2">Due on</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="lending in lendings">
                <td>{{ lending.item.name }}</td>
                <td>{{ lending.created_at }}</td>
                <td>NEVUURRR!</td>
                <td>[Here be available options]</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['lendings']
    }
</script>