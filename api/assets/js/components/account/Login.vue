<template>
    <div>
        <h3 class="title-account">
            Login
            <small class="text-muted">Please signin</small>
        </h3>
        <form method="post" v-on:submit.prevent="sendLogin" class="form-group">
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" value="" name="email" id="inputEmail" class="form-control" v-model="email" placeholder="Email" required autofocus>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" id="inputPassword" class="form-control" v-model="password" placeholder="Password" required>
                </div>
            </div>
            <input type="hidden" name="_csrf_token" v-model="csrf_token">

            <button class="btn btn-lg btn-primary" type="submit">
                Sign in
            </button>
        </form>

        <div v-if="isError === true">
            <div class="alert alert-danger" role="alert">
                {{ errorMessage }}
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['csrf_token', 'last_email'],
        name: "Login",
        data () {
            return {
                email: '',
                password: '',
                isError: false,
                errorMessage: ''
            }
        },
        created () {
            if (this.$props.last_email !== 'undefined'){
                this.email = this.$props.last_email;
            }

            console.log('Login componenet:' + this.$store.getters.isAuthenticated );

            if (this.$store.getters.isAuthenticated === true) {
                this.$router.push('/')
            }

        },
        methods: {
            sendLogin () {
                console.log('send login form');
                fetch('/account', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        'email': this.email,
                        'password': this.password,
                        '_csrf_token': this.$props.csrf_token
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data === 'authenticated') {
                        this.$store.commit('change', true);
                        console.log('user authenticated successfully ' + this.$store.getters.isAuthenticated);
                        this.$router.push('/');
                    } else {
                        this.isError = true;
                        this.errorMessage = data
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
