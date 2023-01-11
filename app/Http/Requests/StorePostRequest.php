<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        return [
            'title' => 'required|unique:posts|max:150|min:3',
            'content' => 'nullable'
        ];
    }
    public function messages(){
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.min' => 'Il titolo deve essere lungo almeno :min caratteri.',
            'title.max' => 'Il titolo non può superare i :max caratteri.',
            'title.unique:posts' => 'Il titolo esiste già'
        ];
    }
}
