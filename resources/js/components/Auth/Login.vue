<template>
    <div class="container-center">
        <div class="panel panel-bd">
            <div class="panel-heading">
                <div class="view-header">
                    <div class="header-icon">
                        <i class="pe-7s-unlock"></i>
                    </div>
                    <div class="header-title">
                        <h3>Login</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <form method="POST" @submit.prevent="handleLogin">
                    <div v-if="errorMessage" class="text-danger text-center" role="alert">
                        <strong>{{ errorMessage }}</strong>
                        <hr>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="username">Email</label>
                        <input v-model="form.email" type="email" placeholder="Email" title="Email" name="email"
                            id="email" class="form-control" autocomplete="email" autofocus required>
                        <span class="help-block small">Your unique email</span>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="password">Password</label>
                        <input v-model="form.password" type="password" title="Please enter your password"
                            placeholder="Password" value="" name="password" id="password" class="form-control" required>
                        <span class="help-block small">Your strong password</span>

                        <!-- <span> <a href="">
                                <b class="text-right"> Forgot Your Password?</b>
                            </a>
                        </span> -->
                    </div>

                    <div>
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    data() {
        return {
            errorMessage: '',
            form: new Form({
                name: '',
                email: '',
                password: '',
            })
        }
    },
    computed: {
        ...mapGetters([
            'authenticated'
        ])
    },
    methods: {
        async handleLogin() {
            this.$Progress.start();
            this.errorMessage = '';
            try {
                await this.$store.dispatch('login', this.form);
                this.$router.push({ name: 'dashboard' });
                Toast.fire({
                    icon: 'success',
                    title: 'Logged in successfully'
                });
                this.$Progress.finish();
            } catch (error) {
                this.$Progress.fail();
                Toast.fire({
                    icon: 'warning',
                    title: 'Wrong email or password'
                });
                this.errorMessage = error;
            }
        }
    },
    mounted() {
        if (this.authenticated) {
            this.$router.push({ name: 'dashboard' })
        }
    }
}
</script>