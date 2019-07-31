<template>
    <div id="search" style="z-index: 100">
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
            </div>
            <input @input="fetchBooks" v-model="search" type="text" class="form-control" aria-label="Small"
                   aria-describedby="inputGroup-sizing-sm"/>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Search",
        data() {
            return {
                search: '',
            }
        },
        methods: {
            fetchBooks() {
                if(this.search === '') {
                    console.log('emptyStringSearch')
                    this.$emit('empty-search', true)
                    return
                }

                var headers = new Headers();
                headers.append('Authorization', this.$store.getters.getToken);

                var requestConfig = {
                    method: 'GET',
                    headers: headers
                };

                fetch('/api/books/search/' + this.search, requestConfig)
                    .then(response => response.json())
                    .then(data => {
                        this.$store.commit('change', data['searchResult'])
                        console.log('list books:' + this.$store.getters.getBookList)
                    })
            }
        }
    }
</script>

<style scoped>


</style>
