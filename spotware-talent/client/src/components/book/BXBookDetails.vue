<template>
    <div class="books">
        <br><br>
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">{{book.Title}}</p>
            </header>
            <div class="card-content">
                <div class="content">
                    <div class="heading">
                        <div>
                            <span>Publication Year: <strong class="is-bold">{{book.Year}}</strong></span><br>
                            <span>Author: <strong>{{book.Author}}</strong></span>
                            <!--<div v-for="user in book.users.data">
                                <blockquote>
                                    <span>User Location:</span>
                                        <span v-for="location in user.Location" >
                                            <span>{{location}}</span>
                                        </span>
                                    <br>
                                    <span>User Age:</span> <strong>{{user.Age}}</strong>
                                </blockquote>
                            </div>-->
                        </div>
                        <hr>
                        <figure class="image"><img :src="book.ImgL" alt="Image" class="image-size"></figure>
                        <br>
                    </div>
                </div>
            </div>
            <footer class="card-footer">
                <el-button v-if="role === 'owner' || role === 'admin'" class="card-footer-item" type="text" icon="edit" @click="dialogVisible = true">Edit</el-button>
                <el-button v-if="role === 'owner'" class="card-footer-item" type="text" icon="delete"  @click="deleteBook()">Delete</el-button>
            </footer>



            <el-dialog title="Edit Book" v-model="dialogVisible" size="tiny">
                <span slot="footer" class="dialog-footer">

                    <el-form :model="form">
                        <el-form-item label="Title" label-width="formLabelWidth">
                            <el-input v-model="form.Title" auto-complete="off"></el-input>
                        </el-form-item>

                        <el-form-item label="Author" label-width="formLabelWidth">
                            <el-input v-model="form.Author" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Publisher" label-width="formLabelWidth">
                            <el-input v-model="form.Publisher" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Year" label-width="formLabelWidth">
                            <el-input v-model="form.Year" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Imgage Small" label-width="formLabelWidth">
                            <el-input v-model="form.ImgS" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Imgage Medium" label-width="formLabelWidth">
                            <el-input v-model="form.ImgM" auto-complete="off"></el-input>
                        </el-form-item>
                        <el-form-item label="Imgage Large" label-width="formLabelWidth">
                            <el-input v-model="form.ImgL" auto-complete="off"></el-input>
                        </el-form-item>
                    </el-form>

                    <el-button @click="dialogVisible = false">Cancel</el-button>
                    <el-button type="primary" :loading="loadingButton" @click="updateBook(book)">Confirm</el-button>


                </span>
            </el-dialog>

        </div>


    </div>
</template>

<script>

    export default {
        name: 'books',
        data () {
            return {
                book: {},
                form: {},
                role: 'admin',
                dialogVisible: false,
                loadingButton: false,
                formLabelWidth: '120px'
            }
        },
        mounted(){
            //Get all books
            this.getBookDetails()
            this.userRole()
        },
        methods: {
            getBookDetails() {
                var isbn = this.$route.params.isbn;
                this.$http.get(this.$conf.API_URL + 'bx_books/' + isbn)
                    .then(res => {
                        this.book = res.data.data;
                        this.form = res.data.data;
                    })
                    .catch(res => this.$router.push('/'))
            },

            userRole(){
                let url = this.$conf.API_URL + 'role';
                this.$http.get(url)
                    .then(res => {
                        this.role = res.data.role.name;
                    })
                    .catch(res => console.log(res))
            },

            deleteBook() {
                this.$msgbox({
                    title: 'Delete Book',
                    message: 'Are you sure you want to delete this book!',
                    showCancelButton: true,
                    confirmButtonText: 'Delete',
                    cancelButtonText: 'Cancel',
                    beforeClose: (action, instance, done) => {
                        if (action === 'confirm') {
                            instance.confirmButtonLoading = true;
                            instance.confirmButtonText = 'Loading...';

                            let isbn = this.$route.params.isbn;
                            let url = this.$conf.API_URL + 'bx_books/delete/' + isbn;
                            this.$http.delete(url)
                                .then(res => {
                                    instance.confirmButtonLoading = false;
                                    window.location = '/';
                                })
                                .catch(res => console.log(res))
                        } else {
                            done();
                        }
                    }
                }).then(action => {
                });
            },

            updateBook(book) {
                let isbn = this.$route.params.isbn;
                let url = this.$conf.API_URL + 'bx_books/update/' + isbn;
                this.loadingButton = true;
                this.$http.put(url,this.form)
                    .then(res => {
                        this.dialogVisible = false;
                        this.loadingButton = false;
                    })
                    .catch(res => console.log(res))
            },

        }
    }

</script>

<style scoped>
    .image-size {
        width: 300px;
    }
</style>