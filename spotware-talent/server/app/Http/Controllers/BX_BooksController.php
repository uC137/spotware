<?php

namespace App\Http\Controllers;

use App\BX_Book;
use App\Http\Requests\BooksRequest;
use App\Transformers\BXBookTransformer;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BX_BooksController extends Controller
{

    use Helpers;

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $bx_books = BX_Book::with(['users'])->orderBy('Year-Of-Publication','DESC')->paginate();
        return $this->response->paginator($bx_books, new BXBookTransformer());
    }


    /** Show Data by id
     * @param $isbn
     * @return \Dingo\Api\Http\Response|void
     */
    public function show($isbn)
    {
        try{
            $book = BX_Book::where('ISBN',$isbn)->firstOrFail();
            return $this->response->item($book,new BXBookTransformer(),['users',$book]);
        }catch (ModelNotFoundException $e){
            return $this->response->error('Model Not Found',500);
        }
    }


    /**Store data
     * @param BooksRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function store(BooksRequest $request)
    {
        try{
            $isbn = $request->input('ISBN');
            $exists = DB::table('BX-Books')->select('BX-Books.ISBN')->where('BX-Books.ISBN','=',$isbn)->count();
            if(!!$exists){
                return $this->response->error('Duplicate Record',401 );
            }
            $book = new BX_Book();
            $book->{'ISBN'} = $request->get('ISBN');
            $book->{'Book-Title'} = $request->get('Book-Title');
            $book->{'Book-Author'} = $request->get('Book-Author');
            $book->{'Publisher'} = $request->get('Publisher');
            $book->{'Year-Of-Publication'} = $request->get('Year-Of-Publication');
            $book->{'Image-URL-S'} = $request->get('Image-URL-S');
            $book->{'Image-URL-M'} = $request->get('Image-URL-M');
            $book->{'Image-URL-L'} = $request->get('Image-URL-L');
            $book->save();

            return $this->response->item($book,new BXBookTransformer());
        }catch (StoreResourceFailedException $e){
            return $this->response->error('Cannot Store Record',422 );
        }
    }


    /**Update Data
     * @param $isbn
     * @param BooksRequest|Request $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function update($isbn,Request $request)
    {
        try{
            $book = BX_Book::where('ISBN','=',$isbn)->firstorFail();
            $book->update([
                //'ISBN'                  => $request->get('ISBN'),
                'Book-Title'            => $request->get('Title'),
                'Book-Author'           => $request->get('Author'),
                'Publisher'             => $request->get('Publisher'),
                'Year-Of-Publication'   => $request->get('Year'),
                'Image-URL-S'           => $request->get('ImgS'),
                'Image-URL-M'           => $request->get('ImgM'),
                'Image-URL-L'           => $request->get('ImgL'),
            ]);
            if($book){
                return $this->response->item($book,new BXBookTransformer());
            }else{
                return $this->response->error('Cannot Update Record',422 );
            }
        }catch (UpdateResourceFailedException $e){
            return $this->response->error('Cannot Update Record',422 );
        }
    }


    /**Destroy a record
     * @param $isbn
     */
    public function destroy($isbn)
    {
        try{
            $book = BX_Book::where('BX-Books.ISBN',$isbn)->firstOrFail();
            $book->delete();
            return $this->response->array(["Record ISBN: {$isbn} was deleted"]);
        }catch (DeleteResourceFailedException $e){
            return $this->response->error('Cannot Delete Record',422 );
        }
    }


}
