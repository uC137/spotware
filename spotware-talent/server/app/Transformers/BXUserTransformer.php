<?php
namespace App\Transformers;

use App\BX_User;
use League\Fractal\TransformerAbstract;

class BXUserTransformer extends TransformerAbstract {

    protected $defaultIncludes = ['book'];


    /**
     * @param BX_User $bx_user
     * @return array
     */
    public function transform(BX_User $bx_user)
    {
        return [
            'User-ID'   => (int) $bx_user->{'User-ID'},
            'Location'  => (string)$bx_user->Location,
            'Age'       => (int)$bx_user->Age,
        ];


    }


    /**Include Users
     * @param BX_User $user
     * @return \League\Fractal\Resource\Item
     * @internal param BX_Book $book
     */
    public function includeBook(BX_User $user)
    {
        $books = $user->book();

        return $this->collection($books, new BXBookTransformer());
    }

}