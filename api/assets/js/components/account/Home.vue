<template>
    <div>
        <h3 class="title-account">
            User Profile
            <small class="text-muted">Home</small>
        </h3>
        <ul class="list-group">
            <li class="list-group-item"><i class="fas fa-user"></i>{{ firstName }} {{ lastName }}</li>
            <li class="list-group-item"><i class="fas fa-envelope-square"></i>{{ email }}</li>
            <li class="list-group-item"><i class="fas fa-lock"></i>{{ roles }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Home",
        data() {
            return {
                firstName: '',
                lastName: '',
                email: '',
                roles: '',
            }
        },
        created() {
            fetch('/authenticated-user')
                .then(response => response.json())
                .then(user => {
                    console.log("user: " + user);

                    this.firstName = user.firstName
                    this.lastName = user.lastName
                    this.email = user.email
                    this.roles = user.roles
                })
        }
    }
</script>

<style scoped>
</style>
