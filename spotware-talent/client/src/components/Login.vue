<template>
    <div>
        <br>
        <div class="columns is-multiline">
            <form @submit.prevent="validateForm('form-1')" class="columns column is-multiline is-12" data-vv-scope="form-1">
                <legend>Enter your credentials</legend>
                <div class="column is-12">
                    <label class="label">Email</label>
                    <p class="control has-icon has-icon-right">
                        <input v-model="login.email" name="email" v-validate="'required|email'" :class="{'input': true, 'is-danger': errors.has('form-1.email') }" type="text" placeholder="Email">
                        <i v-show="errors.has('form-1.email')" class="fa fa-warning"></i>
                        <span v-show="errors.has('form-1.email')" class="help is-danger">{{ errors.first('form-1.email') }}</span>
                    </p>
                </div>
                <div class="column is-12">
                    <label class="label">Password</label>
                    <p class="control has-icon has-icon-right">
                        <input v-model="login.password" name="password" v-validate="'required|min:5'" :class="{'input': true, 'is-danger': errors.has('form-1.password') }" type="password" placeholder="Password">
                        <i v-show="errors.has('form-1.password')" class="fa fa-warning"></i>
                        <span v-show="errors.has('form-1.password')" class="help is-danger">{{ errors.first('form-1.password') }}</span>
                    </p>
                </div>
                <el-alert show-icon title="Credential Error" description="Username and password is incorrect" type="error" v-if="error"></el-alert>
                <div class="column is-12">
                    <p class="control">
                        <button class="button is-primary" :class="{'is-loading':loading}" type="submit" name="button">Login</button>
                        <button class="button is-danger" type="button" name="button" @click="errors.clear('form-1')">Clear</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    import auth from '../auth/index'
    export default {
        name: 'login',
        data () {
            return {
                loading:false,
                error:'',
                closeMessage:false,
                login :{
                    email: '',
                    password: ''
                },
            }
        },
        methods: {
            validateForm(scope) {
                this.$validator.validateAll(scope).then(success => {
                    if (this.errors.errors.length > 0) {
                        this.loading = false;
                        return;
                    }

                    auth.login(this,this.login,'/')
                });

            }
        }
    }
</script>

