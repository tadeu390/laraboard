<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name' => "required|max:50|unique:menus,name,{$id},id",
            'description' => 'required|max:100',
            'icon' => 'required|max:50',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome',
            'description' => 'Descrição',
            'icon' => 'Ícone',
        ];
    }
}