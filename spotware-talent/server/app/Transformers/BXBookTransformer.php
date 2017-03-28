<?php
namespace App\Transformers;

use App\BX_Book;
use App\BX_User;
use App\Task;
use League\Fractal\TransformerAbstract;

class BXBookTransformer extends TransformerAbstract {

    //Temp disable user includes
    protected $defaultIncludes = ['users'];
    //protected $availableIncludes = ['user'];

    public function transform(BX_Book $bx_book)
    {
        return [
            'ISBN'                  => (string)$bx_book->ISBN,
            'Book-Title'            => $bx_book->{'Book-Title'},
            'Book-Author'           => $bx_book->{'Book-Author'},
            'Year-Of-Publication'   => (int)$bx_book->{'Year-Of-Publication'},
            'Publisher'             => $bx_book->Publisher,
            'Image-URL-S'           => $bx_book->{'Image-URL-S'},
            'Image-URL-M'           => $bx_book->{'Image-URL-M'},
            'Image-URL-L'           => $bx_book->{'Image-URL-L'},
        ];
    }


    /**Include Users
     * @param BX_Book $book
     * @return \League\Fractal\Resource\Item
     * @internal param BX_Book $book
     */
    public function includeUsers(BX_Book $book)
    {
        return $book->users() ? $this->collection($book->users(), new BXUserTransformer()) : null;
    }


}