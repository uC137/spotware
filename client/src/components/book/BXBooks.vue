<template>
    <div class="books">
        <br>
        <div class="columns is-multiline is-mobile">

            <div class="column is-one-quarter is-offset-1" v-for="book in books">

                <div class="card">
                    <div class="card-image">

                        <figure class="image is-3by5">
                            <router-link :to="{ name: 'BookDetails', params: { isbn: book.ISBN }}">
                                <img :src="book.ImgL" alt="Image">
                            </router-link>
                        </figure>
                    </div>

                    <div class="card-content">
                        <div class="media">
                            <div class="media-content">
                                <p class="title is-6">{{book.Title}}</p>
                            </div>
                        </div>
                        <div class="content">
                            <small><strong>ISBN:</strong> {{book.ISBN}}</small>
                            <br>
                            <small><strong>Author:</strong> {{book.Author}}</small>
                            <br>
                            <small><strong>Year:</strong> {{book.Year}}</small>
                            <br>
                            <small><strong>Avrege User Age:</strong> {{avg(book)}}</small>
                            <br>
                            <small><strong>Avrege Rook Rating:</strong> {{avg(book,true)}}</small>
                            <br>
                            <small><strong>Location:</strong><span v-for="location in countries(book)" class="tag is-light">{{location}}</span></small>
                            <br>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <br>
        <hr>

        <el-pagination class="pagination is-centered" small
                       v-loading.fullscreen.lock="loading"
                       :current-page="pagination.current_page"
                       :page-size="pagination.per_page"
                       :total="pagination.total"
                       @current-change="currentChange($event)"
                       layout="prev, pager, next" ></el-pagination>
    </div>
</template>

<script>

    export default {
        name: 'books',
        data () {
            return {
                books: [],
                pagination:{},
                loading:false
            }
        },
        mounted(){
            //Get all books
            this.getBooks()
        },
        methods: {
            countries(book){
                let userData = book.users.data,location = [];

                for (var i = 0; i < userData.length; i++) {
                    location.push(userData[i].Location)
                }

                return this.mergeDedupe(location);
            },
            mergeDedupe( arr ) // Merging arrays
            {
                return [ ...new Set( [].concat( ...arr ) ) ];
            },

            avgRating(book){
                let numberArray=book.users.data,
                    thisTotal=0,thisAverage=0;



            },

            avg(book,rating = false){
                //let count = book.users.data.length;
                //let age = book.users.data;

                let numberArray=book.users.data,
                    thisTotal=0,thisAverage=0;
                // add elements of array together
                for (var i = 0; i < numberArray.length; i++) {
                    //console.log(numberArray[i].Age);
                    (rating) ? thisTotal += numberArray[i].Rating : thisTotal += numberArray[i].Age;
                }

                let result = Math.round(thisTotal/numberArray.length);

                if(result > 0){
                    return result;
                }else {

                    return 'N/A';
                }

            },

            getBooks(page) {
                this.loading = true;
                let url = this.$conf.API_URL + 'bx_books';
                if(page){
                    url = url + '?page=' + page;
                }
                this.$http.get(url)
                    .then(res => {
                        this.books = res.data.data
                        this.pagination = res.data.meta.pagination
                        this.loading = false;
                        //console.log(res.data.meta.pagination);
                    })
                    .catch(res => console.log(res))
            },

            currentChange(page){
                this.getBooks(page)
            }

        }
    }
</script>

<style scoped>
    .task {
        margin-top: 100px;
    }
</style>