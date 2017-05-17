<?php
namespace App\Transformers;

use App\BX_User;
use League\Fractal\TransformerAbstract;

class BXUserTransformer extends TransformerAbstract {

    //protected $defaultIncludes = ['book'];
    protected $availableIncludes = ['book'];


    /**
     * @param BX_User $bx_user
     * @return array
     */
    public function transform(BX_User $bx_user)
    {
        return [
            'User-ID'   => (int) $bx_user->{'User-ID'},
            'Location'  => preg_split('/[\s*,\s*]*,+[\s*,\s*]*/', ucfirst(ucwords(trim($bx_user->Location)))),
            'Age'       => (int)$bx_user->Age,
            'Rating'    => isset($bx_user->pivot) ? $bx_user->pivot->{'Book-Rating'} : null,
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