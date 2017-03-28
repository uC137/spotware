<?php

namespace App\Http\Controllers;

use App\BX_User;
use App\Transformers\BXUserTransformer;

class BX_UsersController extends Controller
{

    /**
     * @return \Dingo\Api\Http\Response
     */
    public function index()
    {
        $bx_users = BX_User::paginate();
        return $this->response->paginator($bx_users, new BXUserTransformer());
    }


    /**Show Data by id
     * @param $user_id
     * @return \Dingo\Api\Http\Response|void
     */
    public function show($user_id)
    {
        //return $isbn;
        try{
            return $book = BX_User::where('User-ID','=',$user_id)->with('book')->firstOrFail();
            return $this->response->item($book,new BXUserTransformer());
        }catch (ModelNotFoundException $e){
            return $this->response->error('Model Not Found',500);
        }
    }


}
