<template>
    <div id="router-app">
        <nav class="navbar navbar-dark bg-primary">
            <router-link to='/' class="navbar-brand">Profile</router-link>
            <router-link to='/login' class="navbar-brand" v-if="!this.$store.getters.isAuthenticated">Login</router-link>
            <a href='/account/logout' class="navbar-brand" v-if="this.$store.getters.isAuthenticated">Logout</a>
            <a href="/book/list" class="navbar-brand">Booklist</a>
        </nav>
        <router-view v-bind:csrf_token="csrf_token"/>
    </div>
</template>

<script>
    export default {
        name: "AppRouter",
        props: ['csrf_token']
    }
</script>

<style scoped>

</style>
