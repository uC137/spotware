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
            'ISBN'           => (string)$bx_book->ISBN,
            'Title'          => $bx_book->{'Book-Title'},
            'Author'         => $bx_book->{'Book-Author'},
            'Year'           => (int)$bx_book->{'Year-Of-Publication'},
            'Publisher'      => $bx_book->Publisher,
            'ImgS'           => $bx_book->{'Image-URL-S'},
            'ImgM'           => $bx_book->{'Image-URL-M'},
            'ImgL'           => $bx_book->{'Image-URL-L'},
        ];
    }


    /**Include Users
     * @param BX_Book $book
     * @return \League\Fractal\Resource\Item
     * @internal param BX_Book $book
     */
    public function includeUsers(BX_Book $book)
    {
        $users = $book->users()->withPivot('Book-Rating')->get();
        return $this->collection($users, new BXUserTransformer());
    }


}