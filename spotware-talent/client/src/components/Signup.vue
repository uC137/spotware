<template>
    <div class="container">
        <form @submit.prevent="validateForm('form-1')" class="columns column is-multiline is-12" data-vv-scope="form-1">
            <div class="column is-12">
                <label class="label">Name</label>
                <p class="control has-icon has-icon-right">
                    <input name="name" v-validate="'required|min:5'" :class="{'input': true, 'is-danger': errors.has('form-1.name') }" type="text" placeholder="Name">
                    <i v-show="errors.has('form-1.name')" class="fa fa-warning"></i>
                    <span v-show="errors.has('form-1.name')" class="help is-danger">{{ errors.first('form-1.name') }}</span>
                </p>
            </div>

            <div class="column is-12">
                <label class="label">Email</label>
                <p class="control has-icon has-icon-right">
                    <input name="email" v-validate="'required|email'" :class="{'input': true, 'is-danger': errors.has('form-1.email') }" type="text" placeholder="Email">
                    <i v-show="errors.has('form-1.email')" class="fa fa-warning"></i>
                    <span v-show="errors.has('form-1.email')" class="help is-danger">{{ errors.first('form-1.email') }}</span>
                </p>
            </div>
            <div class="column is-12">
                <label class="label">Password</label>
                <p class="control has-icon has-icon-right">
                    <input name="password" v-validate="'required|min:5'" :class="{'input': true, 'is-danger': errors.has('form-1.password') }" type="password" placeholder="Password">
                    <i v-show="errors.has('form-1.password')" class="fa fa-warning"></i>
                    <span v-show="errors.has('form-1.password')" class="help is-danger">{{ errors.first('form-1.password') }}</span>
                </p>
            </div>

            <div class="column is-12">
                <label class="label">Phone</label>
                <p class="control has-icon has-icon-right">
                    <input name="phone" v-validate="'required|numeric'" :class="{'input': true, 'is-danger': errors.has('form-1.phone') }" type="text" placeholder="Phone">
                    <i v-show="errors.has('form-1.phone')" class="fa fa-warning"></i>
                    <span v-show="errors.has('form-1.phone')" class="help is-danger">{{ errors.first('form-1.phone') }}</span>
                </p>
            </div>

            <div class="column is-12">
                <label class="label">Biography</label>
                <p class="control has-icon has-icon-right">
                    <textarea name="bio" v-validate="'max:255'" :class="{'textarea': true, 'is-danger': errors.has('form-1.bio') }" type="text" placeholder="Bio"></textarea>
                    <i v-show="errors.has('form-1.bio')" class="fa fa-warning"></i>
                    <span v-show="errors.has('form-1.bio')" class="help is-danger">{{ errors.first('form-1.bio') }}</span>
                </p>
            </div>

            <div class="column is-12">
                <label class="label">Image</label>
                <p class="control has-icon has-icon-right">
                    <input name="image" v-validate="'mimes:image/*'" :class="{'file': true, 'is-danger': errors.has('image') }" type="file">
                    <i v-show="errors.has('image')" class="fa fa-warning"></i>
                    <span v-show="errors.has('image')" class="help is-danger">{{ errors.first('image') }}</span>
                </p>
            </div>

            <p class="control">
                <button class="button is-primary" type="submit">Submit</button>
            </p>
        </form>
    </div>
</template>

<script>
    import auth from '../auth/index'

    export default {
        name: 'signup',
        data () {
            return {
                postData: {
                    error:'',
                    name: '',
                    email: '',
                    password: '',
                    phone: '',
                    bio: '',
                    image: '',
                }
            }
        },

        methods: {
            validateForm(scope) {
                this.$validator.validateAll(scope).then(function(result) {
                    if (result) {
                        auth.signup(this,this.postData,'/')
                    }
                });

            }
        }

    }
</script>
