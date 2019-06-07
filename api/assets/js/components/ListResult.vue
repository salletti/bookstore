<template>
    <div id="list-result">
        {{ reset }}
        <p>Total: {{ $store.getters.countBooks }} books. </p>
        <table class="table">
            <tr>
                <th>
                    #Title
                </th>
                <th>
                    #Author
                </th>
                <th>
                    #Actions
                </th>
            </tr>
            <tr v-for="b in $store.getters.getBookList" v-bind:key="b.id">
                <td>
                    <div class="book-title">
                        {{ b.title }}
                    </div>
                </td>
                <td>
                    {{ b.author }}
                </td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                    <a v-bind:href="'/book/'+ b.id">
                        <button class="btn btn-primary"> View</button>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        name: "List",
        created() {
            console.log('List created');
            this.fetchBooks()

        },
        computed: {
            reset() {
                if (this.$store.getters.isEmptySearch === true) {
                    this.fetchBooks()
                }
            }
        },
        methods: {
            fetchBooks() {
                console.log('fetch books');
                fetch('/books')
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        this.$store.commit('change', data['hydra:member'])
                        console.log(this.$store.getters.getBookList)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
