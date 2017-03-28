<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ISBN'                  => 'required|alpha_num',
            'Book-Title'            => 'required|alpha_num',
            'Book-Author'           => 'required|alpha_num',
            'Year-Of-Publication'   => 'required|numeric',
            'Publisher'             => 'required',
            'Image-URL-S'           => 'required',
            'Image-URL-M'           => 'required',
            'Image-URL-L'           => 'required',
        ];
    }
}


