<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPosts extends FormRequest
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
            //'title' => 'required|unique:posts|max:255',
           // 'content' => 'required',
            //'categories_id' => 'required',
           // 'description' => 'required',
           // 'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'É preciso inserir um :attribute',
        ];
    }
}
