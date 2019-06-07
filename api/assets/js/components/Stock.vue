<template>
    <div id="stock">
        <div v-if="book.stock === 0">
            <div class="alert alert-danger" role="alert">
                Out of Stock!!
            </div>
        </div>
        <div v-else>
            {{ book.stock }} {{ message }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Stock',
        props: ['book'],
        data() {
            return {
                message: 'copies available'
            }
        },
        created() {
            console.log('Stock.vue ' + this.book.id);

            const u = new URL('http://localhost:1337/hub');
            u.searchParams.append('topic', 'https://localhost:8443/books/' + this.book.id);

            const es = new EventSource(u);
            es.onmessage = e => {
                console.log('data: ');
                console.log(JSON.parse(e.data));

                const book = JSON.parse(e.data);

                console.log('stock: ' + book.stock);

                this.book.stock = book.stock;
            }
        }
    }
</script>

<style scoped>

</style>
