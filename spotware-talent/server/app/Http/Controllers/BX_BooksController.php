<?php

namespace App\Http\Controllers;

use App\BX_Book;
use App\Transformers\BXBookTransformer;
use App\Transformers\BXUserTransformer;
use League\Fractal\Manager;

class BX_BooksController extends Controller
{


    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $bx_books = BX_Book::paginate();
        return $this->response->paginator($bx_books, new BXBookTransformer());
    }


    /** Show Data by id
     * @param $isbn
     * @return \Dingo\Api\Http\Response|void
     */
    public function show($isbn)
    {
        try{
            $book = BX_Book::with(['users'])->where('BX-Books.ISBN',$isbn)->get();
            return $this->response->item($book,new BXBookTransformer());
        }catch (ModelNotFoundException $e){
            return $this->response->error('Model Not Found',500);
        }
    }

}
