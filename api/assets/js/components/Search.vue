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
                    this.$store.commit('emptySearch', true);
                    this.$emit("done-editing")
                    return
                }

                this.$store.commit('emptySearch', false);
                fetch('/books/search/' + this.search)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                        this.$store.commit('change', data['searchResult'])
                        console.log(this.$store)
                    })
            }
        }
    }
</script>

<style scoped>


</style>
