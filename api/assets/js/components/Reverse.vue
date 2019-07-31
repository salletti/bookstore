<template>
    <div id="app1">
        <p>{{ message }}
            <button v-on:click="reverseMessage">
                Message retourné
            </button>
        </p>
    </div>
</template>

<script>
    export default {
        name: "Reverse",
        data: function () {
            return {
                message: 'Ciao Ciao'
            };
        },
        methods: {
            reverseMessage: function () {
                this.message = this.message.split('').reverse().join('')
            }
        }

    }
</script>

<style scoped>

</style>
