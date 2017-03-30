<template>
    <div class="books">

        <section class="section">
            <div class="container">
                <div class="heading">
                    <h1 class="title">{{book.Title}}</h1>
                    <p>
                        <h3>Publication Year: <strong class="is-bold">{{book.Year}}</strong></h3>
                        <h3>Author: <strong>{{book.Author}}</strong></h3>

                    </p>
                    <hr>
                    <figure class="image">
                        <img :src="book.ImgL" alt="Image" class="image-size">
                    </figure>
                    <br>
                    <div>
                        <div v-for="user in book.users.data">
                            <strong>User Location:</strong><span v-for="location in user.Location" class="tag is-light">{{location}}</span><br>
                            <strong>User Age:</strong> <span>{{user.Age}}</span>
                        </div>
                    </div>


                </div>
            </div>
        </section>
    </div>
</template>

<script>

    export default {
        name: 'books',
        data () {
            return {
                book: []
            }
        },
        mounted(){
            //Get all books
            this.getBookDetails()
        },
        methods: {
            getBookDetails() {
                var isbn = this.$route.params.isbn;
                console.log(this.$conf.API_URL + 'bx_books/' + isbn);
                this.$http.get(this.$conf.API_URL + 'bx_books/' + isbn)
                    .then(res => this.book = res.data.data)
                    .catch(res => console.log(res))
            },

        }
    }
</script>

<style scoped>
    .image-size{
        width: 300px;
    }
</style>