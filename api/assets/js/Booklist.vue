<template>
    <div id="book-list">
        <search @empty-search="isEmptySearchUpdate"></search>
        <list-result v-bind:isEmptySearch="isEmptySearch" @empty-search="isEmptySearchUpdate"></list-result>
    </div>
</template>

<script>
    import Search from './components/Search'
    import ListResult from './components/ListResult'

    export default {
        name: "Booklist",
        data () {
            return {
                isEmptySearch: false
            }
        },
        components: {
            Search,
            ListResult
        },
        methods: {
            isEmptySearchUpdate: function (value) {
                this.isEmptySearch = value;
            }
        }
    }
</script>

<style scoped>

</style>
