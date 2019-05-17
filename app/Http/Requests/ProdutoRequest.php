<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
        $id = $this->segment(3);
        
        return [
            'name' => "required|min:3|max:100|unique:produtos,name,{$id},id",
            'url' => "required|min:3|max:100|unique:produtos,url,{$id},id",
            'price' => 'required',
            'description' => 'required|max:2000',
            'categoria_id' => 'required|exists:categorias,id',
        ];
    }
}
