<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class storeUpdatePost extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id= $this->segment(2);
        $rules = [
            'title' => [
                'required',
                'min:3',
                'max:160',
                Rule::unique('posts')->ignore($id),

            ],
            'content' => 'nullable|min:5|max:10000',
            'image' => 'required|image',

        ];

        if($this->method() == 'PUT'){
            $rules['image'] = ['nullable','image'];

        }
        //Se o metodo for put, a imagem deixa de ser obrigatoria


        return $rules;
    }
}
