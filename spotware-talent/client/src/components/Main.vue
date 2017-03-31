<template>
    <div class="main">
        <p>
        <hr>
            <el-button v-if="role === 'owner' || role === 'admin'" type="text" icon="plus" @click="dialogVisible = true">New Record</el-button>

            <el-dialog title="Add Book" v-model="dialogVisible" size="tiny">
                <span slot="footer" class="dialog-footer">

                    <el-form :model="form" @submit.prevent="validateBeforeSubmit">


                        <el-form-item label="ISBN" label-width="formLabelWidth">
                            <el-input name="ISBN" v-validate:name="'required'" v-model="form.ISBN"  auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Title" label-width="formLabelWidth">
                            <el-input name="Title" v-validate:name="'required'" v-model="form.Title" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Author" label-width="formLabelWidth">
                            <el-input name="Author" v-validate="'required'" v-model="form.Author" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Publisher" label-width="formLabelWidth">
                            <el-input name="Publisher" v-validate="'required'" v-model="form.Publisher" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Year" label-width="formLabelWidth">
                            <el-input name="Year" v-validate="'required'" v-model="form.Year" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Imgage Small" label-width="formLabelWidth">
                            <el-input name="ImgS" v-validate="'required'" v-model="form.ImgS" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Imgage Medium" label-width="formLabelWidth">
                            <el-input name="ImgM" v-validate="'required'" v-model="form.ImgM" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Imgage Large" label-width="formLabelWidth">
                            <el-input name="ImgL" v-validate="'required'" v-model="form.ImgL" auto-complete="off"></el-input>
                        </el-form-item>
                    </el-form>

                    <el-button type="primary" :loading="loadingButton" @click="addBook()">Confirm</el-button>
                    <el-button @click="dialogVisible = false">Cancel</el-button>

                </span>
            </el-dialog>
        <hr>
        </p>


        <books></books>

    </div>
</template>

<script>
    import auth from '../auth/index'
    import books from "components/book/BXBooks";

    export default {
        name: 'main',
        data () {
            return {
                authenticated: auth.checkAuth(),
                dialogVisible:false,
                role: '',
                form: {
                    Author: '',
                    ISBN: '',
                    Publisher: '',
                    Title: '',
                    Year: '',
                    ImgS: '',
                    ImgM: '',
                    ImgL: '',
                },
                err:{},
                loadingButton:false
            }
        },
        mounted(){
            this.userRole()
        },
        methods: {

            logout() {
                auth.logout()
            },
            userRole(){
                let url = this.$conf.API_URL + 'role';
                this.$http.get(url)
                    .then(res => {
                        this.role = res.data.role.name;
                    })
            },
            addBook() {
                let url = this.$conf.API_URL + 'bx_books/store';
                this.loadingButton = true;
                this.$http.post(url,this.form)
                    .then(res => {
                        this.dialogVisible = false;
                        this.loadingButton = false;
                    })
                    .catch(res => {
                        this.err = res
                        console.log(this.form);
                        this.loadingButton = false;
                    })
            },
        },
        components:{
            'books' : books
        }
    }
</script>

