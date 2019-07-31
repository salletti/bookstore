<template>
    <div id="list-result">
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
        props: ['isEmptySearch'],
        created() {
            console.log('List created');
            this.fetchBooks()

        },
        watch: {
            isEmptySearch: function() {
                console.log('isEmptySearch: ' + this.isEmptySearch)
                if (this.isEmptySearch === true) {
                    this.fetchBooks()
                }
            }
        },
        methods: {
            fetchBooks() {

                var headers = new Headers();
                headers.append('Authorization', this.$store.getters.getToken);

                var requestConfig = {
                    method: 'GET',
                    headers: headers
                };

                fetch('/api/books', requestConfig)
                    .then(response => response.json())
                    .then(data => {this.$store.commit('change', data['hydra:member'])
                        console.log('list books:' + this.$store.getters.getBookList)
                        this.$emit("empty-search", false)
                    })
            }
        }
    }
</script>

<style scoped>

</style>
